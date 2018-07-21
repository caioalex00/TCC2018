<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Painel de Controle de Turmas - Professor - Turma: # <?php echo $_REQUEST['TurmaAplicada']?> #</title>
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
                                            <a class="dropdown-item" href="../View/Configuracoes.php">Configurações</a>
                                            <a class="dropdown-item" href="../Controller/EncerrarLogin.php">Logoff</a>
                                        </div>
                                    </div>
                                    <div class="Turma-Log-Drop">
                                        Professor
                                    </div>
                                </section> 
                            </section>
                        </li>
                    </ul>
                </div>
            </section>
        </nav>
        
        <main class="Principal-Conteudo">
            <div class="container">
                <h1 class="titulo-sessoes">Painel de Controle da Turma <strong style="color: #ff3229"><?php echo $_REQUEST['TurmaAplicada']?></strong></h1>
                
                <section class="Ajuda-E-Controle-Turma col-12 row">
                    
                    <section class="col-md-4 Turma-Controle-Status row">
                        <?php
                        include_once '../../loader.php';
                        $turma = new ControleTurma();
                        $numPlm = $turma->getQtsTurmasAtivas();
                        $Status = $turma->checarStatusTurma($_REQUEST['TurmaAplicada'])[0]['Status'];
                        if($numPlm >= 6 && $Status == FALSE){
                        ?>
                        <p class="texto-controle" id="TextoDesAtivStatus">Status da turma: <span style="color: #ff3229;">Desativada</span></p>
                            <center>
                                <label class="switch">
                                    <input type="checkbox" id="CheckBoxStatus" disabled="" >
                                    <span class="slider round"></span>
                                </label>
                            </center>
                        <?php
                        }else if($Status){
                        ?>
                        <p class="texto-controle" id="TextoDesAtivStatus">Status da turma: <span style="color: #00cc33;">Ativada</span></p>
                            <center>
                                <label class="switch">
                                    <input type="checkbox" checked="" id="CheckBoxStatus" onclick="AtivarOuDesativarTurma()" >
                                    <span class="slider round"></span>
                                </label>
                            </center>
                        <?php }else{ ?>
                            <p class="texto-controle" id="TextoDesAtivStatus">Status da turma: <span style="color: #ff3229;">Desativada</span></p>
                            <center>
                                <label class="switch">
                                    <input type="checkbox" id="CheckBoxStatus" onclick="AtivarOuDesativarTurma()">
                                    <span class="slider round"></span>
                                </label>
                            </center>
                        <?php } ?>
                    </section>
                        
                    <section class="col-md-1"></section>
                    
                    <section class="col-md-7 Turma-Controle-Status row" style="padding: 0;">
                        <p class="texto-controle col-md-5" style="padding: 0; text-align: center;margin-right: 0">Ajuda e Opções da Turma: </p>
                        <div class="col-md-2" style="padding: 0;">
                            <button style="width: 90%; margin: 11px auto;" type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="bottom" data-content="O Status da turma se refere a entrada de alunos na turma, com ele desativado alunos são impossiblitados de entrarem na turma, caso você não consiga ativar uma turma, isso se deve ao fato de ja ter 6 turmas ativas, desative uma para ativar essa.">Status</button>
                        </div>
                        <div class="col-md-2" style="padding: 0">
                            <button style="width: 90%; margin: 11px auto;" type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="bottom" data-content="O link de provas ira levar a uma pagina que  mostrará todas as provas que o aluno fez, la você podera ver as resposta do aluno sobre a prova.">Provas</button>
                        </div>
                        <div class="col-md-3" style="padding: 0">
                            <button style="width: 90%; margin: 11px auto;" type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Os alunos estão ligado as turmas, caso uma turma seja exluida,todos os alunos serão excluidos do sistema, caso eles queriam voltar devem se cadastrar novamente em uma turma diferente! Para iniciar o processo clique aqui!">Exluir Turma</button>
                        </div>
                        </section>
                </section>
            </div>
            
            <hr>
            
            <div class="container">
                <table class="table table-hover tabela-alunos">
                    <thead>
                      <tr>
                        <th scope="col">Perfil</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Status</th>
                        <th scope="col">Provas</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php include_once '../Controller/FuncoesTurma.php'; ?>
                    </tbody>
                </table>
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
        
        <!-- JavaScript Obrigatorio -->
        <script>
            $(function () {
                $('[data-toggle="popover"]').popover()
            })
        </script>
        <script>
            function AtivarOuDesativarTurma(){
                var turma = retornarTurma();
                var condicao = document.getElementById('CheckBoxStatus').checked;
                var texto = document.getElementById('TextoDesAtivStatus');
                
                loadDoc(turma, condicao);
                
                if(condicao){
                    texto.innerHTML = 'Status da turma: <span style="color: #00cc33;">Ativada</span>';
                }else{
                    texto.innerHTML = 'Status da turma: <span style="color: #ff3229;">Desativada</span>';
                }
            }
            
            function loadDoc(TurmaA, CondicaoA) {
                var URLiga = "../Controller/FuncoesTurma.php?StatusTurmaAplicada=" + TurmaA + "&StatusTurmaCondicao=" + CondicaoA;
                
                var xhttp = new XMLHttpRequest();
                xhttp.open("GET", URLiga , true);
                xhttp.send();
            }
            
            function retornarTurma(){
                var query = location.search.slice(1);
                var partes = query.split('&');
                var data = {};
                partes.forEach(function (parte) {
                    var chaveValor = parte.split('=');
                    var chave = chaveValor[0];
                    var valor = chaveValor[1];
                    data[chave] = valor;
                });
                return data.TurmaAplicada;
            }
            
        </script>
        
        
    </body>
</html>
