<?php
require_once "includes/header.php";
require_once "engine/UserManager.php";

$err = null;
$UserManager = new UserManager();
if(isset($_POST['submit'])) {
    if(empty($_POST['username']) || empty($_POST['password'])) {
        $err = "Вы не ввели логин/пароль!";
    }else{
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($UserManager->Exist($username)) {
            if($UserManager->VerifyPassword($username, $password)) {
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
<form action="login.php" method="POST">
    Логин: <input type="text" name="username" /><br><br>
    Пароль: <input type="text" name="password" /><br><br>
    <input type="submit" name="submit" value="Войти">
    <p><?=$err?></p>
</form>
<?php require_once "includes/footer.php";