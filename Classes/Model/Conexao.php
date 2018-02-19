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


    protected function conectar(){
        
        try {
            
            $this->conexao = new PDO($this->tipo . ':host=' . $this->host . ';dbname=' . $this->dbname, $this->usuario, $this->senha);
            
        } catch (Exception $ex) {
            echo 'Erro na conexão: ' . $ex->getMessage();
        }
        
        return $this->conexao;
    }

}
