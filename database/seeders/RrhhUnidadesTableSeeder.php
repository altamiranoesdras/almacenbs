<?php

namespace Database\Seeders;

use App\Models\Bodega;
use App\Models\RrhhUnidad;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RrhhUnidadesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        deshabilitaLlavesForaneas();

        RrhhUnidad::truncate();
        Bodega::truncate();

        $centros = [
            10426 => "Centro de Capacitación y Formación Integral (CCFI)",
            10515 => "CENTRO DE ATENCIÓN INTEGRAL MIXCO",
            10516 => "Departamento de atención no residencial Casa Joven (Mixco)",
            10517 => "Departamento de niñez y adolescencia migrante no acompañada (Guatemala)",
            11403 => "CENTRO DE ATENCIÓN INTEGRAL COMITANCILLO",
            11983 => "CENTRO DE PROTECCION INTEGRAL Y ABRIGO TEMPORAL DE ADOLESCENTES",
            1254 => "CENTRO DE ATENCION INTEGRAL CUILAPA",
            12700 => "CENTRO DE ATENCIÓN INTEGRAL CONCEPCIÓN TUTUAPA",
            12701 => "Unidad de Genero",
            12705 => "Departamento de atención no residencial Casa Joven (Villa Nueva)",
            12710 => "Departamento de atención no residencial Casa Joven (Palencia)",
            1301 => "CENTRO DE ATENCIÓN INTEGRAL CHIMALTENANGO",
            1302 => "CENTRO DE ATENCIÓN INTEGRAL CAI VILLA NUEVA",
            1340 => "CENTRO DE ATENCION INTEGRAL ZACAPA",
            1341 => "CENTRO DE ATENCIÓN INTEGRAL SAN PEDRO SAN MARCOS",
            1343 => "COORDINACIÓN DE PROTECCIÓN Y ACOGIMIENTO A LA NIÑEZ Y ADOLESCENCIA.",
            14361 => "EDUCANDO EN FAMILIA",
            14362 => "Prevencion Terciaria",
            14364 => "Departamento de Atención y Orientación especializada a niñez y adolescencia no institucionaliza y su familia",
            15071 => "CENTRO JUVENIL DE PRIVACIÓN DE LIBERTAD PARA MUJERES CEJUPLIM (GORRIONES)",
            15072 => "DEPARTAMENTO DE ATENCIÓN NO RESIDENCIAL CASA JOVEN. (Peronia)",
            15073 => "CENTRO DE ATENCIÓN INTEGRAL SAN PEDRO AYAMPUC",
            15087 => "ORGANO DE CONTROL INTERNO",
            1543 => "CENTRO DE ATENCION INTEGRAL TOTONICAPAN",
            1597 => "CENTRO DE ATENCIÓN INTEGRAL SAN PEDRO SACATEPEQUEZ",
            16350 => "Centro De Atención Integral SAN MIGUEL PETAPA",
            16351 => "Centro de Formación QUÉDATE (Santa María Visitación)",
            16361 => "Sede Departamental ALTA VERAPAZ",
            16363 => "Sede Departamental ZACAPA",
            16365 => "Sede Departamental SAN MARCOS",
            16366 => "Sede Departamental BAJA VERAPAZ",
            16369 => "Sede Departamental PETÉN",
            16371 => "Sede Departamental SUCHITEPEQUEZ",
            16372 => "Sede Departamental QUETZALTENANGO",
            16373 => "Sede Departamental JUTIAPA",
            16374 => "Sede Departamental GUATEMALA",
            16375 => "Sede Departamental IZABAL",
            16376 => "Sede Departamental ESCUINTLA",
            16377 => "Sede Departamental SOLOLA",
            16378 => "Sede Departamental HUEHUETENANGO",
            16379 => "Sede Departamental SACATEPEQUEZ",
            16380 => "Sede Departamental QUICHE",
            16994 => "DIRECCIÓN HOGAR SEGURO VIRGEN DE LA ASUNCIÓN",
            16998 => "Dirección de Protección Especial Residencial Hogar Seguro Virgen de la Asunción. (QUETZALTENANGO)",
            16999 => "Dirección de Protección Especial Residencial Hogar Seguro Virgen de la Asunción. (QUETZALTENANGO LA ESPERANZA)",
            17000 => "Sede Departamental CHIMALTENANGO",
            17001 => "Dirección de Protección Especial Residencial Hogar Seguro Virgen de la Asunción. (QUET-QUET)",
            17002 => "Centro de Formación QUÉDATE JOYABAJ",
            1704 => "CENTRO DE ATENCION INTEGRAL ESCUINTLA",
            1739 => "CENTRO DE ATENCIÓN INTEGRAL BETHANIA",
            1740 => "CENTRO DE ATENCIÓN INTEGRAL HUEHUETENANGO",
            17884 => "Atención a niñez y adolescencia victima de violencia sexual, explotación y trata de personas (COATEPEQUE)",
            17885 => "Atención a niñez y adolescencia victima de violencia sexual, explotación y trata de personas (GUATEMALA)",
            17886 => "CENTRO DE ATENCIÓN INTEGRAL COATEPEQUE",
            17891 => "Centro de Educación Especial San Cristobal Totonicapan",
            17893 => "CASA INTERMEDIA",
            1822 => "Departamento de Protección Especial de Primera Infancia (Zacapa)",
            1837 => "CENTRO DE ATENCIÓN INTEGRAL CHIQUIMULA",
            1841 => "CENTRO DE ATENCIÓN INTEGRAL PRESIDENTA",
            1842 => "CENTRO DE ATENCIÓN INTEGRAL PARROQUIA",
            1843 => "CENTRO DE ATENCIÓN INTEGRAL JÍCARO",
            1845 => "CENTRO DE ATENCIÓN INTEGRAL SAN JUAN BAUTISTA",
            1846 => "CENTRO DE ATENCIÓN INTEGRAL SOLOLÁ",
            1847 => "CENTRO DE ATENCIÓN INTEGRAL MAZATENANGO",
            1848 => "CENTRO DE ATENCIÓN INTEGRAL ZONA 5",
            18841 => "CENTRO ESPECIALIZADO DE REINSERCION -CER-",
            1915 => "Centro Juvenil de Detención Provisional CEJUDEP(GAVIOTAS)",
            2018 => "CENTRO DE ATENCION INTEGRAL ESQUIPULAS",
            20385 => "CENTRO DE ATENCIÓN INTEGRAL PETÉN",
            20386 => "Centro de Educación Especial San Juan Bautista",
            20387 => "Centro de Formación Quédate (Malacatancito)",
            20388 => "Programa Especializado Para Niñez y Adolescencia, Víctimas de Violencia Sexual, Explotación y Trata de Personas",
            20389 => "CASA JOVEN AMATITLAN",
            21683 => "Departamento de Protección Especial a la Niñez y Adolescencia con Capacidades Diferentes Leve y Moderada (San Lucas Sacatepequez)",
            21686 => "Programa Especializado Para Niñez y Adolescencia, Víctimas de Violencia Sexual, Explotación y Trata de Personas",
            2263 => "CENTRO DE ATENCION INTEGRAL JALAPA",
            2355 => "CENTRO DE ATENCIÓN INTEGRAL ZONA 6",
            2356 => "CENTRO DE ATENCIÓN INTEGRAL RETALHULEU",
            2357 => "CENTRO DE EDUCACION ESPECIAL ALIDA ESPAÑA DE ARANA",
            2455 => "CENTRO DE ATENCIÓN INTEGRAL SALAMÁ",
            2457 => "CENTRO DE ATENCIÓN INTEGRAL SAN MARCOS",
            2589 => "CENTRO DE ATENCIÓN INTEGRAL GUASTATOYA",
            2657 => "CENTRO DE ATENCION INTEGRAL QUETZALTENANGO",
            2694 => "CENTRO DE ATENCION INTEGRAL RIO HONDO",
            2800 => "CENTRO DE ATENCIÓN INTEGRAL COLÓN",
            2801 => "CENTRO DE ATENCIÓN INTEGRAL CIUDAD PERONIA",
            2842 => "CENTRO DE ATENCION INTEGRAL PUERTO BARRIOS",
            2843 => "CENTRO DE ATENCIÓN INTEGRAL ZONA 1 BOLIVAR",
            2844 => "CENTRO DE ATENCIÓN INTEGRAL QUICHÉ",
            2845 => "CENTRO DE ATENCIÓN INTEGRAL TERMINAL",
            2880 => "Centro Especializado de Reinsercion -CER 1-",
            2933 => "Departamento de Protección a la Niñez y Adolescencia con Capacidades Diferentes Severa y Profunda",
            2934 => "Departamento de niñez y adolescencia migrante no acompañada (Quetzaltenango)",
            2935 => "COORDINACIÓN DE SUBSECRETARÍA DE PRESERVACIÓN FAMILIAR, FORTALECIMIENTO Y APOYO COMUNITARIO",
            2967 => "Departamento de Acogimiento Familiar Temporal (Familias Sustitutas)",
            3080 => "CENTRO DE ATENCIÓN INTEGRAL JUTIAPA",
            3378 => "CENTRO DE ATENCIÓN INTEGRAL ZONA 3",
            3457 => "Departamento de protección a la niñez y adolescencia VVS con enfoque de genero (Quetzaltenango)",
            3458 => "Centro Juvenil de Privación de Libertad para Varones CEJUPLIV(ETAPA II)",
            3633 => "CENTRO DE CAPACITACION OCUPACIONAL",
            3673 => "CENTRO DE ATENCIÓN INTEGRAL ZONA 19",
            3674 => "CENTRO DE ATENCIÓN INTEGRAL COBÁN",
            4259 => "ORGANO DE APOYO TÉCNICO",
            4322 => "ÓRGANOS DE ADMINISTRACIÓN",
            4323 => "COORDINACION PARA REINSERCION Y RESOCIALIZACIÓN DE ADOLESCENTES EN CONFLICTO CON LA LEY PENAL",
            4324 => "DEPARTAMENTO DE REGULACIÓN DE CENTROS DE CUIDADO INFANTIL DIARIO -DRCCID-",
            4556 => "Medidas Socioeducativas",
            4614 => "SUBSIDIOS FAMILIARES",
            5760 => "DESPACHO SUPERIOR",
            5895 => "COMISIÓN NACIONAL DE LA NIÑEZ Y ADOLESCENCIA"
        ];

        foreach ($centros as $codigo => $nombre) {
            RrhhUnidad::create([
                'codigo' => $codigo,
                'nombre' => $nombre,
                'activa' => 'si',
            ]);
        }

        foreach (RrhhUnidad::all() as $unidad) {
            Bodega::create([
                'nombre' => $unidad->nombre,
            ]);
        }


    }
}
