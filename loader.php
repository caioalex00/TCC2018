<?php

/**
 * @project: librason
 * @name: loader 
 * @description: realiza o carregamento automatico de classes
 * @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.2
 * @métodos CarregarClasse()
 */


/**
* @Descrição: Armazena os valores necessarios na instanciação e executa o 
* metodo construct da Classe herdada Conexao
* @copyright (c) 10/02/2018, Caio Alexandre de Sousa Ramos
* @versao 0.2 - 10/03/2018
* @param string $classe armazena o nome da classe obtida no spl_autoload_register() para fazer o include dela
*/
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
