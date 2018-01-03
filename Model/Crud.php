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

//Leitura de  dados | READ
function read($pdo){
    try {
        $stmt = $pdo->prepare("SELECT * FROM `usuarios`");
        $stmt->execute();
        return $stmt->fetchAll();
        
    } catch (Exception $ex) {
        echo "Erro ao Ler dados: " . $ex->getMessage();
    }
    
}

//Atualização de Dados | UPDATE
function update($pdo,$id,$nome,$email,$dataNascimento,$senha){
    try {
        $stmt = $pdo->prepare("UPDATE `usuarios` SET `Nome`=?,`Email`=?,`DataNascimento`=?,`Senha`= ? WHERE `ID`=?");
    
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $email);
        $stmt->bindParam(3, $dataNascimento);
        $stmt->bindParam(4, $senha);
        $stmt->bindParam(5, $id);
        $stmt->execute();
        
    } catch (Exception $ex) {
        echo "Erro ao atualizar dados: " . $ex->getMessage();
    }

}

