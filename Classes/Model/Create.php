<?php

/**
 * @project: librason
 * @name: Create
 * @description: Classe que realiza A função CREATE do CRUD ou seja inserir dados no banco
 * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.2
 * @métodos executarQuery(), prepararQuery(), executar(), setDadosValues
 */
class Create extends Conexao{
    
    /** @var string $tabela armazena o nome da tabela onde os dados serão inseridos */
    private $tabela;
    
    /** @var string $dadosTabela armazena o nome das colunas onde os dados serão inseridos */
    private $dadosTabela;
    
    /** @var array $dadosValues armazena os dados que serão inseridos na tabela */
    private $dadosValues;
    
    /** @var string $queryFinal armazena a query que sera gerada pelo metodo prepararQuery() para execução posterior */ 
    private $queryFinal;
    
    /**
     * @Descrição: Armazena os valores necessarios na instanciação e executa o 
     * metodo construct da Classe herdada Conexao
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @param string $tabela armazena o nome da tabela obtido na instanciação
     * @param string $dadosTabela armazena o nome das colunas onde os dados serãoinseridos
     * @param string $dadosValues armazena os dados que serão inseridos
     */
    public function __construct($tabela,$dadosTabela,$dadosValues) {  
        parent::__construct();
        $this->tabela = $tabela;
        $this->dadosTabela = $dadosTabela;
        $this->setDadosValues($dadosValues); 
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
    
    //Metodos Privados
    
    /**
     * @Descrição: Esse metódo e responsavel por gerar a query que ira armazana os 
     * dados submetidos na instanciação no banco e por fim armazenar a query gerada
     * no atributo $queryFinal
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    private function prepararQuery() {
        $numDeParametros = "";
        
        //Utilizamos o repetidor para inserir os "?"  necessarios na query
        for ($i = 0; $i < count($this->dadosValues);$i++){
            $numDeParametros .= "?,";
        }
        //Retiramos a ultima virgula que sobro do repetidor 
        $Parametros = substr($numDeParametros,0,-1);
        //Montamos a query com os valores obtidos
        $query = "INSERT INTO " . $this->tabela . "(" . $this->dadosTabela . ") " . "VALUES(" . $Parametros . ")";
        //Armazenamos o resultado no atributo $queryFinal 
        $this->queryFinal =  $query;
    }
    
    /**
     * @Descrição: Responsavel por executar a query gerada no metodo prepararQuery()
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */ 
    private function executar() {
        try {
            //Execultamos a conexão com o banco
            $con = $this->conectar();
            //Preparamos a query
            $pdo = $con -> prepare($this->queryFinal);
            
            $array = $this->dadosValues;
            $numParam = count($array) + 1;
            //Com um repetido e o array dos dados, execultamos os bindParam necessarios
            for($i = 1,$j = 0;$i < $numParam;$i++,$j++){
                $pdo -> bindParam($i, $array[$j]);
            }
            
            //Execultamos a query
            $pdo -> execute();
            
        } catch (Exception $ex) {
            //Imprimos o erro na tela caso ocorra algum problema
            echo "Erro ". $ex->getMessage();
        }
    }
    
    /**
     * @Descrição: Esse metodo pega os dados a serem inseridos no banco que estão 
     * em uma string e separa eles em array pela função explode e armazena no 
     * atributo $dadosValues
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @param string $dadosValues que armazena os dados a serem inseridos no banco
     */
    private function setDadosValues($dadosValues) {
        $arrayDadosValues = explode(",", $dadosValues);
        $this->dadosValues = $arrayDadosValues;
    }

}
