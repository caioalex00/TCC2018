<?php
class Conexao {
    private $host;
    private $dbname;
    private $usuario;
    private $senha;
    private $tipo;
    
    public function __construct() {
        $this->definirValores();
    }
    
    private function definirValores(){
        $this->host = "localhost";
        $this->dbname = "tcc2018";
        $this->usuario = "root";
        $this->senha = "";
        $this->tipo = "mysql";
    }


    public function conectar(){
        try {
            
            $this->conexao = new PDO($this->getTipo() . ':host=' . $this->getHost() . ';dbname=' . $this->getDbname(), $this->getUsuario(), $this->getSenha());
            
        } catch (Exception $ex) {
            echo 'Erro na conexão: ' . $ex->getMessage();
        }
        
        return $this->conexao;
    }

    private function getHost() {
        return $this->host;
    }

    private function getDbname() {
        return $this->dbname;
    }

    private function getUsuario() {
        return $this->usuario;
    }

    private function getSenha() {
        return $this->senha;
    }

    private function getTipo() {
        return $this->tipo;
    }

    

}
