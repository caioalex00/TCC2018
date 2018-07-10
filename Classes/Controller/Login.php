<?php
/**
 * @project: librason
 * @name: Login
 * @description: Classe que contém as funções de Login do AVA
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.4
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
    /** @var string $Turma variavel responsavel por armazenar a Turma correspondente ao usuário no banco de dados */
    private $Turma;
    /** @var string $nivel variavel responsavel por armazenar o nivel de acesso correspondente ao usuário no banco de dados */
    private $nivel;
    /** @var object $read variavel responsavel por armazenar o objeto da função Read do CRUD */
    private $read;
    /** @var object $read1 variavel responsavel por armazenar o objeto da função Read do CRUD */
    private $read1;
    
    /**
     * @Descrição: Faz o login do usuário utilizando metodos desta classe
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
     * @parametros sem parâmetros
     */
    public function logar(){
        $this->autenticar();
        $this->vereficar();
        if($this->logado == true){
            $this->iniciarSessao();
            echo "<script>window.location.href = '../../index.php'</script>";
        }else{
            echo "<script>window.location.href = '../View/Pagina_Inicial.php?Login=ERROR'</script>";
        }
    }


    /**
     * @Descrição: Armazena os valores necessarios na instanciação
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.3 - 06/05/2018
     * @param string $login armazena o login do usuário
     * @param string $senha armazena a senha do usuário
     */
    function __construct($login, $senha) {
        $this->login = $login;
        $this->senha = sha1($senha);
    }
    
    /**
     * @Descrição: Realiza a autentição do Login
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
     * @parametros sem parâmetros
     */
    public function autenticar(){
        $funcao = "SELECT autenticar('" . $this->login . "','" . $this->senha . "');";
        $this->read = new Read($funcao,NULL, NULL);
        $this->nivel =  $this->read->chamarFuncao();
    }
    
    /**
     * @Descrição: Faz uma vereficação final de segurança e obtem o ID do usuário
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
     * @parametros sem parâmetros
     */
    private function vereficar(){
        if($this->nivel == "P"){
            $this->read1 = new Read("Professor", "Email,Senha", $this->login . "," . $this->senha);
            $this->read1-> executarQuery();
            $Infs = $this->read1->getResultado();
            if($Infs[0]['Email'] == $this->login && $Infs[0]['Senha'] == $this->senha){
                $this->ID = $Infs[0]['ID'];
                $this->logado = true;
            }
        }else{
            $this->read1 = new Read("Aluno", "Email,Senha", $this->login . "," . $this->senha);
            $this->read1-> executarQuery();
            $Infs = $this->read1->getResultado();
            if($Infs[0]['Email'] == $this->login && $Infs[0]['Senha'] == $this->senha){
                $this->ID = $Infs[0]['ID'];
                $this->logado = true;
                if(isset($Infs[0]['Turma_COD_FK'])){
                    $this->Turma = $Infs[0]['Turma_COD_FK'];
                }
            }
        }
    }
    
    /**
     * @Descrição: Metodo que inicia sessão com os dados pegos do banco
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 06/05/2018
     * @parametros sem parâmetros
     */
    private function iniciarSessao(){
        $_SESSION['ID_User'] = $this->ID;
        $_SESSION['Login_User'] = $this->login;
        $_SESSION['Senha_User'] = $this->senha;
        $_SESSION['Nivel_User'] = $this->nivel;
        if(!empty($this->Turma)){
            $_SESSION['Turma_User'] = $this->Turma;
        }
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
