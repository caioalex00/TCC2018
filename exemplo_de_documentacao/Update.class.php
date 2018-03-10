<?php

/**
 * @project: sistemaphp
 * @name: Update.class 
 * @Description: Classe responsável pela ação de UPDATE, ou seja, realizar atualizações no Banco de Dados.
 * @copyright (c) 25/10/2017, Iury Gomes - IFTO
 * @author Iury Gomes de Oliveira 
 * @email iury.oliveira@ifto.edu.br
 * @version 1.0
 * @metodos ExecutarUpdate(), getResultado(), getLinhasAlteradas(), AlterarValores(), VerObjeto(), Connect(), GetSintaxe(), Executar() 
 */
class Update extends ConexaoBD {

    /** @var string $Dados Dados que serão inseridos na tabela, realizando atualização */
    private $Dados;
   
    /** @var string $Tabela Nome da tabela que será manipulado pelo banco de dados */
    private $Tabela;

    /** @var string $Parametros Parâmetros para realizar o update no banco */
    private $Parametros;

    /** @var string $Valores Valores quer serão substituídos na string sql */
    private $Valores;

    /** @var string $Resultado Armazenará o resultado das operações no banco de dados */
    private $Resultado;

    /** @var PDOStatement $sql_preparado Armazena a query após o preparo pelo PDO */
    private $sql_preparado;

    /** @var PDO $Conexao Armazena a conexão com o banco de dados */
    private $Conexao;

    /**
     * @Descrição: Executa um update com Prepared Statments.
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @param string $Tabela Nome da tabela
     * @param array $Dados Vetor que contem os dados que serão atualizados no banco 
     * @param string $Parametros Os parametros a serem usados no update. Ex.: WHERE coluna = :link AND.. OR..
     * @param string $Valores Valores que serão substituidos na string da sql
     */
    public function ExecutarUpdate( string $Tabela, array $Dados, string $Parametros, $Valores) {

        $this->Tabela = $Tabela;
        $this->Dados = $Dados;
        $this->Parametros = $Parametros;

        $this->AlterarValores($Valores);

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
     * @Descrição: Retorna o número de registros alterados pela sql
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @parametros Sem parâmetros
     */
    public function getLinhasAlteradas() {
        return $this->sql_preparado->rowCount();
    }

    /**
     * @Descrição: Altera apenas os valores que precisam ser substituidos sem necessidade de alterar o sql montado anteriormente em getSintaxe
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @param string $Valores Valores que serão substituidos na sql
     */
    public function AlterarValores($Valores) {

        if (!empty($Valores)):
            // Coloca uma string em um array
            parse_str($Valores, $this->Valores);
        else:
            return null;
        endif;
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

    // MÉTODOS PRIVADOS ############################
    
    /**
     * @Descrição: Obtem a conexão com o PDO e prepara a query para execução no banco
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @parametros Sem parâmetros
     */
    private function Connect() {

        // Obtendo conexão com o banco de dados
        $this->Conexao = parent::ObterConexao();

        // Preparando o SQL para ser executado pelo Banco
        $this->sql_preparado = $this->Conexao->prepare($this->sql_preparado);

    }

    /**
     * @Descrição: Monta a string sql para ser executada pelo banco de dados
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @parametros Sem parâmetros
     */
    private function getSintaxe() {

        foreach ($this->Dados as $Indices => $Valor):
            $strings[] = $Indices . ' = :' . $Indices;
        endforeach;

        //var_dump($strings); // Para Fins de depuração apenas
       
        // Separar por virgulas as strings
        $strings = implode(', ', $strings);

        //var_dump($strings); // Para Fins de depuração apenas
        $this->sql_preparado = "UPDATE {$this->Tabela} SET {$strings} {$this->Parametros}";
        
        //var_dump($this->sql_preparado);
    
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
            
            $this->sql_preparado->execute(array_merge($this->Dados, $this->Valores));
            $this->Resultado = true;
            
        } catch (PDOException $erro) {
           $this->Resultado = $erro;
        }
    }

}
