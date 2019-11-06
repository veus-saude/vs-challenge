<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produtos = [
            'ABAIXADOR DE LÍNGUA',
            'AGULHAS HIPODÉRMICAS',
            'AGULHAS PARA ANESTESIA',
            'AGULHAS PARA ASPIRAÇÃO',
            'AGULHAS PARA BIÓPSIA',
            'ÁLCOOL',
            'ANTISSÉPTICOS',
            'FORMOL',
            'ALGODÃO',
            'ASPIRADOR E COLETORES DE SECREÇÃO',
            'ATADURAS',
            'ESPARADRAPOS',
            'MICROPORES',
            'PELÍCULAS',
            'PROTETOR OCULAR NEONATAL',
            'AVENTAIS CIRÚRGICOS DESCARTÁVEIS',
            'BOBINAS ESTERILIZANTES',
            'BOLSA DE HEMATOCOMPONENTES',
            'TRANSFUSÃO SANGUÍNEA',
            'EQUIPO SANGUÍNEO',
            'CAL SODADA',
            'CAMPO CIRÚRGICO',
            'CÂNULAS DE GUEDEL',
            'CÂNULAS DE TRAQUEOSTOMIA',
            'CATÉTERES CENTRAIS COM INCERÇÃO PERIFÉRICA(PICC)',
            'CATETERES INTRAVENOSOS PERIFÉRICOS',
            'CATETERES PARA ANESTESIA'
        ];

        $marcas = [
            'Dellamed',
            'Ibraamed',
            'Ortobras',
            'Wise Comfort & Care',
            'Lizz',
            'Bunzl',
        ];

        foreach ($produtos as $key => $produto) {
            DB::table('produtos')->insert([
                'nome' => $produto,
                'marca' =>$marcas[array_rand($marcas)],
                'preco' => mt_rand(60,200),
                'quantidade' => rand(10,40)
            ]);
        }

        DB::table('users')->insert([
            'name' => 'Usuário VEUS',
            'email' => 'user@veus.com.br',
            'password' => Hash::make('Veus1234'),
        ]);
    }
}
