<?php
/**
 * @project: librason
 * @name: CarregarImagens
 * @description: Essa classe trablha com a impressão de imagens
 * dos usuários casos eles desejem.
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.5
 */

include_once '../../loader.php';

// Aqui imprimi a foto de perfil cadastrada caso solicitado
if(isset($_REQUEST['FotoPerfil'])){
    $ID = $_SESSION['ID_User'];
    $Nivel = $_SESSION['Nivel_User'];
    
    $User = new Usuario($ID, $Nivel);
    $User->imprimirFotoPerfil();
}

// Aqui imprimi a foto de perfil a ser cadastrada caso solicitado
if(isset($_REQUEST['FotoPerfilConfig'])){
    Header( "Content-type: image/gif");
    echo $_SESSION['tmpFotoCadastro'];
}