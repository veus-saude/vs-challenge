<?php

namespace App\GlogalFunctions;

use Illuminate\Http\Request;
use Image;

class SystemFunctions
{
    public static function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    public static function VerificaNavegadorSO() {
        $ip = $_SERVER['REMOTE_ADDR'];

        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'Linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'Mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'Windows';
        }


        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/AppleWebKit/i',$u_agent))
        {
            $bname = 'AppleWebKit';
            $ub = "Opera";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }

        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
        }


        $i = count($matches['browser']);
        if ($i != 1) {
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        $Browser = array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );
        return $Browser;
    }


    public function ping($url)
    {
        exec("ping $url", $saida, $retorno);
        return $retorno;
    }

    public function curl_init($url){
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_HEADER, 1);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );
        $content = curl_exec($ch);
        $info = curl_getinfo($ch);
        return $info;
    }
    public function siteOnline($url)
    {
        $info = $this->curl_init($url);
        if( $info['http_code']==200 ) {
            dd('no ar');
        } else {
            dd('off line');
        }
    }

    public static function Tagear($item)
    {
        //Transformando o titulo em tag
        $urlP = $item;
        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z',
            'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
            'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
            'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
            'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
            'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
            'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
            'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
        );
        // Traduz os caracteres em $string, baseado no vetor $table
        $urlP = strtr($urlP, $table);
        // converte para minúsculo
        $urlP = strtolower($urlP);
        // remove caracteres indesejáveis (que não estão no padrão)
        $urlP = preg_replace("/[^a-z0-9_\s-]/", "", $urlP);
        // Remove múltiplas ocorrências de hífens ou espaços
        $urlP = preg_replace("/[\s-]+/", " ", $urlP);
        // Transforma espaços e underscores em hífens
        $urlP = preg_replace("/[\s_]/", "-", $urlP);
        //Transformando o titulo em tag
        return $urlP;
    }

    public static function SalvarImagem($request, $inputName, $caminho, $largura, $altura)
    {
        if($request->hasFile($inputName)){
            $arquivo = $request->file($inputName);
            $filename = time() . '-' . rand() . '.' . $arquivo->getClientOriginalExtension();
            if($arquivo->getClientOriginalExtension() != 'jpg' && $arquivo->getClientOriginalExtension() != 'jpeg' && $arquivo->getClientOriginalExtension() != 'png' && $arquivo->getClientOriginalExtension() != 'PNG' && $arquivo->getClientOriginalExtension() != 'JPG'){
                return false;
            }else{
                Image::make($arquivo)->resize($largura, $altura)->save($caminho.''.$filename);
                return $filename;
            }
        }
        else{
            return false;
        }
    }

    public static function EditarImagem($request, $inputName, $inputNamebanco, $caminho, $largura, $altura)
    {
        if($request->hasFile($inputName)){
            $arquivo = $request->file($inputName);
            $filename = time() . '-' . rand() . '.' . $arquivo->getClientOriginalExtension();
            if($arquivo->getClientOriginalExtension() != 'jpg' && $arquivo->getClientOriginalExtension() != 'jpeg' && $arquivo->getClientOriginalExtension() != 'png' && $arquivo->getClientOriginalExtension() != 'PNG' && $arquivo->getClientOriginalExtension() != 'JPG'){
                return $request->$inputNamebanco;
            }else{
                //Excluindo arquivo de imagem se ele existir
                if(file_exists($caminho.''.$request->$inputNamebanco) && $request->$inputNamebanco!='')
                {
                    unlink($caminho.''.$request->$inputNamebanco."");
                }
                Image::make($arquivo)->resize($largura, $altura)->save($caminho.''.$filename);
                return $filename;
            }
        }
        else{
            return $request->$inputNamebanco;
        }
    }

    public static function ExcluirImagem($nome, $caminho)
    {
        //Excluindo arquivo de imagem se ele existir
        if(file_exists($caminho.''.$nome) && $nome!='')
        {
            unlink($caminho.''.$nome."");
        }
        return true;
    }

}


