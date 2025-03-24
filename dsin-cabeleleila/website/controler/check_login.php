<?php

    include "functions.php"; // Certifique-se de que essa função está implementada corretamente

    $email = htmlspecialchars($_POST["email"]);
    $senha = htmlspecialchars($_POST["password"]); 

    check_login($email, $senha);
?>

