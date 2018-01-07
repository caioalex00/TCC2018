<?php
class Delete {
    private $conexao;
    private $tabela;
    private $condicaoColuna;
    private $condicaoValor;
    private $queryFinal;
    
    public function __construct($conexao,$tabela, $condicaoColuna, $condicaoValor) {
        $this->conexao = $conexao;
        $this->tabela = $tabela;
        $this->condicaoColuna = $condicaoColuna;
        $this->condicaoValor = $condicaoValor;
        $this->prepararQuery();
        $this->executarQuery();
    }

    private function prepararQuery(){
        $query = "DELETE FROM " . $this->tabela . " WHERE " . $this->condicaoColuna . " = " . "?";
        $this->queryFinal = $query;
    }
    
    private function executarQuery(){
        try {
            $con = $this -> conexao -> conectar();
            $pdo = $con -> prepare($this->queryFinal);
            $pdo -> bindParam(1, $this->condicaoValor);
            $pdo -> execute();
        } catch (Exception $ex) {
            echo $ex -> getMessage(); 
        }
    }
}
