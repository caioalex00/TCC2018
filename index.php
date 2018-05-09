<?php require_once './loader.php';?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home - Librason</title>
    </head>
    <body>
       <!--Pagina de Teste de Login-->
       <?php 
        if(!isset($_SESSION['ID_User'])){
       ?>
       <script>
            window.location.href = "Classes/View/Pagina_Inicial.php";
       </script>
       <?php } ?>
       
       
       <?php
       $tabela = "usuarios";
       $dadosTabela = "ID";
       $dadosValues = $_SESSION['ID_User'];
       $read = new Read($tabela, $dadosTabela, $dadosValues);
       $read->executarQuery();
       echo "Usuário Logado: ";
       ?>
       <pre>
           <?php
                print_r($read->getResultado());
            ?>
       </pre>
       <a href="Classes/Controller/EncerrarLogin.php">Sair</a>
    </body>
</html>