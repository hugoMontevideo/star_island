<?php  
require_once 'config/function.php';           

// ***************** teaser ******************
$current_date = new \DateTime();
$expected_delivery_date = '2023-06-30 00:00:00';
$nd = new \DateTime($expected_delivery_date);

if($current_date<$nd){
    header('location:./front/teaser.php');
    exit();
}
// ***************** end teaser ******************


require_once 'inc/header.inc.php';

if (isset($_GET['a']) && $_GET['a']=='dis'){

    unset($_SESSION['user']);
    $_SESSION['messages']['info'][]='A bientôt !!';
    header('location:./');
    exit();
}
?>





<?php     require_once 'inc/footer.inc.php';          ?>
