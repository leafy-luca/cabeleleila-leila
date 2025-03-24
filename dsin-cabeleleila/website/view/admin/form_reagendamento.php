<?php 
include "../../controler/functions.php";
auth_admin(); // Garantir que o administrador tenha acesso
include "../../model/head.php"; 
include "../../controler/connection.php"; 

// Recuperar o ID do agendamento a partir da URL (passado pelo link)
$id_agendamento = isset($_GET['id']) ? $_GET['id'] : null;

if ($id_agendamento) {
    // Buscar os dados do agendamento
    $sql_agendamento = "SELECT A.id_agendamento, A.data_hora, S.nome_servico, C.nome, C.telefone, C.id_cliente, ASV.id_servico 
                        FROM AGENDAMENTO A
                        LEFT JOIN AGENDAMENTO_SERVICO ASV ON A.id_agendamento = ASV.id_agendamento
                        LEFT JOIN SERVICO S ON ASV.id_servico = S.id_servico
                        JOIN CLIENTE C ON A.id_cliente = C.id_cliente
                        WHERE A.id_agendamento = :id_agendamento";
                        
    $stmt_agendamento = $pdo->prepare($sql_agendamento);
    $stmt_agendamento->bindParam(':id_agendamento', $id_agendamento);
    $stmt_agendamento->execute();
    $agendamento = $stmt_agendamento->fetch(PDO::FETCH_ASSOC);
    
    if (!$agendamento) {
        // Se o agendamento não for encontrado, redireciona ou exibe uma mensagem de erro
        echo "<script>alert('Agendamento não encontrado!'); window.location.href = 'dashboard.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID do agendamento não fornecido!'); window.location.href = 'dashboard.php';</script>";
    exit();
}

// Buscar os serviços disponíveis para reagendamento
$sql_servicos = "SELECT id_servico, nome_servico, preco FROM SERVICO";
$stmt_servicos = $pdo->query($sql_servicos);
$servicos = $stmt_servicos->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
<?php include "../../model/clients/header.php"; ?>  

<div style="flex: 1;">
    <main class="container-fluid p-5">
        <div class="row">
            <section class="container d-flex justify-content-center align-items-center">
                <div class="col-md-6 col-lg-4 text-center">
                    <h2 class="display-6 mt-4">Reagendar Agendamento</h2>
                    
                    <form method="POST" action="reg_reagendamento.php" class="form-horizontal mb-4 mx-auto text-center">
                        <fieldset class="d-flex flex-column justify-content-center align-items-center">

                            <!-- Campo oculto com ID do agendamento e ID do cliente -->
                            <input type="hidden" name="id_agendamento" value="<?php echo $agendamento['id_agendamento']; ?>">
                            <input type="hidden" name="id_cliente" value="<?php echo $agendamento['id_cliente']; ?>">

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="nome_cliente" class="form-label">Cliente:</label>
                                <input type="text" id="nome_cliente" class="form-control" value="<?php echo htmlspecialchars($agendamento['nome']); ?>" disabled>
                            </div>

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="telefone_cliente" class="form-label">Telefone:</label>
                                <input type="text" id="telefone_cliente" class="form-control" value="<?php echo htmlspecialchars($agendamento['telefone']); ?>" disabled>
                            </div>

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="nome_servico" class="form-label">Serviço Original:</label>
                                <input type="text" id="nome_servico" class="form-control" value="<?php echo htmlspecialchars($agendamento['nome_servico']); ?>" disabled>
                            </div>

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="data_hora_original" class="form-label">Data e Hora Original:</label>
                                <input type="text" id="data_hora_original" class="form-control" value="<?php echo date('d.m.y - H:i', strtotime($agendamento['data_hora'])); ?>" disabled>
                            </div>

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="id_servico" class="form-label">Novo Serviço:</label>
                                <select id="id_servico" name="id_servico" class="form-control" required>
                                    <option value="">Selecione um novo serviço</option>
                                    <?php foreach ($servicos as $servico): ?>
                                        <option value="<?php echo $servico['id_servico']; ?>" <?php echo ($servico['id_servico'] == $agendamento['id_servico']) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($servico['nome_servico']) . " - R$ " . number_format($servico['preco'], 2, ',', '.'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="data_hora" class="form-label">Nova Data e Hora:</label>
                                <input type="datetime-local" id="data_hora" name="data_hora" class="form-control" required value="<?php echo date('Y-m-d\TH:i', strtotime($agendamento['data_hora'])); ?>">
                            </div>

                            <div class="btn-login">
                                <button type="submit" class="btn btn-warning">Reagendar</button>
                            </div>

                        </fieldset>
                    </form>
                </div>
            </section>
        </div>
    </main>
</div>

<div class="card-footer">
    <a href="deletar_cliente.php?id_cliente=<?php echo $id_cliente; ?>" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este cliente? Esta ação não pode ser desfeita.')">Excluir Cliente</a>
</div>

<?php include "../../model/footer.php"; ?>
</body>
</html>
