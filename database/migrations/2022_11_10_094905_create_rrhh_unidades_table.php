<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRrhhUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabla de tipos si aún no existe
        if (!Schema::hasTable('rrhh_unidad_tipos')) {
            Schema::create('rrhh_unidad_tipos', function (Blueprint $table) {
                $table->id();
                $table->string('nombre')->unique();
                $table->unsignedTinyInteger('nivel')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }

        Schema::create('rrhh_unidades', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique('rrhh_unidades_codigo_UNIQUE');
            $table->string('nombre');

            $table->foreignId('centro_id')
                ->constrained('costo_centros')
                ->onDelete('cascade')
                ->index('fk_rrhh_unidades_costo_centros1_idx');

            $table->foreignId('unidad_tipo_id')
                ->default(1) // Asumiendo que el tipo por defecto es el de nivel 1
                ->constrained('rrhh_unidad_tipos')
                ->onDelete('cascade');

            $table->foreignId('unidad_padre_id')
                ->nullable()
                ->constrained('rrhh_unidades')
                ->onDelete('cascade');

            $table->unsignedBigInteger('jefe_id')
                ->nullable()
                ->index('fk_rrhh_unidades_rrhh_colaboradores1_idx');
            $table->enum('activa', ['si', 'no'])->default('si');
            $table->enum('solicita', ['si', 'no'])->default('si');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rrhh_unidades');
        Schema::dropIfExists('rrhh_unidad_tipos');
    }
}
