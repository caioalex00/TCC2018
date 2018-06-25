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
            print_r($_SESSION);
       ?>
       <script>
            window.location.href = "Classes/View/Pagina_Inicial.php";
       </script>
       <?php } print_r($_SESSION);?>
       <a href="Classes/Controller/EncerrarLogin.php">Sair</a>
    </body>
</html>