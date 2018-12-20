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

          
<aside class="col-sm-3 ml-sm-auto blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>Latest posts</h4>
                <?php
              // pripremamo upit
              $sql1 = "SELECT id,title FROM posts ORDER BY created_at";
              $statement = $connection->prepare($sql1);

              // izvrsavamo upit
              $statement->execute();

              // zelimo da se rezultat vrati kao asocijativni niz.
              // ukoliko izostavimo ovu liniju, vratice nam se obican, numerisan niz
              $statement->setFetchMode(PDO::FETCH_ASSOC);

              // punimo promenjivu sa rezultatom upita
              $posts_title = $statement->fetchAll();

              // koristite var_dump kada god treba da proverite sadrzaj neke promenjive
                //   echo '<pre>';
                //   var_dump($posts_title);
                //   echo '</pre>';
            ?>
            <ul>
                <?php
                    foreach($posts_title as $title) {
                ?>
                <a href="single-post.php?post_id=<?php echo($title['id'])?>"><li>
                        <?php
                            echo $title['title'];
                        ?>
                </a></li>
                <?php
                    }
                ?>
            </ul>
            </div>
</aside><!-- /.blog-sidebar -->