<?php
/**
 * @project: librason
 * @name: CarregarFotoAluno
 * @description: Nesse arquivo tratamos a foto de perfil do usuário, fazemos o upload dela mudando o tamanho dela para
 * 500px de largura e depois disponibilizamos para usuário fazer o corte da área desejada, o corte é feito via JavaScript
 * pelo pacote Jcrop de corte de imagens, todo esse código trabalha somente com a foto de perfil do professor.
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.5
 */
// Codigo que recebara dados e carregara fotos;
include_once '../../loader.php';
if(isset($_REQUEST['Cadastrar-P'])){
    
    //Coletando Informações para o Cadastro do Aluno
    $nomeCompleto = $_REQUEST['Nome-Formulario'];
    $email = $_REQUEST['Email-Formulario'];
    $senha = $_REQUEST['Senha-Formulario'];
    $senhaComfirmacao = $_REQUEST['ComSenha-Formulario'];
    $fotoDePerfil = $_FILES['Foto-Formulario'];
    
    // Congurações de Foto
    $foto = $_FILES['Foto-Formulario']['tmp_name'];
    $conteudoF = file_get_contents($foto);
    $_SESSION['tmpFotoCadastro'] = $conteudoF;
    
    $fotoPerfil = $_FILES['Foto-Formulario'];
    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $fotoPerfil["name"], $ext);
    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
    $caminho_imagem = "../../Temp/". $nome_imagem;
    move_uploaded_file($fotoPerfil["tmp_name"], $caminho_imagem);
    $_SESSION['tmpFotoCadastroCaminho'] = $nome_imagem;
    
   // O arquivo. Dependendo da configuração do PHP pode ser uma URL.
   $filename = '../../Temp/' . $nome_imagem;
   $height = 500;

   // Obtendo o tamanho original
   list($width_orig, $height_orig) = getimagesize($filename);

   // Calculando a proporção
   $ratio_orig = $width_orig/$height_orig;

   $width = $height*$ratio_orig;

   // O resize propriamente dito. Na verdade, estamos gerando uma nova imagem.
   $image_p = imagecreatetruecolor($width, $height);
   $image = imagecreatefromjpeg($filename);
   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

   //Salvando a imagem em arquivo:
   unlink($filename);
   imagejpeg($image_p, $filename, 75);
}else if(isset($_REQUEST['AtualizarFoto'])){
    // Congurações de Foto
    $foto = $_FILES['Foto-Formulario']['tmp_name'];
    $conteudoF = file_get_contents($foto);
    $_SESSION['tmpFotoCadastro'] = $conteudoF;
    
    $fotoPerfil = $_FILES['Foto-Formulario'];
    preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $fotoPerfil["name"], $ext);
    $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
    $caminho_imagem = "../../Temp/". $nome_imagem;
    move_uploaded_file($fotoPerfil["tmp_name"], $caminho_imagem);
    $_SESSION['tmpFotoCadastroCaminho'] = $nome_imagem;
    
    // O arquivo. Dependendo da configuração do PHP pode ser uma URL.
   $filename = '../../Temp/' . $nome_imagem;
   $height = 500;

   // Obtendo o tamanho original
   list($width_orig, $height_orig) = getimagesize($filename);

   // Calculando a proporção
   $ratio_orig = $width_orig/$height_orig;

   $width = $height*$ratio_orig;

   // O resize propriamente dito. Na verdade, estamos gerando uma nova imagem.
   $image_p = imagecreatetruecolor($width, $height);
   $image = imagecreatefromjpeg($filename);
   imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);

   //Salvando a imagem em arquivo:
   unlink($filename);
   imagejpeg($image_p, $filename, 75);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastro - Foto</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap-4.1.0-dist/css/bootstrap.css">
        <!-- Pessoal CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/media_Style.css" rel="stylesheet" type="text/css"/>
        <link href="tapmodo-Jcrop-1902fbc/css/jquery.Jcrop.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        
        <nav class="navbar navbar-expand-md navbar-light Borda-Bottom-Cor2">
            <section class="container">

                <a href="../../index.php" class="navbar-brand h1 mb-0">
                    <img class="Logo-Nav" src="imgs/logotipo.png" alt="Lbrason Logotipo"/>
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#MenuPaginaPrincipal" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="MenuPaginaPrincipal">

                    <ul class="navbar-nav ml-auto Persona-Link Persona-Link-Cor1">

                        <li class="nav-item">
                            <a href="../../index.php" class="nav-link Persona-Link-Cor1">Inicio</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="Curso.php" class="nav-link Persona-Link-Cor1">Curso</a>
                        </li>

                        <li class="nav-item">
                            <a href="Surdo.php" class="nav-link Persona-Link-Cor1">Surdo</a>
                        </li>

                        <li class="nav-item">
                            <a href="Libras.php" class="nav-link Persona-Link-Cor1">Libras</a>
                        </li>
                        
                    </ul>
                </div>
            </section>
        </nav>
        
        <main class="Principal-Conteudo" style="padding-bottom: 50px;">
            
            <h1 id="tituloFG" class="titulo-sessoes">Configurar Foto de Perfil</h1>
            <center>
                <figure class="FotoConfigracaoCadast">
                    <img src="../Controller/CarregarImagens.php?FotoPerfilConfig" id="cropbox" alt=""/>
                </figure> 
            </center>
            <?php
                if(isset($_REQUEST['Cadastrar-P'])){
            ?>
            <form action="../Controller/CadastrarUsuario.php" method="post" onsubmit="return checkCoords();">
                <input type="hidden" id="Nome" name="Nome-Formulario" value="<?php echo $nomeCompleto ?>"/>
                <input type="hidden" id="Email" name="Email-Formulario" value="<?php echo $email ?>"/>
                <input type="hidden" id="Senha" name="Senha-Formulario" value="<?php echo $senha ?>"/>
                <input type="hidden" id="SenhaC" name="ComSenha-Formulario" value="<?php echo $senhaComfirmacao ?>"/>
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <center><button name="Cadastrar-P" type="submit" class="btn btn-cadastro" style="width: 500px" value="Crop Image">Finalizar o cadastro</button></center>
            </form>
            <?php } ?>
            
            <?php
                if(isset($_REQUEST['AtualizarFoto'])){
            ?>
            <form action="../Controller/AtualizarConfiguracoes.php" method="post" onsubmit="return checkCoords();">
                <input type="hidden" id="x" name="x" />
                <input type="hidden" id="y" name="y" />
                <input type="hidden" id="w" name="w" />
                <input type="hidden" id="h" name="h" />
                <center><button name="AtualizarFotoConfig" type="submit" class="btn btn-cadastro" style="width: 500px" value="Crop Image">Finalizar o cadastro</button></center>
            </form>
            <?php } ?>
            
            
        </main>
        
        <footer>
            <p><span class="Logo-Footer">Libras<span class="Logo-Footer-Cor2">on</span></span> foi criado e desenvolvido por Caio Alexandre Ramos, Micaella Fernandes e Jacileia Nascimento Soares com orientação de Glaucielle Celestina de Sá e Iury Gomes</p>
        </footer>
        <!-- Obrigatorio JavaScript -->
        <script src="js/jsConfig.js"></script>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="bootstrap-4.1.0-dist/jquery-3.3.1.min.js"></script>
        <script src="bootstrap-4.1.0-dist/popper.js"></script>
        <script src="bootstrap-4.1.0-dist/js/bootstrap.js"></script>
        <script src="tapmodo-Jcrop-1902fbc/js/jquery.Jcrop.js"></script>
        <script src="tapmodo-Jcrop-1902fbc/js/jquery.Jcrop.min.js"></script>
        <script language="Javascript">
 
            $(function(){
 
                $('#cropbox').Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords,
                });
 
            });
 
            function updateCoords(c)
            {
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
            };
 
            function checkCoords()
            {
                if (parseInt($('#w').val())) return true;
                alert('Selecione a região para recortar.');
                return false;
            };
 
        </script>
    </body>
</html>
