<?php
class Curso {
    private $read;
    
    public function ImprimirFotoModulo($IDModulo){
        $read = new Read("Modulo", "ID", $IDModulo);
        $read->executarQuery();
        $foto = $read->getResultado()[0]['Imagem'];
        Header( "Content-type: image/gif");
        echo $foto;
        header("Content-Type: text/html; charset=ISO-8859-1",true);
    }

    public function contarModulos(){
        $tabela = "modulo";
        $read = new Read($tabela, null, null);
        $read->executarQuery();
        $this->read = $read;
    }
    
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
