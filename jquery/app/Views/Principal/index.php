<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Abas</title>
    <link rel="stylesheet" href="assets/css/abas.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>


    <script>



        $(document).ready(function (){

            $("#abas ul li").addClass("selecionado");

            $("#abas ul li").click(function () {
                $(this).toggleClass("selecionado");
                //$(".conteudo").toggle();

                var meuId = $(this).attr("id");
                $("."+meuId).toggle();
            });
        });

    </script>

</head>

<body>
        <div id="abas">
            <ul>
                <?php

                    foreach ($categorias as $categoria):?>

                    <li id="<?= $categoria->getId(); ?>"><?= $categoria->getNome(); ?></li>


                    <?php endforeach ?>
            </ul>
        </div>

        <div id="conteudos">

            <?php foreach ($produtos as $produto):?>

                <div class="<?= $produto->getIdcategoria();?>">
                    <?= $produto->getNome(); ?>
                </div>


            <?php endforeach ?>
        </div>

</body>
</html>