
<?php

include ('tateti.php');

/**
 * Muestra un menú de opciones a elegir y dependiendo de la elección del usuario realiza las acciones correspondientes.
 */
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
            case 3:mostrarPrimerJuegoGanado();break;
            case 4:mostrarPorcenJuegosGanados();break;
            case 5:;break;
            case 6:ordenarJuegosJugadorO();break;
            case 7: echo "gracias por haber usado el programa";break;
            default: echo "elección ingresada no valida, por favor ingrese otra\n";break;
        }
    }while($eleccion!=7);
}


/** Inicializa una estructura de datos con ejemplos de juegos y retorna 
 * la colección de juegos indexado de arreglos asociativos que almacena 
 * la información de los juegos que se jugaron. En principio todos los juegos se inventaron.
 * @return array $coleecionJuegos
 */
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

/** Solicita al usuario un numero dentro de un rango de valores. 
 * Si el numero no es valido, lo vuelve a pedir y retorna el numero valido.
 * @param int $min, $max
 * @return int $numeroValido 
 */
function solicitarNumeroValido($min,$max){
    do{
        echo "Ingrese un numero comprendido entre ".$min. " y " .$max .":";
    $numeroValido=trim(fgets(STDIN));
    } while (!($numeroValido>=$min && $numeroValido<=$max));
    return $numeroValido;
}

/** 
 * Dado  un  juego,  muestre  en  pantalla  los  datos  de dicho juego
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

/** Dada una colección de juegos, un indice(un juego) y un jugador, la función
 * devuelve true si ese jugador gano en ese juego (como X o como O),
 * false caso contrario. 
 * @param array $coleccionJuegos
 * @param int $i
 * @param string $nombreJugador
 * @return boolean $gano
 */
function gano($coleccionJuegos,$i,$nombreJugador){
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
function primerJuegoGanado($coleccion,$nombreJugador){
    $i=0;
    $n=count($coleccion);
    while ($i<$n && (!gano($coleccion,$i,$nombreJugador))){
        $i++;
    }
    if ($i<$n){
        $resultado=$i;
    }else{
        $resultado=-1;
    }
    return $resultado;
}

/** Solicita al usuario el nombre de un jugador y se muestra en pantalla
 * su primer juego ganado.
 * Sino ganó ningún juego se lo indica.
 * @param array $coleccion
 * @param string $nombreJugador, $ganador, $jugadorX, $jugadorO
 * @param int $iJuego, $puntosX, $puntosO
 * @return float $resultado
 */
function mostrarPrimerJuegoGanado(){
    $coleccion=cargarJuegos();
    $nombreJugador=solicitarNombreValido();
    $iJuego=primerJuegoGanado($coleccion,$nombreJugador);
    if ($iJuego>=0){
        $ganador=evaluaJuego($iJuego);
        $jugadorX=strtoupper($coleccion[$iJuego]["jugadorCruz"]);
        $puntosX=$coleccion[$iJuego]["puntosCruz"];
        $jugadorO=strtoupper($coleccion[$iJuego]["jugadorCirculo"]);
        $puntosO=$coleccion[$iJuego]["puntosCirculo"];
        echo "********************** \n";
        echo "Juego TATETI: ".$iJuego." ($ganador)\n";
        echo "Jugador X: ".$jugadorX." obtuvo ".$puntosX." puntos\n";
        echo "Jugador O: ".$jugadorO." obtuvo ".$puntosO." puntos\n";
        echo "********************** \n";
    }elseif ($iJuego==-1) {
        echo "El jugador ".$nombreJugador." no ganó ningún juego\n";
    }
}
/** Solicita al usuario un nombre de jugador válido (string)
 * @return string $nombre 
*/
function solicitarNombreValido(){
    do{
        echo "Ingrese el nombre de un jugador:";
        $nombre=trim(fgets(STDIN));
    } while (!is_string($nombre));
    return $nombre;
}

/**
 * Evalúa si el juego fue un empate. si ganó el jugador círculo o el jugador cruz. 
 * @param int $numJuego;
 * @return string $resultadoJuego;
 */
function evaluaJuego ($numJuego){
    
    $puntosX = cargarJuegos()[$numJuego]["puntosCruz"];
    $puntosO = cargarJuegos()[$numJuego]["puntosCirculo"];
    
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
function cantJuegosGanados(){
$totalJuegosGanados = 0;
$cantJuegos = count(cargarJuegos());

for($i=0; $i < $cantJuegos; $i++){
    
    if(evaluaJuego($i) == "ganó X" || evaluaJuego($i) == "ganó O"){
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
function cantJuegosGanadosSimbolo($simb){

    $cantJuegosGanadosSimb = 0;
    $arrayJuegos = cargarJuegos();
    
    for($i=0; $i< count($arrayJuegos); $i++){
        
        if(evaluaJuego($i) == "ganó O" && $simb == "O"){
        $cantJuegosGanadosSimb++;
        }elseif(evaluaJuego($i) == "ganó X" && $simb == "X"){
        $cantJuegosGanadosSimb++;
        }
    
    }

return $cantJuegosGanadosSimb;
}

/**
 * Calcula el porcentaje de juegos ganados por simbolo y lo muestra por pantalla. 
 * @return int $cantJuegosGanadosSimb
 */
function mostrarPorcenJuegosGanados(){
$simbolo = validarSimbolo();
$porcentaje = (100*cantJuegosGanadosSimbolo($simbolo))/cantJuegosGanados();
echo "el porcentaje de juegos ganados por el símbolo ".$simbolo." es de un: "." $porcentaje"."%\n";
}

/**
 * Muestra en pantalla la estructura ordenada alfabéticamente por jugador O.
 * La función predefinida uasort ordena el arreglo indexado tal que sus índices
 * mantienen sus correlaciones con los elementos del arreglo con los que están asociados, 
 * usando una función de comparación definida, en este caso micmp, 
 * la cual compara los arreglos asociativos según el indice jugadorO.
 * La función predefinida print_r muestra información sobre un array de forma legible.
 * @param array $coleccion
 */
function ordenarJuegosJugadorO(){
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
    $coleccion=cargarJuegos();
    uasort($coleccion,'micmp');
    print_r($coleccion);
}

