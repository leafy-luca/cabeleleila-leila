<?php
include "../../controler/functions.php";
auth_admin();
include "../../model/head.php";
include "../../model/clients/header.php";
include "../../controler/connection.php";

// Buscar todos os agendamentos
$sql_agendamentos = "SELECT A.id_agendamento, A.data_hora, S.nome_servico, C.nome, C.telefone 
        FROM AGENDAMENTO A
        JOIN AGENDAMENTO_SERVICO ASV ON A.id_agendamento = ASV.id_agendamento
        JOIN SERVICO S ON ASV.id_servico = S.id_servico
        JOIN CLIENTE C ON A.id_cliente = C.id_cliente
        ORDER BY A.data_hora DESC";
$stmt_agendamentos = $pdo->prepare($sql_agendamentos);
$stmt_agendamentos->execute();
$agendamentos = $stmt_agendamentos->fetchAll(PDO::FETCH_ASSOC);

// Buscar todos os clientes
$sql_clientes = "SELECT id_cliente, nome, email, telefone FROM CLIENTE";
$stmt_clientes = $pdo->prepare($sql_clientes);
$stmt_clientes->execute();
$clientes = $stmt_clientes->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container py-4">
    <h1>Painel Administrativo</h1>
    
    <h2>Todos os Agendamentos</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cliente</th>
                <th>Telefone</th>
                <th>Serviço</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($agendamentos) > 0): ?>
                <?php foreach ($agendamentos as $agendamento): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($agendamento['nome']); ?></td>
                        <td>
                            <a href="tel:<?php echo htmlspecialchars($agendamento['telefone']); ?>">
                                <?php echo htmlspecialchars($agendamento['telefone']); ?>
                            </a>
                        </td>
                        <td><?php echo htmlspecialchars($agendamento['nome_servico']); ?></td>
                        <td><?php echo date('d.m.y - H:i', strtotime($agendamento['data_hora'])); ?></td>
                        <td>
                            <button class="btn btn-warning" onclick="reagendar(<?php echo $agendamento['id_agendamento']; ?>)">Reagendar</button>
                            <button class="btn btn-danger" onclick="cancelarAgendamento(<?php echo $agendamento['id_agendamento']; ?>)">Cancelar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">Nenhum agendamento encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Todos os Clientes</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($clientes) > 0): ?>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cliente['nome']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['email']); ?></td>
                        <td><?php echo htmlspecialchars($cliente['telefone']); ?></td>
                        <td>
                            <button class="btn btn-info" onclick="verCliente(<?php echo $cliente['id_cliente']; ?>)">Ver</button>
                            <button class="btn btn-danger" onclick="deletarCliente(<?php echo $cliente['id_cliente']; ?>)">Deletar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="4">Nenhum cliente encontrado.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<script>
function reagendar(idAgendamento) {
    window.location.href = "form_reagendamento.php?id=" + idAgendamento;
}

function cancelarAgendamento(idAgendamento) {
    if (confirm("Tem certeza que deseja cancelar este agendamento?")) {
        window.location.href = "cancelar_agendamento.php?id=" + idAgendamento;
    }
}

function verCliente(idCliente) {
    window.location.href = "ver_cliente.php?id=" + idCliente;
}

function deletarCliente(idCliente) {
    if (confirm("Tem certeza que deseja deletar este cliente?")) {
        window.location.href = "deletar_cliente.php?id=" + idCliente;
    }
}
</script>

<?php include "../../model/footer.php"; ?>
</body>
</html>
