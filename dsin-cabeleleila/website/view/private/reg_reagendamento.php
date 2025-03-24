
<?php
include "../../controler/functions.php";
include "../../controler/connection.php";
auth();

// Pegando os dados do formulário
$id_agendamento = $_POST['id_agendamento'];
$id_cliente = $_POST['id_cliente'];
$id_servico = $_POST['id_servico'];
$data_hora = $_POST['data_hora'];

if ($id_cliente != $_SESSION['id_cliente']) {
    echo "<script>alert('Você não tem permissão para modificar este agendamento!'); window.location.href = '../public/agendamentos.php';</script>";
    exit();
}

// Atualizar o agendamento existente
try {
    $pdo->beginTransaction();

    // Atualizar a data e hora do agendamento
    $sql_update_agendamento = "UPDATE AGENDAMENTO SET data_hora = :data_hora WHERE id_agendamento = :id_agendamento";
    $stmt_update = $pdo->prepare($sql_update_agendamento);
    $stmt_update->bindParam(':data_hora', $data_hora);
    $stmt_update->bindParam(':id_agendamento', $id_agendamento);
    $stmt_update->execute();

    // Atualizar o serviço associado ao agendamento
    $sql_update_servico = "UPDATE AGENDAMENTO_SERVICO SET id_servico = :id_servico WHERE id_agendamento = :id_agendamento";
    $stmt_servico = $pdo->prepare($sql_update_servico);
    $stmt_servico->bindParam(':id_servico', $id_servico);
    $stmt_servico->bindParam(':id_agendamento', $id_agendamento);
    $stmt_servico->execute();

    $pdo->commit();

    echo "<script>alert('Reagendamento realizado com sucesso!'); window.location.href = '../public/agendamentos.php';</script>";
} catch (Exception $e) {
    $pdo->rollBack();
    echo "<script>alert('Erro ao reagendar: " . $e->getMessage() . "'); window.location.href = '../public/agendamentos.php';</script>";
}
?>
