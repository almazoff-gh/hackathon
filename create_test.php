<?php
require_once "includes/header.php";
require_once "engine/CTaskManager.php";

if ( empty( $_SESSION[ "id" ] ) )
{
    header( "Location: index.php", 301 );
    exit( );
}

/*$m_pTaskManager = new CTaskManager( $_SESSION[ "id" ] );
if ( !$m_pTaskManager->HasPermission( ) )
{
    header( "Location: index.php", 301 );
    exit( );
}*/

$m_aParams = array
(
    "classes" => array( 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11 ),
    "letters" => array( "А", "Б", "В", "Г", "Д", "Е", "Ж", "З", "И", "К", "Л", "М", "Н", "И", "О", "П", "Р", "С", "Т" ),
);
?>

<div class="container my-5 py-3">
    <h1>Добавить тест</h1>
    <form>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="schools">Выберите школу</label>
                    <select class="form-control" id="schools" name="school">
                        <?php
                        //foreach ( $m_pTaskManager->GetSchoolList( ) as $m_School ):
                        ?>
                            <!--<option value="<?php //echo $m_School[ "id" ] ?>">
                                <?php //echo $m_School[ "school" ] ?></option>-->
                        <?php
                        //endfor;
                        ?>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
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
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="question_mode">Выберите тип вопроса</label>
                                        <select class="form-control" id="question_mode" name="question_mode">
                                            <option value="0">Выбор ответа</option>
                                            <option value="1">Ввод текста</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 pt-md-4">
                                        <div class="form-check mt-md-3">
                                            <input class="form-check-input" name="autocreate" type="checkbox"
                                                   value="autocreate" id="autocreate">
                                            <label class="form-check-label" for="autocreate">
                                                Сгенерировать автоматически
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Создать</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">

</script>
<?php
require_once "includes/footer.php";
