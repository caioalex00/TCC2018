<?php

/**
 * @project: librason
 * @name: Update
 * @description: Classe que realiza A função UPDATE do CRUD ou seja alterar os dados 
 * já armazenados no banco
 * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.2
 * @métodos executarQuery(), prepararQuery(), executar()
 */
class Update extends Conexao{
    
    /** @var string $tabela armazena o nome da tabela onde os dados serão alterados */
    private $tabela;
    
    /** @var string $dadosTabela armazena o nome das colunas onde os dados serão alterados */
    private $dadosTabela;
    
    /** @var string $dadosValues armazena os dados que serão alterados na tabela */
    private $dadosValues;
    
    /** @var string $condicaoColuna quarda o nome de colunas para saber qual linha  deve ser alterada */
    private $condicaoColuna;
    
    /** @var string $condicaoColuna quarda o valor da coluna para saber qual linha  deve ser alterada */
    private $condicaoValor;
    
    /** @var string $queryFinal armazena a query que sera gerada pelo metodo prepararQuery() para execução posterior */
    private $queryFinal;
    
    /**
     * @Descrição: Armazena os valores necessarios na instanciação e executa o 
     * metodo construct da Classe herdada Conexao
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @param string $tabela armazena o nome da tabela obtido na instanciação
     * @param string $dadosTabela armazena o nome das colunas onde os dados serão alterados
     * @param string $dadosValues armazena os dados que serão inseridos como alteração
     * @param string $condicaoColuna armazena o nome da coluna obtido na instanciação
     * @param string $condicaoValor armazena o valor contido na coluna obtido na instanciação
     */
    public function __construct($tabela, $dadosTabela, $dadosValues, $condicaoColuna, $condicaoValor) {
        parent::__construct();
        $this->tabela = $tabela;
        $this->dadosTabela = $dadosTabela;
        $this->dadosValues = $dadosValues;
        $this->condicaoColuna = $condicaoColuna;
        $this->condicaoValor = $condicaoValor;
    }
    
     /**
     * @Descrição: Executa os metódos prepararQuery() e executar() um depois do outro
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    public function executarQuery(){
        $this->prepararQuery();
        $this->executar();
    }

    /**
     * @Descrição: Esse metódo e responsavel por gerar a query que ira alterar os 
     * dados armazenados no banco e por fim armazenar a query gerada no atributo
     * $queryFinal
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    private function prepararQuery() {
        //Prparamos a primeira parte da query informando qual tabela sera alterada
        $query = "UPDATE " . $this->tabela . " SET ";
        //Separamos os dados em um array
        $arrayColunas = explode(",", $this->dadosTabela);
        $colunasRef = "";
        //Por meio do repetidor inserimos na variavel quais colunas serão alteradas
        for ($i = 0;$i < count($arrayColunas);$i++){
            $arrayColunas[$i] .= " = ?";
        }
        //Juntamos o array em uma string
        $colunasRef .= implode(",", $arrayColunas);
        //Montamos e armazenamos a query
        $query .= $colunasRef . " WHERE " . $this->condicaoColuna . " = ?";
        $this->queryFinal =  $query;
    }
    
     /**
     * @Descrição: Responsavel por executar a query gerada no metodo prepararQuery()
     * e armazenamento do resultado no atributo $resultado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/02/2018
     * @parametros Sem parâmetros
     */ 
    private function executar(){
        try {
            //Realimos a conexão com o banco de dados
            $con = $this -> conectar();
            //preparamos a query
            $pdo = $con -> prepare($this -> queryFinal);
            $array = explode("|\|R", $this->dadosValues);
            $numParam = count($array);
            //Inserido dados necessarios no bindParam por meio de array
            for($i = 1, $j = 0;$j < $numParam;$i++,$j++){
                $pdo -> bindParam($i, $array[$j]);
            } 
            //Adicionando o valor da condição
            $pdo -> bindParam($numParam + 1, $this->condicaoValor);
            //Execultamos o query
            $pdo -> execute();
        
        } catch (Exception $ex) {
            //Imprimimos o erro caso haja
            echo $ex -> getMessage(); 
        }
    }
}