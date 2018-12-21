

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

            <form action="create_post.php" method="POST">
                <label for="title">Post title:</label><br>
                <input type="text" name="title"><br>
                <label for="body">Message:</label><br>
                <?php
                            if (isset($_GET['error'])) {
                                echo "<p class='warning alert alert-danger'>Please complete all fields</p>";  
                            }
                        ?>
                <textarea name="body" id="" cols="30" rows="10"></textarea><br>
                <label for="author">Author:</label><br>
                <input type="text" name="author"><br>
                <button class="btn btn-default">Submit</button>
            </form>
        </div>
        <?php
                  include 'sidebar.php';
         ?>
    </div>
 </main>   

<?php
    include "footer.php";
?>

</body>
</html>