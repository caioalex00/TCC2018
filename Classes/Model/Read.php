<?php
class Read extends Conexao{
    private $tabela;
    private $procura;
    private $queryFinal;
    private $colunas;

    public function __construct($tabela,$colunas,$procura) {
        $this -> tabela = $tabela;
        $this -> procura = $procura;
        $this -> colunas = $colunas;
    }
    
    public function executarQuery() {
        $this->prepararQuery();
        return $this->executar();
    }
    
    private function prepararQuery() {
        $query = "SELECT * FROM " . $this -> tabela;
        $arrayColunas = explode(",", $this -> colunas);
        
        if(!empty($this->colunas)){
            
            $query .= " WHERE ";
            
            for ($i = 0;$i < count($arrayColunas);$i++){
                if($i != 0 ){
                    $query .= " AND ";
                }
                
                $query .= $arrayColunas[$i] . " = ?";
            }
        }
        
        $this -> queryFinal = $query;
    }
    
    private function executar(){
        try {
            
            $con = $this->conectar();
            $pdo = $con -> prepare($this->queryFinal);
            $array = explode(",", $this->procura);
            $numParam = count($array);

            for($i = 1, $j = 0;$j < $numParam;$i++,$j++){
                $pdo -> bindParam($i, $array[$j]);
            }
            
            $pdo -> execute();
            $VerificarQtdresultados = $pdo->rowCount();
            
            if($VerificarQtdresultados == 1){
                $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $resultado = "Não foi encontrado resultados!";
            }  
            
        } catch (Exception $ex) {
            echo $ex -> getMessage(); 
        }
        
        return $resultado;
    }
            
}
