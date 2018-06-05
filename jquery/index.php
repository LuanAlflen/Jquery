<?php

require 'app/Models/CategoriaCrud.php';
require 'app/Models/ProdutoCrud.php';

    if (!isset($_GET['acao'])){
        $acao = 'index';
    }else{
        $acao = $_GET['acao'];
    }

    switch ($acao){
        case 'index':

            $crudCat = new CategoriaCrud();
            $categorias = $crudCat->getCategorias();
            $crudProd = new ProdutoCrud();
            $produtos = $crudProd->getProdutos();
            include "app/Views/Principal/index.php";

            break;
    }