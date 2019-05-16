<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Convert_lib {

    function currencyToDouble($value) {
        $value = str_replace(",", "-", $value);
        $value = str_replace(".", "", $value);
        $value = str_replace("-", ".", $value);
        return $value;
    }

    public static function doubleToCurrency($value) {
        return number_format($value, 2, ',', '.');
    }

    public static function formataValor($value) {
        return substr($value, 0, strlen($value) - 2) . "." . substr($value, -2);
    }

    public static function doubleParaPercentual($value) {
        return number_format($value, 1, ',', '.');
    }

    public static function percentualParaDouble($value) {
        return str_replace(",", ".", $value);
    }

    public static function dataMysqlParaDataBrasileira($date) {
        $tmp = explode("-", $date);
        return $tmp[2] . "/" . $tmp[1] . "/" . $tmp[0];
    }

    public static function brazilianDateTimeToMysqlDate($date) {
        $tmp = explode("/", $date);
        return $tmp[2] . "-" . $tmp[1] . "-" . $tmp[0];
    }

    public static function dateMysqlTimeToBrazilianDateTime($dateTime) {
        $dateTimeArray = explode(" ", $dateTime);
        $date = $dateTimeArray[0];
        $hour = $dateTimeArray[1];
        $tmp = explode("-", $date);
        $date = $tmp[2] . "/" . $tmp[1] . "/" . $tmp[0];
        return $date . " " . $hour;
    }
    
    public static function dataHoraBrasileiraParaDataHoraMysql($dateTime) {
        $dateTimeArray = explode(" ", $dateTime);
        $date = $dateTimeArray[0];
        $hour = $dateTimeArray[1];
        $tmp = explode("/", $date);
        $date = $tmp[2] . "-" . $tmp[1] . "-" . $tmp[0];
        return $date . " " . $hour;
    }
}
