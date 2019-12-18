<?php include 'header.php'; ?>

    <?php if($_GET['autor-id']){
        $proxy = '192.168.10.254:3128';
        $autor_id = $_GET['autor-id'];
        $cr = curl_init(); 
        curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/users?id=$autor_id");
        //curl_setopt($cr, CURLOPT_PROXY, $proxy);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($cr);
        $usuario = json_decode($data);
        // print_r($usuario);
        //fazer um layout com os dados no json users, que dependendo do valor do get já vai puxar de cada um.
        //integrar o here maps!!!!
        $name = $usuario[0]->name;
        $username = $usuario[0]->username;
        $email = $usuario[0]->email;
        $street = $usuario[0]->address->street;
        $suite = $usuario[0]->address->suite;
        $city = $usuario[0]->address->city;
        $zipcode = $usuario[0]->address->zipcode;
        $lat = $usuario[0]->address->geo->lat;
        $lng = $usuario[0]->address->geo->lng;
        $phone = $usuario[0]->phone;
        $website = $usuario[0]->website;
        $companyName = $usuario[0]->company->name;
        $companyCatchPhrase = $usuario[0]->company->catchPhrase;
        $companyBs = $usuario[0]->company->bs; ?>

        <section id="autor-page">
            <h2> Bem vindo à página de </h2>
            <h1><?php echo $username ?> <i class="fas fa-user-astronaut"></i> </h1>
            <h3>Visualizar postagens do autor</h3>
            <h4>E-mail para contato: <?php echo $email ?> </h4>
            <div class="infos-pessoais">
                <h5>Informações pessoais:</h5>
                <p> Nome: <?php echo $name ?> </p>
                <p> Telefone: <?php echo $phone ?> </p>
                <p> Website: <?php echo $website ?> </p>
            </div>
            <div class="infos-profissionais">
                <h5>Informações profissionais:</h5>
                <p>Funcionário da empresa: <?php echo $companyName ?> </p>
                <p>Slogan: <?php echo $companyCatchPhrase ?> </p>
                <p>Missão: <?php echo $companyBs ?> </p>
            </div>
      
 <?php   } ?>    

<?php $cr = curl_init(); 
        $proxy = '192.168.10.254:3128';
        curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/albums?userId=$autor_id");
        //curl_setopt($cr, CURLOPT_PROXY, $proxy);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($cr);
        $albums = json_decode($data);
        curl_close($cr);
        echo "
        <p class='galeria'>Galeria do Autor: </p>
        <div class='albums'>";
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
                //curl_setopt($cr, CURLOPT_PROXY, $proxy);
                curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
                $data = curl_exec($cr);
                $photos = json_decode($data);
                curl_close($cr);
                echo "<div class='photos'>";
                foreach ($photos as $photo){
                    echo "<div class='photo'>
                        <img class='thumbnail' src='$photo->thumbnailUrl' data-image-url='$photo->url'>
                        <p>$photo->title #$photo->id</p>
                    </div>";
                }  
                echo "</div>";
            echo  "</div>";
        }
       echo "</div>";
?>

</section>


<div id="sidenav-tarefas">
    <div class="sidenav-header">
    <i class="fas fa-bullseye fa-lg" id="bullseye"></i><p>Me mude de lugar!</p>
    </div>
    <div class="tarefas">
        <div class="concluidas">
            
        <?php   $cr = curl_init(); 
    $proxy = '192.168.10.254:3128';
    curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/todos?userId=$autor_id&completed=true");
    //curl_setopt($cr, CURLOPT_PROXY, $proxy);
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
    //curl_setopt($cr, CURLOPT_PROXY, $proxy);
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


<?php @include 'footer.php'; ?>