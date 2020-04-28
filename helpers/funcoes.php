<?php

function filtrarItemsPorLojaId(array $items, $lojaID){

    return array_filter($items, function ($linha) use ($lojaID){
        return $linha['loja_id'] == $lojaID;
    });

}
