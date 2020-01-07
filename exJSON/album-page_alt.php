<?php include 'header.php'; ?>

<section id="album-page">
<?php if(isset($_GET['autor-id'])){
    $autor_id = $_GET['autor-id'];
    $proxy = '192.168.10.254:3128';
        $autor_id = $_GET['autor-id'];
        $cr = curl_init(); 
        curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/users?id=$autor_id");
        curl_setopt($cr, CURLOPT_PROXY, $proxy);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($cr);
        $usuario = json_decode($data);
        $nome = $usuario[0]->name;
        curl_close($cr);
        echo "<h1>$nome</h1>";
        echo "<div class='album-wrapper'>";
    
        $cr = curl_init(); 
        curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/albums?userId=$autor_id");
        curl_setopt($cr, CURLOPT_PROXY, $proxy);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($cr);
        $albums = json_decode($data);
        curl_close($cr);
        foreach ($albums as $album){
            echo "<div class='album' >
                    <p>Album #$album->id</p>
                    <div class='title-x'>
                        <p class='album-title' onclick='show_pics(this)'>$album->title</p>
                        <span class='close' onclick='show_pics(this)'>&times;</span>
                    </div>";
                $cr = curl_init(); 
                $proxy = '192.168.10.254:3128';
                curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/photos?albumId=$album->id");
                curl_setopt($cr, CURLOPT_PROXY, $proxy);
                curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
                $data = curl_exec($cr);
                $photos = json_decode($data);
                curl_close($cr);
                echo "<div class='photos'>";
                foreach ($photos as $photo){
                    echo "<div class='photo'>
                        <img class='thumbnail' src='$photo->thumbnailUrl' data-url='$photo->url' onclick='showModal(this)'>
                        <p>$photo->title #$photo->id</p>
                    </div>";
                }  
                echo "</div>";
            echo  "</div>";
        }
} else {
    $proxy = '192.168.10.254:3128';
    $cr = curl_init(); 
    curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/users");
    curl_setopt($cr, CURLOPT_PROXY, $proxy);
    curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($cr);
    $usuarios = json_decode($data);
    curl_close($cr);
    echo "<div class='list-autors'>";
    foreach ($usuarios as $usuario){
        echo "<a class='album-anchor' data-before='$usuario->name' href='album-page.php?autor-id=$usuario->id'>$usuario->name</a>";
    }
    echo "</div>";
}

?>


</section>



<div id="modal">
    <span id="modal-close" onclick='closeModal()'>&times;</span>
    <img id="modal-img">
    <div id="modal-caption"></div>
</div>

<?php include 'footer.php'; ?>