<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ItemPresentacionesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('item_presentaciones')->delete();
        
        \DB::table('item_presentaciones')->insert(array (
            0 => 
            array (
                'id' => 1,
                'codigo' => NULL,
                'nombre' => 'Bolsa',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'codigo' => NULL,
                'nombre' => 'Caja',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'codigo' => NULL,
                'nombre' => 'Sobre',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'codigo' => NULL,
                'nombre' => 'Frasco',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'codigo' => NULL,
                'nombre' => 'Envase',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'codigo' => NULL,
                'nombre' => 'Unidad',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'codigo' => NULL,
                'nombre' => 'Envase espray',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'codigo' => NULL,
                'nombre' => 'Botella',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'codigo' => NULL,
                'nombre' => 'Bote',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'codigo' => NULL,
                'nombre' => 'Lata',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'codigo' => NULL,
                'nombre' => 'Envase spray',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'codigo' => NULL,
                'nombre' => 'Galón',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'codigo' => NULL,
                'nombre' => 'Botella pet',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'codigo' => NULL,
                'nombre' => 'Evanse',
                'created_at' => '2022-12-27 19:20:48',
                'updated_at' => '2022-12-27 19:20:48',
                'deleted_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'codigo' => NULL,
                'nombre' => 'Manojo',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'codigo' => NULL,
                'nombre' => 'Empaque',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'codigo' => NULL,
                'nombre' => 'Garrafón',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'codigo' => NULL,
                'nombre' => 'Vaso',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'codigo' => NULL,
                'nombre' => 'Cupón',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'codigo' => NULL,
                'nombre' => 'Paquete',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'codigo' => NULL,
                'nombre' => 'Red',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'codigo' => NULL,
                'nombre' => 'Trenza',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'codigo' => NULL,
                'nombre' => 'Cabeza',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'codigo' => NULL,
                'nombre' => 'Mazo',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'codigo' => NULL,
                'nombre' => 'Saco',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'codigo' => NULL,
                'nombre' => 'Ración',
                'created_at' => '2022-12-27 19:20:49',
                'updated_at' => '2022-12-27 19:20:49',
                'deleted_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'codigo' => NULL,
                'nombre' => 'Porción',
                'created_at' => '2022-12-27 19:20:50',
                'updated_at' => '2022-12-27 19:20:50',
                'deleted_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'codigo' => NULL,
                'nombre' => 'Fardo',
                'created_at' => '2022-12-27 19:20:50',
                'updated_at' => '2022-12-27 19:20:50',
                'deleted_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'codigo' => NULL,
                'nombre' => 'Pichel',
                'created_at' => '2022-12-27 19:20:50',
                'updated_at' => '2022-12-27 19:20:50',
                'deleted_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'codigo' => NULL,
                'nombre' => 'Tetra pak',
                'created_at' => '2022-12-27 19:20:51',
                'updated_at' => '2022-12-27 19:20:51',
                'deleted_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'codigo' => NULL,
                'nombre' => 'Tetra pack',
                'created_at' => '2022-12-27 19:20:51',
                'updated_at' => '2022-12-27 19:20:51',
                'deleted_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'codigo' => NULL,
                'nombre' => 'Bandeja',
                'created_at' => '2022-12-27 19:20:54',
                'updated_at' => '2022-12-27 19:20:54',
                'deleted_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'codigo' => NULL,
                'nombre' => 'Filete',
                'created_at' => '2022-12-27 19:20:54',
                'updated_at' => '2022-12-27 19:20:54',
                'deleted_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'codigo' => NULL,
                'nombre' => 'Trozo',
                'created_at' => '2022-12-27 19:20:54',
                'updated_at' => '2022-12-27 19:20:54',
                'deleted_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'codigo' => NULL,
                'nombre' => 'Paquete / caja',
                'created_at' => '2022-12-27 19:20:54',
                'updated_at' => '2022-12-27 19:20:54',
                'deleted_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'codigo' => NULL,
                'nombre' => 'Bolsa/paquete',
                'created_at' => '2022-12-27 19:20:55',
                'updated_at' => '2022-12-27 19:20:55',
                'deleted_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'codigo' => NULL,
                'nombre' => 'Barra',
                'created_at' => '2022-12-27 19:20:55',
                'updated_at' => '2022-12-27 19:20:55',
                'deleted_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'codigo' => NULL,
                'nombre' => 'Pote',
                'created_at' => '2022-12-27 19:20:55',
                'updated_at' => '2022-12-27 19:20:55',
                'deleted_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'codigo' => NULL,
                'nombre' => 'Domo',
                'created_at' => '2022-12-27 19:20:55',
                'updated_at' => '2022-12-27 19:20:55',
                'deleted_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'codigo' => NULL,
                'nombre' => 'Cartón',
                'created_at' => '2022-12-27 19:20:57',
                'updated_at' => '2022-12-27 19:20:57',
                'deleted_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'codigo' => NULL,
                'nombre' => 'Tarro',
                'created_at' => '2022-12-27 19:20:57',
                'updated_at' => '2022-12-27 19:20:57',
                'deleted_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'codigo' => NULL,
                'nombre' => 'Bolsa doy pack',
                'created_at' => '2022-12-27 19:21:01',
                'updated_at' => '2022-12-27 19:21:01',
                'deleted_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'codigo' => NULL,
                'nombre' => 'Envase tetra pack',
                'created_at' => '2022-12-27 19:21:01',
                'updated_at' => '2022-12-27 19:21:01',
                'deleted_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'codigo' => NULL,
                'nombre' => 'Copa',
                'created_at' => '2022-12-27 19:21:04',
                'updated_at' => '2022-12-27 19:21:04',
                'deleted_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'codigo' => NULL,
                'nombre' => 'Manga',
                'created_at' => '2022-12-27 19:21:04',
                'updated_at' => '2022-12-27 19:21:04',
                'deleted_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'codigo' => NULL,
                'nombre' => 'Blíster',
                'created_at' => '2022-12-27 19:21:04',
                'updated_at' => '2022-12-27 19:21:04',
                'deleted_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'codigo' => NULL,
                'nombre' => 'Bolsa de papel',
                'created_at' => '2022-12-27 19:21:05',
                'updated_at' => '2022-12-27 19:21:05',
                'deleted_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'codigo' => NULL,
                'nombre' => 'Paleta',
                'created_at' => '2022-12-27 19:21:05',
                'updated_at' => '2022-12-27 19:21:05',
                'deleted_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'codigo' => NULL,
                'nombre' => 'Cono',
                'created_at' => '2022-12-27 19:21:05',
                'updated_at' => '2022-12-27 19:21:05',
                'deleted_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'codigo' => NULL,
                'nombre' => 'Barrita',
                'created_at' => '2022-12-27 19:21:05',
                'updated_at' => '2022-12-27 19:21:05',
                'deleted_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'codigo' => NULL,
            'nombre' => 'Envase (squeeze)',
                'created_at' => '2022-12-27 19:21:06',
                'updated_at' => '2022-12-27 19:21:06',
                'deleted_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'codigo' => NULL,
                'nombre' => 'Caja tetrapack',
                'created_at' => '2022-12-27 19:21:08',
                'updated_at' => '2022-12-27 19:21:08',
                'deleted_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'codigo' => NULL,
                'nombre' => 'Taza',
                'created_at' => '2022-12-27 19:21:08',
                'updated_at' => '2022-12-27 19:21:08',
                'deleted_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'codigo' => NULL,
                'nombre' => 'Redecilla',
                'created_at' => '2022-12-27 19:21:09',
                'updated_at' => '2022-12-27 19:21:09',
                'deleted_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'codigo' => NULL,
                'nombre' => 'Bola',
                'created_at' => '2022-12-27 19:21:11',
                'updated_at' => '2022-12-27 19:21:11',
                'deleted_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'codigo' => NULL,
                'nombre' => 'Cubeta',
                'created_at' => '2022-12-27 19:21:12',
                'updated_at' => '2022-12-27 19:21:12',
                'deleted_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'codigo' => NULL,
                'nombre' => 'Costal / saco',
                'created_at' => '2022-12-27 19:21:14',
                'updated_at' => '2022-12-27 19:21:14',
                'deleted_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'codigo' => NULL,
                'nombre' => 'Tira',
                'created_at' => '2022-12-27 19:21:16',
                'updated_at' => '2022-12-27 19:21:16',
                'deleted_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'codigo' => NULL,
                'nombre' => 'Bulto',
                'created_at' => '2022-12-27 19:21:20',
                'updated_at' => '2022-12-27 19:21:20',
                'deleted_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'codigo' => NULL,
                'nombre' => 'Marqueta',
                'created_at' => '2022-12-27 19:21:20',
                'updated_at' => '2022-12-27 19:21:20',
                'deleted_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'codigo' => NULL,
                'nombre' => 'Libra',
                'created_at' => '2022-12-27 19:21:22',
                'updated_at' => '2022-12-27 19:21:22',
                'deleted_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'codigo' => NULL,
                'nombre' => 'Botella de vidrio',
                'created_at' => '2022-12-27 19:21:24',
                'updated_at' => '2022-12-27 19:21:24',
                'deleted_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'codigo' => NULL,
                'nombre' => 'Dispensador',
                'created_at' => '2022-12-27 19:21:25',
                'updated_at' => '2022-12-27 19:21:25',
                'deleted_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'codigo' => NULL,
                'nombre' => 'Costal',
                'created_at' => '2022-12-27 19:21:32',
                'updated_at' => '2022-12-27 19:21:32',
                'deleted_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'codigo' => NULL,
                'nombre' => 'Paca',
                'created_at' => '2022-12-27 19:21:32',
                'updated_at' => '2022-12-27 19:21:32',
                'deleted_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'codigo' => NULL,
                'nombre' => 'Tonel',
                'created_at' => '2022-12-27 19:21:32',
                'updated_at' => '2022-12-27 19:21:32',
                'deleted_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
                'codigo' => NULL,
                'nombre' => 'Plancha',
                'created_at' => '2022-12-27 19:21:37',
                'updated_at' => '2022-12-27 19:21:37',
                'deleted_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'codigo' => NULL,
                'nombre' => 'Par',
                'created_at' => '2022-12-27 19:21:38',
                'updated_at' => '2022-12-27 19:21:38',
                'deleted_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'codigo' => NULL,
                'nombre' => 'Pieza',
                'created_at' => '2022-12-27 19:21:40',
                'updated_at' => '2022-12-27 19:21:40',
                'deleted_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'codigo' => NULL,
                'nombre' => 'Metro lineal',
                'created_at' => '2022-12-27 19:21:40',
                'updated_at' => '2022-12-27 19:21:40',
                'deleted_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'codigo' => NULL,
                'nombre' => 'Docena',
                'created_at' => '2022-12-27 19:21:49',
                'updated_at' => '2022-12-27 19:21:49',
                'deleted_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'codigo' => NULL,
                'nombre' => 'Botella:',
                'created_at' => '2022-12-27 19:22:01',
                'updated_at' => '2022-12-27 19:22:01',
                'deleted_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'codigo' => NULL,
                'nombre' => 'Bidón',
                'created_at' => '2022-12-27 19:22:02',
                'updated_at' => '2022-12-27 19:22:02',
                'deleted_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'codigo' => NULL,
                'nombre' => 'Frasco/sobre',
                'created_at' => '2022-12-27 19:22:04',
                'updated_at' => '2022-12-27 19:22:04',
                'deleted_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'codigo' => NULL,
                'nombre' => 'Maleta',
                'created_at' => '2022-12-27 19:22:11',
                'updated_at' => '2022-12-27 19:22:11',
                'deleted_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'codigo' => NULL,
                'nombre' => 'Ramo',
                'created_at' => '2022-12-27 19:22:16',
                'updated_at' => '2022-12-27 19:22:16',
                'deleted_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'codigo' => NULL,
                'nombre' => 'Ciento',
                'created_at' => '2022-12-27 19:22:40',
                'updated_at' => '2022-12-27 19:22:40',
                'deleted_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'codigo' => NULL,
                'nombre' => 'Envase aerosol',
                'created_at' => '2022-12-27 19:22:41',
                'updated_at' => '2022-12-27 19:22:41',
                'deleted_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'codigo' => NULL,
                'nombre' => 'Madeja',
                'created_at' => '2022-12-27 19:22:50',
                'updated_at' => '2022-12-27 19:22:50',
                'deleted_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'codigo' => NULL,
                'nombre' => 'Metro cuadrado',
                'created_at' => '2022-12-27 19:22:55',
                'updated_at' => '2022-12-27 19:22:55',
                'deleted_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'codigo' => NULL,
                'nombre' => 'Metro cúbico',
                'created_at' => '2022-12-27 19:22:55',
                'updated_at' => '2022-12-27 19:22:55',
                'deleted_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'codigo' => NULL,
                'nombre' => 'Rollo',
                'created_at' => '2022-12-27 19:22:57',
                'updated_at' => '2022-12-27 19:22:57',
                'deleted_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'codigo' => NULL,
                'nombre' => 'Carrete',
                'created_at' => '2022-12-27 19:22:57',
                'updated_at' => '2022-12-27 19:22:57',
                'deleted_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'codigo' => NULL,
                'nombre' => 'Pliego',
                'created_at' => '2022-12-27 19:22:58',
                'updated_at' => '2022-12-27 19:22:58',
                'deleted_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'codigo' => NULL,
                'nombre' => 'Bobina',
                'created_at' => '2022-12-27 19:23:00',
                'updated_at' => '2022-12-27 19:23:00',
                'deleted_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'codigo' => NULL,
                'nombre' => 'Ovillo',
                'created_at' => '2022-12-27 19:23:00',
                'updated_at' => '2022-12-27 19:23:00',
                'deleted_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'codigo' => NULL,
                'nombre' => 'Yarda',
                'created_at' => '2022-12-27 19:23:04',
                'updated_at' => '2022-12-27 19:23:04',
                'deleted_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'codigo' => NULL,
                'nombre' => 'Juego',
                'created_at' => '2022-12-27 19:23:10',
                'updated_at' => '2022-12-27 19:23:10',
                'deleted_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'codigo' => NULL,
                'nombre' => 'Pie',
                'created_at' => '2022-12-27 19:24:14',
                'updated_at' => '2022-12-27 19:24:14',
                'deleted_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'codigo' => NULL,
                'nombre' => 'Set',
                'created_at' => '2022-12-27 19:24:17',
                'updated_at' => '2022-12-27 19:24:17',
                'deleted_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'codigo' => NULL,
                'nombre' => 'Resma',
                'created_at' => '2022-12-27 19:27:43',
                'updated_at' => '2022-12-27 19:27:43',
                'deleted_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'codigo' => NULL,
                'nombre' => 'Bloc',
                'created_at' => '2022-12-27 19:27:45',
                'updated_at' => '2022-12-27 19:27:45',
                'deleted_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
                'codigo' => NULL,
                'nombre' => 'Talonario',
                'created_at' => '2022-12-27 19:27:54',
                'updated_at' => '2022-12-27 19:27:54',
                'deleted_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'codigo' => NULL,
                'nombre' => 'Block',
                'created_at' => '2022-12-27 19:28:01',
                'updated_at' => '2022-12-27 19:28:01',
                'deleted_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'codigo' => NULL,
                'nombre' => 'Hoja',
                'created_at' => '2022-12-27 19:28:04',
                'updated_at' => '2022-12-27 19:28:04',
                'deleted_at' => NULL,
            ),
            95 => 
            array (
                'id' => 96,
                'codigo' => NULL,
                'nombre' => 'Paquete/rollo',
                'created_at' => '2022-12-27 19:28:36',
                'updated_at' => '2022-12-27 19:28:36',
                'deleted_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'codigo' => NULL,
                'nombre' => 'Tubo',
                'created_at' => '2022-12-27 19:28:45',
                'updated_at' => '2022-12-27 19:28:45',
                'deleted_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'codigo' => NULL,
                'nombre' => 'Caja / paquete',
                'created_at' => '2022-12-27 19:28:45',
                'updated_at' => '2022-12-27 19:28:45',
                'deleted_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'codigo' => NULL,
                'nombre' => 'Tomo',
                'created_at' => '2022-12-27 19:30:05',
                'updated_at' => '2022-12-27 19:30:05',
                'deleted_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'codigo' => NULL,
                'nombre' => 'Kit',
                'created_at' => '2022-12-27 19:30:13',
                'updated_at' => '2022-12-27 19:30:13',
                'deleted_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'codigo' => NULL,
                'nombre' => 'Individual',
                'created_at' => '2022-12-27 19:31:17',
                'updated_at' => '2022-12-27 19:31:17',
                'deleted_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'codigo' => NULL,
                'nombre' => 'Tiraje',
                'created_at' => '2022-12-27 19:31:20',
                'updated_at' => '2022-12-27 19:31:20',
                'deleted_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'codigo' => NULL,
                'nombre' => 'Ampolla',
                'created_at' => '2022-12-27 19:31:27',
                'updated_at' => '2022-12-27 19:31:27',
                'deleted_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'codigo' => NULL,
                'nombre' => 'Cilindro',
                'created_at' => '2022-12-27 19:31:31',
                'updated_at' => '2022-12-27 19:31:31',
                'deleted_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'codigo' => NULL,
                'nombre' => 'Carga',
                'created_at' => '2022-12-27 19:31:31',
                'updated_at' => '2022-12-27 19:31:31',
                'deleted_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'codigo' => NULL,
                'nombre' => 'Recarga',
                'created_at' => '2022-12-27 19:31:31',
                'updated_at' => '2022-12-27 19:31:31',
                'deleted_at' => NULL,
            ),
            106 => 
            array (
                'id' => 107,
                'codigo' => NULL,
                'nombre' => 'Recipiente',
                'created_at' => '2022-12-27 19:31:33',
                'updated_at' => '2022-12-27 19:31:33',
                'deleted_at' => NULL,
            ),
            107 => 
            array (
                'id' => 108,
                'codigo' => NULL,
                'nombre' => 'Disco',
                'created_at' => '2022-12-27 19:31:35',
                'updated_at' => '2022-12-27 19:31:35',
                'deleted_at' => NULL,
            ),
            108 => 
            array (
                'id' => 109,
                'codigo' => NULL,
                'nombre' => 'Gotero',
                'created_at' => '2022-12-27 19:31:38',
                'updated_at' => '2022-12-27 19:31:38',
                'deleted_at' => NULL,
            ),
            109 => 
            array (
                'id' => 110,
                'codigo' => NULL,
                'nombre' => 'Prueba',
                'created_at' => '2022-12-27 19:31:38',
                'updated_at' => '2022-12-27 19:31:38',
                'deleted_at' => NULL,
            ),
            110 => 
            array (
                'id' => 111,
                'codigo' => NULL,
                'nombre' => 'Vial',
                'created_at' => '2022-12-27 19:31:40',
                'updated_at' => '2022-12-27 19:31:40',
                'deleted_at' => NULL,
            ),
            111 => 
            array (
                'id' => 112,
                'codigo' => NULL,
                'nombre' => 'Frasco/empaque',
                'created_at' => '2022-12-27 19:31:43',
                'updated_at' => '2022-12-27 19:31:43',
                'deleted_at' => NULL,
            ),
            112 => 
            array (
                'id' => 113,
                'codigo' => NULL,
                'nombre' => 'Caneca',
                'created_at' => '2022-12-27 19:31:48',
                'updated_at' => '2022-12-27 19:31:48',
                'deleted_at' => NULL,
            ),
            113 => 
            array (
                'id' => 114,
                'codigo' => NULL,
                'nombre' => 'Reacciones por kit',
                'created_at' => '2022-12-27 19:32:54',
                'updated_at' => '2022-12-27 19:32:54',
                'deleted_at' => NULL,
            ),
            114 => 
            array (
                'id' => 115,
                'codigo' => NULL,
                'nombre' => 'Lámina',
                'created_at' => '2022-12-27 19:33:01',
                'updated_at' => '2022-12-27 19:33:01',
                'deleted_at' => NULL,
            ),
            115 => 
            array (
                'id' => 116,
                'codigo' => NULL,
                'nombre' => 'Tarjeta',
                'created_at' => '2022-12-27 19:33:21',
                'updated_at' => '2022-12-27 19:33:21',
                'deleted_at' => NULL,
            ),
            116 => 
            array (
                'id' => 117,
                'codigo' => NULL,
                'nombre' => 'Caja petri',
                'created_at' => '2022-12-27 19:33:49',
                'updated_at' => '2022-12-27 19:33:49',
                'deleted_at' => NULL,
            ),
            117 => 
            array (
                'id' => 118,
                'codigo' => NULL,
                'nombre' => 'Frasco gotero',
                'created_at' => '2022-12-27 19:34:19',
                'updated_at' => '2022-12-27 19:34:19',
                'deleted_at' => NULL,
            ),
            118 => 
            array (
                'id' => 119,
                'codigo' => NULL,
                'nombre' => 'Casete',
                'created_at' => '2022-12-27 19:34:20',
                'updated_at' => '2022-12-27 19:34:20',
                'deleted_at' => NULL,
            ),
            119 => 
            array (
                'id' => 120,
                'codigo' => NULL,
                'nombre' => 'Taxo',
                'created_at' => '2022-12-27 19:34:57',
                'updated_at' => '2022-12-27 19:34:57',
                'deleted_at' => NULL,
            ),
            120 => 
            array (
                'id' => 121,
                'codigo' => NULL,
                'nombre' => 'Ciclo',
                'created_at' => '2022-12-27 19:35:24',
                'updated_at' => '2022-12-27 19:35:24',
                'deleted_at' => NULL,
            ),
            121 => 
            array (
                'id' => 122,
                'codigo' => NULL,
                'nombre' => 'Tambor',
                'created_at' => '2022-12-27 19:35:38',
                'updated_at' => '2022-12-27 19:35:38',
                'deleted_at' => NULL,
            ),
            122 => 
            array (
                'id' => 123,
                'codigo' => NULL,
                'nombre' => 'Contenedor',
                'created_at' => '2022-12-27 19:35:46',
                'updated_at' => '2022-12-27 19:35:46',
                'deleted_at' => NULL,
            ),
            123 => 
            array (
                'id' => 124,
                'codigo' => NULL,
                'nombre' => 'Tableta',
                'created_at' => '2022-12-27 19:37:01',
                'updated_at' => '2022-12-27 19:37:01',
                'deleted_at' => NULL,
            ),
            124 => 
            array (
                'id' => 125,
                'codigo' => NULL,
                'nombre' => 'Tambo',
                'created_at' => '2022-12-27 19:37:02',
                'updated_at' => '2022-12-27 19:37:02',
                'deleted_at' => NULL,
            ),
            125 => 
            array (
                'id' => 126,
                'codigo' => NULL,
                'nombre' => 'Kit de reacciones',
                'created_at' => '2022-12-27 19:37:49',
                'updated_at' => '2022-12-27 19:37:49',
                'deleted_at' => NULL,
            ),
            126 => 
            array (
                'id' => 127,
                'codigo' => NULL,
                'nombre' => 'Reacciones',
                'created_at' => '2022-12-27 19:37:58',
                'updated_at' => '2022-12-27 19:37:58',
                'deleted_at' => NULL,
            ),
            127 => 
            array (
                'id' => 128,
                'codigo' => NULL,
                'nombre' => 'Frasco plástico',
                'created_at' => '2022-12-27 19:38:00',
                'updated_at' => '2022-12-27 19:38:00',
                'deleted_at' => NULL,
            ),
            128 => 
            array (
                'id' => 129,
                'codigo' => NULL,
                'nombre' => 'Enase',
                'created_at' => '2022-12-27 19:38:13',
                'updated_at' => '2022-12-27 19:38:13',
                'deleted_at' => NULL,
            ),
            129 => 
            array (
                'id' => 130,
                'codigo' => NULL,
            'nombre' => 'Juego (pruebas)',
                'created_at' => '2022-12-27 19:38:49',
                'updated_at' => '2022-12-27 19:38:49',
                'deleted_at' => NULL,
            ),
            130 => 
            array (
                'id' => 131,
                'codigo' => NULL,
                'nombre' => 'Vale',
                'created_at' => '2022-12-27 19:38:50',
                'updated_at' => '2022-12-27 19:38:50',
                'deleted_at' => NULL,
            ),
            131 => 
            array (
                'id' => 132,
                'codigo' => NULL,
                'nombre' => 'Cartucho',
                'created_at' => '2022-12-27 19:38:56',
                'updated_at' => '2022-12-27 19:38:56',
                'deleted_at' => NULL,
            ),
            132 => 
            array (
                'id' => 133,
                'codigo' => NULL,
                'nombre' => 'Termo',
                'created_at' => '2022-12-27 19:39:00',
                'updated_at' => '2022-12-27 19:39:00',
                'deleted_at' => NULL,
            ),
            133 => 
            array (
                'id' => 134,
                'codigo' => NULL,
                'nombre' => 'Panel',
                'created_at' => '2022-12-27 19:39:33',
                'updated_at' => '2022-12-27 19:39:33',
                'deleted_at' => NULL,
            ),
            134 => 
            array (
                'id' => 135,
                'codigo' => NULL,
                'nombre' => 'Membrana',
                'created_at' => '2022-12-27 19:39:37',
                'updated_at' => '2022-12-27 19:39:37',
                'deleted_at' => NULL,
            ),
            135 => 
            array (
                'id' => 136,
                'codigo' => NULL,
            'nombre' => 'Kit (2 frascos)',
                'created_at' => '2022-12-27 19:39:57',
                'updated_at' => '2022-12-27 19:39:57',
                'deleted_at' => NULL,
            ),
            136 => 
            array (
                'id' => 137,
                'codigo' => NULL,
                'nombre' => 'Salchicha',
                'created_at' => '2022-12-27 19:41:07',
                'updated_at' => '2022-12-27 19:41:07',
                'deleted_at' => NULL,
            ),
            137 => 
            array (
                'id' => 138,
                'codigo' => NULL,
                'nombre' => 'Bolsa/envase',
                'created_at' => '2022-12-27 19:41:14',
                'updated_at' => '2022-12-27 19:41:14',
                'deleted_at' => NULL,
            ),
            138 => 
            array (
                'id' => 139,
                'codigo' => NULL,
                'nombre' => 'Pomo',
                'created_at' => '2022-12-27 19:41:14',
                'updated_at' => '2022-12-27 19:41:14',
                'deleted_at' => NULL,
            ),
            139 => 
            array (
                'id' => 140,
                'codigo' => NULL,
                'nombre' => 'Estuche',
                'created_at' => '2022-12-27 19:41:53',
                'updated_at' => '2022-12-27 19:41:53',
                'deleted_at' => NULL,
            ),
            140 => 
            array (
                'id' => 141,
                'codigo' => NULL,
            'nombre' => 'Kit (6 frascos)',
                'created_at' => '2022-12-27 19:41:55',
                'updated_at' => '2022-12-27 19:41:55',
                'deleted_at' => NULL,
            ),
            141 => 
            array (
                'id' => 142,
                'codigo' => NULL,
                'nombre' => 'Cuebta',
                'created_at' => '2022-12-27 19:42:15',
                'updated_at' => '2022-12-27 19:42:15',
                'deleted_at' => NULL,
            ),
            142 => 
            array (
                'id' => 143,
                'codigo' => NULL,
                'nombre' => 'Litro',
                'created_at' => '2022-12-27 19:42:19',
                'updated_at' => '2022-12-27 19:42:19',
                'deleted_at' => NULL,
            ),
            143 => 
            array (
                'id' => 144,
                'codigo' => NULL,
                'nombre' => 'Empaque / frasco',
                'created_at' => '2022-12-27 19:42:30',
                'updated_at' => '2022-12-27 19:42:30',
                'deleted_at' => NULL,
            ),
            144 => 
            array (
                'id' => 145,
                'codigo' => NULL,
                'nombre' => 'Jeringa prellenada',
                'created_at' => '2022-12-27 19:42:44',
                'updated_at' => '2022-12-27 19:42:44',
                'deleted_at' => NULL,
            ),
            145 => 
            array (
                'id' => 146,
                'codigo' => NULL,
            'nombre' => 'Envase millicurie (mci)',
                'created_at' => '2022-12-27 19:42:55',
                'updated_at' => '2022-12-27 19:42:55',
                'deleted_at' => NULL,
            ),
            146 => 
            array (
                'id' => 147,
                'codigo' => NULL,
                'nombre' => 'Fasco',
                'created_at' => '2022-12-27 19:42:57',
                'updated_at' => '2022-12-27 19:42:57',
                'deleted_at' => NULL,
            ),
            147 => 
            array (
                'id' => 148,
                'codigo' => NULL,
                'nombre' => 'Envase:',
                'created_at' => '2022-12-27 19:43:08',
                'updated_at' => '2022-12-27 19:43:08',
                'deleted_at' => NULL,
            ),
            148 => 
            array (
                'id' => 149,
                'codigo' => NULL,
                'nombre' => 'Jeringa',
                'created_at' => '2022-12-27 19:44:28',
                'updated_at' => '2022-12-27 19:44:28',
                'deleted_at' => NULL,
            ),
            149 => 
            array (
                'id' => 150,
                'codigo' => NULL,
                'nombre' => 'Aerosol',
                'created_at' => '2022-12-27 19:44:29',
                'updated_at' => '2022-12-27 19:44:29',
                'deleted_at' => NULL,
            ),
            150 => 
            array (
                'id' => 151,
                'codigo' => NULL,
                'nombre' => 'Envase con atomizador',
                'created_at' => '2022-12-27 19:44:32',
                'updated_at' => '2022-12-27 19:44:32',
                'deleted_at' => NULL,
            ),
            151 => 
            array (
                'id' => 152,
                'codigo' => NULL,
                'nombre' => 'Frasco con gotero',
                'created_at' => '2022-12-27 19:44:40',
                'updated_at' => '2022-12-27 19:44:40',
                'deleted_at' => NULL,
            ),
            152 => 
            array (
                'id' => 153,
                'codigo' => NULL,
                'nombre' => 'Blíter',
                'created_at' => '2022-12-27 19:44:56',
                'updated_at' => '2022-12-27 19:44:56',
                'deleted_at' => NULL,
            ),
            153 => 
            array (
                'id' => 154,
                'codigo' => NULL,
                'nombre' => 'Vial con disolvente',
                'created_at' => '2022-12-27 19:45:13',
                'updated_at' => '2022-12-27 19:45:13',
                'deleted_at' => NULL,
            ),
            154 => 
            array (
                'id' => 155,
                'codigo' => NULL,
                'nombre' => 'Cápsula / tableta',
                'created_at' => '2022-12-27 19:45:18',
                'updated_at' => '2022-12-27 19:45:18',
                'deleted_at' => NULL,
            ),
            155 => 
            array (
                'id' => 156,
                'codigo' => NULL,
                'nombre' => 'Envase  spray',
                'created_at' => '2022-12-27 19:45:26',
                'updated_at' => '2022-12-27 19:45:26',
                'deleted_at' => NULL,
            ),
            156 => 
            array (
                'id' => 157,
                'codigo' => NULL,
                'nombre' => 'Spray',
                'created_at' => '2022-12-27 19:45:29',
                'updated_at' => '2022-12-27 19:45:29',
                'deleted_at' => NULL,
            ),
            157 => 
            array (
                'id' => 158,
                'codigo' => NULL,
                'nombre' => 'Envase aspersor',
                'created_at' => '2022-12-27 19:45:38',
                'updated_at' => '2022-12-27 19:45:38',
                'deleted_at' => NULL,
            ),
            158 => 
            array (
                'id' => 159,
                'codigo' => NULL,
                'nombre' => 'Envase aspesor',
                'created_at' => '2022-12-27 19:45:38',
                'updated_at' => '2022-12-27 19:45:38',
                'deleted_at' => NULL,
            ),
            159 => 
            array (
                'id' => 160,
                'codigo' => NULL,
                'nombre' => 'Frasco presurizado',
                'created_at' => '2022-12-27 19:45:53',
                'updated_at' => '2022-12-27 19:45:53',
                'deleted_at' => NULL,
            ),
            160 => 
            array (
                'id' => 161,
                'codigo' => NULL,
            'nombre' => 'Envase dosificador (dosis)',
                'created_at' => '2022-12-27 19:45:55',
                'updated_at' => '2022-12-27 19:45:55',
                'deleted_at' => NULL,
            ),
            161 => 
            array (
                'id' => 162,
                'codigo' => NULL,
                'nombre' => 'Frasco vial',
                'created_at' => '2022-12-27 19:46:21',
                'updated_at' => '2022-12-27 19:46:21',
                'deleted_at' => NULL,
            ),
            162 => 
            array (
                'id' => 163,
                'codigo' => NULL,
                'nombre' => 'Frasco spray',
                'created_at' => '2022-12-27 19:46:50',
                'updated_at' => '2022-12-27 19:46:50',
                'deleted_at' => NULL,
            ),
            163 => 
            array (
                'id' => 164,
                'codigo' => NULL,
                'nombre' => 'Envase spay',
                'created_at' => '2022-12-27 19:46:56',
                'updated_at' => '2022-12-27 19:46:56',
                'deleted_at' => NULL,
            ),
            164 => 
            array (
                'id' => 165,
                'codigo' => NULL,
                'nombre' => 'Frasco aerosol',
                'created_at' => '2022-12-27 19:46:58',
                'updated_at' => '2022-12-27 19:46:58',
                'deleted_at' => NULL,
            ),
            165 => 
            array (
                'id' => 166,
                'codigo' => NULL,
                'nombre' => 'Frasco ampolla',
                'created_at' => '2022-12-27 19:47:38',
                'updated_at' => '2022-12-27 19:47:38',
                'deleted_at' => NULL,
            ),
            166 => 
            array (
                'id' => 167,
                'codigo' => NULL,
                'nombre' => 'Óvulo',
                'created_at' => '2022-12-27 19:47:59',
                'updated_at' => '2022-12-27 19:47:59',
                'deleted_at' => NULL,
            ),
            167 => 
            array (
                'id' => 168,
                'codigo' => NULL,
                'nombre' => 'Frosco',
                'created_at' => '2022-12-27 19:48:02',
                'updated_at' => '2022-12-27 19:48:02',
                'deleted_at' => NULL,
            ),
            168 => 
            array (
                'id' => 169,
                'codigo' => NULL,
                'nombre' => 'Empaque / lata',
                'created_at' => '2022-12-27 19:48:20',
                'updated_at' => '2022-12-27 19:48:20',
                'deleted_at' => NULL,
            ),
            169 => 
            array (
                'id' => 170,
                'codigo' => NULL,
                'nombre' => 'Envase calendario',
                'created_at' => '2022-12-27 19:48:22',
                'updated_at' => '2022-12-27 19:48:22',
                'deleted_at' => NULL,
            ),
            170 => 
            array (
                'id' => 171,
                'codigo' => NULL,
                'nombre' => 'Tubo con aplicador',
                'created_at' => '2022-12-27 19:48:24',
                'updated_at' => '2022-12-27 19:48:24',
                'deleted_at' => NULL,
            ),
            171 => 
            array (
                'id' => 172,
                'codigo' => NULL,
                'nombre' => 'Pluma precargada',
                'created_at' => '2022-12-27 19:48:25',
                'updated_at' => '2022-12-27 19:48:25',
                'deleted_at' => NULL,
            ),
            172 => 
            array (
                'id' => 173,
                'codigo' => NULL,
                'nombre' => 'Dispositivo prellenado',
                'created_at' => '2022-12-27 19:48:29',
                'updated_at' => '2022-12-27 19:48:29',
                'deleted_at' => NULL,
            ),
            173 => 
            array (
                'id' => 174,
                'codigo' => NULL,
            'nombre' => 'Dispositivo prellenado (dosis)',
                'created_at' => '2022-12-27 19:48:29',
                'updated_at' => '2022-12-27 19:48:29',
                'deleted_at' => NULL,
            ),
            174 => 
            array (
                'id' => 175,
                'codigo' => NULL,
                'nombre' => 'Ampolla bebible',
                'created_at' => '2022-12-27 19:48:30',
                'updated_at' => '2022-12-27 19:48:30',
                'deleted_at' => NULL,
            ),
            175 => 
            array (
                'id' => 176,
                'codigo' => NULL,
                'nombre' => 'Vial / frasco',
                'created_at' => '2022-12-27 19:48:40',
                'updated_at' => '2022-12-27 19:48:40',
                'deleted_at' => NULL,
            ),
            176 => 
            array (
                'id' => 177,
                'codigo' => NULL,
                'nombre' => 'Envase con aplicador',
                'created_at' => '2022-12-27 19:49:09',
                'updated_at' => '2022-12-27 19:49:09',
                'deleted_at' => NULL,
            ),
            177 => 
            array (
                'id' => 178,
                'codigo' => NULL,
                'nombre' => 'Monovial',
                'created_at' => '2022-12-27 19:49:28',
                'updated_at' => '2022-12-27 19:49:28',
                'deleted_at' => NULL,
            ),
            178 => 
            array (
                'id' => 179,
                'codigo' => NULL,
                'nombre' => 'Jeringa prellanada',
                'created_at' => '2022-12-27 19:49:32',
                'updated_at' => '2022-12-27 19:49:32',
                'deleted_at' => NULL,
            ),
            179 => 
            array (
                'id' => 180,
                'codigo' => NULL,
                'nombre' => 'Pluma',
                'created_at' => '2022-12-27 19:49:33',
                'updated_at' => '2022-12-27 19:49:33',
                'deleted_at' => NULL,
            ),
            180 => 
            array (
                'id' => 181,
                'codigo' => NULL,
                'nombre' => 'Clicker',
                'created_at' => '2022-12-27 19:49:38',
                'updated_at' => '2022-12-27 19:49:38',
                'deleted_at' => NULL,
            ),
            181 => 
            array (
                'id' => 182,
                'codigo' => NULL,
                'nombre' => 'Cartucho dental de vidrio',
                'created_at' => '2022-12-27 19:50:14',
                'updated_at' => '2022-12-27 19:50:14',
                'deleted_at' => NULL,
            ),
            182 => 
            array (
                'id' => 183,
                'codigo' => NULL,
                'nombre' => 'Envase roll on',
                'created_at' => '2022-12-27 19:50:21',
                'updated_at' => '2022-12-27 19:50:21',
                'deleted_at' => NULL,
            ),
            183 => 
            array (
                'id' => 184,
                'codigo' => NULL,
                'nombre' => 'Cápsula',
                'created_at' => '2022-12-27 19:51:47',
                'updated_at' => '2022-12-27 19:51:47',
                'deleted_at' => NULL,
            ),
            184 => 
            array (
                'id' => 185,
                'codigo' => NULL,
                'nombre' => 'Envase aspersor de 60 dosis',
                'created_at' => '2022-12-27 19:51:50',
                'updated_at' => '2022-12-27 19:51:50',
                'deleted_at' => NULL,
            ),
            185 => 
            array (
                'id' => 186,
                'codigo' => NULL,
                'nombre' => 'Frasco aspersor',
                'created_at' => '2022-12-27 19:52:11',
                'updated_at' => '2022-12-27 19:52:11',
                'deleted_at' => NULL,
            ),
            186 => 
            array (
                'id' => 187,
                'codigo' => NULL,
            'nombre' => 'Frasco aspersor (dosis)',
                'created_at' => '2022-12-27 19:52:12',
                'updated_at' => '2022-12-27 19:52:12',
                'deleted_at' => NULL,
            ),
            187 => 
            array (
                'id' => 188,
                'codigo' => NULL,
                'nombre' => 'Frasco inhalador',
                'created_at' => '2022-12-27 19:52:13',
                'updated_at' => '2022-12-27 19:52:13',
                'deleted_at' => NULL,
            ),
            188 => 
            array (
                'id' => 189,
                'codigo' => NULL,
                'nombre' => 'Frasco/bolsa',
                'created_at' => '2022-12-27 19:52:22',
                'updated_at' => '2022-12-27 19:52:22',
                'deleted_at' => NULL,
            ),
            189 => 
            array (
                'id' => 190,
                'codigo' => NULL,
                'nombre' => 'Aplicador con esponja',
                'created_at' => '2022-12-27 19:52:24',
                'updated_at' => '2022-12-27 19:52:24',
                'deleted_at' => NULL,
            ),
            190 => 
            array (
                'id' => 191,
                'codigo' => NULL,
                'nombre' => 'Vial / ampolla',
                'created_at' => '2022-12-27 19:52:46',
                'updated_at' => '2022-12-27 19:52:46',
                'deleted_at' => NULL,
            ),
            191 => 
            array (
                'id' => 192,
                'codigo' => NULL,
                'nombre' => 'Jeringa prellenda',
                'created_at' => '2022-12-27 19:53:34',
                'updated_at' => '2022-12-27 19:53:34',
                'deleted_at' => NULL,
            ),
            192 => 
            array (
                'id' => 193,
                'codigo' => NULL,
                'nombre' => 'Ampolla / vial',
                'created_at' => '2022-12-27 19:53:38',
                'updated_at' => '2022-12-27 19:53:38',
                'deleted_at' => NULL,
            ),
            193 => 
            array (
                'id' => 194,
                'codigo' => NULL,
                'nombre' => 'Perla',
                'created_at' => '2022-12-27 19:53:41',
                'updated_at' => '2022-12-27 19:53:41',
                'deleted_at' => NULL,
            ),
            194 => 
            array (
                'id' => 195,
                'codigo' => NULL,
                'nombre' => 'Millar',
                'created_at' => '2022-12-27 20:00:11',
                'updated_at' => '2022-12-27 20:00:11',
                'deleted_at' => NULL,
            ),
            195 => 
            array (
                'id' => 196,
                'codigo' => NULL,
                'nombre' => 'Milesimas de pulgada',
                'created_at' => '2022-12-27 20:00:12',
                'updated_at' => '2022-12-27 20:00:12',
                'deleted_at' => NULL,
            ),
            196 => 
            array (
                'id' => 197,
                'codigo' => NULL,
                'nombre' => 'Lío',
                'created_at' => '2022-12-27 20:04:07',
                'updated_at' => '2022-12-27 20:04:07',
                'deleted_at' => NULL,
            ),
            197 => 
            array (
                'id' => 198,
                'codigo' => NULL,
                'nombre' => 'Material',
                'created_at' => '2022-12-27 20:05:17',
                'updated_at' => '2022-12-27 20:05:17',
                'deleted_at' => NULL,
            ),
            198 => 
            array (
                'id' => 199,
                'codigo' => NULL,
            'nombre' => 'Unidad(es)',
                'created_at' => '2022-12-27 20:05:31',
                'updated_at' => '2022-12-27 20:05:31',
                'deleted_at' => NULL,
            ),
            199 => 
            array (
                'id' => 200,
                'codigo' => NULL,
                'nombre' => 'Union',
                'created_at' => '2022-12-27 20:08:39',
                'updated_at' => '2022-12-27 20:08:39',
                'deleted_at' => NULL,
            ),
            200 => 
            array (
                'id' => 201,
                'codigo' => NULL,
                'nombre' => 'Rótulo',
                'created_at' => '2022-12-27 20:09:26',
                'updated_at' => '2022-12-27 20:09:26',
                'deleted_at' => NULL,
            ),
            201 => 
            array (
                'id' => 202,
                'codigo' => NULL,
                'nombre' => 'Undiad',
                'created_at' => '2022-12-27 20:11:24',
                'updated_at' => '2022-12-27 20:11:24',
                'deleted_at' => NULL,
            ),
            202 => 
            array (
                'id' => 203,
                'codigo' => NULL,
                'nombre' => 'Ensase',
                'created_at' => '2022-12-27 20:12:32',
                'updated_at' => '2022-12-27 20:12:32',
                'deleted_at' => NULL,
            ),
            203 => 
            array (
                'id' => 204,
                'codigo' => NULL,
                'nombre' => 'Cuadernillo',
                'created_at' => '2022-12-27 20:13:51',
                'updated_at' => '2022-12-27 20:13:51',
                'deleted_at' => NULL,
            ),
            204 => 
            array (
                'id' => 205,
                'codigo' => NULL,
                'nombre' => 'Bloque',
                'created_at' => '2022-12-27 20:14:37',
                'updated_at' => '2022-12-27 20:14:37',
                'deleted_at' => NULL,
            ),
            205 => 
            array (
                'id' => 206,
                'codigo' => NULL,
                'nombre' => 'Metro',
                'created_at' => '2022-12-27 20:14:43',
                'updated_at' => '2022-12-27 20:14:43',
                'deleted_at' => NULL,
            ),
            206 => 
            array (
                'id' => 207,
                'codigo' => NULL,
                'nombre' => 'Balde',
                'created_at' => '2022-12-27 20:17:01',
                'updated_at' => '2022-12-27 20:17:01',
                'deleted_at' => NULL,
            ),
            207 => 
            array (
                'id' => 208,
                'codigo' => NULL,
                'nombre' => 'Quintal',
                'created_at' => '2022-12-27 20:18:27',
                'updated_at' => '2022-12-27 20:18:27',
                'deleted_at' => NULL,
            ),
            208 => 
            array (
                'id' => 209,
                'codigo' => NULL,
                'nombre' => 'Unidad:',
                'created_at' => '2022-12-27 20:31:04',
                'updated_at' => '2022-12-27 20:31:04',
                'deleted_at' => NULL,
            ),
            209 => 
            array (
                'id' => 210,
                'codigo' => NULL,
                'nombre' => 'Lavatrastos industrial',
                'created_at' => '2022-12-27 20:36:38',
                'updated_at' => '2022-12-27 20:36:38',
                'deleted_at' => NULL,
            ),
            210 => 
            array (
                'id' => 211,
                'codigo' => NULL,
                'nombre' => 'Unidcad',
                'created_at' => '2022-12-27 20:37:38',
                'updated_at' => '2022-12-27 20:37:38',
                'deleted_at' => NULL,
            ),
            211 => 
            array (
                'id' => 212,
                'codigo' => NULL,
                'nombre' => 'Envase con dosificador',
                'created_at' => '2022-12-27 20:43:37',
                'updated_at' => '2022-12-27 20:43:37',
                'deleted_at' => NULL,
            ),
            212 => 
            array (
                'id' => 213,
                'codigo' => NULL,
                'nombre' => 'Frasco pulverizador',
                'created_at' => '2022-12-27 20:43:50',
                'updated_at' => '2022-12-27 20:43:50',
                'deleted_at' => NULL,
            ),
            213 => 
            array (
                'id' => 214,
                'codigo' => NULL,
                'nombre' => 'Bolsa hermética',
                'created_at' => '2022-12-27 20:43:50',
                'updated_at' => '2022-12-27 20:43:50',
                'deleted_at' => NULL,
            ),
            214 => 
            array (
                'id' => 215,
                'codigo' => NULL,
                'nombre' => 'Tripack',
                'created_at' => '2022-12-27 20:44:29',
                'updated_at' => '2022-12-27 20:44:29',
                'deleted_at' => NULL,
            ),
            215 => 
            array (
                'id' => 216,
                'codigo' => NULL,
                'nombre' => 'Sixpack',
                'created_at' => '2022-12-27 20:44:29',
                'updated_at' => '2022-12-27 20:44:29',
                'deleted_at' => NULL,
            ),
            216 => 
            array (
                'id' => 217,
                'codigo' => NULL,
                'nombre' => 'Envase dispensador',
                'created_at' => '2022-12-27 20:44:41',
                'updated_at' => '2022-12-27 20:44:41',
                'deleted_at' => NULL,
            ),
            217 => 
            array (
                'id' => 218,
                'codigo' => NULL,
                'nombre' => 'Frasco con atomizador',
                'created_at' => '2022-12-27 20:46:07',
                'updated_at' => '2022-12-27 20:46:07',
                'deleted_at' => NULL,
            ),
            218 => 
            array (
                'id' => 219,
                'codigo' => NULL,
                'nombre' => 'Bolsa de tela',
                'created_at' => '2022-12-27 20:47:00',
                'updated_at' => '2022-12-27 20:47:00',
                'deleted_at' => NULL,
            ),
            219 => 
            array (
                'id' => 220,
                'codigo' => NULL,
                'nombre' => 'Paquete:',
                'created_at' => '2022-12-27 20:49:15',
                'updated_at' => '2022-12-27 20:49:15',
                'deleted_at' => NULL,
            ),
            220 => 
            array (
                'id' => 221,
                'codigo' => NULL,
                'nombre' => 'Empaque individual',
                'created_at' => '2022-12-27 20:57:35',
                'updated_at' => '2022-12-27 20:57:35',
                'deleted_at' => NULL,
            ),
            221 => 
            array (
                'id' => 222,
                'codigo' => NULL,
            'nombre' => 'Paquete (unidades)',
                'created_at' => '2022-12-27 21:01:57',
                'updated_at' => '2022-12-27 21:01:57',
                'deleted_at' => NULL,
            ),
            222 => 
            array (
                'id' => 223,
                'codigo' => NULL,
                'nombre' => 'Caja/bolsa',
                'created_at' => '2022-12-27 21:02:24',
                'updated_at' => '2022-12-27 21:02:24',
                'deleted_at' => NULL,
            ),
            223 => 
            array (
                'id' => 224,
                'codigo' => NULL,
            'nombre' => 'Caja (par)',
                'created_at' => '2022-12-27 21:05:47',
                'updated_at' => '2022-12-27 21:05:47',
                'deleted_at' => NULL,
            ),
            224 => 
            array (
                'id' => 225,
                'codigo' => NULL,
                'nombre' => 'Udidad',
                'created_at' => '2022-12-27 21:19:29',
                'updated_at' => '2022-12-27 21:19:29',
                'deleted_at' => NULL,
            ),
            225 => 
            array (
                'id' => 226,
                'codigo' => NULL,
                'nombre' => 'Soporte individual',
                'created_at' => '2022-12-27 21:26:09',
                'updated_at' => '2022-12-27 21:26:09',
                'deleted_at' => NULL,
            ),
            226 => 
            array (
                'id' => 227,
                'codigo' => NULL,
                'nombre' => 'Cable de red utp',
                'created_at' => '2022-12-27 21:46:39',
                'updated_at' => '2022-12-27 21:46:39',
                'deleted_at' => NULL,
            ),
            227 => 
            array (
                'id' => 228,
                'codigo' => NULL,
                'nombre' => 'Snake',
                'created_at' => '2022-12-27 21:46:47',
                'updated_at' => '2022-12-27 21:46:47',
                'deleted_at' => NULL,
            ),
            228 => 
            array (
                'id' => 229,
                'codigo' => NULL,
                'nombre' => 'Pies',
                'created_at' => '2022-12-27 21:55:58',
                'updated_at' => '2022-12-27 21:55:58',
                'deleted_at' => NULL,
            ),
            229 => 
            array (
                'id' => 230,
                'codigo' => NULL,
                'nombre' => 'Pares',
                'created_at' => '2022-12-27 21:57:52',
                'updated_at' => '2022-12-27 21:57:52',
                'deleted_at' => NULL,
            ),
            230 => 
            array (
                'id' => 231,
                'codigo' => NULL,
                'nombre' => 'Uniidad',
                'created_at' => '2022-12-27 21:59:33',
                'updated_at' => '2022-12-27 21:59:33',
                'deleted_at' => NULL,
            ),
            231 => 
            array (
                'id' => 232,
                'codigo' => NULL,
                'nombre' => 'Faja',
                'created_at' => '2022-12-27 22:00:53',
                'updated_at' => '2022-12-27 22:00:53',
                'deleted_at' => NULL,
            ),
            232 => 
            array (
                'id' => 233,
                'codigo' => NULL,
                'nombre' => 'Perlas por hilo',
                'created_at' => '2022-12-27 22:02:43',
                'updated_at' => '2022-12-27 22:02:43',
                'deleted_at' => NULL,
            ),
            233 => 
            array (
                'id' => 234,
                'codigo' => NULL,
                'nombre' => 'Archivo',
                'created_at' => '2022-12-27 22:06:58',
                'updated_at' => '2022-12-27 22:06:58',
                'deleted_at' => NULL,
            ),
            234 => 
            array (
                'id' => 235,
                'codigo' => NULL,
                'nombre' => 'Estantería',
                'created_at' => '2022-12-27 22:12:44',
                'updated_at' => '2022-12-27 22:12:44',
                'deleted_at' => NULL,
            ),
            235 => 
            array (
                'id' => 236,
                'codigo' => NULL,
                'nombre' => 'Estantería  industrial',
                'created_at' => '2022-12-27 22:13:17',
                'updated_at' => '2022-12-27 22:13:17',
                'deleted_at' => NULL,
            ),
            236 => 
            array (
                'id' => 237,
                'codigo' => NULL,
                'nombre' => 'Unodad',
                'created_at' => '2022-12-27 22:19:56',
                'updated_at' => '2022-12-27 22:19:56',
                'deleted_at' => NULL,
            ),
            237 => 
            array (
                'id' => 238,
                'codigo' => NULL,
                'nombre' => 'Unidades',
                'created_at' => '2022-12-27 22:23:58',
                'updated_at' => '2022-12-27 22:23:58',
                'deleted_at' => NULL,
            ),
            238 => 
            array (
                'id' => 239,
                'codigo' => NULL,
                'nombre' => 'Sistema purificador de agua para laboratorio',
                'created_at' => '2022-12-27 22:24:17',
                'updated_at' => '2022-12-27 22:24:17',
                'deleted_at' => NULL,
            ),
            239 => 
            array (
                'id' => 240,
                'codigo' => NULL,
                'nombre' => 'Combo',
                'created_at' => '2022-12-27 22:25:37',
                'updated_at' => '2022-12-27 22:25:37',
                'deleted_at' => NULL,
            ),
            240 => 
            array (
                'id' => 241,
                'codigo' => NULL,
                'nombre' => 'Cantidad',
                'created_at' => '2022-12-27 22:35:36',
                'updated_at' => '2022-12-27 22:35:36',
                'deleted_at' => NULL,
            ),
            241 => 
            array (
                'id' => 242,
                'codigo' => NULL,
                'nombre' => 'Transmisor de enlace',
                'created_at' => '2022-12-27 22:36:10',
                'updated_at' => '2022-12-27 22:36:10',
                'deleted_at' => NULL,
            ),
            242 => 
            array (
                'id' => 243,
                'codigo' => NULL,
                'nombre' => 'Consola',
                'created_at' => '2022-12-27 22:36:42',
                'updated_at' => '2022-12-27 22:36:42',
                'deleted_at' => NULL,
            ),
            243 => 
            array (
                'id' => 244,
                'codigo' => NULL,
                'nombre' => 'Duo',
                'created_at' => '2022-12-27 22:37:53',
                'updated_at' => '2022-12-27 22:37:53',
                'deleted_at' => NULL,
            ),
            244 => 
            array (
                'id' => 245,
                'codigo' => NULL,
                'nombre' => 'Unidas',
                'created_at' => '2022-12-27 22:39:51',
                'updated_at' => '2022-12-27 22:39:51',
                'deleted_at' => NULL,
            ),
            245 => 
            array (
                'id' => 246,
                'codigo' => NULL,
                'nombre' => 'Uni',
                'created_at' => '2022-12-27 22:41:39',
                'updated_at' => '2022-12-27 22:41:39',
                'deleted_at' => NULL,
            ),
            246 => 
            array (
                'id' => 247,
                'codigo' => NULL,
                'nombre' => 'Closet',
                'created_at' => '2022-12-27 22:55:07',
                'updated_at' => '2022-12-27 22:55:07',
                'deleted_at' => NULL,
            ),
            247 => 
            array (
                'id' => 248,
                'codigo' => NULL,
                'nombre' => 'Maquina tortilladora',
                'created_at' => '2022-12-27 23:02:28',
                'updated_at' => '2022-12-27 23:02:28',
                'deleted_at' => NULL,
            ),
            248 => 
            array (
                'id' => 249,
                'codigo' => NULL,
                'nombre' => 'Tester digital de gancho',
                'created_at' => '2022-12-27 23:04:30',
                'updated_at' => '2022-12-27 23:04:30',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}