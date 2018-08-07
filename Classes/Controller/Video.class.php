<?php
class Video {
    private $IDVideo;
    public $Video;
    public $resultNumVideo;
    
    function __construct($IDVideo) {
        $this->IDVideo = $IDVideo;
        $this->obterDadosVideo();
    }
    
    private function obterDadosVideo(){
        $read =  new Read("Video", "ID", $this->IDVideo);
        $read ->executarQuery();
        $this->Video = $read ->getResultado()[0];
        $this->resultNumVideo =  $read->getQtsResultado();
    }
    
}
