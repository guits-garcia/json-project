<?php include 'header.php'; ?>

<section id="autor-portfl"> 

<?php

if(isset($_GET['autor-id'])){
$autor_id = $_GET['autor-id'];
$ch = curl_init(); 
$proxy = '192.168.10.254:3128';
curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/users?id=$autor_id"); // request dos USUARIOS
curl_setopt($ch, CURLOPT_PROXY, $proxy);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json =  curl_exec($ch);
$users = json_decode($json);
//print_r($users);
curl_close($ch);
foreach ($users as $user){
            $ch = curl_init(); 
            $proxy = '192.168.10.254:3128';
            curl_setopt($ch, CURLOPT_URL, "https://my-json-server.typicode.com/guits-garcia/guits-json/profilepics?userId=$user->id"); // request das FOTOS
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json =  curl_exec($ch);
            $profile_pic = json_decode($json); //aqui está como um array. precisa acessar o index [0] para utilizar como objeto
            $profile_pic_object = $profile_pic[0];
            curl_close($ch);
            $company = $user->company;
            echo "<div class='img-bg'>
                    <img class='facepic' src='$profile_pic_object->url' onclick='layoutDynamic(this);'>
                    <p class='portfl-name'>$user->name</p>
                    <img class='companypic' src='company.png'>
                    <p class='portfl-company'>$company->name</p>
                    <p class='portfl-catch'>$company->catchPhrase</p>
                    <div class='portfl-albuns'>"; //aqui faço um curl pra pegar os albuns de cada autor e botar dentro dessa div;
                    
                    $ch = curl_init(); 
                    $proxy = '192.168.10.254:3128';
                    curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/albums?userId=$user->id"); // request dos ALBUMS
                    curl_setopt($ch, CURLOPT_PROXY, $proxy);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $json =  curl_exec($ch);
                    $albums = json_decode($json);
                    curl_close($ch);
                    foreach ($albums as $album){ //para cada album pego a primeira foto para colocar no portfólio
                        $ch = curl_init(); 
                        $proxy = '192.168.10.254:3128';
                        curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/photos?albumId=$album->id"); // request das FOTOS, vai pegar todas as fotos de cada album que eu entrar o id...
                        curl_setopt($ch, CURLOPT_PROXY, $proxy);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $json =  curl_exec($ch);
                        $fotos = json_decode($json); //este array tem todas as fotos de cada album que eu dei o id, vou optar por pegar só a primeira
                        curl_close($ch);
                        $foto = $fotos[0];
                        echo "<a href='album-page.php?autor-id=$autor_id'><img class='portfl-photo' src='$foto->thumbnailUrl'></a>";
                    }   
            echo  "</div>
                  </div>";
}
}

?>

</section>


<?php include 'footer.php'; ?>