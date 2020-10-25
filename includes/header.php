<?php

session_start( );

?>
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>nstudy</title>
    <script src="assets/jquery-slim.min.js"></script>
    <script src="assets/bootstrap-bundle.js"></script>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light py-2">
    <div class="container">
        <a class="navbar-brand" href="index.php">NStudy</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_school.php">Подключить школу</a>
                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <?php
                if ( empty( $_SESSION[ "id" ] ) ):
                ?>
                <a href="login.php" class="btn btn-success my-2 my-sm-0">Войти</a>
                <?php
                else:
                ?>
                <a href="user.php">Мой профиль</a>
                <?php
                endif;
                ?>
            </form>
        </div>
    </div>
</nav>