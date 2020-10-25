<?php
require_once "includes/header.php";
require_once "engine/UserManager.php";
$UserManager = new UserManager();
$m_aParams = array
(
    "classes" => array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ),
    "letters" => array( "А", "Б", "В", "Г", "Д", "Е", "Ж", "З", "И", "К", "Л", "М", "Н", "И", "О", "П", "Р", "С", "Т" ),
);
$permissions = array
(
    'Директор' => 2
);
$schools = $UserManager->getSchools();
if(isset($_POST['submit'])) {
    if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['permission']) && isset($_POST['school'])) {
        $name = htmlspecialchars($_POST['firstName'] . ' ' . $_POST['lastName']);
        $username = $_POST['username'];
        $password = $_POST['password'];
        $permission = $_POST['permission'];
        $group = 0;

        if($UserManager->Exist($username)) {
            print "Данный логин уже занят!";
        }else{
            $UserManager->Create($username, $password, $name, $group, $permission);
            $user = $UserManager->Get($username);

            $UserManager->CreateSchool($_POST['school'], $user['id']);
            $school_id = $UserManager->GetSchoolByDir($user['id'])['id'];
            $UserManager->EditGroup($username, $school_id);
        }
    }else{
        print "Вы не указали все данные!";
    }
}
?>
<div class="container my-5 py-3 text-center">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Добавления школы
                </div>
                <div class="card-body">
                    <form method="post" action="addSchool.php">
                        <div class="row justify-content-center">
                            <div class="col-md-5 mb-3">
                                <label for="firstName">Имя</label>
                                <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="lastName">Фамилия</label>
                                <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5 mb-3">
                                <label for="username">Логин</label>
                                <input type="text" class="form-control" name="username" id="username" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="password">Пароль</label>
                                <input type="text" class="form-control" name="password" id="password" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5 mb-3">
                                <label for="country">Права</label>
                                <select class="custom-select d-block w-100" name="permission" id="country" required="">
                                    <option value="">Выберите..</option>
                                    <?php
                                    foreach($permissions as $key => $perm):
                                        ?>
                                        <option value="<?php echo $perm ?>">
                                            <?php echo $key ?></option>
                                    <?php
                                    endforeach;
                                    ?>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="school">Школа</label>
                                <input type="text" class="form-control" name="school" id="school" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Добавить</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php
require_once "includes/footer.php";
?>
