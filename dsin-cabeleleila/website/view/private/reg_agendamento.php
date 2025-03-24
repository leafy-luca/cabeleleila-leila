<?php
include "../../controler/connection.php";

$transactionStarted = false;  // Variável para rastrear o estado da transação

try {
    // Obtém os dados do formulário e sanitiza
    $id_cliente = intval($_POST["id_cliente"]);
    $id_servico = intval($_POST["id_servico"]);
    $data_hora = $_POST["data_hora"];


    // Verificar se já existe um agendamento para o mesmo serviço no mesmo horário
    $sql_verifica = "SELECT COUNT(*) FROM AGENDAMENTO_SERVICO AS ags
                     INNER JOIN AGENDAMENTO AS ag ON ags.id_agendamento = ag.id_agendamento
                     WHERE ags.id_servico = :id_servico AND ag.data_hora = :data_hora";
    
    $stmt_verifica = $pdo->prepare($sql_verifica);
    $stmt_verifica->bindParam(":id_servico", $id_servico);
    $stmt_verifica->bindParam(":data_hora", $data_hora);
    $stmt_verifica->execute();
    
    $existe = $stmt_verifica->fetchColumn();

    if ($existe > 0) {
        throw new Exception("Já existe um agendamento para este serviço neste horário. Escolha outro horário.");
    }

    // Iniciar transação
    $pdo->beginTransaction();
    $transactionStarted = true;

    // Inserir o agendamento na tabela AGENDAMENTO
    $sql_agendamento = "INSERT INTO AGENDAMENTO (id_cliente, data_hora) VALUES (:id_cliente, :data_hora)";
    $stmt_agendamento = $pdo->prepare($sql_agendamento);
    $stmt_agendamento->bindParam(":id_cliente", $id_cliente);
    $stmt_agendamento->bindParam(":data_hora", $data_hora);
    $stmt_agendamento->execute();

    // Obtém o ID do agendamento recém-criado
    $id_agendamento = $pdo->lastInsertId();

    // Relacionar o agendamento com o serviço na tabela AGENDAMENTO_SERVICO
    $sql_servico = "INSERT INTO AGENDAMENTO_SERVICO (id_agendamento, id_servico) VALUES (:id_agendamento, :id_servico)";
    $stmt_servico = $pdo->prepare($sql_servico);
    $stmt_servico->bindParam(":id_agendamento", $id_agendamento);
    $stmt_servico->bindParam(":id_servico", $id_servico);
    $stmt_servico->execute();

    // Confirmar transação
    $pdo->commit();
    $sucesso = true;

} catch (Exception $e) {
    // Só chama rollBack() se a transação foi iniciada
    if ($transactionStarted) {
        $pdo->rollBack();
    }
    $erro = $e->getMessage();
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
                        
                        <?php if (isset($sucesso) && $sucesso) { ?>
                            <div class="alert alert-success" role="alert">
                                <h2 class="display-6 mt-4">Agendamento realizado com sucesso!</h2>
                                <p><a href="../public/agendamentos.php" class="btn btn-primary">Voltar ao painel</a></p>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-danger" role="alert">
                                <h2 class="display-6 mt-4">Falha no agendamento!</h2>
                                <p><?php echo isset($erro) ? $erro : "Ocorreu um erro desconhecido."; ?></p>
                                <p><a href="../public/form_agendamento.php" class="btn btn-danger">Tente novamente</a></p>
                            </div>
                        <?php } ?>

                    </div>
                </section>
            </div>
        </main>
    </div>
    
    <?php include "../../model/footer.php"; ?>
</body>
</html>
