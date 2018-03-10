<?php

/**
 * @project: sistemaphp
 * @name: Read.class 
 * @Description: Classe responsável pela ação de READ, ou seja, realizar leituras no Banco de Dados.
 * @copyright (c) 25/10/2017, Iury Gomes - IFTO
 * @author Iury Gomes de Oliveira 
 * @email iury.oliveira@ifto.edu.br
 * @version 1.0
 * @metodos ExecutarRead(), getResultado(), getLinhasAlteradas(), AlterarValores(), VerObjeto(), Connect(), GetSintaxe(), Executar() 
 */
class Read extends ConexaoBD {

    /** @var string $Select Armazena o select que vai realizar a leitura */
    private $Select;

    /** @var string $Valores Valores quer serão substituídos na string sql */
    private $Valores;

    /** @var string $Resultado Armazenará o resultado das operações no banco de dados */
    private $Resultado;

    /** @var PDOStatement $sql_preparado Armazena a query após o preparo pelo PDO */
    private $sql_preparado;

    /** @var PDO $Conexao Armazena a conexão com o banco de dados */
    private $Conexao;

    /**
     * @Descrição: Executa uma leitura simplificada com Prepared Statments. Informe colunas, tabela, os termos da seleção e os valores a serem lidos.
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @param string $Colunas Colunas a serem pesquisadas no banco
     * @param string $Tabela Nome da tabela
     * @param string $Termos Os termos a serem usados na seleção. Ex.: WHERE coluna = :link AND.. OR..
     * @param string $Valores Valores que serão substituidos na string da sql
     */
    public function ExecutarRead($Colunas, $Tabela, $Termos = null, $Valores = null) {

        if (!empty($Valores)):
            // Coloca uma string em um array
            $this->AlterarValores($Valores);
        endif;


        $this->Select = "SELECT {$Colunas} FROM {$Tabela} {$Termos}";

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
        $this->sql_preparado = $this->Conexao->prepare($this->Select);

        // Setando o retorno dos resultados como array
        $this->sql_preparado->setFetchMode(PDO::FETCH_ASSOC);
    }

    /**
     * @Descrição: Monta a string sql para ser executada pelo banco de dados
     * @copyright (c) 25/10/2017, Iury Gomes - IFTO
     * @versao 1.0 - 07/01/2018
     * @parametros Sem parâmetros
     */
    private function getSintaxe() {

        // Se existirem valores para serem substituidos na string da sql
        // então eu posso realizar a montagem da sql
        if ($this->Valores):

            // foreach serve para percorrer cada posição do vetor
            // que contem os valores a serem substituidos
            foreach ($this->Valores as $Indices => $Valor):

                // Caso eu acrescente na sql os parametros de LIMIT ou OFFSET
                // os indices que contem os valores do limit ou offsset devem ser do tipo inteiro na sql
                // por isso é necessário fazer essa conversão de tipos aqui
                if ($Indices == 'limit' || $Indices == 'offset'):
                    $Valor = (int) $Valor;
                endif;
                // Utilizando operadores ternarios aqui
                // caso $Valor seja inteiro recebe PDO::PARAM_INT
                // caso $valor não seja inteiro recebe PDO::PARAM_STR
                $this->sql_preparado->bindValue(":{$Indices}", $Valor, ( is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));

                // LEMBREM-SE:
                // No bindValue temos:
                // 1º Argumento: É o link a ser substituido
                // 2º Argumento: É o valor a ser substituido
                // 3º Argumento: É o tipo de dado que está sendo informado

            endforeach;

        endif;
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


            $this->getSintaxe(); // Montando SQL
            //var_dump($this->sql_preparado); // Para fins de depuração
            $this->sql_preparado->execute(); // Exectuando SQL montado
            $this->Resultado = $this->sql_preparado->fetchAll(); // Armazenando os resulados em formato de Array
        } catch (PDOException $erro) {
            $this->Resultado = $erro;
        }
    }

}
