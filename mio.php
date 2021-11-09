<?php

function solicitarNumeroValido($min,$max){
    do{
        echo "Ingrese un numero comprendido entre ".$min. " y " .$max ." :";
    $numeroValido=trim(fgets(STDIN));
    } while (!($numeroValido>=$min && $numeroValido<=$max));
    echo $numeroValido;
    return $numeroValido;
}

solicitarNumeroValido(2,10);

