<?php

use Illuminate\Database\Seeder;

class EstoqueTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    DB::table('estoque')->insert([
      ['id' => 1,'id_produto' => 2,'id_fornecedor' => 2,'lote' => '1D8081','fabricacao' => '2019-06-01','validade' => '2021-06-01','quantidade' => 1,'valor' => 8],
      ['id' => 2,'id_produto' => 2,'id_fornecedor' => 2,'lote' => '1F5235','fabricacao' => '2019-07-01','validade' => '2021-07-01','quantidade' => 1,'valor' => 8],
      ['id' => 3,'id_produto' => 2,'id_fornecedor' => 2,'lote' => '1J5677','fabricacao' => '2019-09-01','validade' => '2019-09-01','quantidade' => 1,'valor' => 8],
      ['id' => 4,'id_produto' => 2,'id_fornecedor' => 6,'lote' => 'B20B2043','fabricacao' => '2020-02-01','validade' => '2022-02-01','quantidade' => 2,'valor' => 8],
      ['id' => 5,'id_produto' => 2,'id_fornecedor' => 6,'lote' => 'B20G1763','fabricacao' => '2020-07-01','validade' => '2022-07-01','quantidade' => 1,'valor' => 8],
      ['id' => 6,'id_produto' => 2,'id_fornecedor' => 4,'lote' => '1S9307','fabricacao' => '2020-05-01','validade' => '2022-05-01','quantidade' => 1,'valor' => 8],
      ['id' => 7,'id_produto' => 2,'id_fornecedor' => 7,'lote' => '19F701','fabricacao' => '2019-05-01','validade' => '2021-05-01','quantidade' => 2,'valor' => 8],
      ['id' => 8,'id_produto' => 2,'id_fornecedor' => 7,'lote' => '20C042','fabricacao' => '2020-02-01','validade' => '2022-02-01','quantidade' => 1,'valor' => 8],
      ['id' => 9,'id_produto' => 2,'id_fornecedor' => 9,'lote' => '14183369','fabricacao' => '2020-09-01','validade' => '2022-09-01','quantidade' => 1,'valor' => 8],
      ['id' => 10,'id_produto' => 1,'id_fornecedor' => 1,'lote' => '1913802','fabricacao' => '2019-10-01','validade' => '2021-10-01','quantidade' => 1,'valor' => 12],
      ['id' => 11,'id_produto' => 1,'id_fornecedor' => 1,'lote' => '1914321','fabricacao' => '2019-10-01','validade' => '2021-10-01','quantidade' => 1,'valor' => 12],
      ['id' => 12,'id_produto' => 1,'id_fornecedor' => 1,'lote' => '2000849','fabricacao' => '2020-01-01','validade' => '2022-01-01','quantidade' => 1,'valor' => 12],
      ['id' => 13,'id_produto' => 1,'id_fornecedor' => 8,'lote' => 'KU1097','fabricacao' => '2020-07-01','validade' => '2022-06-01','quantidade' => 1,'valor' => 12],
      ['id' => 14,'id_produto' => 1,'id_fornecedor' => 8,'lote' => 'KB4864','fabricacao' => '2019-08-01','validade' => '2021-07-01','quantidade' => 1,'valor' => 12],
      ['id' => 15,'id_produto' => 1,'id_fornecedor' => 8,'lote' => 'KW4505','fabricacao' => '2020-09-01','validade' => '2022-08-01','quantidade' => 1,'valor' => 12],
      ['id' => 16,'id_produto' => 1,'id_fornecedor' => 5,'lote' => '1K3094','fabricacao' => '2019-11-01','validade' => '2012-04-01','quantidade' => 2,'valor' => 12],
      ['id' => 17,'id_produto' => 1,'id_fornecedor' => 5,'lote' => '1K7656','fabricacao' => '2019-11-01','validade' => '2012-04-01','quantidade' => 1,'valor' => 12],
      ['id' => 18,'id_produto' => 3,'id_fornecedor' => 1,'lote' => '1709738','fabricacao' => '2017-08-01','validade' => '2019-08-01','quantidade' => 1,'valor' => 4],
      ['id' => 19,'id_produto' => 3,'id_fornecedor' => 3,'lote' => '1806521','fabricacao' => '2018-06-01','validade' => '2020-06-01','quantidade' => 1,'valor' => 4]
    ]);
  }
}
