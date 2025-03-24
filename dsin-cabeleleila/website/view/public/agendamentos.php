<?php 

include "../../controler/functions.php";
auth();
include "../../model/head.php"; 
include "../../model/clients/header.php";
include "../../controler/connection.php"; 

$id_cliente = $_SESSION["id_cliente"];
$nome_cliente = $_SESSION["nome"];

// Buscar os agendamentos do usuário
$sql = "SELECT A.id_agendamento, A.data_hora, S.nome_servico 
        FROM AGENDAMENTO A
        JOIN AGENDAMENTO_SERVICO ASV ON A.id_agendamento = ASV.id_agendamento
        JOIN SERVICO S ON ASV.id_servico = S.id_servico
        WHERE A.id_cliente = ? 
        ORDER BY A.data_hora DESC ";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_cliente]);
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container py-4">
    <h1>Olá, <?php echo htmlspecialchars($nome_cliente); ?>!</h1>
    <h2>Seus últimos agendamentos</h2>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Data</th>
                <th>Serviço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($agendamentos) > 0): ?>
                <?php foreach ($agendamentos as $agendamento): 
                    $data_agendamento = strtotime($agendamento['data_hora']);
                    $data_atual = strtotime(date('Y-m-d H:i:s'));
                    $diferenca_dias = ($data_agendamento - $data_atual) / 86400; // Converte para dias
                ?>
                    <tr>
                        <td><?php echo date('d.m.y - H:i', $data_agendamento); ?></td>
                        <td><?php echo htmlspecialchars($agendamento['nome_servico']); ?></td>
                        <td>
                            <button class="btn btn-warning" onclick="reagendar(<?php echo $diferenca_dias; ?>, <?php echo $agendamento['id_agendamento']; ?>)">Reagendar</button>
                            <button class="btn btn-danger" onclick="cancelarAgendamento(<?php echo $agendamento['id_agendamento']; ?>)">Cancelar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">Nenhum agendamento encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="text-center mt-3">
        <a href="form_agendamento.php" class="btn btn-primary">Novo Agendamento</a>
    </div>
</main>

<script>
function reagendar(dias, idAgendamento) {
    if (dias <= 2) {
        alert("Agendamentos com menos de 2 dias de antecedência devem ser feitos por telefone.");
    } else {
        window.location.href = "form_reagendamento.php?id=" + idAgendamento;
    }
}

function cancelarAgendamento(idAgendamento) {
    if (confirm("Tem certeza que deseja cancelar este agendamento?")) {
        window.location.href = "cancelar_agendamento.php?id=" + idAgendamento;
    }
}
</script>

<?php include "../../model/footer.php"; ?>
</body>
</html>
