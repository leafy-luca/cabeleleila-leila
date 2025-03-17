# cabeleleila-leila
Projetinho de sistema para o processo seletivo da DSIN .


▒█▀▀█ ▒█▀▀▀ ░█▀▀█ ▒█▀▀▄ 　 ▒█▀▄▀█ ▒█▀▀▀ 
▒█▄▄▀ ▒█▀▀▀ ▒█▄▄█ ▒█░▒█ 　 ▒█▒█▒█ ▒█▀▀▀ 
▒█░▒█ ▒█▄▄▄ ▒█░▒█ ▒█▄▄▀ 　 ▒█░░▒█ ▒█▄▄▄

(READ ME)

---------------------

Sistema de Agendamentos para 
o salão de beleza Cabeleleila Leila, 
por Luca Yarmak.

Contém:
> CRUD de clientes e agendamentos ;
> Scripts SQL para criação do banco de dados com inserts básicos para testar ;
> Organização em pastas distintas ;
> Responsividade através de Bootstrap ;

---------------------

Inicialização e configurações iniciais:

Você precisará estar com o Xampp (https://www.apachefriends.org - versão 8.2.12 para Windows) instalado na máquina, rodando o servidor Apache (versão 8.2.12), e uma instalação do MySQL ativa. Os scripts SQL estão disponíveis em "dsin-cabeleleila\documentation\sql-scripts", denominados, respectivamente "create.sql" e "insert".sql, para criação e inserção de dados. Após criação do schema com todas as tabelas e realização dos inserts, você precisará conectar o sistema ao banco utilizado. Esse arquivo de configuração, chamado "connection.php" está localizado em "dsin-cabeleleila\website\controler".


Após as configurações do sistema, dentro do Xampp, clique em “Config > PHP (php.ini)” conforme mostra a imagem abaixo. No arquivo de configuração do PHP, encontre a configuração “allow_url_include”, na sessão “Fopen wrappers”. Por padrão, essa variável é definida como “allow_url_include=Off”. Mude para “allow_url_include=On”. Salve o arquivo, e feche. Você poderá voltar essa configuração para o padrão quando terminar de usar o sistema.

(imagem disponível no pdf em "Documentation")

Assim que as configurações iniciais estiverem prontas e ok, coloque a pasta "dsin-cabeleleila" dentro da pasta "htdocs" do Xampp, normalmente localizada em "C:\xampp\htdocs", e inicie (ou reinicie) o servidor Apache, junto com sua instalação do MySQL. Nesse caso, utilizamos o banco mysql padrão do Xampp.

Abra seu navegador, e visite “http://localhost/dsin-cabeleleila/” - isso te dará acesso ao sistema. A página inicial está localizada em “http://localhost/dsin-cabeleleila/website/view/public/login.php” . Tudo pronto! Uma conexão ativa com a internet é recomendada, pois o site possui conteúdos que precisam de conexão com a rede (Google Maps e Youtube).


---------------------

Notas:

Ao analisar os scripts do banco, você perceberá que existem mais tabelas do que as utilizadas no projeto atual. Essas tabelas foram adicionadas para permitir a expansão do projeto, conforme sugerido nos requisitos adicionais, possibilitando a gestão de negócios e agendamentos em um único local.
