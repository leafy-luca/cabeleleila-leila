<?php
include "../../controler/functions.php";
include "../../model/head.php";
include "../../model/clients/header.php";
?>

<main class="container py-4">
    <h1 class="text-center">Contato</h1>
    
    <section class="my-4 text-center">
        <p class="lead">Entre em contato conosco para agendamentos e dúvidas. Estamos sempre prontos para atender você!</p>
    </section>
    
    <section class="row my-5 text-center">
        <div class="col-md-6">
            <h2>Nosso Endereço</h2>
            <p>Cabeleleila Leila - Rua da Cabeleleila Leila, 70, São Paulo/SP</p>
            <div class="ratio ratio-16x9">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.835434508619!2d144.95373531531692!3d-37.81627974202171!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d5df1f5b4ff%3A0x5045675218ce7e33!2sMelbourne%20Central!5e0!3m2!1sen!2sau!4v1614386174666!5m2!1sen!2sau" 
                    width="100%" 
                    height="300" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Telefone</h2>
            <p>Para falar conosco, ligue para:</p>
            <p class="fs-4"><a href="tel:+5511978257759" class="btn btn-primary">(11) 97825-7759</a></p>
        </div>
    </section>
</main>

<?php include "../../model/footer.php"; ?>
</body>
</html>
