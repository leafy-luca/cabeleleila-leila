<?php
//session_start();
include "../../controler/functions.php";
auth();  // Ensure this function is correctly checking the session

include "../../model/head.php"; 

// Fetching the user's name and ID from the session
$id_cliente = $_SESSION["id_cliente"];
$nome_cliente = $_SESSION["nome"];  // User's name should already be in the session

include "../../controler/connection.php"; // Database connection

include "../../model/clients/header.php";

// Query to get user's last 3 appointments
$sql = "SELECT A.data_hora, S.nome_servico 
        FROM AGENDAMENTO A
        JOIN AGENDAMENTO_SERVICO ASV ON A.id_agendamento = ASV.id_agendamento
        JOIN SERVICO S ON ASV.id_servico = S.id_servico
        WHERE A.id_cliente = ? 
        ORDER BY A.data_hora DESC 
        LIMIT 3";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_cliente]); // Use the session's id_cliente
$agendamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container py-4">
    <h1>Olá, <?php echo htmlspecialchars($nome_cliente); ?>!</h1>
    <h2>Seus últimos agendamentos</h2>
    <table class="table table-bordered">
        <?php if (count($agendamentos) > 0): ?>
            <?php foreach ($agendamentos as $agendamento): ?>
                <tr>
                    <td><?php echo date('d.m.y - H:i', strtotime($agendamento['data_hora'])); ?></td>
                    <td><?php echo htmlspecialchars($agendamento['nome_servico']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2">Nenhum agendamento encontrado.</td></tr>
        <?php endif; ?>
    </table>
    
    <h2>O que quer fazer hoje?</h2>
    <div class="opcoes">
        <a href="form_agendamento.php"><button class="btn btn-primary">Agendar</button></a>
        <a href="agendamentos.php"><button class="btn btn-primary">Meus Agendamentos</button></a>
        <a href="contact.php"><button class="btn btn-primary">Contato</button></a>
    </div>
</main>

<?php include "../../model/footer.php"; ?>

        </body>
    </html>
