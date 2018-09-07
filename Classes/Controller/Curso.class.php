<?php
/**
 * @project: librason
 * @name: Curso
 * @description: Classe que contém as funções ligadas a pagina de Curso dos usuários
 * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
 * @author Caio Alexandre De Sousa Ramos
 * @email caioxandres2000@gmail.com
 * @version 0.8
 * @métodos ImprimirFotoModulo(), contarModulos(), imprimirModulos()
 */
class Curso {
    /** @var object $read variavel responsavel por armazenar o obejto read que realiaza a leitura de dados no BD*/
    private $read;
    /**
     * @Descrição: Imprime a foto do módulo armazenada no banco de dados
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @param int $IDModulo referencia o módulo que deve imprimir a foto
     */
    public function ImprimirFotoModulo($IDModulo){
        $read = new Read("Modulo", "ID", $IDModulo);
        $read->executarQuery();
        $foto = $read->getResultado()[0]['Imagem'];
        Header( "Content-type: image/gif");
        echo $foto;
        header("Content-Type: text/html; charset=ISO-8859-1",true);
    }
    /**
     * @Descrição:Esse método conta quantos módulos existem registrados no BD
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    public function contarModulos(){
        $tabela = "modulo";
        $read = new Read($tabela, null, null);
        $read->executarQuery();
        $this->read = $read;
    }
    
    /**
     * @Descrição: Faz a impressao dos módulos na tela do curso do usuário
     * @copyright (c) 06/05/2018, Caio Alexandre de Sousa Ramos
     * @versao 0.8 - 07/09/2018
     * @parametros sem parâmetros
     */
    public function imprimirModulos(){
        $modulos = $this->read->getResultado();
        foreach ($modulos as $value) {
            ?>
            <section class="modulo row">
                            <div class="col-md-3 modulo-icone">
                                <figure class="modulo-figure-icone ">
                                    <img src="../Controller/CarregarImagens.php?IconeModulo=<?php echo $value['ID']; ?>" alt=""/>
                                </figure>
                            </div>
                            <div class="col-md-9">
                                <h1 class="modulo-titulo">Módulo <?php echo $value['ID']; ?>: <?php echo $value['Nome']; ?></h1>
                                <p class="modulo-descricao">Descrição: <?php echo $value['Descricao']; ?></p>
                                 <table class="table table-hover tabela-modulo">
                                    <thead>
                                        <?php 
                                        $read1 = new Read("Video", "Modulo_FK", $value['ID']);
                                        $read1->executarQuery();
                                        $resultado = $read1->getResultado();
                                        foreach ($resultado as $value1) {
                                        ?>
                                        <tr>
                                            <td scope="col"><a href="ModuloVideo.php?ID=<?php echo $value1['ID']?>"><div><img class="img-icon-curso" src="../View/imgs/icon-video.png" alt=""/>Módulo <?php echo $value['ID']; ?>: Vídeo - <?php echo $value1['Nome']; ?></div></a></td>
                                        </tr>
                                        <?php } ?>
                                        
                                        <?php 
                                        $read2 = new Read("Exercicio", "Modulo_FK", $value['ID']);
                                        $read2->executarQuery();
                                        $resultado = $read1->getResultado();
                                        foreach ($resultado as $value1) {
                                        ?>
                                        <tr>
                                            <td scope="col"><a href="ModuloExercicio.php?ID=<?php echo $value1['ID']?>"><div><img class="img-icon-curso" src="../View/imgs/icon-prova.png" alt=""/>Módulo <?php echo $value['ID']; ?>: Atividade - <?php echo $value1['Nome']; ?></div></a></td>
                                        </tr>
                                        <?php } ?>
                                    </thead>
                                 </table>
                            </div>
                    </section>
            <?php
        }
    }
}
