<?php
require_once "includes/header.php";
require_once "engine/UserManager.php";

$err = "";
$UserManager = new UserManager();

print_r( $_SESSION );

if(isset($_SESSION['id'])) {
    header( "Location: index.php", 301 );
}elseif(isset($_POST['submit'])) {
    if(empty($_POST['username']) || empty($_POST['password'])) {
        $err = "Вы не ввели логин/пароль!";
    }else{
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($UserManager->Exist($username)) {
            $user = $UserManager->Get($username);

            if($UserManager->VerifyPassword($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                header( "Location: index.php", 301 );
            }else{
                $err = "Вы ввели неверный пароль!";
            }
        }else{
            $err = "Такого пользоваеля не существует!";
        }
    }
}

?>

<div class="container my-5 py-3">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <b>Авторизация</b>
                </div>
                <div class="card-body">
                    <?php

                    if ( strlen( $err ) > 3 ):

                    ?>
                    <div class="alert alert-danger">
                        <?php echo $err ?>
                    </div>
                    <?php

                    endif;

                    ?>
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Имя пользователя</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-success" name="submit" value="submit">Войти</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<?php require_once "includes/footer.php";