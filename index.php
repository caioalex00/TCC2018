<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!-- Formulario De Teste -->
        <h1>Formulario</h1>
        <form method="POST">
            <label>Nome:</label><br>
            <input type="text" name="Nome" required=""><br>
            <label>Email</label><br>
            <input type="email" name="Email" required=""><br>
            <label>Data de Nascimento</label><br>
            <input type="date" name="DataNasc" required=""><br>
            <label>Senha</label><br>
            <input type="password" name="Senha" required=""><br>
            <button name="Enviar">Enviar</button><br><br><br>
        </form>
        <?php 
        if(isset($_REQUEST['Enviar'])){
            
            //Capturando dados do usuario
            $Nome = $_REQUEST['Nome'];
            $Email = $_REQUEST['Email'];
            $DataNasc = $_REQUEST['DataNasc'];
            $Senha = $_REQUEST['Senha'];
            
            //Faço a conexão
            include_once './Model/Conexao.php';
            $pdo = new Conexao();  

            //Chamo a classe Create Usuario passando como parametro a conexao e o dados do usuario
            include_once './Model/CreateUsuario.php';
            $cadastrar = new CreateUsuario($pdo,$Nome,$Email, $DataNasc, $Senha);

            //Destruindo objetox
            unset($pdo);
            unset($cadastrar);
        }
        ?>
    </body>
</html>
