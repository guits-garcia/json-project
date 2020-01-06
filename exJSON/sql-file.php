<?php


$servername = "192.168.10.115";
$username = "root";
$password = "d0r1t0s1mp10";
$dbname = "exercício_php_guilherme";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//DESCOMENTAR PARA DEBUG VVV
// $sql_del = "DROP TABLE IF EXISTS albums, comments, photos, posts, todos, users;";
// $val = $conn->query($sql_del);

function object_keys($ar) {
  $temp = array();
  foreach ($ar as $k => $v ) {
      if(is_object($ar->{$k})) {
        $temp[$k] = object_keys($ar->{$k});  
      } else {
        $temp[] = $k;
      }
  }
  return $temp;
}

$columns = [];
function create_columns($props, $prefix="", &$columns) {
  foreach($props as $i => $p) {
    if(is_int($i)) {
      $column_name = $prefix . $p;
      $columns[] = $column_name;
    } else if(is_string($i)) {
      $prefix .= $i . "_";
      create_columns($p, $prefix, $columns);
      $prefix = "";
    }
  }
}

$arruma_counter = 0;
function arruma_valores($row,&$sql,&$columns,&$arruma_counter){  //função pra ir abrindo os stdClass objects
  if (is_object($row)){
    foreach ($row as $g => $r){
      arruma_valores($r,$sql,$columns,$arruma_counter);
    }
  } 
  else {
    if ($arruma_counter == count($columns) - 1){
      $sql .= " ' " . $row . " ' " . ")";
      $arruma_counter = 0;
    } else {
      $sql .= " ' " . $row . " ' " . ", ";
      $arruma_counter++;
    }
  }
}

for ($hehe = 0; $hehe < 7; $hehe++){

  $request_URL = 'https://jsonplaceholder.typicode.com/';


  switch ($hehe){
    case 0 :
      $table_name = "posts";
      break;
    case 1 :
      $table_name = "comments";
      break;
    case 2 :
      $table_name = "albums";
      break;
    case 3 :
      $table_name = "photos";
      break;
    case 4 :
      $table_name = "todos";
      break;
    case 5 :
      $table_name = "users";
      break;
    case 6 :
      $table_name = "profilepics";
      $request_URL = 'https://my-json-server.typicode.com/guits-garcia/guits-json/';
      break;
  }

 

  $val = mysqli_query($conn,"select 1 from $table_name LIMIT 1");

  if($val !== FALSE)
  {
     //aqui verificar se os valores do api mudaram e então atualizar a db
  }
  else
  {


    $ch = curl_init(); //só faz o curl caso necessario aka a tabela nao existir
    $proxy = '192.168.10.254:3128';
    curl_setopt($ch, CURLOPT_URL, $request_URL . $table_name); // request dos POSTS
    curl_setopt($ch, CURLOPT_PROXY, $proxy);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json =  curl_exec($ch);
    $curl_values = json_decode($json);


      //criação da tabela início

      $sql = "CREATE TABLE $table_name (";
   
      $props = object_keys($curl_values[0]);
      
      $columns = [];
      create_columns($props, "", $columns);
      
      foreach($columns as $k => $column) {
        if($column == "id") {
          $sql .= "$column INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,";
        } else {
          if ($k == count($columns) - 1){
            $sql .= "$column VARCHAR(510) NOT NULL);";
          } else {
            $sql .= "$column VARCHAR(510) NOT NULL,";
          }
        }
      }


      if ($conn->query($sql) === TRUE) {
        echo "Table $table_name created successfully";
      } else {
          echo "Error creating table: " . $conn->error;
      }

        //criação da tabela fim

        //adicionar valores início
      echo "<pre>";

        foreach ($curl_values as $valor_entrada){
            $sql = "
              INSERT INTO $table_name (";
              foreach ($columns as $i => $column_name){
                if($i == count($columns) - 1) $sql .= "$column_name)";
                else $sql .= "$column_name, ";
              }
              $sql .= " VALUES (";
              foreach ($valor_entrada as $gg => $row){
                    arruma_valores($row,$sql,$columns,$arruma_counter)."\n";
                  }
                  // die();
                  // echo $sql;
                  if($conn->query($sql) === TRUE){
                    echo "dados inseridos";
                  } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                  }
                  $sql = "";
                }
  }
        }
        //adicionar valores fim



$conn->close();
