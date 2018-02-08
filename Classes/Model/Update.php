<?php
class Update extends Conexao{
    private $tabela;
    private $colunas;
    private $valores;
    private $condicaoColuna;
    private $condicaoValor;
    private $queryFinal;
    
    public function __construct($tabela, $colunas, $valores, $condicaoColuna, $condicaoValor) {
        $this->tabela = $tabela;
        $this->colunas = $colunas;
        $this->valores = $valores;
        $this->condicaoColuna = $condicaoColuna;
        $this->condicaoValor = $condicaoValor;
    }
    
    public function executarQuery(){
        $this->prepararQuery();
        $this->executar();
    }

    private function prepararQuery() {
        $query = "UPDATE " . $this->tabela . " SET ";
        $arrayColunas = explode(",", $this->colunas);
        $colunasRef = "";
        for ($i = 0;$i < count($arrayColunas);$i++){
            $arrayColunas[$i] .= " = ?";
        }
        $colunasRef .= implode(",", $arrayColunas);
        $query .= $colunasRef . " WHERE " . $this->condicaoColuna . " = ?";
        $this->queryFinal =  $query;
    }
    
    private function executar(){
        try {
        $con = $this -> conectar();
        $pdo = $con -> prepare($this -> queryFinal);
        $array = explode(",", $this->valores);
        $numParam = count($array);
        
        for($i = 1, $j = 0;$j < $numParam;$i++,$j++){
            $pdo -> bindParam($i, $array[$j]);
        } 
        
        $pdo -> bindParam($numParam + 1, $this->condicaoValor);
        $pdo -> execute();
        
        } catch (Exception $ex) {
            echo $ex -> getMessage(); 
        }
    }
}
