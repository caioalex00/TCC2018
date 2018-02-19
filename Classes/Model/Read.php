<?php
require_once __DIR__ . "/" . "Conexao.php";
class Read extends Conexao{
    private $tabela;
    private $dadosValues;
    private $dadosTabela;
    private $queryFinal;
    private $resultado;
    
    public function __construct($tabela,$dadosTabela,$dadosValues) {
        parent::__construct();
        $this -> tabela = $tabela;
        $this -> dadosValues = $dadosValues;
        $this -> dadosTabela = $dadosTabela;
        $this -> resultado = "Resultado não disponivel!"; 
    }
    
    public function executarQuery() {
        $this->prepararQuery();
        return $this->executar();
    }
    
    private function prepararQuery() {
        $query = "SELECT * FROM " . $this -> tabela;
        $arrayColunas = explode(",", $this -> dadosTabela);
        
        if(!empty($this->dadosTabela)){
            
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
            $array = explode(",", $this->dadosValues);
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
            $resultado = $ex -> getMessage(); 
        }
        
        $this->resultado =  $resultado;
    }
    
    public function getResultado() {
        return $this->resultado;
    }


}
