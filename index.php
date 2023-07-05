<?php  
require_once 'config/function.php';  

// le chemin absolu de l'application
const BASE_PATH_DIR = __DIR__ ;
// $bool = unlink(BASE_PATH_DIR . '/assets/upload/avatar/team/64a42939a23c404_07_2023_14_14_17_avatar-cochon.jpg');
// header('location:http://localhost/PHP/star_island');
// var_dump($bool); die;

// ***************** teaser ******************
// $current_date = new \DateTime();
// $expected_delivery_date = '2023-06-30 00:00:00';
// $nd = new \DateTime($expected_delivery_date);
// // var_dump($current_date<$nd); die();
// if($current_date<$nd){
//     header('location:./front/teaser.php');
//     exit();
// }
// ***************** end teaser ******************
if(isset ($_GET['back']) && $_GET['back'] == 'true'){
    require_once 'inc/backheader.inc.phtml';  
}else{
    require_once 'inc/header.inc.php';
}

if (isset($_GET['a']) && $_GET['a']=='dis'){

    unset($_SESSION['user']);
    $_SESSION['messages']['info'][]='A bientôt !!';
    header('location:./');
    exit();
}

// grace a $action on pourra
// inclure le contenu de la bonne page
if ( isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = 'home';
}
// var_dump($_GET['action']); die();

// if( $action == 'team' 
//     || $action == 'register'
//     || $action == 'login'
//     || $action == 'userList'
//     || $action == 'home'
//     || $action == 'indexBack'
//     || $action == 'homeUpdate'
// ){

    require_once 'back/controllers/' .$action. '.php';  

// }else{
    
//     require_once $action. ".php";                
// }


if(isset ($_GET['back']) && $_GET['back'] == 'true'){
// if(isset ($_GET['action']) && $_GET['action'] == 'indexBack'){
    require_once 'inc/backheader.inc.phtml';  
}else{
    require_once 'inc/footer.inc.php';         
}
