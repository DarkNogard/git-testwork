<?php
session_start();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Задачник</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="../../css/task.css" rel="stylesheet">
    <link href="../../css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" rel="stylesheet">


    <!-- JS -->
    <script src="../../js/jquery-3.3.1.js" type="text/javascript"></script>
    <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../../js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../../js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
    <script src="../../js/dataTables.responsive.js" type="text/javascript"></script>
    <script src="../../js/responsive.bootstrap4.min.js" type="text/javascript"></script>
    <script src="../../js/task.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">

            <div class="col-10 text-center">
                <a class="blog-header-logo text-dark" href="/">Задачник</a>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center">
                <?php if($_SESSION['login']){ ?>
                <img src="../../images/admin.jpg" class="rounded-circle mr-1" style="max-width: 36px;">
                <?php echo $_SESSION['login']; ?>
                    <button id="exit" class="btn btn-sm btn-outline-secondary ml-1">Выйти</button>
                <?php } else {?>
                    <a class="btn btn-sm btn-outline-secondary ml-1" href="/login">Войти</a>
                <?php } ?>
            </div>
        </div>
    </header>



    <div class="pt-5 rounded" style="max-height: 350px; overflow: hidden;">
        <img src="/images/head-img.jpg" width="100%">
    </div>


</div>

<main role="main" class="container pt-5">
    <div class="row">
        <div class="col-md-12 blog-main">

            <div class="blog-post" style="min-height: 346px;">
                <?php include 'application/views/'.$content_view; ?>
            </div>

        </div>

    </div>

</main>

<footer class="blog-footer">
    <p>Cверстан при поддержке <a href="https://getbootstrap.com/">Bootstrap</a> </p>
    <p>
        by <a href="#">#ДобрыйЧеловек</a>.
    </p>
</footer>
</body>
</html>