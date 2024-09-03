<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP-DB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .m-border {
            border: 1px solid #ccc;
            border-radius: 10px;
            width: 800px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php
    if (!isset($_SESSION['username'])) {
        header("Location: ../HW07/loginCrud/login.php");
        exit();
      };

    include "header.php";
    include "main-menu.php";
    include "footer.php";
?>
</body>
</html>
