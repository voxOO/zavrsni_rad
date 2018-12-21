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

<body>
<?php
     include "header.php";
?>
<main role="main" class="container">

    <div class="row">

        <div class="col-sm-8 blog-main">
            <?php
               if (isset($_GET['post_id'])) {
              // pripremamo upit
                $sql =
                "SELECT *
                FROM posts
                WHERE id = {$_GET['post_id']}";
                
                $statement = $connection->prepare($sql);

                // izvrsavamo upit
                $statement->execute();

                // zelimo da se rezultat vrati kao asocijativni niz.
                // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
                $statement->setFetchMode(PDO::FETCH_ASSOC);

                // punimo promenjivu sa rezultatom upita
                $singlepost = $statement->fetch();

                // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                    //   echo '<pre>';
                    //   var_dump($posts);
                    //   echo '</pre>';
                    $sql1="SELECT * from comments WHERE post_id = {$_GET['post_id']}";
                    $statement1 =$connection->prepare($sql1);
                    $statement1->execute();
                    $statement1->setFetchMode(PDO::FETCH_ASSOC);

                    $comments = $statement1->fetchAll();
                    $post_id = $_GET['post_id'];

            ?>
             
            
             <h2 class="blog-post-title"><?php echo $singlepost['title']?></h2>
                <p class="blog-post-meta"><?php echo $singlepost['created_at']?> <a href="#">Mark</a></p>
                <div>
                    <p><?php echo $singlepost['body'];?></p>
                </div>

                <form action="create_comment.php" method="POST">
                    <label for="author">Name:</label>
                    <input id ="author_submitt" type="text" name="author"><br>
                        <?php
                            if (isset($_GET['error'])) {
                                echo "<p class='warning alert alert-danger'>Please complete all fields</p>";  
                            }
                        ?>
                    <input type="text" hidden name="post_id" value="<?php echo $post_id?>"><br>
                    <label for="text">Comment:</label><br>
                    <textarea name="text" id="" cols="30" rows="10"></textarea><br>
                    <input type="submit" value="Submit"><br>
                </form>
                <button id="comment_button" class="btn btn-default" onclick="comments_function()">Hide comments</button>

                <div id="comments_div">
                    <ul>
                        <?php
                            foreach ($comments as $comment) {
                        ?>
                        <li>
                            <?php echo $comment['author']." ".$comment['text']."<hr>";?>
                        </li>
                        <form action="delete_comment.php" method="POST">
                        <input type="text" hidden name="comment_id" value="<?php echo $comment['ID']?>">
                        <input type="text" hidden name="post_id" value="<?php echo $post_id?>">
                        <button class="btn btn-default" >Delete comment</button>
                        </form>
                        <?php
                            };
                        ?>
                    </ul>
                    <form action="delete_post.php" method="POST">
                    <input type="text" hidden name=post_id value="<?php echo $post_id?>">
                    <button class="btn btn-primary">Delete this post</button>
                    </form>
               </div>
               <br>
            <nav class="blog-pagination">
                <a class="btn btn-outline-primary" href="#">Older</a>
                <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
            </nav>
            <?php
                };
            ?>
        </div><!-- /.blog-main -->
    <?php
    include 'sidebar.php';
    ?>
                           
    </div><!-- /.row -->

</main><!-- /.container -->

<?php
include 'footer.php';
?>
</body>
<script src="javascript/javascript.js"></script>
</html>