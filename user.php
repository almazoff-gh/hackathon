<?php
require_once "includes/header.php";
require_once "engine/UserManager.php";

$UserManager = new UserManager();
if(!isset($_SESSION['id']))
    header('location: index.php');
$user = $UserManager->GetByID($_SESSION['id']);

if($user['permission'] < 1)
    print '<a href="test.php"><button type="button" class="btn btn-primary">Решать тесты</button></a>';
else
    print '<a href="addUser.php"><button type="button" class="btn btn-primary">Создать пользователя</button></a>';
?>
<?php require_once "includes/footer.php";