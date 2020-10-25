<?php
require_once "includes/header.php";
require_once "engine/UserManager.php";

$UserManager = new UserManager();
if(!isset($_SESSION['id']))
    header('location: index.php');

$user = $UserManager->GetByID($_SESSION['id']);
?>
<div class="container my-5 py-3">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <div class="text-center my-2 pb-3">
                        <img src="img/user.png" class="rounded" alt="user" style="max-width: 50%">
                    </div>
                    <h5 class="card-title text-center"><?php echo $user[ "display_name" ] ?></h5>
                    <h4 class="text-center"><span class="badge badge-success">Учитель</span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <!--<div class="card">
                <div class="card-header">
                    Доступные тесты
                </div>
                <div class="card-body">
                    <div class="table-responsive-md">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td><a href="test.php">Тест на знание логики игры майнкрафт</a></td>
                                <td>30 мин</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>-->
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6 py-2">
                            Мои тесты
                        </div>
                        <div class="col-6">
                            <a href="create_test.php" class="btn btn-primary float-right">Создать тест</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive-md">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row" class="py-3">1</th>
                                <td class="py-3"><a href="test.php">Тест на знание логики игры майнкрафт</a></td>
                                <td class="py-3">30 мин</td>
                                <td><a href="" class="btn btn-danger">Удалить</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Статистика
                </div>
                <div class="card-body">
                    <!--<div class="table-responsive-md"> teacher / director
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Ученик</th>
                                <th scope="col">Оценки за тесты</th>
                                <th scope="col">Средний балл</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">Говноед говноедов</th>
                                <td>5 2 3 2 5 3 4 2 4 2 5 3 5 3</td>
                                <td>3.75</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>-->
                    <!--<div class="table-responsive-md"> student
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Предмет</th>
                                <th scope="col">Оценки за тесты</th>
                                <th scope="col">Средний балл</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">Русский язык</th>
                                <td>5 2 3 2 5 3 4 2 4 2 5 3 5 3</td>
                                <td>3.75</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "includes/footer.php";