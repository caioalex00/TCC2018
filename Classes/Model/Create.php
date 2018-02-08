<?php
class Create extends Conexao{
    private $tabela;
    private $dadosTabela;
    private $dadosValues;
    private $dadosArray;
    private $queryFinal;
    
    public function __construct($tabela,$dadosTabela,$dadosValues) {  
        $this->tabela = $tabela;
        $this->dadosTabela = $dadosTabela;
        $this->dadosValues = $dadosValues;  
    }
    
    public function ExecutarQuery(){
        $this->prepararQuery();
        $this->executar();
    }
    
    private function prepararQuery() {
        $arrayDadosValues = explode(",", $this->dadosValues);
        $numDeParametros = "";
        for ($i = 0; $i < count($arrayDadosValues);$i++){
             
            $numDeParametros .= "?,";
        }
         
        $Parametros = substr($numDeParametros,0,-1);
         
        $query = "INSERT INTO " . $this->tabela . "(" . $this->dadosTabela . ") " . "VALUES(" . $Parametros . ")";
         
        $this->dadosArray = $arrayDadosValues;
        $this->queryFinal =  $query;
        
    }
    
    private function executar() {
        try {
            $con = $this -> conectar();
            $pdo = $con -> prepare($this->queryFinal);
            
            $array = $this->dadosArray;
            $numParam = count($array) + 1;
            
            for($i = 1,$j = 0;$i < $numParam;$i++,$j++){
                $pdo -> bindParam($i, $array[$j]);
            }
            
           $pdo -> execute();
            
        } catch (Exception $ex) {
            echo "Erro ". $ex->getMessage();
        }
    }
}
