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
    //Variavel que contem nome das pastas onde contem classes
    $Pastas = ['Controller','Model','View'];
    
    //Por meio do foreach pecorremos as pastas, vereficando se nelas contem a classe passada
    //no parametro do metodo
    foreach ($Pastas as $Pasta) {
        $Caminho = __DIR__ . "/" . "Classes" . "/" . $Pasta . "/" . $classe . ".php";
        
        if (file_exists($Caminho) && !is_dir($Caminho)){
            include_once $Caminho;
            break;
        }
    }
}
//Essa função cgamara nossa função de loader quando uma classe for instanciada
//Passando como parametro o nome da classe
spl_autoload_register('CarregarClasse');