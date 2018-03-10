<?php

/**
 * @project: sistemaphp
 * @name: Create.class 
 * @Description: Classe responsável pela ação do CREATE, ou seja, realizar cadastros no Banco de Dados. 
 * @copyright (c) 25/10/2017, Iury Gomes - IFTO
 * @author Iury Gomes de Oliveira 
 * @email iury.oliveira@ifto.edu.br
 * @version 1.0
 * @métodos ExecutarCreate(), getResultado(), VerObjeto(), Connect(), getSintaxe(), Executar() 
 */
class Create extends ConexaoBD {

    /** @var string $Tabela Nome da tabela que será manipulado pelo banco de dados */
    private $Tabela; 
    
    /** @var string $Dados Dados que serão inseridos no banco de dados */
    private $Dados; 
    
    /** @var string $Resultado Armazenará o resultado das operações no banco de dados */
    private $Resultado; 

    /** @var PDOStatement $sql_preparado Armazena a query após o preparo pelo PDO */
    private $sql_preparado;

    /** @var PDO $Conexao Armazena a conexão com o banco de dados*/
    private $Conexao; 

    /**
     * @Descrição: Executa o cadastro no banco de dados utilizando prepared statements
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @param string $Tabela Nome da tabela no banco de dados que será alterada 
     * @param array $Dados Vetor que contém os dados que serão inseridos no banco de dados
     */
        public function ExecutarCreate($Tabela, array $Dados) {
        $this->Tabela = (string) $Tabela;
        $this->Dados = $Dados;

        $this->getSintaxe();
        $this->Executar();
    }

    /**
     * @Descrição: Retorna o valor de $this->Resultado
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @parametros Sem parâmetros
     */
    public function getResultado() {
        return $this->Resultado;
    }
    
    /**
     * @Descrição: Exibe o objeto na tela do usuario
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @parametros Sem parâmetros
     */
    public function VerObjeto() {

        var_dump($this);
        echo '<hr>';
    }

    // METODOS PRIVADOS ####################################
   
    /**
     * @Descrição: Obtem a conexão com o PDO e prepara a query para execução no banco
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @parametros Sem parâmetros
     */
    private function Connect() {
        $this->Conexao = parent::ObterConexao(); // Pegando conexão com o banco
        
        // Preparando o sql para ser inserido no banco
        $this->sql_preparado = $this->Conexao->prepare($this->sql_preparado);
    }

    /**
     * @Descrição: Monta a string sql para ser executada pelo banco de dados
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @parametros Sem parâmetros
     */
    private function getSintaxe() {
        
        // implode: Junta elementos de uma matriz em uma string
        // array_keys: extrai os índices de um vetor
        // $colunas: são as colunas do vetor
        // $valores: valores a serem substituidos no vetor
        $colunas = implode(', ', array_keys($this->Dados));
        
        $valores = ':' . implode(', :', array_keys($this->Dados));
        
        $this->sql_preparado = "INSERT INTO {$this->Tabela} ({$colunas}) VALUES ({$valores})";
    }

    /**
     * @Descrição: Realiza efetivamente a execução no banco de dados da query montada pelo sistema
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @parametros Sem parâmetros
     */
    private function Executar() {
        $this->Connect();
        try {
            
            // Existe uma diferença aqui, não foi necessário executar o bindValue ou bindParam, pois a propria 
            // classe PDO vai identificar os links que precisam ser substituidos no sql preparado
            
            $this->sql_preparado->execute($this->Dados); 
            $this->Resultado = $this->Conexao->lastInsertId(); // Capturando respostas do banco
        } catch (PDOException $erro) {
            $this->Resultado = $erro;
        }
    }

}
