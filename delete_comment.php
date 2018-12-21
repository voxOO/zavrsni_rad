<?php
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

    $comment_id= $_POST['comment_id'];
    $post_id= $_POST['post_id'];
   
    $sql1 = "DELETE from comments WHERE id=$comment_id";
    $statement = $connection->prepare($sql1);
    $connection->exec($sql1);

    header('Location: http://localhost:8000/single-post.php?post_id='.$post_id);


?>