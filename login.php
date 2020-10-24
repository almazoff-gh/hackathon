<?php
require_once "includes/header.php";
require_once "engine/UserManager.php";

$err = null;
$UserManager = new UserManager();

if(isset($_SESSION['id'])) {
    $err = $_SESSION['id'] . ' - Твой ID';
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
                $err = "Вы успешно авторизовались!";
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
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Имя пользователя</label>
                            <input type="email" class="form-control" id="username" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-success">Войти</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<form action="login.php" method="POST">
    Логин: <input type="text" name="username" /><br><br>
    Пароль: <input type="text" name="password" /><br><br>
    <input type="submit" name="submit" value="Войти">
    <p><?=$err?></p>
</form>
<?php require_once "includes/footer.php";