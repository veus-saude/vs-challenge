<?php

/**
* Formated price
* @param string $price
* @return type
*/
function str_price(string $price)
{
   return str_replace(['.', ','], ['', '.'], $price);
}

/**
* Convert number of month
* @param int $mes
* @return type
*/
function convert_month(int $mes)
{
   $arrayMeses = [
       1 => 'Jan',
       2 => 'Fev',
       3 => 'Mar',
       4 => 'Abr',
       5 => 'Mai',
       6 => 'Jun',
       7 => 'Jul',
       8 => 'Ago',
       9 => 'Set',
       10 => 'Out',
       11 => 'Nov',
       12 => 'Dez'
   ];

   return $arrayMeses[$mes];
}
