<?php
include "../../controler/functions.php";
auth_admin(); // Garantir que o administrador tenha acesso
include "../../model/head.php"; 
include "../../controler/connection.php"; 

// Recuperar o ID do cliente a partir da URL (passado pelo link)
$id_cliente = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_cliente) {
    // Buscar os dados do cliente
    $sql_cliente = "SELECT nome, telefone, email, cpf FROM CLIENTE WHERE id_cliente = :id_cliente";
    $stmt_cliente = $pdo->prepare($sql_cliente);
    $stmt_cliente->bindParam(':id_cliente', $id_cliente);
    $stmt_cliente->execute();
    $cliente = $stmt_cliente->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        // Se o cliente não for encontrado
        echo "<script>alert('Cliente não encontrado!'); window.location.href = 'clientes.php';</script>";
        exit();
    }

    // Buscar todos os agendamentos do cliente
    $sql_agendamentos = "SELECT A.id_agendamento, A.data_hora, S.nome_servico, C.nome, C.telefone 
                         FROM AGENDAMENTO A
                         JOIN AGENDAMENTO_SERVICO ASV ON A.id_agendamento = ASV.id_agendamento
                         JOIN SERVICO S ON ASV.id_servico = S.id_servico
                         JOIN CLIENTE C ON A.id_cliente = C.id_cliente
                         WHERE C.id_cliente = :id_cliente
                         ORDER BY A.data_hora DESC";
    $stmt_agendamentos = $pdo->prepare($sql_agendamentos);
    $stmt_agendamentos->bindParam(':id_cliente', $id_cliente);
    $stmt_agendamentos->execute();
    $agendamentos = $stmt_agendamentos->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "<script>alert('ID do cliente não fornecido!'); window.location.href = 'dashboard.php';</script>";
    exit();
}
?>

<body>
<?php include "../../model/clients/header.php"; ?>  

<div style="flex: 1;">
    <main class="container-fluid p-5">
        <div class="row">
            <section class="container d-flex justify-content-center align-items-center">
                <div class="col-md-8 col-lg-6 text-center">
                    <h2 class="display-6 mt-4">Detalhes do Cliente</h2>

                    <!-- Dados do Cliente -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($cliente['nome']); ?></h5>
                            <p><strong>Telefone:</strong> <?php echo htmlspecialchars($cliente['telefone']); ?></p>
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($cliente['email']); ?></p>
                            <p><strong>CPF:</strong> <?php echo htmlspecialchars($cliente['cpf']); ?></p>
                        </div>
                    </div>

                    <h3 class="mt-4">Agendamentos do Cliente</h3>
                    
                    <!-- Tabela de Agendamentos -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Serviço</th>
                                <th>Data e Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($agendamentos) > 0): ?>
                                <?php foreach ($agendamentos as $agendamento): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($agendamento['nome_servico']); ?></td>
                                        <td><?php echo date('d.m.y - H:i', strtotime($agendamento['data_hora'])); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="3">Nenhum agendamento encontrado para este cliente.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
</div>

<?php include "../../model/footer.php"; ?>
</body>
</html>
