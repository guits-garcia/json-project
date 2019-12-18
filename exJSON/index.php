
<?php include 'header.php'; ?>

    <main>
        <?php
        $ch = curl_init(); 
        $proxy = '192.168.10.254:3128';
        curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/posts/'); // request dos POSTS
        //curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json =  curl_exec($ch);
        $posts = json_decode($json);
        curl_close($ch);

        $ch = curl_init(); 
        $proxy = '192.168.10.254:3128';
        curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/comments/'); // request dos COMMENTS
        //curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json =  curl_exec($ch);
        $comments = json_decode($json);
        curl_close($ch);

       //NAO É PRA APAGAR!!!! COMENTEI PRA PAG CARREGAR MAIS RAPIDO PROS TESTES
        // echo "<div id='posts'>";  
        //     foreach($posts as $post){
        //         echo "<div class='post'>
        //                     <div class='post-id-info'>
        //                         <p> Post número: $post->id </p>
        //                         <p> Id do usuário: $post->userId </p>
        //                     </div>
        //                     <p class='post-title'> $post->title </p> 
        //                     <p class='post-content'> $post->body </p>
        //                     <div class='comentarios'>";
        //                         foreach ($comments as $comentario){
        //                             if(($comentario->postId) == ($post->id)){
                                //         echo "<div class='comentario'>
                                //                     <div class='comentario-info'>
                                //                         <p>$comentario->name</p>
                                //                         <p>$comentario->email</p>
                                //                         <p>Comentário número: $comentario->id</p>
                                //                     </div>
                                //                     <p class='comentario-content'>$comentario->body</p>
                                //             </div>";
                                //     }
                                // }
            //             echo "</div>
            //             </div>";
            // }
        // echo "</div>";
        ?>




<section id="posts">
        <?php foreach ($posts as $post){
            echo "<div class='post'>
                        <p class='title'> $post->title </p>
                        <div class='post-info'>
                            <p>Post de número: $post->id </p>
                            <form action='autor-page.php'>
                                <button type='submit' name='autor-id' id='autor-id' value='$post->userId'>
                                    Id do autor: $post->userId
                                </button></p>
                            </form>
                        </div>
                        <p class='content'> $post->body </p>
                        <div class='comentarios'>
                        <p> Veja o que as pessoas estão falando sobre o assunto: </p>";
                            //aqui gero o código pra puxar apenas o comm referentes ao post atual do foreach $posts
                            $cr = curl_init(); 
                            $proxy = '192.168.10.254:3128';
                            curl_setopt($cr, CURLOPT_URL, "https://jsonplaceholder.typicode.com/comments?postId=$post->id");
                            //curl_setopt($cr, CURLOPT_PROXY, $proxy);
                            curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
                            $data = curl_exec($cr);
                            $comentarios = json_decode($data);
                            curl_close($cr);
                            foreach ($comentarios as $comentario){
                                echo "<div class='comentario'>
                                        
                                        <div class='comentario-info'>
                                            <p>Comentário <b>#$comentario->id</b>  &nbsp </p>
                                            <p> por $comentario->email: </p>
                                        </div>
                                        <div class='comentario-conteudo'>
                                            <p> $comentario->body </p>
                                        </div>
                                      </div>";
                            }
                    echo "</div>
                  </div>";
        } ?>
    </main>
<?php @include 'footer.php'; ?>