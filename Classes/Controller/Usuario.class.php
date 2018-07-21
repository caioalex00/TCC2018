<?php
/**
 * @project: librason
 * @name: Usuario
 * @description: Essa classe representa o usuário e serve para a obtenção de dados do mesmo
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.5
 * @métodos detectarUsuario(), detectarFotoPerfil(), imprimirFotoPerfil()
 */

class Usuario {
    /** @var int $ID variavel responsavel por armazenar o ID do usuário */
    private $ID;
    /** @var char $nivel variavel responsavel por armazenar o nivel do usuário*/
    private $nivel;
    /** @var object $read variavel responsavel por armazenar o objeto Read */
    private $read;
    /** @var string $nome variavel responsavel por armazenar o nome do suário */
    public $nome;
    /** @var string $turma variavel responsavel por armazenar a turma do usuário caso aluno */
    public $turma;
    /** @var string $email variavel responsavel por armazenar o dado de email */
    public $email;
    /** @var string $ftPerfil variavel responsavel por armazenar a foto de perfil do usuário */
    public $ftPerfil;
    
    /**
     * @Descrição: Armazena os valores necessarios na instanciação e execulta métodos que ja detectam as informações do usuário
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @param string $ID armazena o ID do usuário
     * @param string $Nivel armazena o Nivel do usuário
     */
    public function __construct($ID, $Nivel) {
        $this->ID = $ID;
        $this->nivel = $Nivel;
        $this->detectarUsuario();
        $this->detectarFotoPerfil();
    }

     /**
     * @Descrição: Método que detecta as informações do usuario no banco de dados 
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @parametros sem parâmetros
     */
    private function detectarUsuario(){
        if($this->nivel ==  "A"){
            $this->read = new Read("Aluno", "ID", $this->ID);
        }else if($this->nivel ==  "P"){
            $this->read = new Read("Professor", "ID", $this->ID);
        }
        
        $this->read->executarQuery();
        $Usuario = $this->read->getResultado();
        
        $this->nome = $Usuario[0]['Nome'];
        if($this->nivel ==  "A"){
            $this->turma = $Usuario[0]['Turma_COD_FK'];
        }
        $this->email = $Usuario[0]['Email'];
    }
    
    /**
     * @Descrição: Método que detecta a foto do usuario no banco e armazena ela em variavel
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @parametros sem parâmetros
     */
    private function detectarFotoPerfil(){
        if($this->nivel == "A"){
           $this->read = new Read("Perfil_Aluno", "Aluno_FK", $this->ID); 
        }else if($this->nivel == "P"){
            $this->read = new Read("Perfil_Professor", "Professor_FK", $this->ID);
        }
        $this->read->executarQuery();
        $this->ftPerfil = $this->read->getResultado();
    }
    
    /**
     * @Descrição: Método que imprimi a foto de perfil
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @parametros sem parâmetros
     */
    public function imprimirFotoPerfil(){
        Header( "Content-type: image/gif");
        echo $this->ftPerfil[0]['Imagem'];
        header("Content-Type: text/html; charset=ISO-8859-1",true);
    }
}
