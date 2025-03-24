<?php
include "../../controler/functions.php";
auth_admin(); // Garantir que o administrador tenha acesso
include "../../controler/connection.php"; 

// Verificar se o ID do cliente foi fornecido na URL
if (isset($_GET['id'])) {
    $id_cliente = $_GET['id'];

    // Iniciar uma transação para garantir que todos os dados relacionados ao cliente sejam removidos corretamente
    try {
        $pdo->beginTransaction();

        // Primeiro, deletar todos os agendamentos relacionados ao cliente
        $sql_agendamentos = "DELETE FROM AGENDAMENTO WHERE id_cliente = :id_cliente";
        $stmt_agendamentos = $pdo->prepare($sql_agendamentos);
        $stmt_agendamentos->bindParam(':id_cliente', $id_cliente);
        $stmt_agendamentos->execute();

        // Agora, deletar o cliente
        $sql_cliente = "DELETE FROM CLIENTE WHERE id_cliente = :id_cliente";
        $stmt_cliente = $pdo->prepare($sql_cliente);
        $stmt_cliente->bindParam(':id_cliente', $id_cliente);
        $stmt_cliente->execute();

        // Commit da transação
        $pdo->commit();

        // Redirecionar de volta para a lista de clientes
        echo "<script>alert('Cliente excluído com sucesso!'); window.location.href = 'dashboard.php';</script>";

    } catch (Exception $e) {
        // Se algo der errado, realiza o rollback da transação
        $pdo->rollBack();
        echo "<script>alert('Erro ao excluir cliente. Tente novamente.'); window.location.href = 'dashboard.php';</script>";
    }
} else {
    // Caso não tenha o ID do cliente na URL
    echo "<script>alert('ID do cliente não fornecido!'); window.location.href = 'dashboard.php';</script>";
    exit();
}
