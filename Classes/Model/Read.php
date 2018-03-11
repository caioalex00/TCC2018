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
    
    /**
     * @Descrição: Responsavel por executar a query gerada no metodo prepararQuery()
     * e armazenamento do resultado no atributo $resultado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/02/2018
     * @parametros Sem parâmetros
     */ 
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
    
    /**
     * @Descrição: retorna valor contido no atributo $resultado
     * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.2 - 10/03/2018
     * @parametros Sem parâmetros
     */ 
    public function getResultado() {
        return $this->resultado;
    }


}
