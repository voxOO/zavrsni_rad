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
?>

<!doctype html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Vivify Blog</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="styles/blog.css" rel="stylesheet">
    <link href="styles/styles.css" rel="stylesheet">
</head>

<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">
            <?php
              // pripremamo upit
              $sql1 = "SELECT * FROM posts ORDER BY created_at";
              $statement = $connection->prepare($sql1);

              // izvrsavamo upit
              $statement->execute();

              // zelimo da se rezultat vrati kao asocijativni niz.
              // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
              $statement->setFetchMode(PDO::FETCH_ASSOC);

              // punimo promenjivu sa rezultatom upita
              $posts = $statement->fetchAll();

              // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                //   echo '<pre>';
                //   var_dump($posts);
                //   echo '</pre>';
            ?>
             <?php
                foreach ($posts as $post) {
            ?>
            
             <h2 class="blog-post-title"><?php echo $post['title']?></h2>
                <p class="blog-post-meta"><?php echo $post['created_at']?> <a href="#">Mark</a></p>
                <div>
                    <p><?php echo $post['body']?></p>
                </div>
            <?php
                }
            ?>
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>
            
        </div><!-- /.blog-main -->
    <?php
    include 'sidebar.php';
    ?>

    </div><!-- /.row -->

</main><!-- /.container -->

<?php
include 'footer.php';
?>