<?php 
session_start();
session_unset();
session_destroy();
header("Location: http://localhost/dsin-cabeleleila/website/view/public/login.php");
exit();
?>