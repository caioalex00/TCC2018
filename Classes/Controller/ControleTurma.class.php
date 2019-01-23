<?php
/**
 * @project: librason
 * @name: ControleTurma
 * @description: Aqui fica localizado varios metódos que serão utilizados pelo professor para gerenciar a 
 * sua turma.
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.6
 */
class ControleTurma {
    /** @var string $ID_Professor variavel responsavel por armazenar o ID do professor do banco de dados para vereficações */
    private $ID_Professor;
    /** @var int $qtsTurma variavel responsavel por armazenar a quantidade de turmas que o professor tem */
    private $qtsTurmas;
    /** @var string $TurmasCadastradas variavel responsavel por armazenar informações de uma turma a ser consultada no banco */
    private $TurmasCadastradas;
    /** @var string $qtsTurmasAtivasvariavel responsavel por armazenar a quantidade de turmas ativas do professor */
    private $qtsTurmasAtivas;
    
    /**
     * @Descrição: Método construtor da classe, nele armazenamos os dados de instanciação
     * e nele chamamos os setters que pegam o ID_Professor que vai usar a classe, setamos a quantidade de turmas
     * que ele tem e quantas turmas ativas ele tem.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    public function __construct() {
        $this->setID_Professor();
        $this->setQtsTurmas();
        $this->setQtsTurmasAtivas();
    }
    
    /**
     * @Descrição: Método chamado para realizar a criação da turma.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    public function criarTurma(){
        $COD = $this->gerarCodigoUnico();
        $dadosValues = $COD . "|\|R" . $this->ID_Professor . "|\|R" . "1";
        $create = new Create("Turma", "COD,Professor_ID_FK,Status", $dadosValues);
        $create->executarQuery();
        echo "<script>window.location.href = '../View/Turmas.php?NovaTurmaCriada=" . $COD ."'</script>";
    }
    
    /**
     * @Descrição: Esse método verefica se o professor que está tentando acessar alguma pagina de controle de turma
     * realmente é o administardor dela.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @param string $turma passamos a turma a ser vereficada o acesso.
     */
    public function vereficarAutorizacaoDeAcesso($turma){
        $tabela = "Turma";
        $dadosTabela = "COD, Professor_ID_FK";
        $dadosValues = $turma . "," . $this->ID_Professor;
        $read = new Read($tabela, $dadosTabela, $dadosValues);
        $read->executarQuery();
        $resultado = $read->getQtsResultado();
        
        if($resultado == 0){
            return FALSE;
        }else if($resultado == 1){
            return TRUE;
        }
    }
    
    /**
     * @Descrição: Esse método retorna todos o alunos pertecentes a uma turma que é passada pelo parametro
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @param string $turma passamos a turma para ser retornada os alunos dela.
     */
    public function detectarAlunosTurma($turma) {
        $read = new Read("Alunos_Turma", "Turma_COD_FK", $turma);
        $read ->executarQuery();
        return $read->getResultado();
    }
    
    /**
     * @Descrição: Esse método retorna os dados de uma turma.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @param string $turma passamos a turma para ser retornada os dados dela.
     */
    public function checarStatusTurma($turma) {
        $read = new Read("Turma", "COD", $turma);
        $read ->executarQuery();
        return $read->getResultado();
    }
    
    /**
     * @Descrição: Esse método muda o status da turma caso solicitado fazendo as vereficações necessarias.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @param string $turma passamos a turma a ser alterado o status.
     * @param string $condicao passamos o valor de alteração desejado.
     */
    public function mudarStatusTurma($turma, $condicao) {
        if($condicao == "false"){
           $condicaoA = 0;  
        }else if($this->qtsTurmasAtivas < 6){
            $condicaoA = 1;
        }else{
            $condicaoA = 0;
        }
        if($this->vereficarAutorizacaoDeAcesso($turma)){
            $update = new Update("Turma", "Status", $condicaoA, "COD", $turma);
            $update->executarQuery();
        }
    }
    
    /**
     * @Descrição: Esse método retorna uma letra de acordo com o número passado a ele, esse número de ser de 1 a 26
     * pois cada um representa uma letra do alfabeto.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @param string $COD passamos o numero para obter a letra desejada.
     */
    private function detectarLetra($COD){
        if($COD == 1){
            return "A";
        }else if($COD == 2){
            return "B";
        }else if($COD == 3){
            return "C";
        }else if($COD == 4){
            return "D";
        }else if($COD == 5){
            return "E";
        }else if($COD == 6){
            return "F";
        }else if($COD == 7){
            return "G";
        }else if($COD == 8){
            return "H";
        }else if($COD == 9){
            return "I";
        }else if($COD == 10){
            return "J";
        }else if($COD == 11){
            return "K";
        }else if($COD == 12){
            return "L";
        }else if($COD == 13){
            return "M";
        }else if($COD == 14){
            return "N";
        }else if($COD == 15){
            return "O";
        }else if($COD == 16){
            return "P";
        }else if($COD == 17){
            return "Q";
        }else if($COD == 18){
            return "R";
        }else if($COD == 19){
            return "S";
        }else if($COD == 20){
            return "T";
        }else if($COD == 21){
            return "U";
        }else if($COD == 22){
            return "V";
        }else if($COD == 23){
            return "W";
        }else if($COD == 24){
            return "X";
        }else if($COD == 25){
            return "Y";
        }else{
            return "Z";
        }
    }
    
    
    /**
     * @Descrição: Nesse método geramos um código, o codigo e feito de varios numero, mas os 3 primeiros e ultimos
     * são trocados por letras usando o método detectarLetra();
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    private function gerarCodigo(){
        $V1 = $this->detectarLetra(rand(1, 26));
        $V2 = $this->detectarLetra(rand(1, 26));
        $V3 = $this->detectarLetra(rand(1, 26));
        $V4 = rand(1, 9);
        $V5 = rand(1, 9);
        $V6 = rand(1, 9);
        $V7 = rand(1, 9);
        $V8 = $this->detectarLetra(rand(1, 26));
        $V9 = $this->detectarLetra(rand(1, 26));
        $V10 = $this->detectarLetra(rand(1, 26));
        
        $COD = "";
        $COD = $V1 . $V2 . $V3 . $V4 . $V5 . $V6 . $V7 . $V8 . $V9 . $V10; 
        return $COD;
    }
    
    /**
     * @Descrição: Esse método retornamos o valor retornado do metodo gerarCodigo, mas vereficando se o codigo ja existe no banco,
     * caso exista ele ira gerar outro código.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    private function gerarCodigoUnico(){
        $CDUnicoCondicao = TRUE;
        $CDUnico = "";
        
        while ($CDUnicoCondicao){
            $CDUnico = $this->gerarCodigo();
            $funcao = "SELECT disponiblidadeDeTurma('" . $CDUnico . "')";
            $read = new Read($funcao, null, null);
            $read->chamarFuncao();
            $resultado = $read->getResultado();
            if($resultado[0][0]){
                $CDUnicoCondicao = FALSE;
            }
        }
            
        return $CDUnico;
    }
    
    /**
     * @Descrição: Esse método armazena as turmas pertecentes ao professor.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    private function detectarTurmas(){
        $read = new Read("Turma", "Professor_ID_FK", $this->ID_Professor);
        $read->executarQuery();
        $this->TurmasCadastradas = $read->getResultado();
    }
    
    /**
     * @Descrição: setter do atributo ID_Professor;
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    private function setID_Professor() {
        $this->ID_Professor = $_SESSION['ID_User'];
    }
    
    /**
     * @Descrição: setter do atributo QtsTurmas.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    private function setQtsTurmas() {
        $funcao = "SELECT qtsDeTurmasProfessor(" . $this->ID_Professor .")";
        $read = new Read($funcao, null, null);
        $read->chamarFuncao();
        $this->qtsTurmas = $read->getResultado()[0][0];
    }
    
    /**
     * @Descrição: setter do atributo QtsTurmasAtivas.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    private function setQtsTurmasAtivas() {
        $funcao = "SELECT qtsDeTurmasProfessorAtivas(" . $this->ID_Professor .")";
        $read = new Read($funcao, null, null);
        $read->chamarFuncao();
        $this->qtsTurmasAtivas = $read->getResultado()[0][0];
    }
    
    /**
     * @Descrição: get do atributo TurmasCadastradas.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    public function getTurmasCadastradas() {
        $this->detectarTurmas();
        return $this->TurmasCadastradas;
    }
    
    /**
     * @Descrição: get do atributo QtsTurmas.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    public function getQtsTurmas() {
        return $this->qtsTurmas;
    }
    
    /**
     * @Descrição: get do atributo QtsTurmasAtivas.
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.6 - 21/07/2018
     * @parametros sem parametros.
     */
    function getQtsTurmasAtivas() {
        return $this->qtsTurmasAtivas;
    }


}
