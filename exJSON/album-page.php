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
        }?>
<section id="album-page">
<?php if(isset($_GET['autor-id'])){
       $autor_id = $_GET['autor-id'];
        $sql = "SELECT * FROM users WHERE id = $autor_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { // output data of each row
            while($row = $result->fetch_assoc()) {
                $usuario = $row;
                $nome = $usuario['name'];
                echo "<h1>$nome</h1>";
                echo "<div class='album-wrapper'>";
            }
        } else {
            #no res00lts
        }

        $sql_albums = "SELECT * FROM albums WHERE userId = $autor_id";
        $result_albums = $conn->query($sql_albums);
        if ($result_albums->num_rows > 0) { // output data of each row
            while($row_albums = $result_albums->fetch_assoc()) {
                $album = $row_albums;
                $album_id = $album['id'];
                $album_title = $album['title'];
                echo "<div class='album' id='$album_id'>
                    <p>Album #$album_id</p>
                    <div class='title-x'>
                        <p class='album-title' onclick='show_pics(this)'>$album_title</p>
                        <span class='close' onclick='show_pics(this)'>&times;</span>
                    </div>";
                    echo "<div class='photos'>"; // essa div aqui vou deixar vazia e adiciono o html dela via ajax
                    echo "</div>";
                    echo  "</div>";
            }
        } else {
            #keine Ergebnisse
        }
} else {

    $sql_users = "SELECT * FROM users";
    $result_users = $conn->query($sql_users);
    echo "<div class='list-autors'>";
    if ($result_users->num_rows > 0) { // output data of each row
        while($row_users = $result_users->fetch_assoc()) {
            $usuario = $row_users;
            $usuario_name = $usuario['name'];
            $usuario_name = preg_replace('/\s/', '', $usuario_name); //por algum motivo o nome tá vindo com um espaço branco extra no início e no fim, dai dá problema no efeito typewritter
            $usuario_id = $usuario['id'];
            echo "<a class='album-anchor' data-before='$usuario_name' href='album-page.php?autor-id=$usuario_id'>$usuario_name</a>";
        }
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