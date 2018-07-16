<?php
/**
 * @project: librason
 * @name: MSGErroCadastro
 * @description: Essa classe detecta o erro no cadastro e imiprimi em um alert danger no menu de cadastro
 * este arquivo serve de include
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.5
 */

if(isset($_REQUEST['MSGERR']) || isset($_REQUEST['MSGERRP'])){

?>
<div class="alert alert-danger" role="alert">
<?php
    if(isset($_REQUEST['MSGERR'])){
        $ERROR = $_REQUEST['MSGERR'];
    }else{
        $ERROR = $_REQUEST['MSGERRP'];
    }
    
    if($ERROR == "ERROR-Preenchimento-1"){
        echo "Preencha todos os campos do formulário";
    }else if($ERROR == "ERROR-Email-1"){
        echo "Email inserido incorreto";
    }else if($ERROR == "ERROR-Email-2"){
        echo "Email já consta no sistema";
    }else if($ERROR == "ERROR-Senha-1"){
        echo "Senha com no mínimo 8 caracteres";
    }else if($ERROR == "ERROR-Senha-2"){
        echo "Senhas Incompatíveis";
    }else if($ERROR == "ERROR-Turma-1"){
        echo "Código de Turma Incorreto";
    }
?>
    
</div>

<?php
}