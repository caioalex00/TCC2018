<?php
/**
 * @project: librason
 * @name: Exercicio
 * @description: Classe que contém todaa as funções ligadas aos Exercicíos
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.8
 * @métodos localizarExercicio(), localizarQuestoes(), localizarQuestoesASS(), imprimirQuestoes(), vereficarExercicioRespondido(), vereficarQuestaoRespondida(), imprimirQuestaoRespondida()
 */
class Exercicio {
    /** @var int $IDExercicio guarda o ID do exercicio que a classe trabalhara */
    private $IDExercicio;
    /** @var string $Exercicio guarda as informações do exercicio solicitado */
    public  $Execicio;
    /** @var string $Questoes guarda as questões do exercicio correpodente com indice numerico */
    private $Questoes;
    /** @var string $QuestoesSP guarda as questões do exercicio correpodente com indice copm nome das colunas do BD */
    private $QuestoesSP;
    /** @var boolean $ParametroRespondido apenas guarda um valor de boorleano para o metodo imprimirBotaoEnvio() trabalhar*/
    private $ParametroRespondido;
    
    /**
     * @Descrição: método construtor da classe
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @param string $IDExercicio armazena o ID do exercicio que a classe trabalhara
     */
    public function __construct($IDExercicio) {
        $this->IDExercicio = $IDExercicio;
    }
    
    /**
     * @Descrição: Encontra o exercicio correspodente no BD e armazena suas informações no atrubuto $Exercicio
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    public function localizarExercicio(){
        $read = new Read("Exercicio", "ID", $this->IDExercicio);
        $read->executarQuery();
        $this->Execicio = $read->getResultado()[0];
    }
    
    /**
     * @Descrição: Encontra as questões do exercicio que o objeto está trabalhando por meio de chamada de função usando um SP para obeter indice numerico
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    private function localizarQuestoes(){
        $read = new Read("call QuestoesExercicio($this->IDExercicio);", null, null);
        $read -> chamarFuncao();
        $this->Questoes = $read->getResultado();
    }
    
    /**
     * @Descrição: Encontra as questões do exercicio que o objeto está trabalhando
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    private function localizarQuestoesASS(){
        $read = new Read("call QuestoesExercicio($this->IDExercicio);", null, null);
        $read -> chamarSP();
        $this->QuestoesSP = $read->getResultado();
    }
    
    /**
     * @Descrição: Realiza a impressão do formulario de resposta do exercicio com as qiestões
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    public function imprimirQuestoes(){
        $this->localizarQuestoes();
        $this->localizarQuestoesASS();
        $num = count($this->Questoes) + 1;
        
        for($i = 1; $i < $num; $i++){
            ?>
            <section class="Atividade-Interace">
                <p><?php echo $i . ". " . $this->Questoes[$i - 1][2]?></p>
                <section class="area-perguntas">
                    <?php if(!empty($this->QuestoesSP[$i - 1]['Foto'])){ ?>
                    <figure class="FotoQuestao">
                        <center>
                            <img alt="" src="imgs_tarefa/<?php print_r($this->QuestoesSP[$i - 1]['Foto']) ?>">
                        </center>
                    </figure>
                    <?php } ?>
                    <?php
                    $alternativas = $this->Questoes[$i - 1];
                    $Letras =  array("A","B","C","D","E");
                    for ($l = 3; $l < 8;$l++) {
                        if($this->vereficarExercicioRespondido($this->QuestoesSP[$i - 1]['ID'])){
                            $this->imprimirQuestaoRespondida($l, $alternativas, $Letras, $i);
                        }else if($alternativas[$l]){  
                            $this->imprimirQuestaoNaoRespondida($l, $alternativas, $Letras, $i);
                        }} ?>
                </section>
            </section>
                    <?php
        }
    }
    /**
     * @Descrição: Verefica se um exercicio por meio da questão nele foi respondido
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @param string $IDQuestao Contem o ID da questão do exercicio a ser vereficado
     */
    private function vereficarExercicioRespondido($IDQuestao){
        $ID_U = $_SESSION['ID_User'];
        $ID_Q = $IDQuestao;
        $read = new Read("call vereficarResposta($ID_U, $ID_Q)",null,null);
        $read->chamarSP();
        
        if($read->getQtsResultado() != 0){
            $this->ParametroRespondido = TRUE;
            return TRUE;
        }else{
            $this->ParametroRespondido = FALSE;
            return FALSE;
        }
    }
    
    /**
     * @Descrição: Verefica qual a resposta da questão pelo usuário
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    private function vereficarQuestaoRespondida($IDQuestao, $alternativa){
        $ID_U = $_SESSION['ID_User'];
        $ID_Q = $IDQuestao;
        $read = new Read("call vereficarResposta($ID_U, $ID_Q)",null,null);
        $read->chamarSP();
        $resposta = $read->getResultado()[0]['Texto_Resposta'];
        
        if($resposta == $alternativa){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /**
     * @Descrição: Imprime o input com a questão marcada sinalizando que o usuario a respondeu
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    private function imprimirQuestaoRespondida($l, $alternativas, $Letras, $i){
        $qrespodinda = $this->vereficarQuestaoRespondida($this->QuestoesSP[$i - 1]['ID'], $alternativas[$l]);
        
        if($alternativas[$l]){ ?>
            <div class="custom-control custom-radio">
                <input name="ID_<?php print_r($this->QuestoesSP[$i - 1]['ID']); ?>" type="radio" id="questao<?php echo $l - 3?>_<?php echo $i ?>" name="customRadio" class="custom-control-input" value="<?php echo $alternativas[$l] ?>" required="" disabled="" <?php if($qrespodinda){ echo 'checked=""'; }?>>
                <label class="custom-control-label" for="questao<?php echo $l - 3?>_<?php echo $i ?>"><?php echo $Letras[$l - 3] ?>) <?php echo $alternativas[$l] ?></label>
            </div>
        <?php }
    }
    
    /**
     * @Descrição: Impre o input do caso do usuário não ter respondido a tarefa ainda
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    private function imprimirQuestaoNaoRespondida($l, $alternativas, $Letras, $i){
        if($alternativas[$l]){ ?>
            <div class="custom-control custom-radio">
                <input name="ID_<?php print_r($this->QuestoesSP[$i - 1]['ID']); ?>" type="radio" id="questao<?php echo $l - 3?>_<?php echo $i ?>" name="customRadio" class="custom-control-input" value="<?php echo $alternativas[$l] ?>" required="">
                <label class="custom-control-label" for="questao<?php echo $l - 3?>_<?php echo $i ?>"><?php echo $Letras[$l - 3] ?>) <?php echo $alternativas[$l] ?></label>
            </div>
        <?php }
    }
    
    /**
     * @Descrição: Imprime botão de envio do exercicio
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    public function imprimirBotaoEnvio(){
        if(!$this->ParametroRespondido){
            ?>
            <button class="btn btn-curso-modulo-interno-atv" name="ID_SubmeterExercicio" value="btnenviar" type="submit" style="width: 90%;">Registrar Respostas</button>
            <?php
        }
    }
    
}
