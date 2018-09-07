<?php
/**
 * @project: librason
 * @name: FuncoesExercicio
 * @description: Arquivo que trabalha com a classe Respostas
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.8
 */

// Arquivo loader do projeto
include_once '../../loader.php';

//Verifica se o botão de submeter foi pressionado
if(isset($_REQUEST['ID_SubmeterExercicio'])){
    
    //Instancia classe repostas, prepara as questoes para envio e egistra elas no BD
    $respostas = new Respostas();
    $respostas -> prepararRespostas($_REQUEST);
    $respostas -> registrarResposta();
    
    //Redireciona com uma mensagem de sucesso
    echo "<script>window.location.href = '../View/Curso.php?RepostaUsuarioAoSistema'</script>";
}