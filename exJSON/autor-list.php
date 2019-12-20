<?php include 'header.php'; ?>

<section id="autor-list">
    <h1>CONHEÇA NOSSOS CRIADORES</h1>
    <div class="profile-pics">
        <?php

        $ch = curl_init(); 
        $proxy = '192.168.10.254:3128';
        curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/users/'); // request dos USUARIOS
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json =  curl_exec($ch);
        $users = json_decode($json);
        //print_r($users);
        curl_close($ch);
        $contador = 0;
        echo "<div class='esquerda'>";
        foreach ($users as $user){
            if ($contador == 5){
                echo "</div><img class='middle-img' src='team-pic.jpeg'><img class='middle-img-behind' src='https://media.istockphoto.com/photos/cute-smiling-dog-headshot-portrait-picture-id1149961016'><div class='direita'>";
            }
            //para cada user, pegar o user->id e jogar como parametro no json que eu vou criar com as fotos
            echo "<div class='profile-pic'>";
            $ch = curl_init(); 
            $proxy = '192.168.10.254:3128';
            curl_setopt($ch, CURLOPT_URL, "https://my-json-server.typicode.com/guits-garcia/guits-json/profilepics?userId=$user->id"); // request das FOTOS
            curl_setopt($ch, CURLOPT_PROXY, $proxy);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json =  curl_exec($ch);
            $profile_pic = json_decode($json); //aqui está como um array. precisa acessar o index [0] para utilizar como objeto
            $profile_pic_object = $profile_pic[0];
            curl_close($ch);
            echo "<img src='$profile_pic_object->url' onmouseover='getYoUrl(this)' onmouseout='hideYoImg(this)'>";
            echo "<a href='autor-portfl.php?autor-id=$user->id'>$user->name</a>
            <div class='phone-web-mail'>
                <img src='phone.png' data-info='$user->phone' onmouseover='showInfo(this)' onmouseout='hideInfo(this)'>
                <img src='internet-blue.png' data-info='$user->website' onmouseover='showInfo(this)' onmouseout='hideInfo(this)'>
                <img src='mail.png' data-info='$user->email' onmouseover='showInfo(this)' onmouseout='hideInfo(this)'>
            </div>
            <div class='info-phone-web-mail'></div>
            </div>";
            $contador = $contador + 1;
        }
echo "</div>";
?>
    </div>
</section>

<?php @include 'footer.php'; ?>