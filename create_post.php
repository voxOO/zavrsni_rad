<?php
     $title=$_POST['title'];
     $body=$_POST['body'];
     $author=$_POST['author'];

     if (empty($title)|| empty($body) || empty($author)) {
        header('Location:http://localhost:8000/create.php?&error=error');
        return;
     }
   
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
    $time = date('y-m-d H:i:s');
    $sql1 = "INSERT INTO posts (title,body,author, created_at) values ('$title','$body','$author', '$time')";
    $statement = $connection->prepare($sql1);
    $connection->exec($sql1);
  
    header('Location:http://localhost:8000/index.php');
    
?>