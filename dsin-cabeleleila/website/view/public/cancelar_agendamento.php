<?php
include "../../controler/functions.php";
auth(); // Garantir que o administrador tenha acesso
include "../../controler/connection.php"; 

// Verificar se o ID do agendamento foi fornecido na URL
if (isset($_GET['id'])) {
    $id_agendamento = $_GET['id'];

    // Iniciar uma transação para garantir que a exclusão do agendamento seja realizada corretamente
    try {
        $pdo->beginTransaction();

        // Deletar o agendamento
        $sql = "DELETE FROM AGENDAMENTO WHERE id_agendamento = :id_agendamento";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_agendamento', $id_agendamento);
        $stmt->execute();

        // Commit da transação
        $pdo->commit();

        // Redirecionar de volta para a lista de agendamentos
        echo "<script>alert('Agendamento cancelado com sucesso!'); window.location.href = 'agendamentos.php';</script>";

    } catch (Exception $e) {
        // Se algo der errado, realiza o rollback da transação
        $pdo->rollBack();
        echo "<script>alert('Erro ao cancelar agendamento. Tente novamente.'); window.location.href = 'agendamentos.php';</script>";
    }
} else {
    // Caso não tenha o ID do agendamento na URL
    echo "<script>alert('ID do agendamento não fornecido!'); window.location.href = 'agendamentos.php';</script>";
    exit();
}
