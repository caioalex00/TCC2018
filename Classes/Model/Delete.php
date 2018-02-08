<?php
class Delete extends Conexao{
    private $tabela;
    private $condicaoColuna;
    private $condicaoValor;
    private $queryFinal;
    
    public function __construct($tabela, $condicaoColuna, $condicaoValor) {
        $this->tabela = $tabela;
        $this->condicaoColuna = $condicaoColuna;
        $this->condicaoValor = $condicaoValor;
    }
    
    public function executarQuery() {
        $this->prepararQuery();
        $this->executar();
    }

    private function prepararQuery(){
        $query = "DELETE FROM " . $this->tabela . " WHERE " . $this->condicaoColuna . " = " . "?";
        $this->queryFinal = $query;
    }
    
    private function executar(){
        try {
            $con = $this -> conectar();
            $pdo = $con -> prepare($this->queryFinal);
            $pdo -> bindParam(1, $this->condicaoValor);
            $pdo -> execute();
        } catch (Exception $ex) {
            echo $ex -> getMessage(); 
        }
    }
}