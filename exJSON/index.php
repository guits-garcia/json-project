
<?php include 'header.php'; ?>

<?php include 'sql-file.php' ?>


    <section id="posts-wrap">
    <?php
        // //variáveis e dados para a paginação !!! V
        // $posts_number = count($posts); //descobre quantos posts tem
        $posts_number = 100;
        $posts_per_page = 6;
        // $totalpages = ceil($posts_number/$posts_per_page);
        $totalpages = 17;



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




<div id="posts">
        <?php 
        if ( ($offset + $posts_per_page) <= $posts_number){
            $limite_superior = $offset + $posts_per_page;
        } else {
            $limite_superior = $posts_number;
        }

        //faz sentido fazer o query aqui só dos posts delimitados pela paginação ao invés de carregador todos no início do script
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
        $sql = "SELECT * FROM posts WHERE id > $offset AND  id <= $limite_superior";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) { // output data of each row
            while($row = $result->fetch_assoc()) {
                // print_r($row);
                $post = $row;
                $title_excerpt = substr($post['title'],0,20);
                $post_id = $post['id'];
                $post_userId = $post['userId'];
                $post_body = $post['body'];
                echo "<div class='post'>
                    <div class='post-stuff'>
                        <div class='post-info'>
                            <p onclick='abrirPopUp(this)' data-after='veja comentários..' >Post de número: $post_id </p>
                            <a href='autor-portfl.php?autor-id=$post_userId' id='autor-id' data-after='Visite o autor!'>
                                Id do autor: $post_userId
                            </a>
                        </div>
                        <p class='title'> $title_excerpt </p>";
                        //gerando uma data fake pra colocar junto com o nome do autor

                        $start = strtotime("10 October 2017");//Start point of our date range.
                        $end = strtotime("22 November 2019");//End point of our date range.
                        $timestamp = mt_rand($start, $end);//Custom range.
                        $fake_data = date("Y-m-d", $timestamp);
                        $sql_users = "SELECT * FROM users WHERE id = $post_userId";
                        $result_users = $conn->query($sql_users);
                        if ($result_users->num_rows > 0) { // output data of each row
                            while($row_users = $result_users->fetch_assoc()) {
                                //o que fazer com o resultado
                                $user = $row_users;
                                $user_name = $user['name'];
                                echo "<p class='autor'> Escrito por $user_name em $fake_data </p>";
                                echo "<p class='content'> $post_body </p>
                                </div>
                                <div class='comentarios'>
                                <hr>
                                <p> COMENTÁRIOS </p>";

                                $sql_comments = "SELECT * FROM comments WHERE postId = $post_id";
                                $result_comments = $conn->query($sql_comments);
                                if ($result_comments->num_rows > 0) { // output data of each row
                                    while($row_comments = $result_comments->fetch_assoc()) {
                                        $comentario = $row_comments;
                                        $comentario_email = $comentario['email'];
                                        $comentario_body = $comentario['body'];
                                        echo "<div class='comentario'>
                                        
                                        <div class='comentario-info'>
                                            <p>$comentario_email diz: </p>
                                        </div>
                                        <div class='comentario-conteudo'>
                                            <p> $comentario_body </p>
                                        </div>
                                      </div>";
                                    }
                                    echo "</div>
                                </div>";
                                } else {
                                    //caso não ocorrer a conexão com a db
                                }
                            }
                        } else {
                            //caso dê erro na conexão
                        }
            }
        } else {
            echo "0 results";
        }
        $conn->close();
                ?>
        </div>
        <div class='paginaccion'>
        <?php
        if ($currentpage > 1) {
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a>";
            $prevpage = $currentpage - 1;
            echo "<a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a>";
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
       ?>
        </div>


        
    <div class="popup-blog"></div>


    </section>
<?php include 'footer.php'; ?>