<?php
// Carregamento Automatico de Classes

function CarregarClasse($classe){
    $Pastas = ['Controller','Model','View'];
    
    foreach ($Pastas as $Pasta) {
        $Caminho = __DIR__ . "/" . "Classes" . "/" . $Pasta . "/" . $classe . ".php";
        
        if (file_exists($Caminho) && !is_dir($Caminho)){
            include_once $Caminho;
            break;
        }
    }
}
spl_autoload_register('CarregarClasse');
