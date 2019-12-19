
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Girassol&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/312820fbf8.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
    
    <title>Document</title>
</head>
<body>
<section id="header_certo">
    <div class="header-wrapper">
            <div class="posts <?php if (($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']) == 'localhost/json-project/exJSON/index.php'){ echo 'atual';} ?>">
                <a href='index.php'>POSTAGENS</a>
            </div>
            <div class="albums <?php if (($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']) == 'localhost/json-project/exJSON/album-page.php'){ echo 'atual';} ?>">
                <a href='album-page.php'>ALBUNS</a>
            </div>
            <div class="usuarios <?php if (($_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']) == 'localhost/json-project/exJSON/autor-list.php'){ echo 'atual';} ?>">
                <a href='autor-list.php'>USUÁRIOS</a>
            </div>
    </div>
</section>


<!-- <a href='autor-page.php?autor' -->