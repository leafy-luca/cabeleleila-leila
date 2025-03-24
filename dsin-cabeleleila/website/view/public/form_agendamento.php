<?php 
include "../../controler/functions.php";
auth();
include "../../model/head.php"; 
include "../../controler/connection.php"; 

// Buscar os serviços disponíveis
$sql = "SELECT id_servico, nome_servico, preco FROM SERVICO";
$stmt = $pdo->query($sql);
$servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$id_cliente = $_SESSION["id_cliente"];
?>

<body>
<?php include "../../model/clients/header.php"; ?>  

<div style="flex: 1;">
    <main class="container-fluid p-5">
        <div class="row">
            <section class="container d-flex justify-content-center align-items-center">
                <div class="col-md-6 col-lg-4 text-center">
                    <h2 class="display-6 mt-4">Novo Agendamento</h2>
                    
                    <form method="POST" action="../private/reg_agendamento.php" class="form-horizontal mb-4 mx-auto text-center">
                        <fieldset class="d-flex flex-column justify-content-center align-items-center">

                            <!-- Campo oculto com ID do cliente -->
                            <input type="hidden" name="id_cliente" value="<?php echo $id_cliente; ?>">

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="id_servico" class="form-label">Serviço:</label>
                                <select id="id_servico" name="id_servico" class="form-control" required>
                                    <option value="">Selecione um serviço</option>
                                    <?php foreach ($servicos as $servico): ?>
                                        <option value="<?php echo $servico['id_servico']; ?>">
                                            <?php echo htmlspecialchars($servico['nome_servico']) . " - R$ " . number_format($servico['preco'], 2, ',', '.'); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-md-10 col-xs-10 mb-3">
                                <label for="data_hora" class="form-label">Data e Hora:</label>
                                <input type="datetime-local" id="data_hora" name="data_hora" class="form-control" required>
                            </div>

                            <div class="btn-login">
                                <button type="submit" class="btn btn-primary">Agendar</button>
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
