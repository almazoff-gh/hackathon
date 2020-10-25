<?php
require_once "includes/header.php";
require_once "engine/CTaskManager.php";

if ( empty( $_SESSION[ "id" ] ) )
{
    header( "Location: index.php", 301 );
    exit( );
}

$m_pTaskManager = new CTaskManager( $_SESSION[ "id" ] );
if ( !$m_pTaskManager->HasPermission( ) )
{
    header( "Location: index.php", 301 );
    exit( );
}

if ( isset( $_GET[ "remove" ] ) )
{
    $m_pTaskManager->RemoveTest( $_GET[ "remove" ] );
    header( "Location: user.php", 301 );
    exit( );
}

if ( isset( $_POST[ "submit" ] ) )
    $m_pTaskManager->CreateTest( $_POST );

$m_pUserManager = new UserManager( );
$m_User = $m_pUserManager->GetByID( $_SESSION[ "id" ] );

$m_aParams = array
(
    "classes" => array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ),
    "letters" => array( "А", "Б", "В", "Г", "Д", "Е", "Ж", "З", "И", "К", "Л", "М", "Н", "И", "О", "П", "Р", "С", "Т" ),
);
?>

<div class="container my-5 py-3">
    <h1>Добавить тест</h1>
    <form method="post">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <div class="form-group">
                        <label for="test_name">Введите название теста</label>
                        <input type="text" class="form-control" id="test_name" name="test_name"
                               placeholder="Тест на знание времен года">
                    </div>
                    <input type="hidden" name="school" value="<?php echo $m_User[ "unique_group" ] ?>">
                    <input type="hidden" name="owner" value="<?php echo $_SESSION[ "id" ] ?>">
                    <div class="row my-2">
                        <div class="col-8">
                            <label for="class_number">Выберите класс</label>
                            <select class="form-control" id="class_number" name="class_number">
                                <?php
                                for ( $i = 0; $i < count( $m_aParams[ "classes" ] ); $i++ ):
                                ?>
                                    <option value="<?php echo $m_aParams[ "classes" ][ $i ] ?>">
                                        <?php echo $m_aParams[ "classes" ][ $i ] ?></option>
                                <?php
                                endfor;
                                ?>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="class_letter">Буква класса</label>
                            <select class="form-control" id="class_letter" name="class_letter">
                                <?php
                                for ( $i = 0; $i < count( $m_aParams[ "letters" ] ); $i++ ):
                                    ?>
                                    <option value="<?php echo $m_aParams[ "letters" ][ $i ] ?>">
                                        <?php echo $m_aParams[ "letters" ][ $i ] ?></option>
                                <?php
                                endfor;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div id="options">

                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="question_1">Введите вопрос</label>
                                            <input type="text" class="form-control" id="question_1" name="question_1"
                                                   placeholder="Сколько дней в году?">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="answer_1">Введите ответ</label>
                                            <input type="text" class="form-control" id="answer_1" name="answer_1"
                                                   placeholder="Много">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-success" name="submit" value="1">Создать</button>
                    </div>
                    <div class="col-6 text-end">
                        <a href="#" id="add_question" class="text-right">Добавить вопрос</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    var m_iCurrentQuestion = 1;

    $( "#add_question" ).on( "click", function () {
        m_iCurrentQuestion++;
        $( "#options" ).append
        (
            "<div class=\"card my-2\">\n" +
            "                        <div class=\"card-body\">\n" +
            "                            <div class=\"form-group\">\n" +
            "                                <div class=\"row\">\n" +
            "                                    <div class=\"col-md-6\">\n" +
            "                                        <div class=\"form-group\">\n" +
            "                                            <label for=\"question_1\">Введите вопрос</label>\n" +
            "                                            <input type=\"text\" class=\"form-control\" id=\"question_" + m_iCurrentQuestion + "\" name=\"question_" + m_iCurrentQuestion + "\"\n" +
            "                                                   placeholder=\"Сколько дней в году?\">\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                    <div class=\"col-md-6\">\n" +
            "                                        <div class=\"form-group\">\n" +
            "                                            <label for=\"answer_1\">Введите ответ</label>\n" +
            "                                            <input type=\"text\" class=\"form-control\" id=\"answer_1\" name=\"answer_" + m_iCurrentQuestion + "\"\n" +
            "                                                   placeholder=\"Много\">\n" +
            "                                        </div>\n" +
            "                                    </div>\n" +
            "                                </div>\n" +
            "                            </div>\n" +
            "                        </div>\n" +
            "                    </div>\n" +
            "                </div>"
        );
    } );
</script>
<?php
require_once "includes/footer.php";
