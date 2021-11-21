<?php

include ('tateti.php');

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* ... COMPLETAR ... */

/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


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
//array $coleccionJuegos;
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
 * @return array $coleccion
 */
function agregarJuego($coleccionJuego,$juego){
    array_push($coleccionJuego,$juego);
    return $coleccionJuego;
}

/** esta función invoca la función jugar() y agrega el juego a una colección que se muestra por pantalla 
 * luego agrega el juego nurvo invocando la función agregarJuego()
 * y retorna la coleccion total modificada
 * @param array $coleccion
 * @return array $coleccionMod;
 */
function jugarTateti($coleccion){
//array $juegoNuevo, $coleccionMod;
    $juegoNuevo = jugar();
    $coleccionMod = agregarJuego($coleccion,$juegoNuevo);
    print_r($coleccionMod);
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

/** 
 * Dado un juego, muestra por pantalla los datos de dicho juego
 * @param array $coleccion
 */
function mostrarUnJuego($coleccion){
    //int $totalJuegos, $num;
    //string $mostrarJuego;
   $totalJuegos= count($coleccion)-1;
   echo "ingrese número: ";
   $num=solicitarNumeroEntre(0,$totalJuegos);
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
// boolean $gano;
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
 * @param string $nombreJugador
 * @param int $i
 * @return float $resultado
 */
function primerJuegoGanado($coleccionJuego,$nombre){
//int $i, $n;
//float $resultado;
    $ind=0;
    $n=count($coleccionJuego);
    while ($ind<$n && (!jugadorGano($coleccionJuego,$ind,$nombre))){
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


/** Solicita al usuario un nombre de jugador válido (string)
 * @param array $coleccioJuego
 * @return string $nombre 
*/
function solicitarNombreValido($coleccionJuego){
//string nombre;
    do{
        echo "Ingrese el nombre de un jugador:";
        $nombre=trim(fgets(STDIN));
    } while (!esJugador($nombre, $coleccionJuego));
    return $nombre;
}

/** Chequea que un nombre dado haya sido jugador
 * @param string $nombre
 * @param array $coleccion;
 * @return boolean $resultado
*/
function esJugador($name, $coleccion){
//int $cantJuegos, $i;
//boolean $resultado;
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
// int $puntosX, $puntosO;
// string $resultadoJuego;
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
 * Verifica si el usuario ingresó un número válido, si no, repite hasta que sea válido. 
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
 * @return int $resultadoJuego;
 */
function cantJuegosGanados($coleccionTotal){
    $totalJuegosGanados = 0;
    $cantJuegos = count($coleccionTotal);
    
    for($i=0; $i < $cantJuegos; $i++){
        if(evaluaJuego($i, $coleccionTotal) == "ganó X" || evaluaJuego($i, $coleccionTotal) == "ganó O"){
        $totalJuegosGanados++;
        }
    }
    return $totalJuegosGanados;
}


/**
 * Cuenta la cantidad de juegos ganados por simbolo. 
 * @param string $simb
 * @return int $cantJuegosGanadosSimb
 */
function cantJuegosGanadosSimbolo($simb, $coleccion){

    $cantJuegosGanadosSimb = 0;
    $arrayJuegos = $coleccion;
    
    for($i=0; $i< count($arrayJuegos); $i++){
        
        if(evaluaJuego($i, $arrayJuegos) == "ganó O" && $simb == "O"){
        $cantJuegosGanadosSimb++;
        }elseif(evaluaJuego($i, $arrayJuegos) == "ganó X" && $simb == "X"){
        $cantJuegosGanadosSimb++;
        }   
    }
    return $cantJuegosGanadosSimb;
}

/**
 * Calcula el porcentaje de juegos ganados por simbolo y lo muestra por pantalla. 
 * @return int $cantJuegosGanadosSimb
 */
function mostrarPorcenJuegosGanados($coleccion){
    $simbolo = validarSimbolo();
    $porcentaje = (100*cantJuegosGanadosSimbolo($simbolo, $coleccion))/cantJuegosGanados($coleccion);
    echo "el porcentaje de juegos ganados por el símbolo ".$simbolo." es de un: "." $porcentaje"."%\n";
}


/**
 * Muestra en pantalla la estructura ordenada alfabéticamente por jugador O.
 * La función predefinida uasort ordena el arreglo indexado tal que sus índices
 * mantienen sus correlaciones con los elementos del arreglo con los que están asociados, 
 * usando una función de comparación definida, en este caso micmp, 
 * la cual compara los arreglos asociativos según el indice jugadorO.
 * La función predefinida print_r muestra información sobre un array de forma legible.
 * @param array 
 */
function ordenarJuegosJugadorO($coleccionTotal){
    function micmp($a,$b) {
        if ($a["jugadorCirculo"]==$b["jugadorCirculo"]){
            $orden=0;
        }elseif($a["jugadorCirculo"]<$b["jugadorCirculo"]){
            $orden=-1;
        }else{
            $orden=1;
        }
        return $orden;
    }
    $coleccion=$coleccionTotal;
    uasort($coleccion,'micmp');
    print_r($coleccion);
}


//Dado el nombre de un jugador devuelve el resumen de dicho jugador
function mostrarResumenJugador($coleccionTotal){
    //Inicializar variables
    $empate= 0;
    $ganados= 0;
    $perdidos= 0;
    $puntosAcumulados= 0;

    $cantJuegos = count($coleccionTotal);
    $nombreJugador=solicitarNombreValido($coleccionTotal);
    for($i=0; $i < $cantJuegos; $i++){
      
        $jugadorX = $coleccionTotal[$i]["jugadorCruz"];
        $jugadorO = $coleccionTotal[$i]["jugadorCirculo"];
        $puntosX = $coleccionTotal[$i]["puntosCruz"];
        $puntosO = $coleccionTotal[$i]["puntosCirculo"];
        $resultado=evaluaJuego($i, $coleccionTotal);
            if($jugadorX == $nombreJugador){
                //Cuando el jugador es X
                if($resultado =="ganó X"){
                    $ganados++;
                }elseif($resultado == "ganó O"){
                    $perdidos++;
                }else{
                    $empate++;
                }
                $puntosAcumulados = $puntosAcumulados + $puntosX;

            }elseif($jugadorO == $nombreJugador){
                //Cuando el jugador es O
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
     echo"JUGADOR: ".$nombreJugador."\n";
     echo"GANÓ: ".$ganados."\n";
     echo"PERDIO: ".$perdidos."\n";
     echo"EMPATO: ".$empate."\n"; 
     echo"Total de puntos acumulados ".$puntosAcumulados."\n";

} 



