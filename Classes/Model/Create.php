<?php
class Create {
    private $conexao;
    private $tabela;
    private $dadosTabela;
    private $dadosValues;
    private $dadosArray;
    private $queryFinal;
    
    public function __construct($conexao,$tabela,$dadosTabela,$dadosValues) {
        
        $this->tabela = $tabela;
        $this->dadosTabela = $dadosTabela;
        $this->dadosValues = $dadosValues;
        $this->conexao = $conexao;
        $this->queryFinal = ($this->prepararQuery($dadosValues));
        $this->executarQuery();
    }
    
    private function prepararQuery($dadosValues) {
         $arrayDadosValues = explode(",", $dadosValues);
         $numDeParametros = "";
         for ($i = 0; $i < count($arrayDadosValues);$i++){
             
             $numDeParametros .= "?,";
         }
         
         $Parametros = substr($numDeParametros,0,-1);
         
         $query = "INSERT INTO " . $this->tabela . "(" . $this->dadosTabela . ") " . "VALUES(" . $Parametros . ")";
         
         $this->dadosArray = $arrayDadosValues;
         return $query;
         
    }
    
    private function executarQuery() {
        try {
            $con = $this -> conexao -> conectar();
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
