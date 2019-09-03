<?php
//Usage: http://SERVIDOR/API?q=seringa&filter=brand:BUNZL

$auth = file_get_contents('access.json');
//simple auth with json
if(!array_key_exists('user', $_GET) && !array_key_exists('email', $_GET)){
  print 'Acesso Negado.';
  exit;
}else{
  if($_GET['user']== 'thiago' && $_GET['email']== 'thiago@nospam.com'){
    continue;
  }else{
    print 'Acesso Negado.';
    exit;
  }
}
//if someone try to access API without documentation knowledge
if(!array_key_exists('q', $_GET)){
  echo 'Erro. Query Missing';
  exit;
}

$query =  $_GET['q'];
$filter = explode(':', $_GET['filter']);
//if someone try to access API without q with a value
if(count($query) == 0 || $query == ''){
  echo 'Erro. No Query.';
  exit;
}

//initialize vars
$filterType = $filterName = "";

if(count($filter)>1){
  $filterType = $filter[0];
  $filterName = $filter[1];
}
//store data for further manipulation
$contents = file_get_contents('db.json');
$json = json_decode($contents, true);

header('Content-type: application/json');
$body = file_get_contents('php://input');

function findByQueryString($vector){
  $prods = [];
  foreach($vector as $brand){
    foreach($prod as $key => $obj){
      if($obj['type']==$q){
        $prods[$brand] = $obj;
      }
      if(strpos($obj['name'], $q) == true){
        $prods[$brand] = $obj;
      }
    }
  }
  return $prods;
}

if($method === 'GET'){

  if(empty($filter)){

    $vector = $json['fabricante'];
    $prodsFound = findByQueryString($vector);
    print $prodsFound;

  }elseif($filterType == 'brand'){

    if($json['fabricante'][$filterName]){

      if($json['fabricante'][$filterName] == $filterName){

          $prodsFound = $json['fabricante'][$filterName];
          print $prodsFound;

      }else{

        print 'Manufactor Not Found';

      }
  }

}else{

  print 'Erro. Filter Type Not Suported';
}
exit;
?>
