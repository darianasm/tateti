
<?php

include ('tateti.php');

seleccionarOpcion();

function seleccionarOpcion (){
 
    do{
        echo "------Menú de opciones------\n"
            ."1) Jugar al tateti.\n"
            ."2) Mostrar un juego.\n"
            ."3) Mostrar el primer juego ganador.\n"
            ."4) Mostrar porcentaje de Juegos ganados.\n"
            ."5) Mostrar resumen de Jugador.\n"
            ."6) Mostrar listado de juegos Ordenado por jugador O.\n"
            ."7) Salir.\n";
        
        echo "Ingrese su eleccion: ";
        $eleccion = trim(fgets(STDIN));
        
        switch($eleccion){
            case 1:jugar();break;
            case 2:;break;
            case 3:;break;
            case 4:;break;
            case 5:;break;
            case 6:;break;
            case 7: echo "gracias por haber usado el programa";break;
            default: echo "elección ingresada no valida, por favor ingrese otra\n";break;
        }
    }while($eleccion!=7);
}