<?php      
require_once 'config/function.php';           
require_once 'inc/header.inc.php';

if (isset($_GET['a']) && $_GET['a']=='dis'){

    unset($_SESSION['user']);
    $_SESSION['messages']['info'][]='A bientôt !!';
    header('location:./');
    exit();
}
?>





<?php     require_once 'inc/footer.inc.php';          ?>
