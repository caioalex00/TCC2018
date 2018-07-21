<?php
/**
 * @project: librason
 * @name: Cadastro
 * @description: Classe que contém as funções de cadastro do AVA
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.4
 * @métodos cadastroAluno(), cadastroProfessor(), validarDadosAluno(), validarDadosProfessor(), vereficarDisponibilidadeEmail(), verificarExistenciaDeTurma(), realizarCadastroAluno(), encriptarSenha(), realizarCadastroProfessor()
 */
class Cadastro {
    /** @var string $nome variavel responsavel por armazenar o nome do usuário para o cadastro */
    private $nome;
    /** @var string $email variavel responsavel por armazenar o e-mail do usuário para o cadastro */
    private $email;
    /** @var string $senha variavel responsavel por armazenar a senha do usuário para o cadastro */
    private $senha;
    /** @var string $turma variavel responsavel por armazenar a senha de comfirmação do usuário para o cadastro */
    private $turma;
    /** @var string $senhaCom variavel responsavel por armazenar a Turma do usuário caso Aluno para o cadastro */
    private $senhaCom;
    /** @var string $ftPerfil variavel responsavel por armazenar a Foto de Perfil do usuário para o cadastro */
    private $ftPerfil;
    /** @var object $read variavel responsavel por armazenar o objeto da função Read do CRUD */
    private $read;
    /** @var object $read1 variavel responsavel por armazenar o objeto da função Read do CRUD */
    private $read1;
    /** @var object $create variavel responsavel por armazenar o objeto da função Create do CRUD */
    private $create;
    /** @var object $create1 variavel responsavel por armazenar o objeto da função Create do CRUD */
    private $create1;
    /** @var string $senhaSegura variavel responsavel por armazenar a senha do usuário em hash para o cadastro */
    private $senhaSegura;
    /** @var int $idGerado variavel responsavel por armazenaro o ID do usuário*/
    private $idGerado;
    
    /**
     * @Descrição: Responsavel por utilizar todas as funções de cadastro do Aluno,
     * para utiliza esse método basta passar os dados necessarios pelos parametros.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @param string $nome armazena o nome do aluno
     * @param string $email armazena o email do aluno
     * @param string $senha armazena a senha do aluno
     * @param string $senhaCom armazena a senha de comfirmação do aluno
     * @param string $foto armazena a foto de perfil do aluno
     * @param string $turma armazena a turma que o aluno pertence
     * @param string $x armazena o eixo x do recorte de foto
     * @param string $y armazena o eixo y do recorte de foto
     * @param string $w armazena a lagura do recorte de foto
     * @param string $h armazena a altura do recorte de foto
     */
    public function cadastroAluno($nome, $email, $senha, $senhaCom, $foto, $turma,$x,$y,$w,$h){
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->senhaCom = $senhaCom;
        $this->ftPerfil = $foto;
        $this->turma = $turma;
        
        $ERRORValidacao = $this->validarDadosAluno();
        if($ERRORValidacao != "ERROR-0"){
            echo "<script>window.location.href = '../View/Pagina_Inicial.php?MSGERR=" . $ERRORValidacao ."'</script>";
        }else{
            $this->encriptarSenha();
            $this->realizarCadastroAluno();
            $this->subirFotoAluno($x,$y,$w,$h);
            echo "<script>window.location.href = '../View/Pagina_Inicial.php?SucessoNoCadastro'</script>";
        }
    }
    
    /**
     * @Descrição: Responsavel por utilizar todas as funções de cadastro do Professor,
     * para utiliza esse método basta passar os dados necessarios pelos parametros.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
     * @param string $nome armazena o nome do professor
     * @param string $email armazena o email do professor
     * @param string $senha armazena a senha do professor
     * @param string $senhaCom armazena a senha de comfirmação do professor
     * @param string $foto armazena a foto de perfil do professor
     * @param string $turma armazena a turma que o aluno pertence
     * @param string $x armazena o eixo x do recorte de foto
     * @param string $y armazena o eixo y do recorte de foto
     * @param string $w armazena a lagura do recorte de foto
     * @param string $h armazena a altura do recorte de foto
     */
    public function cadastroProfessor($nome, $email, $senha, $senhaCom, $foto, $x, $y, $w, $h) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->senhaCom = $senhaCom;
        $this->ftPerfil = $foto;
        
        $ERRORValidacao = $this->validarDadosProfessor();
        if($ERRORValidacao != "ERROR-0"){
            echo "<script>window.location.href = '../View/Pagina_Inicial.php?MSGERRP=" . $ERRORValidacao ."'</script>";
        }else{
            $this->encriptarSenha();
            $this->realizarCadastroProfessor();
            $this->subirFotoProfessor($x,$y,$w,$h);
            echo "<script>window.location.href = '../View/Pagina_Inicial.php?SucessoNoCadastro'</script>";
        }
    }
    
    /**
     * @Descrição: Faz algumas vereficações se os dados a serem inseridos no banco são validos por parte do aluno
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
     * @parametros sem parâmetros
     */
    private function validarDadosAluno(){
        if(empty($this->nome) || empty($this->email) || empty($this->senha) || empty($this->senhaCom) || empty($this->turma) || empty($this->ftPerfil)){
            return "ERROR-Preenchimento-1";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            return "ERROR-Email-1";
        }else if(!$this->vereficarDisponibilidadeEmail()){
            return "ERROR-Email-2";
        }else if(strlen ($this->senha) < 8){
            return "ERROR-Senha-1";
        }else if($this->senha != $this->senhaCom){
            return "ERROR-Senha-2";
        }else if(!$this->verificarExistenciaDeTurma()){
            return "ERROR-Turma-1";
        }else{
            return "ERROR-0";
        }
    }
    
    /**
     * @Descrição: Faz algumas vereficações se os dados a serem inseridos no banco são validos por parte do Professor
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
     * @parametros sem parâmetros
     */
    private function validarDadosProfessor(){
        if(empty($this->nome) || empty($this->email) || empty($this->senha) || empty($this->ftPerfil)){
            return "ERROR-Preenchimento-1";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            return "ERROR-Email-1";
        }else if(!$this->vereficarDisponibilidadeEmail()){
            return "ERROR-Email-2";
        }else if(strlen ($this->senha) < 8){
            return "ERROR-Senha-1";
        }else if($this->senha != $this->senhaCom){
            return "ERROR-Senha-2";
        }else{
            return "ERROR-0";
        }
    }
    
    /**
     * @Descrição: Faz um vereficação de disponibilidade no banco de dados vereficando se o email a ser cadastrado
     * ja está cadastrado no banco, pra isso utilizamos também uma função interna do banco
     * ja existe;
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
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
     * @Descrição: Verefica se a turma inserida pelo aluno existe ou se ela está aberta para receber alunos.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
     * @parametros sem parâmetros
     */
    private function verificarExistenciaDeTurma(){
        $tabela = "Turma";
        $dadosTabela = "COD,Status"; 
        $dadosValues = $this->turma . "," . '1';
        $this->read1 = new Read($tabela, $dadosTabela, $dadosValues);
        $this->read1->executarQuery();
        $this->read1->getResultado();
        
        if($this->read1->getQtsResultado() != 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * @Descrição: Coloca a senha digitada pelo usuario em um hash e armazena
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
     * @parametros sem parâmetros
     */
    private function encriptarSenha(){
        $this->senhaSegura = sha1($this->senha);
    }
    
    /**
     * @Descrição: Realiza o cadastro do usuário no banco por meio do objeto CREAT das funções CRUD
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
     * @parametros sem parâmetros
     */
    private function realizarCadastroAluno(){
        $tabela = "Aluno";
        $dadosTabela = "ID,Nome,Email,Turma_COD_FK,Senha";
        $dadosValues = "null|\|R" . $this->nome . "|\|R" .$this->email . "|\|R" . $this->turma . "|\|R" . $this->senhaSegura;
        $this->create = new Create($tabela, $dadosTabela, $dadosValues);
        $this->create->executarQuery();
        $this->idGerado = $this->create->idGerado;
    }
    
    /**
     * @Descrição: Realiza o cadastro do usuário no banco por meio do objeto CREAT das funções CRUD
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.4 - 25/06/2018
     * @parametros sem parâmetros
     */
    private function realizarCadastroProfessor(){
        $tabela = "professor";
        $dadosTabela = "ID,Nome,Email,Senha";
        $dadosValues = "null|\|R" . $this->nome . "|\|R" .$this->email . "|\|R" . $this->senhaSegura;
        $this->create = new Create($tabela, $dadosTabela, $dadosValues);
        $this->create->executarQuery();
        $this->idGerado = $this->create->idGerado;
    }
    
    /**
     * @Descrição: Esse método recorta a foto de acordo com o que o aluno fez na pagina VIEW
     * CarregarFotoAluno e insere ela no banco de dados em formato Binario em um campo BLOB
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @param string $x armazena o eixo x do recorte de foto
     * @param string $y armazena o eixo y do recorte de foto
     * @param string $w armazena a lagura do recorte de foto
     * @param string $h armazena a altura do recorte de foto
     */
    private function subirFotoAluno($x,$y,$w,$h){
        $targ_w = $targ_h = 500;
	$jpeg_quality = 90;
	$src = "../../Temp/" . $this-> ftPerfil;
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
        imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
	$targ_w,$targ_h,$w,$h);
        
        
        ob_start();
	imagejpeg($dst_r,null,$jpeg_quality);
        $conteudoF = ob_get_contents();
        ob_end_clean();
        
        unlink($src);
        
        $tabela = "Perfil_Aluno";
        $dadosTabela = "ID,Imagem,Aluno_FK";
        $dadosValues = "null|\|R" . $conteudoF . "|\|R" . $this->idGerado;
        $this->create1 = new Create($tabela, $dadosTabela, $dadosValues);
        $this->create1->executarQuery();
    }
    
    /**
     * @Descrição: Esse método recorta a foto de acordo com o que o professor fez na pagina VIEW
     * CarregarFotoProfessor e insere ela no banco de dados em formato Binario em um campo BLOB.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.5 - 15/07/2018
     * @param string $x armazena o eixo x do recorte de foto
     * @param string $y armazena o eixo y do recorte de foto
     * @param string $w armazena a lagura do recorte de foto
     * @param string $h armazena a altura do recorte de foto
     */
    private function subirFotoProfessor($x,$y,$w,$h){
        $targ_w = $targ_h = 500;
	$jpeg_quality = 90;
	$src = "../../Temp/" . $this-> ftPerfil;
	$img_r = imagecreatefromjpeg($src);
	$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
        imagecopyresampled($dst_r,$img_r,0,0,$x,$y,
	$targ_w,$targ_h,$w,$h);
        
        
        ob_start();
	imagejpeg($dst_r,null,$jpeg_quality);
        $conteudoF = ob_get_contents();
        ob_end_clean();
        
        unlink($src);
        
        $tabela = "Perfil_Professor";
        $dadosTabela = "ID,Imagem,Professor_FK";
        $dadosValues = "null|\|R" . $conteudoF . "|\|R" . $this->idGerado;
        $this->create1 = new Create($tabela, $dadosTabela, $dadosValues);
        $this->create1->executarQuery();
    }
}
