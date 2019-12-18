
<?php include 'header.php'; ?>
    <div id="posts-wrap">
    <?php
        $ch = curl_init(); 
        $proxy = '192.168.10.254:3128';
        curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/posts/'); // request dos POSTS
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json =  curl_exec($ch);
        $posts = json_decode($json);
        //variáveis e dados para a paginação !!! V
        $posts_number = count($posts); //descobre quantos posts tem
        $posts_per_page = 6;
        $totalpages = ceil($posts_number/$posts_per_page);
        curl_close($ch);


        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
            $currentpage = (int) $_GET['currentpage'];
        } else {
            $currentpage = 1;
        }

        if ($currentpage > $totalpages){
            $currentpage = $totalpages;
        }

        if($currentpage < 1) {
            $currentpage = 1;
        }

        $offset = ($currentpage - 1) * $posts_per_page; //encontra o quanto tem que deslocar pra colocar
        //os posts certos na pagina atual
        ?>




<section id="posts">
        <?php 
        // echo "<pre>";
        // print_r($posts[0]);
        if ( ($offset + $posts_per_page) <= $posts_number){
            $limite_superior = $offset + $posts_per_page;
        } else {
            $limite_superior = $posts_number;
        }
        
        for($i = $offset; $i < $limite_superior; $i++){
        // foreach ($posts as $post){
            $post = $posts[$i];
            $title_excerpt = substr($post->title,0,20);
            echo "<div class='post'>
                    <div class='post-stuff'>
                        <div class='post-info'>
                            <p onclick='showComments(this)' data-after='veja comentários..' >Post de número: $post->id </p>
                            <a href='autor-page.php?autor-id=$post->userId' id='autor-id' data-after='Visite o autor!'>
                                Id do autor: $post->userId
                            </a>
                        </div>
                        <p class='title'> $title_excerpt </p>";
                        //gerando uma data fake pra colocar junto com o nome do autor

                        $start = strtotime("10 October 2017");//Start point of our date range.
                        $end = strtotime("22 November 2019");//End point of our date range.
                        $timestamp = mt_rand($start, $end);//Custom range.
                        $fake_data = date("Y-m-d", $timestamp);


                        $cr = curl_init(); 
                        $proxy = '192.168.10.254:3128';
                        curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/users?id=$post->userId");
                        curl_setopt($cr, CURLOPT_PROXY, $proxy);
                        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
                        $data = curl_exec($cr);
                        $users = json_decode($data);
                        $user = $users[0];
                        echo "<p class='autor'> Escrito por $user->name em $fake_data </p>";
                        echo "<p class='content'> $post->body </p>
                    </div>
                        <div class='comentarios'>
                        <hr>
                        <p> COMENTÁRIOS </p>";
                            //aqui gero o código pra puxar apenas o comm referentes ao post atual do foreach $posts
                            $cr = curl_init(); 
                            $proxy = '192.168.10.254:3128';
                            curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/comments?postId=$post->id");
                            curl_setopt($cr, CURLOPT_PROXY, $proxy);
                            curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
                            $data = curl_exec($cr);
                            $comentarios = json_decode($data);
                            curl_close($cr);
                            foreach ($comentarios as $comentario){
                                echo "<div class='comentario'>
                                        
                                        <div class='comentario-info'>
                                            <p>$comentario->email diz: </p>
                                        </div>
                                        <div class='comentario-conteudo'>
                                            <p> $comentario->body </p>
                                        </div>
                                      </div>";
                            }
                    echo "</div>
                  </div>";
        }

        $range = 3; //qtd de páginas disponíveis na paginação
        for($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++){
            if (($x > 0) && ($x <= $totalpages)) {
                if ($x == $currentpage){
                    echo "[<b>$x</b>]";
                } else {
                    echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a>";
                }
            }
        }

        if ($currentpage != $totalpages){
            $nextpage = $currentpage + 1;
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a>";
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a>";
        }
        echo "</div>";
        echo "<div class='paginacao'>";
        if ($currentpage > 1) {
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a>";
            $prevpage = $currentpage - 1;
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a>";
        } 
         ?>
        </section>
    <?php   ?>
    </div>
    <main>
     
    </main>
<?php @include 'footer.php'; ?>