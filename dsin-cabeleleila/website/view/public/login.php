<?php
//session_start(); // Make sure the session is started

include "../../controler/functions.php";
include "../../model/head.php"; 
?>

<body>
<?php
include "../../model/clients/header.php";
?>                 
<div style="flex: 1;">
    <main class="container-fluid p-5">
        <div class="row">
            <section class="container d-flex justify-content-center align-items-center "> <!-- vh-100 para ocupar a altura total da tela -->
                <div class="col-md-6 col-lg-4 loginForm text-center"> <!-- Ajuste de tamanho da coluna -->
                    <h2 class="display-6 mt-4">Login</h2>
                    <form class="form-horizontal mb-4 mx-auto text-center" method="POST" action="../../controler/check_login.php">
                        <fieldset class="d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="email" class="form-label">Email:</label>  
                                <input id="email" name="email" type="email" placeholder="Digite seu email" class="form-control" required>
                            </div>
                            
                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="password" class="form-label">Senha:</label>  
                                <input id="password" name="password" type="password" placeholder="Digite sua senha" class="form-control" required>
                            </div>
            
                            <div class="btn-login">
                                <button id="login" name="login" class="btn btn-primary">Entrar</button>
                            </div>
                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <p>Ainda não tem conta? <span><a href="form_reg_client.php">Clique aqui para se registrar.</a></span></p>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </section>
        </div>
    </main>
</div>

<?php include "../../model/footer.php"; ?>
</body>
</html>
