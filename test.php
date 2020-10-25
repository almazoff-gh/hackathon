<?php
require_once "includes/header.php";

if ( empty( $_SESSION[ "id" ] ) || empty( $_GET[ "test_id" ] ) )
    header( "Location: index.php", 301 );

require_once "engine/CTaskController.php";

$m_pTaskController = new CTaskController( $_SESSION[ "id" ], $_GET[ "test_id" ] );
if ( !$m_pTaskController->IsValid( ) )
    header( "Location: index.php", 301 );

$m_aTasks = $m_pTaskController->GetTasks( );

if ( isset( $_POST[ "answered" ] ) ):
    $m_iResult = $m_pTaskController->SendTask( $_POST );
    $m_sModifier = "success";

    if ( $m_iResult < 70 && $m_iResult > 35 )
        $m_sModifier = "warning";
    else if ( $m_iResult <= 35 )
        $m_sModifier = "danger";

?>
    <div class="container mt-5 py-3">
        <div class="alert alert-<?php echo $m_sModifier ?>">Ваш результат <?php echo $m_iResult ?></div>
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2">
                <a href="index.php" class="btn btn-primary mt-3">На главную</a>
            </div>
            <div class="col-5"></div>
        </div>
    </div>
<?php
else:
?>
<div class="container my-3 py-5">
    <form method="post">
        <input type="hidden" name="answered" value="answered">
    <?php
    $m_nIdx = 1;
    foreach ( $m_aTasks as $m_Task ):
    ?>
        <div class="card mt-3">
            <div class="card-header">
                <?php echo "Задание #" . $m_nIdx ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $m_Task[ "context" ] ?></h5>
                    <div class="form-group">
                        <label for="<?php echo $m_nIdx ?>">Введите ответ</label>
                        <input type="text" class="form-control" name="<?php echo $m_nIdx ?>" id="<?php echo $m_nIdx ?>"
                               placeholder="Ответьте на вопрос" required>
                    </div>
            </div>
        </div>
    <?php
    $m_nIdx++;
    endforeach;
    ?>
        <button type="submit" class="btn btn-success mt-3">Отправить</button>
    </form>
</div>
<?php
endif;
require_once "includes/footer.php";