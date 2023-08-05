<?php 
if(isset($_SESSION['email_user'])) unset( $_SESSION['email_user'] );

header("Location:index.php?action=home");
exit();