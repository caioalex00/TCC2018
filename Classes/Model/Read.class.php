<?php

/**
 * @project: librason
 * @name: Read
 * @description: Classe que realiza A função READ do CRUD ou seja ler o dados 
 * contidos no banco
 * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.2 - 10/02/2018
 * @métodos executarQuery(), prepararQuery(), executar(), getResultado()
 */
class Read extends Conexao{
    
    /** @var string $tabela armazena o nome da tabela onde os dados serão lidos */
    private $tabela;
    
    /** @var string $dadosValues armazena os dados que serão lidos na tabela */
    private $dadosValues;
    
    /** @var string $dadosTabela armazena o nome das colunas onde os dados serão lidos */
    private $dadosTabela;
    
    /** @var string $queryFinal armazena a query que sera gerada pelo metodo prepararQuery() para execução posterior */ 
    private $queryFinal;
    
    /** @var string $resultado armazena o resultado obtido da execulção da query pelo metodo executar()*/
    private $resultado;
    
    /** @var string $qtsResultado armazena a quanridade de resultados */
    private $qtsResultado;
    /**
     * @Descrição: Armazena os valores necessarios na instanciação e executa o 
     * metodo construct da Classe herdada Conexao
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @param string $tabela armazena o nome da tabela obtido na instanciação
     * @param string $dadosTabela armazena o nome das colunas onde os dados serão lidos
     * @param string $dadosValues armazena os dados que serão usados para indicar a linha a ser lida
     */
    public function __construct($tabela,$dadosTabela,$dadosValues) {
        parent::__construct();
        $this -> tabela = $tabela;
        $this -> dadosValues = $dadosValues;
        $this -> dadosTabela = $dadosTabela;
        $this -> resultado = "Resultado não disponivel!"; 
    }
    
    /**
     * @Descrição: Executa os metódos prepararQuery() e executar() um depois do outro
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    public function executarQuery() {
        $this->prepararQuery();
        return $this->executar();
    }
    
    /**
     * @Descrição: Esse metódo e responsavel por gerar a query que ira ler os 
     * dados armazenados no banco e por fim armazenar a query gerada no atributo
     * $queryFinal
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */
    private function prepararQuery() {
        $query = "SELECT * FROM " . $this -> tabela;
        //Separamos os nomes das conunas do banco em um array
        $arrayColunas = explode(",", $this -> dadosTabela);
        
        //Aqui preparamos o WHERE da query, para indentificarmos quais informações devem ser lidas
        if(!empty($this->dadosTabela)){
            //Montamos a variavel com o WHERE
            $query .= " WHERE ";
            
            //Nesse repetidor montamos a query adicionando as colunas necessarias mais o "=?" e o AND quando necessario
            for ($i = 0;$i < count($arrayColunas);$i++){
                if($i != 0 ){
                    $query .= " AND ";
                }
                
                $query .= $arrayColunas[$i] . " = ?";
            }
        }
        //Armazenamos a qlizuery gerada para utilização futura
        $this -> queryFinal = $query;
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
            //Realizamos conexao com o banco
            $con = $this->conectar();
            //Preparamos a query
            $pdo = $con -> prepare($this->queryFinal);
            //Separamos os dados em um array
            $array = explode(",", $this->dadosValues);
            $numParam = count($array);
            
            //Inserimos os dados no bindParam por meio de um repetidor
            for($i = 1, $j = 0;$j < $numParam;$i++,$j++){
                $pdo -> bindParam($i, $array[$j]);
            }
            //Executamos a query
            $pdo -> execute();
            //Armazenamos a quantidade e resultados obtidos
            $this->qtsResultado = $pdo->rowCount();
            
            if($this->qtsResultado >= 1){
                $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);
            }else{
                $resultado = NULL;
            }  
            
        } catch (Exception $ex) {
            //Imprimos o erro caso haja
            $resultado = $ex -> getMessage(); 
        }
        
        //Armazenamos o resultado
        $this->resultado =  $resultado;
    }
    
    /**
     * @Descrição: Responsavel por executar Funções contidas no SGBD
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 20/02/2018
     * @parametros Sem parâmetros
     */ 
    public function chamarFuncao() {
        try {
            //Preparando Select de Função que foi inserido na variavel tabela 
            $select = $this->tabela;
            //Realizamos conexao com o banco
            $con = $this->conectar();
            //Preparamos a query
            $pdo = $con -> prepare($select);
            //Executamos a query
            $pdo -> execute();
            
            //Armazena resultado e retornando
            $resultado = $pdo->fetchAll(PDO::FETCH_NUM);
            $this->resultado = $resultado;
            
            return $resultado[0][0];
        } catch (Exception $ex) {
            //Imprimimos o erro caso haja
            $resultado = $ex -> getMessage(); 
        }
        
        //Armazenamos o resultado e retornando
        return $this->resultado =  $resultado;
    }
    
    /**
     * @Descrição: Responsavel por executar StoreProcedures contidas no SGBD
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 20/02/2018
     * @parametros Sem parâmetros
     */ 
    public function chamarSP() {
        try {
            //Preparando Select de Função que foi inserido na variavel tabela 
            $select = $this->tabela;
            //Realizamos conexao com o banco
            $con = $this->conectar();
            //Preparamos a query
            $pdo = $con -> prepare($select);
            //Executamos a query
            $pdo -> execute();
            //Armazenamos a quantidade e resultados obtidos
            $this->qtsResultado = $pdo->rowCount();
            //Armazena resultado e retornando
            $resultado = $pdo->fetchAll(PDO::FETCH_ASSOC);
            $this->resultado = $resultado;
            
        } catch (Exception $ex) {
            //Imprimimos o erro caso haja
            $resultado = $ex -> getMessage(); 
        }
        
        //Armazenamos o resultado e retornando
        return $this->resultado =  $resultado;
    }
    
    /**
     * @Descrição: retorna valor contido no atributo $resultado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */ 
    public function getResultado() {
        return $this->resultado;
    }
    
    /**
     * @Descrição: retorna valor contido no atributo $qtsResultado
     * @copyright (c) 12/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */ 
    public function getQtsResultado() {
        return $this->qtsResultado;
    }


}
