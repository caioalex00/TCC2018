<?php
/**
 * @project: librason
 * @name: Login
 * @description: Classe que contém as funções de Login do AVA
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.3
 * @métodos logar(), veriLogin(), autenticar(), iniciarSessao()
 */
class Login {
    /** @var string $login variavel responsavel por armazenar o dado de login, nesse caso o email */
    private $login;
    /** @var string $senha variavel responsavel por armazenar a senha do usuário para o cadastro */
    private $senha;
    /** @var boolean $logado variavel responsavel por armazenar valor logico que corresponde ao usuário estar logado */
    private $logado = false;
    /** @var string $ID variavel responsavel por armazenar o ID correspondente ao usuário no banco de dados */
    private $ID;
    /** @var object $read variavel responsavel por armazenar o objeto da função Read do CRUD */
    private $read;
    /** @var object $read variavel responsavel por armazenar os dados gerados do objeto Read */
    private $infs;
    
    /**
     * @Descrição: Armazena os valores necessarios na instanciação
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @param string $login armazena o login do usuário
     * @param string $senha armazena a senha do usuário
     */
    function __construct($login, $senha) {
        $this->login = $login;
        $this->senha = $senha;
    }
    
    /**
     * @Descrição: Faz o login do usuário utilizando metodos desta classe
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @parametros sem parâmetros
     */
    public function logar() {
        $this->Autenticar();
        if($this -> logado){
            $this->iniciarSessao();
            echo "<script>alert('Login Realizado!')</script>";
            echo "<script>window.location.href = '../../index.php'</script>";
        }else{
            echo "<script>alert('Acesso não altorizado! tente novamente fazer o login.')</script>";
            echo "<script>window.location.href = '../../index.php'</script>";
        }
    }
    
    /**
     * @Descrição: Metodo que verefica se o usuário permanece logado
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @parametros sem parâmetros
     */
    public function veriLogin(){
        $this->Autenticar();
        return $this->logado;
    }
    
    /**
     * @Descrição: Realiza a autentição do Login
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @parametros sem parâmetros
     */
    private function autenticar(){
        $tabela = "usuarios";
        $dadosTabela = "Email,Senha";
        $dadosValues = $this->login . "," . sha1($this->senha);
        $this->read = new Read($tabela, $dadosTabela, $dadosValues);
        $this->read->executarQuery();
        $Infs = $this->read->getResultado();
        if($Infs[0]['Email'] == $this->login && $Infs[0]['Senha'] == sha1($this->senha)){
            $this->ID = $Infs[0]['ID'];
            $this->infs = $Infs;
            $this->logado = true;
        }
    }
    
    /**
     * @Descrição: Metodo que inicia sessão com os dados pegos do banco
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @parametros sem parâmetros
     */
    private function iniciarSessao(){
        $_SESSION['ID_User'] = $this->infs[0]['ID'];
        $_SESSION['Login_User'] = $this->infs[0]['Email'];
        $_SESSION['Senha_User'] = $this->senha;
    }
    
    /**
     * @Descrição: Metodo que realiza o logout do sistema
     * @copyright (c) 09/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 09/05/2018
     * @parametros sem parâmetros
     */
    public static function encerrarLogin(){
        unset($_SESSION);
        session_destroy();
        echo "<script>alert('Login encerrado! Até mais')</script>";
        echo "<script>window.location.href = '../../index.php'</script>";
    }
}
