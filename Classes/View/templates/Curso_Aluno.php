<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Curso - Aluno - # <?php echo $User->turma; ?> #</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap-4.1.0-dist/css/bootstrap.css">
        <!-- Pessoal CSS -->
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <link href="css/media_Style.css" rel="stylesheet" type="text/css"/>
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
                        
                        <li class="nav-item menu-user-adpt">
                            <section class="UI-User-Interna row menu-user-adpt">
                                <figure class="ft-User-Drop">
                                    <img src="../Controller/CarregarImagens.php?FotoPerfil" alt="# Foto DO Usuario #"/>
                                </figure>
                                <section class="Usuario-Menu">
                                    <div class="dropdown btn-user-log">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownDoUsuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                           <?php echo $User->nome; ?>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="Configuracoes.php">Configurações</a>
                                            <a class="dropdown-item" href="../Controller/EncerrarLogin.php">Logoff</a>
                                        </div>
                                    </div>
                                    <div class="Turma-Log-Drop">
                                        Turma: <?php echo $User->turma; ?>
                                    </div>
                                </section> 
                            </section>
                        </li>
                    </ul>
                </div>
            </section>
        </nav>
        
        <main class="Principal-Conteudo" style="padding-bottom: 50px;">
            
            <h1 class="titulo-sessoes">Curso de introdução a LIBRAS</h1>
            <div class="container">
                <p class="Curso-descricao">O AVA LibrasOn conta com um curso básico de Libras online e totalmente gratuito. O curso tem como público alvo os ouvintes e apresenta um método simples de introdução à Libras como segunda língua e tem o conteúdo dividido em vídeo-aulas e atividades para fixar o aprendizado do aluno e testar os conhecimentos adquiridos. Os vídeos são disponibilizados pelo Instituto Nacional de Educação de Surdos-o INES- e apresenta os aspectos básicos da língua de sinais brasileira, o histórico da língua de sinais no Brasil, saudações, vídeos sobre família, cores, animais etc., tendo o intuito de despertar o interesse para a aquisição da Libras tanto por professores quanto por alunos de todos os lugares do Brasil. Pensando nisso, o curso apresenta um material didático simples e conciso, tendo todos os vídeos legendados e com áudio para possibilitar um melhor aprendizado.</p>
            </div>
            
            <div class="container">
                <?php
                    $curso = new Curso;
                    $curso->contarModulos();
                    $curso->imprimirModulos();
                ?>
            </div>
            
            
        </main>
        
        <footer>
            <p><span class="Logo-Footer">Libras<span class="Logo-Footer-Cor2">on</span></span> foi criado e desenvolvido por Caio Alexandre Ramos, Micaella Fernandes e Jacileia Nascimento Soares com orientação de Glaucielle Celestina de Sá e Iury Gomes</p>
        </footer>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="bootstrap-4.1.0-dist/jquery-3.3.1.min.js"></script>
        <script src="bootstrap-4.1.0-dist/popper.js"></script>
        <script src="bootstrap-4.1.0-dist/js/bootstrap.js"></script>
    </body>
</html>
