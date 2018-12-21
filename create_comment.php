<?php

    $post_id=$_POST['post_id'];
    $author =  $_POST['author'];
    $text_comment= $_POST['text'];

    if (empty($author)) {
        header('Location: http://localhost:8000/single-post.php?post_id='.$post_id."&error=error");
        return;
    }
    if (empty($text_comment)) {
        header('Location: http://localhost:8000/single-post.php?post_id='.$post_id."&error=error");
        return;
    }
   
    //echo $post_id;

    // ako su mysql username/password i ime baze na vasim racunarima drugaciji
    // obavezno ih ovde zamenite
    $servername = "127.0.0.1";
    $username = "root"; 
    $password = "vivify";
    $dbname = "blog_zavrsni";

    try {
        $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }

    $sql1 = "INSERT INTO comments (author,text,post_id) values ('$author','$text_comment','$post_id')";
    $statement = $connection->prepare($sql1);
    $connection->exec($sql1);


header('Location: http://localhost:8000/single-post.php?post_id='.$post_id);

?>