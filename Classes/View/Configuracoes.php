<?php 
/**
 * @project: librason
 * @name: Configuracoes
 * @description: Nesse arquivo a é feito uma verificação de nível de usuário, vereficando se ele é aluno ou professor
 * para exibir a pagina de acordo com seu previlegio, nela tambem detectamos os usuario é armazernamos ele em um objeto
 * para uso de seus dados básico pela página
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.5
 */
require_once '../../loader.php';

if(isset($_SESSION['Nivel_User'])){
    
    $ID = $_SESSION['ID_User'];
    $Nivel = $_SESSION['Nivel_User'];
    $User = new Usuario($ID, $Nivel);

    if($_SESSION['Nivel_User'] == "A"){
        include_once './templates/Configuracoes_Aluno.php';
    }else if($_SESSION['Nivel_User'] == "P"){
        include_once './templates/Configuracoes_Professor.php';
    }
    
} else {
    echo '<script> window.location.href = "Pagina_Inicial.php";</script>';
}
