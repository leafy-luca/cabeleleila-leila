<?php
session_start();
include "connection.php";

function check_login($email, $senha) {
    global $pdo;
    
    // Verifica se o usuário é o administrador, consultando o banco de dados
    $sql = "SELECT * FROM ADMINISTRADOR WHERE email = :email AND senha = :senha";
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":email", $email);
    $comando->bindParam(":senha", $senha);
    $comando->execute();
    $admin = $comando->fetch();

    // Verifica se o administrador foi encontrado
    if ($admin) {
        $_SESSION["admin"] = true;
        header("Location: ../view/admin/dashboard.php");
        exit();
    }

    // Se não for admin, verificar no banco de dados para clientes
    $sql = "SELECT * FROM CLIENTE WHERE email = :email AND senha = :senha";
    $comando = $pdo->prepare($sql);
    $comando->bindParam(":email", $email);
    $comando->bindParam(":senha", $senha);
    $comando->execute();
    $res = $comando->fetch();

    if ($res) {
        $_SESSION["id_cliente"] = $res["id_cliente"];
        $_SESSION["nome"] = $res["nome"];
        $_SESSION["login"] = true;
        header("Location: ../view/public/index.php");
        exit();
    } else {
        echo "<script>alert('Usuário ou senha incorretos!'); window.location.href = '../view/public/login.php';</script>";
    }
}

 // Prevent further script execution
/*    } else { ?>

            <?php 
                include "http://localhost/dsin-cabeleleila/website/model/head.php"; 
                ?>

                <body>
                    <?php include "http://localhost/dsin-cabeleleila/website/model/clients/header.php"; ?>
                    
                    <div style="flex: 1;">
                        <main class="container-fluid p-5">
                            <div class="row">
                                <section class="container d-flex justify-content-center align-items-center">
                                    <div class="col-md-6 col-lg-4 text-center">
                                            <div class="alert alert-danger" role="alert">
                                                <h2 class="display-6 mt-4">Usuário ou senha incorretos!</h2>
                                                <p><a href="http://localhost/dsin-cabeleleila/website/view/public/login.php" class="btn btn-danger">Clique aqui para tentar novamente!</a></p>
                                            </div>
                                    </div>
                                </section>
                            </div>
                        </main>
                    </div>
                    
                    <?php include "http://localhost/dsin-cabeleleila/website/model/footer.php"; ?>
                    </body>
                </html>
        <?php }
}*/

function auth() {

    if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
        header("Location: http://localhost/dsin-cabeleleila/website/view/public/login.php");
        exit();
    }    
}

function auth_admin() {
    if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
        header("Location: ../view/public/login.php");
        exit();
    }
}

?>
