<?php
//Conexão com o banco de dados     
try {
    $username = 'root';
    $password = '';
    $pdo = new PDO('mysql:host=localhost;dbname=tcc2018', $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex) {
    //Gera Erro
    echo 'Erro na conexão: ' . $ex->getMessage();
}

//Inserir dados | CREATE
function create($pdo,$Nome,$Email,$DataNascimento,$Senha){
    
    try{
        $sttm = $pdo->prepare("INSERT INTO `usuarios`(`ID`,`Nome`,`Email`,`DataNascimento`,`Senha`) VALUES(NULL,?,?,?,?);");

        $sttm->bindParam(1, $Nome);
        $sttm->bindParam(2, $Email);
        $sttm->bindParam(3, $DataNascimento);
        $sttm->bindParam(4, $Senha);
        $sttm->execute();

    } catch (Exception $ex) {
        //Gera Erro
        echo 'Erro ao Registrar: ' . $ex->getMessage();
    }
}
//Exemplo de inserção;
//create($pdo,"Caio Alexandre", "caioxandres2000@gmail.com", "2000-07-16", "OlaMundo");