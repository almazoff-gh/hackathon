<?php
require_once "includes/header.php";
?>

    <div class="container my-5 py-5">
        <h1 class="text-center">NStudy</h1>
        <p class="text-center">Подайте заявку на подключение вашей школы прямо сейчас!</p>

        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Адрес эл.почты</label>
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                            </div>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Отправить заявку
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Заявка отправлена</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Спасибо за отправление заявки на подключение вашей школы. Скоро мы свяжемся с вами по EMail для
                    уточнения деталей
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>

<?php
require_once "includes/footer.php";
