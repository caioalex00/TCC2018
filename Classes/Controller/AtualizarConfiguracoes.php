<?php
/**
 * @project: librason
 * @name: AtualizarConfigurações
 * @description: este arquivo trabalha com com a Classe ConfiguraçõesUsuario para atualizar/modificar dados
 * dos usuários casos eles desejem.
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.5
 */
include_once '../../loader.php';

//So ativamos o Código caso o usuário tenha pressionado o botão de atualização do cadastro
if(isset($_REQUEST['AlterarInfs'])){
    
    $param1 = "";
    
    //Daqui para frente fazemos uma breve validação de dados antes de inserilos na classe de configuração
    
    //Validação do Email
    if(isset($_REQUEST['AlterEmail'])){
        $param1 .= "Email-" . $_REQUEST['AlterEmail'] . "|\|R";
        if(empty($_REQUEST['AlterEmail'])){
            echo "<script>window.location.href = '../View/Configuracoes.php?ERROR'</script>";
        }else if(!filter_var($_REQUEST['AlterEmail'], FILTER_VALIDATE_EMAIL)){
            echo "<script>window.location.href = '../View/Configuracoes.php?ERROR'</script>";
        }
    }
    
    //Validação do Nome do usuário
    if(isset($_REQUEST['AlterNome'])){
        $param1 .= "Nome-" . $_REQUEST['AlterNome'] . "|\|R";
        if(empty($_REQUEST['AlterNome'])){
            echo "<script>window.location.href = '../View/Configuracoes.php?ERROR'</script>";
        }
    }
    
    //Validações de alteração de senha
    if(isset($_REQUEST['AlterSenha1']) && isset($_REQUEST['AlterSenha2'])){
        if($_REQUEST['AlterSenha1'] == $_REQUEST['AlterSenha2'] && strlen($_REQUEST['AlterSenha1']) >= 8){
            $SenhaEncript = sha1($_REQUEST['AlterSenha1']);
            $param1 .= "Senha-" . $SenhaEncript . "|\|R";
        }else{
            echo "<script>window.location.href = '../View/Configuracoes.php?ERROR'</script>";
        }
    }
    
    // Aqui atualizamos as informações do usuario no banco
    $Atualizar = new ConfiguracoesUsuario($param1);
    $Atualizar->executarAtualizacao();
    echo "<script>window.location.href = '../View/Configuracoes.php?Sucesso'</script>";
}else if(isset ($_REQUEST['AtualizarFotoConfig'])){
    //Aqui fica o codico que atualiza a foto trabalhando com o método estatico alterarFoto() da classe ConfiguracoesUsuario
    $x = $_REQUEST['x'];
    $y = $_REQUEST['y'];
    $h = $_REQUEST['h'];
    $w = $_REQUEST['w'];
    $foto = $_SESSION['tmpFotoCadastroCaminho'];
    unset($_SESSION['tmpFotoCadastroCaminho']);
    ConfiguracoesUsuario::alterarFoto($foto, $x, $y, $h, $w);
    echo "<script>window.location.href = '../View/Configuracoes.php?SucessoFoto'</script>";
}else{
    //Caso o acesso não seja autorizado retornamos com uma mensagem de ERRO
    echo "<script>window.location.href = '../View/Pagina_Inicial.php?Error-Autorizacao</script>";
}