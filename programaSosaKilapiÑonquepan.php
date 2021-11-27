<?php

include_once('tateti.php');

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
//array $coleccionTotal

//Inicialización de variables:
$coleccionTotal=cargarJuegos();

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/
/**
 * Muestra un menú de opciones a elegir y dependiendo de la elección del usuario realiza las acciones correspondientes.
 * @param array $coleccionTotal
 */
seleccionarOpcion($coleccionTotal);
function seleccionarOpcion ($coleccionTotal){
//int $eleccion;    
//array $coleccionTotal;
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
/*La sentencia switch es similar a una serie de sentencias IF en la misma expresión. 
En muchas ocasiones, es posible que se quiera comparar la misma variable (o expresión)
con muchos valores diferentes, y ejecutar una parte de código distinta dependiendo de
a que valor es igual. Para esto es exactamente la expresión switch.*/
        switch($eleccion){
            case 1:$coleccionTotal=jugarTateti($coleccionTotal);break;
            case 2:mostrarUnJuego($coleccionTotal);break;
            case 3:mostrarPrimerJuegoGanado($coleccionTotal);break;
            case 4:mostrarPorcenJuegosGanados($coleccionTotal);break;
            case 5:mostrarResumenJugador($coleccionTotal);break;
            case 6:ordenarJuegosJugadorO($coleccionTotal);break;
            case 7: echo "gracias por haber usado el programa";break;
            default: echo "elección ingresada no valida, por favor ingrese otra\n";break;
        }
    }while($eleccion!=7);
}

/** Inicializa una estructura de datos con ejemplos de juegos y retorna 
 * la colección de juegos indexado de arreglos asociativos que almacena 
 * la información de los juegos que se jugaron. En principio todos los juegos se inventaron.
 * @return array $coleccionJuegos
 */
function cargarJuegos(){
    $coleccionJuegos=[];
    $coleccionJuegos[0]=["jugadorCruz"=>"IGOR","jugadorCirculo"=>"FELIX", "puntosCruz"=>4,"puntosCirculo"=>0];
    $coleccionJuegos[1]=["jugadorCruz"=>"MIA","jugadorCirculo"=>"FELIX", "puntosCruz"=>0,"puntosCirculo"=>0];
    $coleccionJuegos[2]=["jugadorCruz"=>"IGOR","jugadorCirculo"=>"LANA", "puntosCruz"=>5,"puntosCirculo"=>0];
    $coleccionJuegos[3]=["jugadorCruz"=>"MIA","jugadorCirculo"=>"LANA", "puntosCruz"=>3,"puntosCirculo"=>3];
    $coleccionJuegos[4]=["jugadorCruz"=>"FELIX","jugadorCirculo"=>"IGOR", "puntosCruz"=>2,"puntosCirculo"=>4];
    $coleccionJuegos[5]=["jugadorCruz"=>"IGOR","jugadorCirculo"=>"MIA", "puntosCruz"=>2,"puntosCirculo"=>2];
    $coleccionJuegos[6]=["jugadorCruz"=>"LANA","jugadorCirculo"=>"FELIX", "puntosCruz"=>1,"puntosCirculo"=>0];
    $coleccionJuegos[7]=["jugadorCruz"=>"MIA","jugadorCirculo"=>"FELIX", "puntosCruz"=>4,"puntosCirculo"=>0];
    $coleccionJuegos[8]=["jugadorCruz"=>"IGOR","jugadorCirculo"=>"LANA", "puntosCruz"=>5,"puntosCirculo"=>5];
    $coleccionJuegos[9]=["jugadorCruz"=>"FELIX","jugadorCirculo"=>"MIA", "puntosCruz"=>3,"puntosCirculo"=>0];
    $coleccionJuegos[10]=["jugadorCruz"=>"LANA","jugadorCirculo"=>"MIA", "puntosCruz"=>4,"puntosCirculo"=>0];    
    return $coleccionJuegos;
}

/** Dado una colección  de  juegos y  un  juego, la  función retorna la colección modificada 
 * al agregarse el nuevo juego
 * @param array $coleccionJuegos
 * @param array $juego
 * @return array $coleccionJuegos
 */
function agregarJuego($coleccionJuegos,$juego){
    array_push($coleccionJuegos,$juego);
    return $coleccionJuegos;
}

/** 
 * Invoca a la función jugar() y agrega el juego a la colecciónTotal
 * que muestra por pantalla
 * y retorna la coleccion total modificada
 * @param array $coleccion
 * @return array $coleccionMod;
 */
function jugarTateti($coleccion){
    //array $juegoNuevo
    $juegoNuevo = jugar();
    imprimirResultado($juegoNuevo);
    $coleccionMod = agregarJuego($coleccion,$juegoNuevo);
    return $coleccionMod;
}

/** 
 * Dado  un  indice muestra los detalles de dicho juego
 * @param int $indice
 * @param array $coleccionTotal
 */
function detalleJuego($indice, $coleccionTotal){
    //string $ganador, jugadorX, jugadorO;
    //int $puntosX, $puntosO; 
    $ganador= evaluaJuego($indice, $coleccionTotal);
    $jugadorX=$coleccionTotal[$indice]["jugadorCruz"];
    $puntosX=$coleccionTotal[$indice]["puntosCruz"];
    $jugadorO=$coleccionTotal[$indice]["jugadorCirculo"];
    $puntosO=$coleccionTotal[$indice]["puntosCirculo"];
    echo "********************** \n";
    echo "Juego TATETI: ".$indice." ($ganador)\n";
    echo "Jugador X: ".$jugadorX." obtuvo ".$puntosX." puntos\n";
    echo "Jugador O: ".$jugadorO." obtuvo ".$puntosO." puntos\n";
    echo "********************** \n";
}

/** Solicita al usuario un numero dentro de un rango de valores. 
 * Si el numero no es valido, lo vuelve a pedir y retorna el numero valido.
 * @param int $minNum, $maxNum
 * @return int $numeroValido 
 */
function solicitarNumeroValido($minNum,$maxNum){
    echo "Ingrese un numero comprendido entre ".$minNum. " y " .$maxNum .":";
    $numeroValido=solicitarNumeroEntre($minNum, $maxNum);
    return $numeroValido;
}

/** 
 * Dado un juego, muestra por pantalla los datos de dicho juego
 * @param array $coleccion
 */
function mostrarUnJuego($coleccion){
    //int $totalJuegos, $num;
    //string $mostrarJuego;
   $totalJuegos= count($coleccion)-1;
   $num=solicitarNumeroValido(0,$totalJuegos);
   $mostrarJuego=detalleJuego($num, $coleccion);
   echo $mostrarJuego;
}


/** Dada una colección de juegos, un indice(un juego) y un jugador, la función
 * devuelve true si ese jugador gano en ese juego (como X o como O),
 * false caso contrario. 
 * @param array $coleccionJuegos
 * @param int $i
 * @param string $nombreJugador
 * @return boolean $gano
 */
function jugadorGano($coleccionJuegos,$i,$nombreJugador){
    if ($coleccionJuegos[$i]["jugadorCruz"]==$nombreJugador && $coleccionJuegos[$i]["puntosCruz"]>$coleccionJuegos[$i]["puntosCirculo"]){
        $gano=true;
    }
    elseif ($coleccionJuegos[$i]["jugadorCirculo"]==$nombreJugador && $coleccionJuegos[$i]["puntosCirculo"]>$coleccionJuegos[$i]["puntosCruz"]){
        $gano=true;
    }else{
        $gano=false;
    }
    return $gano;
}

/** Dada una colección de juegos y un jugador, retorna el índice de su primer juego ganado. 
 * Sino ganó ningún juego, la funcion debe retornar -1
 * @param array $coleccion
 * @param string $nombre
 * @return int $resultado
 */
function primerJuegoGanado($coleccion,$nombre){
    //int $ind, $n;
    $ind=0;
    $n=count($coleccion);
    while ($ind<$n && (!jugadorGano($coleccion,$ind,$nombre))){
        $ind++;
    }
    if ($ind<$n){
        $resultado=$ind;
    }else{
        $resultado=-1;
    }
    return $resultado;
}

/** Solicita al usuario el nombre de un jugador y se muestra en pantalla
 * su primer juego ganado.
 * Sino ganó ningún juego se lo indica.
 * @param array $coleccion
 */
function mostrarPrimerJuegoGanado($coleccion){
    //string $nombreJugador;
    //int $iJuego;
    $nombreJugador=solicitarNombreValido($coleccion);
    $iJuego=primerJuegoGanado($coleccion,$nombreJugador);

    if ($iJuego>=0){
        echo "PRIMER JUEGO GANADO\n";
        echo detalleJuego($iJuego, $coleccion);
    }elseif ($iJuego==-1) {
        echo "El jugador ".$nombreJugador." no ganó ningún juego\n";
    }
}


/** Solicita al usuario un nombre de jugador válido
 * @param array $coleccionJuegos
 * @return string $nombre 
*/
function solicitarNombreValido($coleccionTotal){
    //string nombre;
    $coleccionJuegos=$coleccionTotal;
    do{
        echo "Ingrese el nombre de un jugador:";
        $nombre=strtoupper(trim(fgets(STDIN)));
    } while (!esJugador($nombre, $coleccionJuegos));
    return $nombre;
}

/** Chequea que un nombre dado haya sido jugador
 * @param string $name
 * @param array $coleccion;
 * @return boolean $resultado
*/
function esJugador($name, $coleccion){
    //int $cantJuegos, $i;
    $cantJuegos = count($coleccion);
    $i=0;
    $resultado=false;
    while ($i<$cantJuegos && $resultado==false){
        if ($coleccion[$i]["jugadorCruz"]==$name or $coleccion[$i]["jugadorCirculo"]==$name){
            $resultado=true;
        }else{
            $i++;
        }
    }
    return $resultado;
}


/**
 * Evalúa si el juego fue un empate. si ganó el jugador círculo o el jugador cruz. 
 * @param int $numJuego;
 * @param $coleccionJuegos;
 * @return string $resultadoJuego;
 * 
 */
function evaluaJuego ($numJuego, $coleccionJuegos){
    //int $puntosX, $puntosO;
    $puntosX = $coleccionJuegos[$numJuego]["puntosCruz"];
    $puntosO = $coleccionJuegos[$numJuego]["puntosCirculo"];
    
    if($puntosX < $puntosO){
        $resultadoJuego = "ganó O";
    }
    elseif($puntosX > $puntosO){
        $resultadoJuego = "ganó X";
    }
    elseif($puntosX == $puntosO){
        $resultadoJuego = "empate";   
    }
    
    return $resultadoJuego;
}
/**
 * Verifica si el usuario ingresó un simbolo válido, si no, repite hasta que sea válido. 
 * @return string $simboloValido;
 */
function validarSimbolo(){    
    do{
        echo "ingrese símbolo válido, debe ser un 'O' o una 'X': \n";
        $simboloValido = strtoupper(trim(fgets(STDIN)));
    }while(!($simboloValido == "O" || $simboloValido == "X"));

    return $simboloValido;
}

/**
 * Cuenta la cantidad de juegos en total que se han ganado, sin importar el simbolo. 
 * @param array $coleccion;
 * @return int $totalJuegosGanados;
 */
function cantJuegosGanados($coleccion){
    //int $i, $totalJuegosGanados, $cantJuegos;    
    $totalJuegosGanados = 0;
    $cantJuegos = count($coleccion);
    
    for($i=0; $i < $cantJuegos; $i++){
        if(evaluaJuego($i, $coleccion) == "ganó X" || evaluaJuego($i, $coleccion) == "ganó O"){
        $totalJuegosGanados++;
        }
    }
    return $totalJuegosGanados;
}


/**
 * Cuenta la cantidad de juegos ganados por simbolo. 
 * @param string $simb
 * @param array $coleccion;
 * @return int $cantJuegosGanadosSimb
 */
function cantJuegosGanadosSimbolo($simb, $coleccion){
    //int $i,$cantJuegosGanadosSimb;
    $cantJuegosGanadosSimb = 0;
    
    for($i=0; $i< count($coleccion); $i++){
        
        if(evaluaJuego($i, $coleccion) == "ganó O" && $simb == "O"){
        $cantJuegosGanadosSimb++;
        }elseif(evaluaJuego($i, $coleccion) == "ganó X" && $simb == "X"){
        $cantJuegosGanadosSimb++;
        }   
    }
    return $cantJuegosGanadosSimb;
}

/**
 * Calcula el porcentaje de juegos ganados por simbolo y lo muestra por pantalla.
 * @param array $coleccion 
 */
function mostrarPorcenJuegosGanados($coleccion){
    //string $simbolo
    //float $porcentaje;
    $simbolo = validarSimbolo();
    $porcentaje = (100*cantJuegosGanadosSimbolo($simbolo, $coleccion))/cantJuegosGanados($coleccion);
    echo "el porcentaje de juegos ganados por el símbolo ".$simbolo." es de un: "." $porcentaje"."%\n";
}


/**
 * Muestra en pantalla la estructura ordenada alfabéticamente por jugador O.
 * La función predefinida uasort ordena el arreglo indexado tal que sus índices
 * mantienen sus correlaciones con los elementos del arreglo con los que están asociados, 
 * usando una función de comparación definida, en este caso micmp. 
 * La función predefinida print_r muestra información sobre un array de forma legible.
 * @param array coleccion
 */
function ordenarJuegosJugadorO($coleccion){
    uasort($coleccion,'micmp');
    print_r($coleccion);
}

/**
 * Compara los valores de "jugadorCirculo" de los arreglos asociativos,
 * y les asigna un orden. 
 * @param array $juegoA
 * @param array $juegoB
 * @return int $orden
 */
function micmp($juegoA,$juegoB){
    if ($juegoA["jugadorCirculo"]==$juegoB["jugadorCirculo"]){
        $orden=0;
    }elseif($juegoA["jugadorCirculo"]<$juegoB["jugadorCirculo"]){
        $orden=-1;
    }else{
        $orden=1;
    }
    return $orden;
}


/** Dado el nombre de un jugador retorna el resumen de dicho jugador en un array
* @param array $coleccion 
* @return array $resumen
*/
function resumenJugador($coleccion,$nombre){
    //int $i, $empate, $ganados, $perdidos, $puntosAcumulados, cantJuegos, $puntosX, $puntosO, $puntosAcumulados;
    //string $nombreJugador, $jugadorX, $jugadorO, $resultado;
    $empate= 0;
    $ganados= 0;
    $perdidos= 0;
    $puntosAcumulados= 0;
  
   
    $cantJuegos = count($coleccion);
    
    for($i=0; $i < $cantJuegos; $i++){
        $jugadorX =$coleccion[$i]["jugadorCruz"];
        $jugadorO = $coleccion[$i]["jugadorCirculo"];
        $puntosX = $coleccion[$i]["puntosCruz"];
        $puntosO = $coleccion[$i]["puntosCirculo"];
      
        $resultado=evaluaJuego($i, $coleccion);
       
            if( $jugadorX == $nombre){
                //si el jugador es X
                if($resultado =="ganó X"){
                    $ganados++;
                }elseif($resultado == "ganó O"){
                    $perdidos++;
                }else{
                    $empate++;
                }
                $puntosAcumulados = $puntosAcumulados + $puntosX;

            }elseif($jugadorO == $nombre){
                //si el jugador es O
                if($resultado =="ganó O"){
                    $ganados++;
                }elseif($resultado == "ganó X"){
                    $perdidos++;
                }else{
                    $empate++;
                }
                $puntosAcumulados = $puntosAcumulados + $puntosO;
            }
           
    }
    
    $resumen = [
        "jugador" => $nombre,
        "gano" => $ganados,
        "perdio" => $perdidos,
        "empato" => $empate,
        "puntosAcumulados" => $puntosAcumulados

    ];
   
  return $resumen;


}

/**
 * Muestra por pantalla el resumen de un jugador 
 * @param array $coleccionTotal
 */

function mostrarResumenJugador($coleccionTotal){
    //array $resumen
    $nombreJugador=solicitarNombreValido($coleccionTotal);
    $resumen=resumenJugador($coleccionTotal,$nombreJugador);
    echo "********************** \n";
     echo"JUGADOR: ".$resumen["jugador"]."\n";
     echo"GANÓ: ".$resumen["gano"]."\n";
     echo"PERDIO: ".$resumen["perdio"]."\n";
     echo"EMPATO: ".$resumen["empato"]."\n"; 
     echo"Total de puntos acumulados: ".$resumen["puntosAcumulados"]."\n";
     echo "********************** \n";
}