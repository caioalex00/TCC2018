<?php
/**
 * @project: librason
 * @name: ConfiguracoesUsuario
 * @description: Classe que trabalha com configurações da parte do usuário, como alteração de senha, nome e foto de perfil.
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.5
 * @métodos executarAtualizacao(), organizarDados(), setID(), setNivel(), atualizarDados(), vereficarDisponibilidadeEmail(), localizarEmailNovo()
 */

class ConfiguracoesUsuario {
    /** @var string $dadosRecebidos variavel responsavel por armazenar os dados de instaciação*/
    private $dadosRecebidos;
    /** @var string $dadosRecebidos variavel responsavel por armazenar quais campos serão alterados */
    private $dadosInsercao;
    /** @var string $dadosAtuaçizacao variavel responsavel por armazenar os dados que serão alterados */
    private $dadosAtualizacao;
    /** @var int $ID variavel responsavel por armazenar o ID do usuário que ira alterar suas configurações */
    private $ID;
    /** @var string $email variavel responsavel por armazenar o email do usuario caso ele queira alterar para uma vereficação de disponibilidade */
    private $email;
    /** @var char $nivel variavel responsavel por armazenar o nivel do usuário */
    private $nivel;
    /** @var object $update variavel responsavel por armazenar o objeto Update */
    private $update;
    /** @var object $uread variavel responsavel por armazenar o objeto Read */
    private $read;
    
    /**
     * @Descrição: Método construtor da classes, nele armazenamos os dados de instanciação
     * e nele pegamos o ID e o Nivel do usuário
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @param string $dadosRecebidos armazena os dados de instanciação
     */
    public function __construct($dadosRecebidos) {
        $this->dadosRecebidos = $dadosRecebidos;
        $this->setID();
        $this->setnivel();
    }
    
    /**
     * @Descrição: Método executarAtualizacao(), ele utiliza todos os métodos da classe para
     * atualizar confirgurações
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @parametros sem parâmetros
     */
    public function executarAtualizacao(){
        $this->organizarDados();
        $this->localizarEmailNovo();
        if(!$this->vereficarDisponibilidadeEmail()){
            echo "<script>window.location.href = '../View/Configuracoes.php?ERROR'</script>";
        }else{
            $this->atualizarDados();
        }
    }

    /**
     * @Descrição: Método organizarDados(), ele pega os dados da instanciação e trata eles, armazenando
     * os resultados nos atributos  $dadosInsercao e $dadosRecebidos
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @parametros sem parâmetros
     */
    private function organizarDados(){
        $arrayDados1 = explode("|\|R", $this->dadosRecebidos);
        $dadosInsecaoTmp = "";
        $dadosAtualizacaoTmp  = "";
        
        $num = count($arrayDados1) - 1;
        
        for($i = 0; $i < $num; $i++){
            $arrayDados2 = explode("-", $arrayDados1[$i]);
            $dadosInsecaoTmp .= $arrayDados2[0] . ",";
            $dadosAtualizacaoTmp .= $arrayDados2[1] . "|\|R";
        }
        
        $this->dadosInsercao = substr($dadosInsecaoTmp,0,-1);
        $this->dadosAtualizacao = substr($dadosAtualizacaoTmp,0,-4);
    }
    
    /**
     * @Descrição: Setter do atrubuto ID
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @parametros sem parâmetros
     */
    private function setID(){
        $this->ID = $_SESSION["ID_User"];
    }
    
    /**
     * @Descrição: Setter do atrubuto nivel
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @parametros sem parâmetros
     */
    private function setNivel(){
        $this->nivel = $_SESSION["Nivel_User"];
    }
    
    /**
     * @Descrição: Método atualizarDados() que execulta o update dos dados inseridos pelos usuário
     * utilizando o bjeto instanciado da classe Update que se enocntra armazenada no atrubuto update
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @parametros sem parâmetros
     */
    private function atualizarDados(){
        if($this->nivel == "A"){
            $tabela = "Aluno";
        }else if($this->nivel == "P"){
            $tabela = "Professor";
        }
        
        $this->update = new Update($tabela, $this->dadosInsercao, $this->dadosAtualizacao, "ID", $this->ID);
        $this->update->executarQuery();
    }
    
    /**
     * @Descrição: Faz um vereficação de disponibilidade no banco de dados vereficando se o email a ser atualizado
     * ja está cadastrado no banco, pra isso utilizamos também uma função interna do banco ja existe;
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @parametros sem parâmetros
     */
    private function vereficarDisponibilidadeEmail(){
        $funcao = "SELECT disponiblidadeDeEmail('". $this->email ."')";
        $this->read = new Read($funcao, NULL, NULL);
        if($this->read->chamarFuncao()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * @Descrição: Atua praticamente como um setter do atributo email, ele verefica se usuário quer atualizar 
     * o email e armazena esse email no atributo $email para ser usado no método vereficarDisponibilidadeEmail()
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @parametros sem parâmetros
     */
    private function localizarEmailNovo(){
        $array1 = explode(",", $this->dadosInsercao);
        $EmailNum = 1;
        $Email = "";
        
        for($i = 0; $i < count($array1); $i++){
            if($array1[$i] == "Email"){
                $EmailNum = $i;
            }
        }
        if($EmailNum == 0){
            $array2 = explode("|\|R", $this->dadosAtualizacao);
            $Email = $array2[$EmailNum];
        }
        
        $this->email = $Email;
    }
    
    public static function alterarFoto($foto, $x, $y, $h, $w){
        $targ_w = $targ_h = 500;
	$jpeg_quality = 90;
	$src = "../../Temp/" . $foto;
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
        imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
	$targ_w,$targ_h,$w,$h);
        
        ob_start();
	imagejpeg($dst_r,null,$jpeg_quality);
        $conteudoF = ob_get_contents();
        ob_end_clean();
        
        unlink($src);
        
        //Obetendo Dados do usuário
        $ID = $_SESSION['ID_User'];
        $Nivel = $_SESSION['Nivel_User'];
        
        if($Nivel == "A"){
            $read = new Read("Perfil_Aluno", "Aluno_FK", $ID);
            $read->executarQuery();
            $FotoCampo = $read->getResultado();
            $IDFotoCampo = $FotoCampo[0]['ID'];
            
            $update = new Update("Perfil_Aluno", "Imagem", $conteudoF, "ID", $IDFotoCampo);
            $update->executarQuery();
        }else if($Nivel == "P"){
            $read = new Read("Perfil_Professor", "Professor_FK", $ID);
            $read->executarQuery();
            $FotoCampo = $read->getResultado();
            $IDFotoCampo = $FotoCampo[0]['ID'];
            
            $update = new Update("Perfil_Professor", "Imagem", $conteudoF, "ID", $IDFotoCampo);
            $update->executarQuery();
        }
    }
}
