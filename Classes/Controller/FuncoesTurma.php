<?php
/**
 * @project: librason
 * @name: FunçõesTurma
 * @description: Esse arquivo trabalha com a classe ControleTurma, os códigos são feitos aqui para ser inclusos
 * na View, assim evitando muita mistura de front e back end.
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.6
 */
include_once '../../loader.php';

//Vereficamos se o nivel do usuário ta sendo passado para iniciar o código
if(isset($_SESSION['Nivel_User'])){
    //Fazemos outra vereficação antes de iniciar o codigo, vereficamos se o usuário é professor, pois essas funções
    //so podem ser utilizadas por eles, o resto da verificações são feitas na classe.
    if($_SESSION['Nivel_User'] == "P"){
        
        // Instanciamos o controle de Turmas
        $turma = new ControleTurma;
        
        //Agora fazemos uma serie de IFs para utilizar as funções da classe caso solicitado de acordo com os ifs
        
        //Criar Turma
        if(isset($_REQUEST['CriarNovaTurma'])){
            $turma->criarTurma();
        }
        //Exibir turmas em cards
        else if(isset ($ExibirTurmas)){
            $Turma = $turma->getTurmasCadastradas();
            $qtdTurmas = $turma->getQtsTurmas();
            for($i = 0; $i < $qtdTurmas; $i++){
                ?>
                <section class="Card-Turma col-md-3">
                    <div class="Card-Turma-back">
                        <a href="PainelTurma.php?TurmaAplicada=<?php echo $Turma[$i]['COD'] ?>">
                            <figure>
                                <center>
                                    <img src="imgs/Cards/Card-Link-4.png" alt="Icon Turma">
                                </center>
                            </figure>
                            <p class="Card-Turma-Cod">Turma: <span style="color: #ff3229"><?php echo $Turma[$i]['COD']?></span></p>
                            <p class="Card-Turma-Status">Status: 
                                <?php if($Turma[$i]['Status'] == true){ ?><span style="color: #ff3229">Aberta</span><?php }  ?> 
                                <?php if($Turma[$i]['Status'] == false){ ?><span style="color: #ff3229">Fechada</span><?php }  ?> 
                           </p>
                        </a>
                    </div>
                </section>
                <?php
            }
        }
        //Exibir lista de alunos em tabela
        else if(isset ($_REQUEST['TurmaAplicada'])){
            $Aluno = $turma->detectarAlunosTurma($_REQUEST['TurmaAplicada']);
            if(empty($Aluno)){
                $numAlunos = 0;
            }else{
                $numAlunos = count($Aluno);
            }
            
            for ($i = 0; $i < $numAlunos; $i++){
            ?>
                <tr>
                    <th scope="row" class="align-middle" style="padding: 4px 10px;"><img style="border: 2px solid #ff3229; border-radius: 100%;" src="../Controller/CarregarImagens.php?FotoPerfilAluno=<?php echo $Aluno[$i]['ID']?>" width="50" height="50"></th>
                    <td><?php echo $Aluno[$i]['nome'];?></td>
                    <td>Cursando</td>
                    <td><a href="AnaliseDeProvas.php?ID=<?php echo $Aluno[$i]['ID'];?>">Acessar Provas</a></td>
                </tr>
            <?php
            }
        }
        //Mudança de Status da turma
        else if(isset ($_REQUEST['StatusTurmaAplicada']) && isset($_REQUEST['StatusTurmaCondicao'])){
            $Turma = $_REQUEST['StatusTurmaAplicada'];
            $Condicao = $_REQUEST['StatusTurmaCondicao'];
            
            $turma->mudarStatusTurma($Turma, $Condicao);
        }
        
    }else{
        // Retornamso a pagina anterior com um erro caso a vereficação de false.
        echo "<script>window.location.href = '../View/Turmas.php?ErroCriacaoTurmas'</script>";
    }
}else{
    // Retornamso a pagina anterior com um erro caso a vereficação de false.
    echo "<script>window.location.href = '../View/Turmas.php?ErroCriacaoTurmas'</script>";
}