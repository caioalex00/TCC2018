<?php
class Read {
    private $conexao;
    private $tabela;
    private $procura;
    private $queryFinal;
    private $colunas;

    public function __construct($conexao,$tabela,$colunas,$procura) {
        $this -> conexao = $conexao;
        $this -> tabela = $tabela;
        $this -> procura = $procura;
        $this -> colunas = $colunas;
        $this -> prepararQuery();
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
        
        echo $this -> queryFinal = $query;
    }
    
    public function executarQuery(){
        try {
            
            $con = $this-> conexao -> conectar();
            $pdo = $con -> prepare($this->queryFinal);
            $array = explode(",", $this->procura);
            $numParam = count($array);

            for($i = 1, $j = 0;$j < $numParam;$i++,$j++){
                $pdo -> bindParam($i, $array[$j]);
            }
            $pdo -> execute();
            
        } catch (Exception $ex) {
            echo $ex -> getMessage(); 
        }
        
        $resultado = $pdo->fetchAll();
        return $resultado;
    }
            
}
