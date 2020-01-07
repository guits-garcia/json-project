<?php include 'header.php'; 

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

        ?>
<section id="autor-portfl"> 

<?php

if(isset($_GET['autor-id'])){

$autor_id = $_GET['autor-id'];
?>

<div id="sidenav-tarefas">
    <div class="sidenav-header">
    <i class="fas fa-bullseye fa-lg" id="bullseye"></i><p>Me mude de lugar!</p>
    </div>
    <div class="tarefas">
        <div class="concluidas">
            
        <?php   $cr = curl_init(); 
    $proxy = '192.168.10.254:3128';
    curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/todos?userId=$autor_id&completed=true");
    curl_setopt($cr, CURLOPT_PROXY, $proxy);
    curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($cr);
    $concluidas = json_decode($data);
    $qtd_concluidas = count($concluidas);
    curl_close($cr);
    echo "
    <p>Você concluiu <b>$qtd_concluidas</b> tarefas. <i class='far fa-grin-stars fa-lg'></i></p>
    <ul>";
    foreach ($concluidas as $concluida){
        $tarefa_title = $concluida->title;
        $titulo = explode(" ",$concluida->title);
        echo "<li>
                <p class='tarefa-id'> Tarefa #$concluida->id <br> <b>Título: $titulo[0] ...</b> </p>
                <p class='tarefa-info'> Descrição: $tarefa_title </p>
            </li>";
    } ?>

            </ul>
        </div>
        <div class="not-concluidas">
            
            <?php   $cr = curl_init(); 
    $proxy = '192.168.10.254:3128';
    curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/todos?userId=$autor_id&completed=false");
    curl_setopt($cr, CURLOPT_PROXY, $proxy);
    curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($cr);
    $not_concluidas = json_decode($data);
    $qtd_faltando = count($not_concluidas);
    curl_close($cr);
    echo "<p>Você possui <b>$qtd_faltando</b> tarefas por fazer! <i class='far fa-sad-cry fa-lg'></i> </p>
    <ul>";
    foreach ($not_concluidas as $not_concluida){
        $tarefa_title = $not_concluida->title;
        $titulo = explode(" ",$not_concluida->title);
        echo "<li>
                <p class='tarefa-id'> Tarefa #$not_concluida->id <br> Título: <b>$titulo[0] ...</b> </p>
                <p class='tarefa-info'> Descrição: $tarefa_title </p>
            </li>";
    }
    ?>
            </ul>
        </div>
    </div>
</div>

<?php


$sql = "SELECT * FROM users WHERE id = $autor_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) { // output data of each row
    while($row = $result->fetch_assoc()) {
        $user = $row;
        $user_name = $user['name'];
        $company = $user['company_name'];
        $company_catchPhrase = $user['company_catchPhrase'];

        $sql_profilepic = "SELECT * FROM profilepics WHERE userId = $autor_id";
        $result_profilepic = $conn->query($sql_profilepic);
        if ($result_profilepic->num_rows > 0){
            while($row_profilepic = $result_profilepic->fetch_assoc()){
                $profilepic = $row_profilepic;
                $profilepic_url = $profilepic['url'];
                echo "<div class='img-bg'>
                <img class='facepic' src='$profilepic_url' onclick='layoutDynamic(this);'>
                <p class='portfl-name'>$user_name</p>
                <img class='companypic' src='company.png'>
                <p class='portfl-company'>$company</p>
                <p class='portfl-catch'>$company_catchPhrase</p>
                <div class='portfl-albuns'>"; //aqui faço um curl pra pegar os albuns de cada autor e botar dentro dessa div;

                $sql_albums = "SELECT * FROM albums WHERE userId = $autor_id";
                $result_albums = $conn->query($sql_albums);
                if ($result_albums->num_rows > 0){
                    while($row_albums = $result_albums->fetch_assoc()){
                        $album = $row_albums;
                        $album_id = $album['id'];
                        $sql_photos = "SELECT * FROM photos WHERE albumId = $album_id LIMIT 1"; // request das FOTOS, vai pegar todas as fotos de cada album que eu entrar o id, LIMITANDO PARA APENAS UMA
                        $result_photos = $conn->query($sql_photos);
                        if ($result_photos->num_rows > 0) { // output data of each row
                            while($row_photos = $result_photos->fetch_assoc()) {
                                $foto_thumbnailUrl = $row_photos['thumbnailUrl'];
                                echo "<a href='album-page.php?autor-id=$autor_id'><img class='portfl-photo' src='$foto_thumbnailUrl'></a>";
                            }
                        }
                        
                    }
                    echo  "</div>
                  </div>";
        }
        
    }
}
    }
}
} else {
    function redirect($url) {
        ob_start();
        header('Location: '.$url);
        ob_end_flush();
        die();
    }
    redirect('autor-list.php');
}


// $ch = curl_init(); 
// $proxy = '192.168.10.254:3128';
// curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/users?id=$autor_id"); // request dos USUARIOS
// curl_setopt($ch, CURLOPT_PROXY, $proxy);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// $json =  curl_exec($ch);
// $users = json_decode($json);
// //print_r($users);
// curl_close($ch);
// foreach ($users as $user){
//             $ch = curl_init(); 
//             $proxy = '192.168.10.254:3128';
//             curl_setopt($ch, CURLOPT_URL, "https://my-json-server.typicode.com/guits-garcia/guits-json/profilepics?userId=$user->id"); // request das FOTOS
//             curl_setopt($ch, CURLOPT_PROXY, $proxy);
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//             $json =  curl_exec($ch);
//             $profile_pic = json_decode($json); //aqui está como um array. precisa acessar o index [0] para utilizar como objeto
//             $profile_pic_object = $profile_pic[0];
//             curl_close($ch);
//             $company = $user->company;
//             echo "<div class='img-bg'>
//                     <img class='facepic' src='$profile_pic_object->url' onclick='layoutDynamic(this);'>
//                     <p class='portfl-name'>$user->name</p>
//                     <img class='companypic' src='company.png'>
//                     <p class='portfl-company'>$company->name</p>
//                     <p class='portfl-catch'>$company->catchPhrase</p>
//                     <div class='portfl-albuns'>"; //aqui faço um curl pra pegar os albuns de cada autor e botar dentro dessa div;
                    
//                     $ch = curl_init(); 
//                     $proxy = '192.168.10.254:3128';
//                     curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/albums?userId=$user->id"); // request dos ALBUMS
//                     curl_setopt($ch, CURLOPT_PROXY, $proxy);
//                     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                     $json =  curl_exec($ch);
//                     $albums = json_decode($json);
//                     curl_close($ch);
//                     foreach ($albums as $album){ //para cada album pego a primeira foto para colocar no portfólio
//                         $ch = curl_init(); 
//                         $proxy = '192.168.10.254:3128';
//                         curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/photos?albumId=$album->id"); // request das FOTOS, vai pegar todas as fotos de cada album que eu entrar o id...
//                         curl_setopt($ch, CURLOPT_PROXY, $proxy);
//                         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                         $json =  curl_exec($ch);
//                         $fotos = json_decode($json); //este array tem todas as fotos de cada album que eu dei o id, vou optar por pegar só a primeira
//                         curl_close($ch);
//                         $foto = $fotos[0];
//                         echo "<a href='album-page.php?autor-id=$autor_id'><img class='portfl-photo' src='$foto->thumbnailUrl'></a>";
//                     }   
//             echo  "</div>
//                   </div>";
// }
// }

?>

</section>


<?php include 'footer.php'; ?>