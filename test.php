<?php
require_once "includes/header.php";

if ( empty( $_SESSION[ "id" ] ) || empty( $_GET[ "test_id" ] ) )
    header( "Location: index.php", 301 );

require_once "engine/CTaskController.php";

$m_pTaskController = new CTaskController( $_SESSION[ "id" ], $_GET[ "test_id" ] );
if ( !$m_pTaskController->IsValid( ) )
    header( "Location: index.php", 301 );

$m_aTasks = $m_pTaskController->GetTasks( );

?>

<div class="container my-3 py-5">
    <form>
    <?php
    $m_nIdx = 1;

    foreach ( $m_aTasks as $m_Task ):
    ?>
        <div class="card">
            <div class="card-header">
                <?php echo "Задание #" . $m_nIdx ?>
            </div>
            <div class="card-body">
                <h5 class="card-title"><?php echo $m_Task[ "context" ] ?></h5>
                <?php
                if ( $m_Task[ "type" ] == 0 ):
                    $m_nOption = 0;
                    foreach ( $m_Task[ "options" ] as $m_Option ):
                ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="<?php echo $m_nIdx . "_" . $m_nOption ?>"
                               value="1" id="<?php echo $m_nIdx . "_" . $m_nOption ?>">
                        <label class="form-check-label" for="<?php echo $m_nIdx . "_" . $m_nOption ?>">
                            <?php echo $m_Option ?>
                        </label>
                    </div>
                <?php
                    $m_nOption++;
                    endforeach;
                else:
                ?>

                <?php
                endif;
                ?>
            </div>
        </div>
    <?php
    $m_nIdx++;

    endforeach;
    ?>
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>
</div>

<?php
require_once "includes/footer.php";