<?php
require_once "includes/header.php";
require_once "engine/UserManager.php";
$UserManager = new UserManager();
$user = $UserManager->GetByID($_SESSION['id']);
$permissions = [
    'Администратор' => 3,
    'Директор' => 2,
    'Преподаватель' => 1,
    'Ученик' => 0
];
$sch = '<div class="col-md-5 mb-3">
                    <label for="country">Учебное заведение</label>
                    <select class="custom-select d-block w-100" id="country" name="school" required="">
                        <option value="">Выберите...</option>
                        <option>United States</option>
                    </select>
                    <div class="invalid-feedback"> Please select a valid country. </div>
                </div>';

if($user['permission'] == 3) {
    $sch = '<div class="col-md-3 mb-3">
                    <label for="zip">Учебное заведение</label>
                    <input type="text" class="form-control" id="zip" placeholder="№312" required="" name="school_2">
                    <div class="invalid-feedback"> Zip code required. </div>
                </div>';
}
if(isset($_POST['submit'])) {
    if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['permission']) && isset($_POST['group'])) {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $school = isset($school) ? $school : 0;
        $permission = $permissions[$_POST['permission']];
        $group = $_POST['group'];
        $name = $firstName . ' ' . $lastName;
        $unique_group = $school . '_' . $group;

        $admin = $UserManager->GetByID($_SESSION['id']);
        if($admin['permission'] < 1)
            header('location: index.php');

        $UserManager->Create($username, $password, $name, 0, $permission);
        if($admin['permission'] == 3) {
            if(isset($_POST['school_2'])) {
                $user = $UserManager->Get($username);
                $UserManager->CreateSchool($_POST['school_2'], $user['id']);

                $school = $UserManager->GetSchoolByDir($user['id']);
                $UserManager->EditGroup($username, $school['id']);
            }else{
                print('Вы не указали школу!');
            }
        }else{
            $UserManager->EditGroup($username, $school);
        }
    }else{
        #TODO Ошибка не все заполнено
    }
}
?>

    <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Создание Пользователя</h4>
        <form class="needs-validation" novalidate="" action="addUser.php" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">Имя</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Вася" value="" required="">
                    <div class="invalid-feedback"> Valid first name is required. </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Фамилия</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Пупкин" value="" required="">
                    <div class="invalid-feedback"> Valid last name is required. </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="username">Логин</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Vasya_Pupkin_2020" required="">
                        <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="password">Пароль</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="VasyaPupkin12345" required="">
                        <div class="invalid-feedback" style="width: 100%;"> Your username is required. </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?=$sch?>
                <div class="col-md-4 mb-3">
                    <label for="state">Права</label>
                    <select class="custom-select d-block w-100" id="state" name="permission" required="">
                        <option value="">Выберите...</option>
                        <option>Ученик</option>
                        <option>Преподаватель</option>
                        <option>Директор</option>
                        <option>Администратор</option>
                    </select>
                    <div class="invalid-feedback"> Please provide a valid state. </div>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="zip">Класс</label>
                    <input type="text" class="form-control" id="zip" placeholder="10Б" required="" name="group">
                    <div class="invalid-feedback"> Zip code required. </div>
                </div>
            </div>
            <button name="submit" class="btn btn-primary btn-lg btn-block" type="submit">Создать</button>
        </form>
    </div>
<?php require_once "includes/footer.php";