<?php
/**
 * @project: librason
 * @name: Respostas
 * @description: Classe que contém as funções de Login do AVA
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.8
 * @métodos prepararRespostas(), registrarResposta(), coletarDadosNecessarios(), enviarResposta()
 */
class Respostas {
    /** @var string $dadosRespostaID vetor que armazena os Indices do array de respostas que são os ID da questão*/
    private $dadosRespostaID;
    /** @var string $dadosResposta vetor que armazena as respostas */
    private $dadosResposta;
    /** @var int $IDUsuario armazena o ID do usuário que trabalhara o BD */
    private $IDUsuario;
    
    /**
     * @Descrição: Nesse método é pego o array que vem do $_Request e trablaha para pegar os IDs que estão no Indice
     * e pegar as repostas que estão dentro do array
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @param string $arrayRequest armazena o $_REQUEST do formulario de envio do exercicio
     */
    public function prepararRespostas($arrayRequest){
        $dadosRespostaForm = $arrayRequest;
        $dadosImplode = implode("", array_keys($dadosRespostaForm));
        $dadosRespostaIDForm = explode("ID_", $dadosImplode);
        
        unset($dadosRespostaIDForm[0]);
        
        //$dadosRespostaID;
        //$dadosResposta;
    
        foreach ($dadosRespostaForm as $value) {
            if($value != 'btnenviar'){
                $dadosResposta[] = $value;
            }
        }

        foreach ($dadosRespostaIDForm as $value) {
            if($value != "SubmeterExercicio" ){
                $dadosRespostaID[] = $value;
            }
        }
        
        $this->dadosResposta = $dadosResposta;
        $this->dadosRespostaID = $dadosRespostaID;
        
    }
    
    /**
     * @Descrição: Execulta os metodos coletarDadosNecessarios() e enviarResposta dessa classe
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    public function registrarResposta(){
        $this->coletarDadosNecessarios();
        $this->enviarResposta();
    }
    
    /**
     * @Descrição: Coleta o $ID do usuário
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    private function coletarDadosNecessarios(){
        $this->IDUsuario = $_SESSION['ID_User'];
    }
    
    /**
     * @Descrição: registra a reposta no banco de dados
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    private function enviarResposta(){
        $num = count($this->dadosRespostaID);
        
        for($i = 0; $i < $num; $i++){
            $create = new Create("Respostas", "ID,Texto_Resposta,Questoes_FK,Aluno_FK", "null|\|R" . $this->dadosResposta[$i] . "|\|R" . $this->dadosRespostaID[$i] . "|\|R" . $this->IDUsuario);
            $create ->executarQuery();
        }
        
    }
    
}
