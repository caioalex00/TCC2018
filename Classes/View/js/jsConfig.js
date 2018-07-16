function atvDstFormularios(){
    var emailAlter = document.getElementById('customCheck1');
    var nomeAlter = document.getElementById('customCheck2');
    var senhaAlter = document.getElementById('customCheck4');
    var emailForm = document.getElementById('Email');
    var nomeForm = document.getElementById('Nome');
    
    if(emailAlter.checked === true){
       document.getElementById("caixaEmailAlter").innerHTML = '<input name="AlterEmail" type="email" class="form-control" id="Email" placeholder="Alterar e-mail" value="'+ emailForm.value +'">';
    }else{
       document.getElementById("caixaEmailAlter").innerHTML = '<input name="Email" type="email" disabled="" class="form-control" id="Email" placeholder="Alterar e-mail" value="'+ emailForm.value +'">';
    }
    
    if(nomeAlter.checked === true){
        document.getElementById("caixaNomeAlter").innerHTML = '<input name="AlterNome" type="text" class="form-control" id="Nome" placeholder="Nome do usuário" value="'+ nomeForm.value +'">';
    }else{
        document.getElementById("caixaNomeAlter").innerHTML = '<input name="Nome" disabled="" type="text" class="form-control" id="Nome" placeholder="Nome do usuário" value="'+ nomeForm.value +'">';
    }
    
    if(senhaAlter.checked === true){
        document.getElementById("caixaSenha1Alter").innerHTML = '<input name="AlterSenha1" type="password" class="form-control" id="Senha1" placeholder="Senha" value="">';
        document.getElementById("caixaSenha2Alter").innerHTML = '<input name="AlterSenha2" type="password" class="form-control" id="Senha2" placeholder="Senha de Confirmação" value="">';
    }else{
        document.getElementById("caixaSenha1Alter").innerHTML = '<input name="Senha1" disabled="" type="password" class="form-control" id="Senha1" placeholder="Senha" value="aaaaaaaaaaa">';
        document.getElementById("caixaSenha2Alter").innerHTML = '<input name="Senha2" disabled="" type="password" class="form-control" id="Senha2" placeholder="Senha de Confirmação" value="aaaaaaaaaaa">';
    }
    
    if(emailAlter.checked === true || nomeAlter.checked === true || senhaAlter.checked === true){
        document.getElementById("BotaoAtualizacaoConfig").innerHTML = '<button type="submit" name="AlterarInfs" style="width: 100%;" class="btn btn-cadastro">Confirmar Alterações</button>';
    }else{
         document.getElementById("BotaoAtualizacaoConfig").innerHTML = '<button type="submit" disabled="" name="AlterarInfs" style="width: 100%;" class="btn btn-cadastro">Confirmar Alterações</button>';
    }
}
