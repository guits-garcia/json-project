<?php include 'header.php'; ?>

<section id="autor-list">
    <h1>CONHEÇA NOSSOS CRIADORES</h1>
    <div class="profile-pics">
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
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { // output data of each row
            $contador = 0;
            echo "<div class='esquerda'>";
            while($row = $result->fetch_assoc()) {
                $user = $row;
                $user_id = $user['id'];
                $user_name = $user['name'];
                $user_phone = $user['phone'];
                $user_website = $user['website'];
                $user_email = $user['email'];
                if ($contador == 5){
                    echo "</div><img class='middle-img' src='team-pic.jpeg'><img class='middle-img-behind' src='https://media.istockphoto.com/photos/cute-smiling-dog-headshot-portrait-picture-id1149961016'><div class='direita'>";
                }
                echo "<div class='profile-pic'>";
                $sql_pictures = "SELECT * FROM profilepics WHERE userId = $user_id ";
                $result_pictures = $conn->query($sql_pictures);
                if ($result_pictures->num_rows > 0) { // output data of each row
                    while($row_pictures = $result_pictures->fetch_assoc()){
                        $picture = $row_pictures;
                        $picture_url = $picture['url'];
                        echo "<img src='$picture_url' onmouseover='getYoUrl(this)' onmouseout='hideYoImg(this)'>";
                        echo "<a href='autor-portfl.php?autor-id=$user_id'>$user_name</a>
                        <div class='phone-web-mail'>
                            <img src='phone.png' data-info='$user_phone' onmouseover='showInfo(this)' onmouseout='hideInfo(this)'>
                            <img src='internet-blue.png' data-info='$user_website' onmouseover='showInfo(this)' onmouseout='hideInfo(this)'>
                            <img src='mail.png' data-info='$user_email' onmouseover='showInfo(this)' onmouseout='hideInfo(this)'>
                        </div>
                        <div class='info-phone-web-mail'></div>
                        </div>";
                        $contador = $contador + 1;
                    }
                } else {
                //error boohoo
                }
            }   
        } else {
            #não foram encontrados resultados :[
        }    
?>
    </div>
</section>

<?php include 'footer.php'; ?>