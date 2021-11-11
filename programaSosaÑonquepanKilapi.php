
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
            case 2:mostrarUnJuego();break;
            case 3:;break;
            case 4:;break;
            case 5:;break;
            case 6:;break;
            case 7: echo "gracias por haber usado el programa";break;
            default: echo "elección ingresada no valida, por favor ingrese otra\n";break;
        }
    }while($eleccion!=7);
}


/**Inicializa una estructura de datos con ejemplos de juegos y retorna 
 * la colección de juegos indexado de arreglos asociativos que almacena 
 * la información de los juegos que se jugaron. En principio todos los juegos se inventaron.
 */
//arreglo $coleccionJuegos
function cargarJuegos(){
    $coleccionJuegos=[];
    $coleccionJuegos[0]=["jugadorCruz"=>"Igor","jugadorCirculo"=>"Felix", "puntosCruz"=>4,"puntosCirculo"=>0];
    $coleccionJuegos[1]=["jugadorCruz"=>"Mia","jugadorCirculo"=>"Felix", "puntosCruz"=>0,"puntosCirculo"=>0];
    $coleccionJuegos[2]=["jugadorCruz"=>"Igor","jugadorCirculo"=>"Lana", "puntosCruz"=>5,"puntosCirculo"=>0];
    $coleccionJuegos[3]=["jugadorCruz"=>"Mia","jugadorCirculo"=>"Lana", "puntosCruz"=>3,"puntosCirculo"=>3];
    $coleccionJuegos[4]=["jugadorCruz"=>"Felix","jugadorCirculo"=>"Igor", "puntosCruz"=>2,"puntosCirculo"=>4];
    $coleccionJuegos[5]=["jugadorCruz"=>"Igor","jugadorCirculo"=>"Mia", "puntosCruz"=>2,"puntosCirculo"=>2];
    $coleccionJuegos[6]=["jugadorCruz"=>"Lana","jugadorCirculo"=>"Felix", "puntosCruz"=>1,"puntosCirculo"=>0];
    $coleccionJuegos[7]=["jugadorCruz"=>"Mia","jugadorCirculo"=>"Felix", "puntosCruz"=>4,"puntosCirculo"=>0];
    $coleccionJuegos[8]=["jugadorCruz"=>"Igor","jugadorCirculo"=>"Lana", "puntosCruz"=>5,"puntosCirculo"=>5];
    $coleccionJuegos[9]=["jugadorCruz"=>"Felix","jugadorCirculo"=>"Mia", "puntosCruz"=>3,"puntosCirculo"=>0];
    $coleccionJuegos[10]=["jugadorCruz"=>"Lana","jugadorCirculo"=>"Mia", "puntosCruz"=>4,"puntosCirculo"=>0];
    

    return $coleccionJuegos;

};

/**Solicita al usuario un numero dentro de un rango de valores. 
 * Si el numero no es valido, lo vuelve a pedir y retorna el numero valido.
 */
function solicitarNumeroValido($min,$max){
    do{
        echo "Ingrese un numero comprendido entre ".$min. " y " .$max .":";
    $numeroValido=trim(fgets(STDIN));
    } while (!($numeroValido>=$min && $numeroValido<=$max));
    return $numeroValido;
}

/**
 * 
*Dado  un  juego,  muestre  en  pantalla  los  datos  de dicho juego
 * @param array $coleccionJuegos
 */
function listarJuegos($coleccionJuegos)
{
   echo"Ingrese un numero de juego: ";
   $num=trim(fgets(STDIN));

   if($num >=0 && $num < count($coleccionJuegos)){

    if($coleccionJuegos[$num]["puntosCruz"] < $coleccionJuegos[$num]["puntosCirculo"] ){
        $final = "gano O";
    }elseif($coleccionJuegos[$num]["puntosCruz"] > $coleccionJuegos[$num]["puntosCirculo"] ) {
        $final = "gano X";
    } else {
        $final = "empate";
    }
    echo "------RESULTADOS------\n";
    echo "juego TATETI ".$final. "\n ";

    echo "JUGADOR X: ".$coleccionJuegos[$num]["jugadorCruz"]." obtuvo ".$coleccionJuegos[$num]["puntosCruz"]." puntos \n";
    echo "JUGADOR O: ".$coleccionJuegos[$num]["jugadorCirculo"]." obtuvo ".$coleccionJuegos[$num]["puntosCirculo"]." puntos \n";
   }
   else{
       echo "ERROR! no existe ese juego intentelo nuevamente\n ".$num;
   }
  
}

function mostrarUnJuego(){
    $arregloJuegos = cargarJuegos();

    listarJuegos($arregloJuegos);
}





