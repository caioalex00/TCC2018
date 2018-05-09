<?php
/**
 * @project: librason
 * @name: Cadastro
 * @description: Classe que contém as funções de cadastro do AVA
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.3
 * @métodos Cadastrar(), vereficarDisponibilidade(), validarDados(), encriptarSenha(), realizarCadastro()
 */
class Cadastro {
    
    /** @var string $nome variavel responsavel por armazenar o nome do usuário para o cadastro */
    private $nome;
    /** @var string $email variavel responsavel por armazenar o e-mail do usuário para o cadastro */
    private $email;
    /** @var string $senha variavel responsavel por armazenar a senha do usuário para o cadastro */
    private $senha;
    /** @var object $read variavel responsavel por armazenar o objeto da função Read do CRUD */
    private $read;
    /** @var object $create variavel responsavel por armazenar o objeto da função Create do CRUD */
    private $create;
    /** @var string $senhaHost variavel responsavel por armazenar a senha do usuário em hash para o cadastro */
    private $senhaSegura;
    
    /**
     * @Descrição: Armazena os valores necessarios na instanciação
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @param string $nome armazena o nome do usuário
     * @param string $email armazena o email do usuário
     * @param string $senha armazena a senha do usuário
     */
    public function __construct($nome, $email, $senha) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
    }
    
    /**
     * @Descrição: Execulta o metodo encriptarSenha() e depois o metodo $this->realizarCadastro();
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @parametros sem parâmetros
     */
    public function Cadastrar(){
        $this->encriptarSenha();
        $this->realizarCadastro();
    }

    /**
     * @Descrição: Faz um vereficação no banco de dados vereficando se o email a ser cadastrado
     * ja existe;
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @parametros sem parâmetros
     */
    public function vereficarDisponibilidade(){
        $tabela = "usuarios";
        $dadosTabela = "Email";
        $dadosValues = $this->email;
        $this->read = new Read($tabela, $dadosTabela, $dadosValues);
        $this->read->executarQuery();
        $numeroDeUsuarios = $this->read->getQtsResultado();
        if($numeroDeUsuarios == 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * @Descrição: Faz algumas vereficações se os dados a serem inseridos no banco são validos
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @parametros sem parâmetros
     */
    public function validarDados(){
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            return "ERROR-Email-2";
        }else if(strlen($this->senha) < 8){
            return "ERROR-Senha-1";
        }else{
            return "ERROR-None";
        }
    }
    
    /**
     * @Descrição: Coloca a senha digitada no usuario em um hash e armazena
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @parametros sem parâmetros
     */
    private function encriptarSenha(){
        $this->senhaSegura = sha1($this->senha);
    }

    /**
     * @Descrição: Realiza o cadastro do usuário no banco por meio do objeto CREAT das funções CRUD
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @parametros sem parâmetros
     */
    private function realizarCadastro(){
        $tabela = "usuarios";
        $dadosTabela = "ID, Nome, Email, DataNascimento, Senha";
        $dadosValues = "null," . $this->nome . "," .$this->email . ",2000-01-00" . "," . $this->senhaSegura;
        $this->create = new Create($tabela, $dadosTabela, $dadosValues);
        $this->create->executarQuery();
    }
}
