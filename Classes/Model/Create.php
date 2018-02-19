<?php
require_once __DIR__ . "/" . "Conexao.php";
class Create extends Conexao{
    private $tabela;
    private $dadosTabela;
    private $dadosValues;
    private $queryFinal;
    
    public function __construct($tabela,$dadosTabela,$dadosValues) {  
        parent::__construct();
        $this->tabela = $tabela;
        $this->dadosTabela = $dadosTabela;
        $this->setDadosValues($dadosValues); 
    }
    
    public function ExecutarQuery(){
        $this->prepararQuery();
        $this->executar();
    }
    
    private function prepararQuery() {
        $numDeParametros = "";
        
        for ($i = 0; $i < count($this->dadosValues);$i++){
            $numDeParametros .= "?,";
        }
         
        $Parametros = substr($numDeParametros,0,-1);
        $query = "INSERT INTO " . $this->tabela . "(" . $this->dadosTabela . ") " . "VALUES(" . $Parametros . ")";
         
        $this->queryFinal =  $query;
    }
    
    private function executar() {
        try {
            $con = $this->conectar();
            $pdo = $con -> prepare($this->queryFinal);
            $array = $this->dadosValues;
            $numParam = count($array) + 1;
            
            for($i = 1,$j = 0;$i < $numParam;$i++,$j++){
                $pdo -> bindParam($i, $array[$j]);
            }
            
           $pdo -> execute();
            
        } catch (Exception $ex) {
            echo "Erro ". $ex->getMessage();
        }
    }
    
    private function setDadosValues($dadosValues) {
        $arrayDadosValues = explode(",", $dadosValues);
        $this->dadosValues = $arrayDadosValues;
    }

}
