<?php

use Illuminate\Database\Seeder;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('type')->insert([
          [
              'id' => 1,
              'type' => 'admin',
          ],
          [
              'id' => 2,
              'type' => 'user',
          ]
      ]);
  }
}
