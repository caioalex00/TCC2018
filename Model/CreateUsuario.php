<?php
class CreateUsuario {
    private $Nome;
    private $Email;
    private $DataNascimento;
    private $Senha;
    
    function __construct($conexao,$Nome, $Email, $DataNascimento, $Senha) {
        $this->setNome($Nome);
        $this->setEmail($Email);
        $this->setDataNascimento($DataNascimento);
        $this->setSenha($Senha);

        $this->create($conexao, $this->getNome(), $this->getEmail(), $this->getDataNascimento(), $this->getSenha());
    }
    
    private function create($conexao,$Nome,$Email,$DataNascimento,$Senha){
    
    try{
        $pdo = $conexao->conectar();
        
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
    
    private function getNome() {
        return $this->Nome;
    }

    private function getEmail() {
        return $this->Email;
    }

    private function getDataNascimento() {
        return $this->DataNascimento;
    }

    private function getSenha() {
        return $this->Senha;
    }

    //Setters
    
    private function setNome($Nome) {
        if(empty($Nome)){
            $this->Nome = NULL;
        }else{
            $this->Nome = $Nome;
        }
    }

    private function setEmail($Email) {
        if(filter_var($Email,FILTER_VALIDATE_EMAIL)){
            $this->Email = $Email;
        } else {
            $this->Email = NULL;
        }
    }

    private function setDataNascimento($DataNascimento) {
        
        $Data = explode("-", $DataNascimento);
        
        if(count($Data) == 3){
            
            $ano = $Data[0];
            $mes = $Data[1];
            $dia = $Data[2];
            
            if(checkdate($mes, $dia, $ano)){
                $this->DataNascimento = $DataNascimento;
            }else{
                $this->DataNascimento = NULL;
            }
        }else{
            $this->DataNascimento = NULL;
        }
    }

    private function setSenha($Senha) {
        if(strlen($Senha) >= 8){
            if(!strstr($Senha," ")){
            $this->Senha = sha1($Senha);
            }
        }else{
            $this->Senha = NULL;
        }
    }



}
