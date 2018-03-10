<?php
//require_once __DIR__ . "/" . "Conexao.php";
class Update extends Conexao{
    private $tabela;
    private $dadosTabela;
    private $dadosValues;
    private $condicaoColuna;
    private $condicaoValor;
    private $queryFinal;
    
    public function __construct($tabela, $dadosTabela, $dadosValues, $condicaoColuna, $condicaoValor) {
        parent::__construct();
        $this->tabela = $tabela;
        $this->dadosTabela = $dadosTabela;
        $this->dadosValues = $dadosValues;
        $this->condicaoColuna = $condicaoColuna;
        $this->condicaoValor = $condicaoValor;
    }
    
    public function executarQuery(){
        $this->prepararQuery();
        $this->executar();
    }

    private function prepararQuery() {
        $query = "UPDATE " . $this->tabela . " SET ";
        $arrayColunas = explode(",", $this->dadosTabela);
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
        $array = explode(",", $this->dadosValues);
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
