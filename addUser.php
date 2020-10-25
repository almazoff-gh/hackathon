<?php
require_once "includes/header.php";
require_once "engine/UserManager.php";
$UserManager = new UserManager();

?>
<div class="container my-5 py-3 text-center">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Добавления пользователя
                </div>
                <div class="card-body">
                    <form>
                        <div class="row justify-content-center">
                            <div class="col-md-5 mb-3">
                                <label for="firstName">Имя</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="firstName">Фамилия</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5 mb-3">
                                <label for="firstName">Логин</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="firstName">Пароль</label>
                                <input type="text" class="form-control" id="firstName" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-5 mb-3">
                                <label for="country">Класс</label>
                                <select class="custom-select d-block w-100" id="country" required="">
                                    <option value="">Выберите..</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                    <option value="">5</option>
                                    <option value="">6</option>
                                    <option value="">7</option>
                                    <option value="">8</option>
                                    <option value="">9</option>
                                    <option value="">10</option>
                                    <option value="">11</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="country">Класс</label>
                                <select class="custom-select d-block w-100" id="country" required="">
                                    <option value="">Выберите..</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                    <option value="">5</option>
                                    <option value="">6</option>
                                    <option value="">7</option>
                                    <option value="">8</option>
                                    <option value="">9</option>
                                    <option value="">10</option>
                                    <option value="">11</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Добавить</button>
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
