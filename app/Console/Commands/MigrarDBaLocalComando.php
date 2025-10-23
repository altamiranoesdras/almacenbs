<?php

namespace App\Console\Commands;

use App\Conexiones\SFTP;
use App\Conexiones\SSH;
use App\Traits\ComandosTrait;
use Carbon\Carbon;
use Config;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use ZipArchive;

class MigrarDBaLocalComando extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrar:produccion_a_local';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    private $ssh;
    private $sftp;
    private $fechaBackup;

    private $directorioDescarga;

    private $directorioExtrae;

    private $nombreAplicacionRemota = "almacenbs";

    private $rutaAplicacion = "/var/www/almacenbs";

    private $nombreBaseDatos;

    /**
     * Create a new command instance.
     *
     * @return void
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        $this->ssh = new SSH(false);
        $this->sftp = new SFTP(false);

        $this->fechaBackup = Carbon::now()->format('Y-m-d');
        $this->nombreBaseDatos = config('database.connections.mysql.database');
        $this->directorioDescarga = storage_path('temp/backups');
        $this->directorioExtrae = storage_path('temp/backups_ext');

    }

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle(): int
    {

        //pregunta con opciones
        $ejecuta = $this->askWithCompletion('¿Ejecutar copia de bases de datos en producción (si/no)?', ['si', 'no'], 'si');
        $descargaYextrae = $this->askWithCompletion("¿Descargar y extraer archivo de respaldo (si/no)?", ['si', 'no'], 'si');
        $restaura = $this->askWithCompletion("¿Restaurar bases de datos (si/no)?", ['si', 'no'], 'si');
        $elimina = $this->askWithCompletion("¿Eliminar backup locale (si/no)?", ['si', 'no'], 'si');

        if ($ejecuta=="si"){
            $this->ejecutaScriptEnServidor();
        }

        if ($descargaYextrae=="si"){
            $this->descargarArchivos();
            $this->extraerArchivos();
        }

        if ($restaura=="si"){
            $this->restaurarBasesDatos();
        }

        if ($elimina=="si"){
            $this->eliminarBackUpsLocas();
        }

        $this->info('-----------------------------------');
        $this->info('   ✓✓ Proceso finalizado ✓✓');
        $this->info('-----------------------------------');

        return 0;

    }




    public function ejecutaScriptEnServidor(): void
    {


        $this->warn('------------------------------------------');
        $this->warn('Ejecutar script en el servidor remoto');
        $this->warn('------------------------------------------');

        $this->line("Conectando mediante ssh...");

        $this->ssh->conectarConLlavePrivada();

        $this->line('Ejecutando script...');

        $comandoBackup = "cd $this->rutaAplicacion && php artisan backup:run --only-db --disable-notifications --no-interaction --filename=$this->fechaBackup.zip";

        $this->ssh->conexion->setTimeout(0);

        $output =  $this->ssh->ejecutar($comandoBackup);

        $this->line("");
        $this->line("Output:\n$output");
        $this->line("");
        $this->info("✓✓ Script ejecutado.");

        $this->ssh->desconectar();

    }

    /**
     * @throws \Exception
     */
    public function descargarArchivos(): void
    {
        $this->line('-----------------------------------');
        $this->warn('Descargando archivos de respaldo');
        $this->line('-----------------------------------');

        $this->line("Conectando mediante sftp...");
        $this->sftp->conectarConLlavePrivada();

        //crea directorio si no existe
        if (!is_dir($this->directorioDescarga)) {
            mkdir($this->directorioDescarga, 0777, true);
        }

        $nombreArchivo = $this->fechaBackup.".zip";
        $rutaRemota = "$this->rutaAplicacion/storage/app/$this->nombreAplicacionRemota/".$nombreArchivo;
        $rutaLocal = $this->directorioDescarga."/".$nombreArchivo;


        $this->line("Descargando $nombreArchivo...");

        if (!$this->sftp->descargar($rutaRemota, $rutaLocal)) {
            $this->error("Error al descargar.");
        } else {
            $this->info("✓✓");
        }

        $this->sftp->desconectar();

    }


    public function extraerArchivos(): void
    {
        $this->warn('-----------------------------------');
        $this->warn('Extrayendo archivos de respaldo...');
        $this->warn('-----------------------------------');

        //crea directorio si no existe
        if (!is_dir($this->directorioExtrae)) {
            mkdir($this->directorioExtrae, 0777, true);
        }

        $nombreArchivo = $this->fechaBackup.".zip";
        $rutaArchivo = $this->rutaBackupZip();
        $rutaDescomprime = $this->directorioExtrae;

        $this->line("Extrayendo $nombreArchivo...");

        if (!file_exists($rutaArchivo)) {
            $this->error("No existe el archivo.");
            return;
        }
        $zip = new ZipArchive;
        if ($zip->open($rutaArchivo) === TRUE) {
            $zip->extractTo($rutaDescomprime);
            $zip->close();
            $this->info("✓✓");

        } else {
             $this->error("Error al descomprimir.");
        }


    }


    public function restaurarBasesDatos(): void
    {
        $this->warn('----------------------------');
        $this->warn('Restaurando base de datos...');
        $this->warn('----------------------------');

        $nombreArchivo = "mysql-$this->nombreBaseDatos.sql";
        $rutaBackup = "$this->directorioExtrae/db-dumps/$nombreArchivo";

        if (!file_exists($rutaBackup)) {
            $this->error("No existe el archivo: ".$nombreArchivo);
            return;
        }

        $this->line("Desconectando de la base de datos...");
        Config::set('database.connections.mysql.database', null);

        $this->line("Borrando base de datos...");
        DB::statement('DROP DATABASE IF EXISTS ' . $this->nombreBaseDatos);

        $this->line("Creando base de datos...");
        DB::statement('CREATE DATABASE ' . $this->nombreBaseDatos);

        // Volvemos a conectar a la base de datos recién creada
        Config::set('database.connections.mysql.database', $this->nombreBaseDatos);
        DB::reconnect('mysql');

        $this->line("Importando datos desde archivo $nombreArchivo...");

        // --- Inicio de la lógica robusta ---

        // 1. Obtenemos la ruta al ejecutable de mysql desde .env
        // ¡Aquí es donde lee tu nueva ruta de DBngin!
        $mysqlPath = env('MYSQL_CLI_PATH', 'mysql');

        // 2. Obtenemos las credenciales desde la configuración de Laravel
        $dbConfig = config('database.connections.mysql');

        $username = escapeshellarg($dbConfig['username']);
        $password = $dbConfig['password'];
        $database = escapeshellarg($this->nombreBaseDatos);
        $host = escapeshellarg($dbConfig['host']);
        $port = escapeshellarg($dbConfig['port']);

        // 3. Construimos el argumento de la contraseña de forma segura
        $passwordArg = '';
        if (!empty($password)) {
            $passwordArg = "--password=" . escapeshellarg($password);
        }
        // (En macOS/Linux con DBngin, si la contraseña está vacía,
        // no enviar el argumento --password es lo correcto)

        // 4. Escapamos la ruta del archivo de backup
        $rutaBackupEscapada = escapeshellarg($rutaBackup);

        // 5. Construimos y ejecutamos el comando completo
        $command = "$mysqlPath -h $host -P $port -u $username $passwordArg $database < $rutaBackupEscapada";

        // exec() para ejecutar el comando
        exec($command, $output, $return_var);

        // 6. Manejo de errores
        if ($return_var !== 0) {
            $this->error('¡Error! Ocurrió un problema durante la importación de MySQL.');
            $this->error('Comando ejecutado: ' . $command);
            $this->error('Salida de error: ' . implode("\n", $output));
            return;
        }

        // --- Fin de la lógica robusta ---

        $this->info('✓✓ Base de datos restaurada con éxito.');
    }

    public function eliminarBackUpsLocas()
    {
        $this->line('Eliminando backups locales...');

        if(File::exists($this->directorioDescarga)){
            File::cleanDirectory($this->directorioDescarga);
        }

        if(File::exists($this->directorioExtrae)){
            File::cleanDirectory($this->directorioExtrae);
        }

        $this->info('✓✓');

    }

    public function rutaBackupSql($uuid): string
    {
        return storage_path("temp/backups_ext/".$this->fechaBackup.".sql");

    }

    public function rutaBackupZip(): string
    {
        return storage_path("temp/backups/".$this->fechaBackup.".zip");
    }



}
