<?php

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

