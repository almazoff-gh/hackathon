<?php
require_once "includes/header.php";
require_once "engine/UserManager.php";

$UserManager = new UserManager();
if(!isset($_SESSION['id']))
    header('location: index.php');

$user = $UserManager->GetByID($_SESSION['id']);

$m_aUserData = array();

switch ( $user[ "permission" ] )
{
    case 0:
        $m_aUserData = array( "Ученик", "secondary" );
        break;
    case 1:
        $m_aUserData = array( "Учитель", "success" );
        break;
    case 2:
        $m_aUserData = array( "Директор", "primary" );
        break;
    case 3:
        $m_aUserData = array( "Hypervisor", "danger" );
        break;
    default:
        header( "Location: index.php", 301 );
}
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
                    <h4 class="text-center"><span class="badge badge-<?php echo $m_aUserData[ 1 ] ?>">
                            <?php echo $m_aUserData[ 0 ] ?></span></h4>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <?php
            if ( $user[ "permission" ] == 0 ):
            ?>
            <div class="card">
                <div class="card-header">
                    Доступные тесты
                </div>
                <div class="card-body">
                    <div class="table-responsive-md">
                        <table class="table">
                            <tbody>
                            <?php
                            foreach ( $UserManager->GetAvailableTests( $_SESSION[ "id" ] ) as $m_Test ):
                            ?>
                            <tr>
                                <th scope="row">1</th>
                                <td><a href="test.php?test_id=<?php echo $m_Test[ "id" ] ?>">
                                        <?php echo $m_Test[ "test_name" ] ?></a></td>
                                <td>30 мин</td>
                            </tr>
                            <?php
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            elseif ( $user[ "permission" ] == 1 ):
            ?>
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
                            <?php
                            $idx = 1;
                            foreach ( $UserManager->GetModifableTests( $_SESSION[ "id" ] ) as $m_Test ):
                            ?>
                            <tr>
                                <th scope="row" class="py-3"><?php echo $idx ?></th>
                                <td class="py-3"><?php echo $m_Test[ "test_name" ] ?></td>
                                <td class="py-3">30 мин</td>
                                <td><a href="create_test.php?remove=<?php echo $m_Test[ "id" ] ?>" class="btn btn-danger">Удалить</a></td>
                            </tr>
                            <?php
                            $idx++;
                            endforeach;
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            endif;
            ?>
        </div>
    </div>
    <!--<div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Статистика
                </div>
                <div class="card-body">
                    <?php
                    if ( $user[ "permission" ] == 1 || $user[ "permission" ] == 2 ):
                    ?>
                    <div class="table-responsive-md">
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
                    </div>
                    <?php
                    elseif ( $user[ "permission" ] == 0 ):
                    ?>
                    <div class="table-responsive-md">
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
                    </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>-->
</div>
<?php require_once "includes/footer.php";