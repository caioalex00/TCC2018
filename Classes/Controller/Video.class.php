<?php
/**
 * @project: librason
 * @name: Video
 * @description: Classe que contém as funções dos Vídeo do AVA
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.8
 * @métodos obterDadosVideo()
 */
class Video {
    /** @var int $IDVideo armazena o ID do vídeo que a classe ira trabalhar*/
    private $IDVideo;
    /** @var string $Video vetor que armazena os dados do vídeo*/
    public $Video;
    /** @var int $resultNumVideo a quantidade de resultados obtidos na bsuca pelo vídeo no BD*/
    public $resultNumVideo;
    
    /**
     * @Descrição: Método construtor, coleta o ID do video passado na instaciação
     * e execulta o método obterDadosvideo();
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @param string $IDVideo ID do vídeo
     */
    function __construct($IDVideo) {
        $this->IDVideo = $IDVideo;
        $this->obterDadosVideo();
    }
    
    /**
     * @Descrição: Obtem o Vídeo no BD
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    private function obterDadosVideo(){
        $read =  new Read("Video", "ID", $this->IDVideo);
        $read ->executarQuery();
        $this->Video = $read ->getResultado()[0];
        $this->resultNumVideo =  $read->getQtsResultado();
    }
    
}
