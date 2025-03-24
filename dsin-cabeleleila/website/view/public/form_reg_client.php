<?php 
include "../../model/head.php"; 
?>

<body>
<?php include "../../model/clients/header.php"; ?>  

<div style="flex: 1;">
    <main class="container-fluid p-5">
        <div class="row">
            <section class="container d-flex justify-content-center align-items-center">
                <div class="col-md-6 col-lg-4 text-center">
                    <h2 class="display-6 mt-4">Nova Conta</h2>
                    
                    <form method="POST" action="../private/reg_client.php" class="form-horizontal mb-4 mx-auto text-center">
                        <fieldset class="d-flex flex-column justify-content-center align-items-center">
                            
                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="nome" class="form-label">Nome Completo:</label>
                                <input type="text" id="nome" name="nome" class="form-control" maxlength="50" required>
                            </div>

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="cpf" class="form-label">CPF:</label>
                                <input type="text" id="cpf" name="cpf" class="form-control" required>
                            </div>

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="telefone" class="form-label">Telefone:</label>
                                <input type="tel" id="telefone" name="telefone" class="form-control" maxlength="15" required>
                            </div>

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" maxlength="30" required>
                            </div>

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="senha" class="form-label">Senha:</label>
                                <input type="password" id="senha" name="senha" class="form-control" minlength="6" maxlength="12" required>
                            </div>

                            <div class="btn-login">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
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
