<?php
include "../../controler/connection.php";

// Preparamos a consulta para inserir os dados
$sql = "INSERT INTO CLIENTE (nome, telefone, email, senha, cpf) ";
$sql .= "VALUES (:nome, :tel, :email, :pas, :cpf)";

// htmlspecialchars() - EVITA ATAQUES DO TIPO XSS (Cross Site Script)

$nome = htmlspecialchars($_POST["nome"]);
$cpf = htmlspecialchars($_POST["cpf"]);
$tel = htmlspecialchars($_POST["telefone"]);
$email = htmlspecialchars($_POST["email"]);
$pas = htmlspecialchars($_POST["senha"]);

// Preparando a execução do comando
$comando = $pdo->prepare($sql);
$comando->bindParam(":nome", $nome);
$comando->bindParam(":tel", $tel);
$comando->bindParam(":email", $email);
$comando->bindParam(":pas", $pas);
$comando->bindParam(":cpf", $cpf);

try {
    // Tentamos executar a consulta
    $sucesso = $comando->execute();

    // Se a execução for bem-sucedida, mostramos a mensagem de sucesso
    if ($sucesso) {
        $mensagem = "Cadastro realizado com sucesso!";
        $tipo_alerta = "success";
        $botao = '<a href="../public/login.php" class="btn btn-primary">Clique aqui para fazer seu login na loja.</a>';
    }
} catch (PDOException $e) {
    // Se ocorrer erro (como violação de chave única), mostramos uma mensagem de erro personalizada
    if ($e->getCode() == 23000) { // Erro de violação de chave única (duplicação)
        $mensagem = "Este email já está cadastrado. Por favor, use outro email.";
        $tipo_alerta = "danger";
        $botao = '<a href="../public/form_reg_client.php" class="btn btn-danger">Clique aqui para tentar novamente!</a>';
    } else {
        // Para outros erros, mostramos uma mensagem genérica
        $mensagem = "Falha no Cadastro! Tente novamente.";
        $tipo_alerta = "danger";
        $botao = '<a href="../public/form_reg_client.php" class="btn btn-danger">Clique aqui para tentar novamente!</a>';
    }
}

?>

<?php include "../../model/head.php"; ?>

<body>
    <?php include "../../model/clients/header.php"; ?>
    
    <div style="flex: 1;">
        <main class="container-fluid p-5">
            <div class="row">
                <section class="container d-flex justify-content-center align-items-center">
                    <div class="col-md-6 col-lg-4 text-center">
                        <!-- Exibindo a mensagem de sucesso ou erro com base no resultado -->
                        <div class="alert alert-<?php echo $tipo_alerta; ?>" role="alert">
                            <h2 class="display-6 mt-4"><?php echo $mensagem; ?></h2>
                            <p><?php echo $botao; ?></p>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
    
    <?php include "../../model/footer.php"; ?>
</body>
</html>
