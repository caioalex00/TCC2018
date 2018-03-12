<?php

/**
 * @project librason
 * @name: Delete
 * @description: Classe que realiza A função DELETE do CRUD ou seja deletar dados no banco
 * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.2
 * @métodos executarQuery(), prepararQuery(), executar()
 */
class Delete extends Conexao{
    
    /** @var string $tabela armazena o nome da tabela onde os dados serão deletados */
    private $tabela;
    
    /** @var string $condicaoColuna armazena o nome da coluna para ser usado como condição na query*/
    private $condicaoColuna;
    
    /** @var string do na $condicaoValor armazena o valor contido na coluna para ser usado como condicao na query */
    private $condicaoValor;
    
    /** @var string $queryFinal armazena a query que sera gerada pelo metodo prepararQuery() para execução posterior */
    private $queryFinal;
    
    /**
     * @Descrição: Armazena os valores necessarios na instanciação e executa o 
     * metodo construct da Classe herdada Conexao
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @param string $tabela armazena o nome da tabela obtido na instanciação
     * @param string $condicaoColuna armazena o nome da coluna obtido na instanciação
     * @param string $condicaoValor armazena o valor contido na coluna obtido na instanciação
     */
    public function __construct($tabela, $condicaoColuna, $condicaoValor) {
        parent::__construct();
        $this->tabela = $tabela;
        $this->condicaoColuna = $condicaoColuna;
        $this->condicaoValor = $condicaoValor;
    }
    
    /**
     * @Descrição: Executa os metódos prepararQuery() e executar() um depois do outro
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    public function executarQuery() {
        $this->prepararQuery();
        $this->executar();
    }

    /**
     * @Descrição: Esse metódo e responsavel por gerar a query que ira deletar as linhas
     * indicadas na condição
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    private function prepararQuery(){
        $query = "DELETE FROM " . $this->tabela . " WHERE " . $this->condicaoColuna . " = " . "?";
        $this->queryFinal = $query;
    }
    
    /**
     * @Descrição: Responsavel por executar a query gerada no metodo prepararQuery()
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */ 
    private function executar(){
        try {
            //Fazemos a conexão com o banco de dados
            $con = $this -> conectar();
            //preparamos a query pelo metodo prepare() e logo depois execultamos o bindParam
            $pdo = $con -> prepare($this->queryFinal);
            $pdo -> bindParam(1, $this->condicaoValor);
            //Execultamos a query
            $pdo -> execute();
        } catch (Exception $ex) {
            //Imprimos na tela o erro caso haja
            echo $ex -> getMessage(); 
        }
    }
}