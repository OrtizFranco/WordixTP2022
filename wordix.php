<?php

/*
La librería JugarWordix posee la definición de constantes y funciones necesarias
para jugar al Wordix.
Puede ser utilizada por cualquier programador para incluir en sus programas.
*/

/**************************************/
/***** DEFINICION DE CONSTANTES *******/
/**************************************/
const CANT_INTENTOS = 6;

/*
    disponible: letra que aún no fue utilizada para adivinar la palabra
    encontrada: letra descubierta en el lugar que corresponde
    pertenece: letra descubierta, pero corresponde a otro lugar
    descartada: letra descartada, no pertence a la palabra
*/
const ESTADO_LETRA_DISPONIBLE = "disponible";
const ESTADO_LETRA_ENCONTRADA = "encontrada";
const ESTADO_LETRA_DESCARTADA = "descartada";
const ESTADO_LETRA_PERTENECE = "pertenece";

/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 *  @param int $min;
 *  @param int $max;
 *  @return int;
 * Solicita y verifica un numero entre un rango de valores determinado. 
 */
function solicitarNumeroEntre($min, $max)
{
    //int $numero
    $numero = trim(fgets(STDIN));
    while (!is_int($numero) && !($numero >= $min && $numero <= $max)) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}

/**
 * Escrbir un texto en color ROJO
 * @param string $texto)
 */
function escribirRojo($texto)
{
    echo "\e[1;37;41m $texto \e[0m";
}

/**
 * Escrbir un texto en color VERDE
 * @param string $texto)
 */
function escribirVerde($texto)
{
    echo "\e[1;37;42m $texto \e[0m";
}

/**
 * Escrbir un texto en color AMARILLO
 * @param string $texto)
 */
function escribirAmarillo($texto)
{
    echo "\e[1;37;43m $texto \e[0m";
}

/**
 * Escrbir un texto en color GRIS
 * @param string $texto)
 */
function escribirGris($texto)
{
    echo "\e[1;34;47m $texto \e[0m";
}

/**
 * Escrbir un texto pantalla.
 * @param string $texto)
 */
function escribirNormal($texto)
{
    echo "\e[0m $texto \e[0m";
}

/**
 * Escribe un texto en pantalla teniendo en cuenta el estado.
 * @param string $texto
 * @param string $estado
 */
function escribirSegunEstado($texto, $estado)
{
    switch ($estado) {
        case ESTADO_LETRA_DISPONIBLE:
            escribirNormal($texto);
            break;
        case ESTADO_LETRA_ENCONTRADA:
            escribirVerde($texto);
            break;
        case ESTADO_LETRA_PERTENECE:
            escribirAmarillo($texto);
            break;
        case ESTADO_LETRA_DESCARTADA:
            escribirRojo($texto);
            break;
        default:
            echo " $texto ";
            break;
    }
}

/**
 * ****COMPLETAR*****
 */
function escribirMensajeBienvenida($usuario)
{
    echo "***************************************************\n";
    echo "** Hola ";
    escribirAmarillo($usuario);
    echo " Juguemos una PARTIDA de WORDIX! **\n";
    echo "***************************************************\n";
}


/**
 * Cuenta los caracteres que se encuentran en la palabra 
 * @param string $cadena
 * @return bool
 */
function esPalabra($cadena)
{
    //int $cantCaracteres, $i, boolean $esLetra
    $cantCaracteres = strlen($cadena);
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]);
        $i++;
    }
    return $esLetra;
}

/**
 * Detecta si la palabra ingresada es de 5 letras, en caso contrario te solicita una palabra de 5 letras
 * @return String
 */
function leerPalabra5Letras()
{
    //string $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = trim(fgets(STDIN));
    $palabra  = strtoupper($palabra);

    while ((strlen($palabra) != 5) || !esPalabra($palabra)) {
        echo "Debe ingresar una palabra de 5 letras:";
        $palabra = strtoupper(trim(fgets(STDIN)));
    }
    return $palabra;
}


/**
 * Inicia una estructura de datos Teclado. La estructura es de tipo: ¿Indexado, asociativo o Multidimensional?
 *@return array
 */
function iniciarTeclado()
{
    //array $teclado (arreglo asociativo, cuyas claves son las letras del alfabeto)
    $teclado = [
        "A" => ESTADO_LETRA_DISPONIBLE, "B" => ESTADO_LETRA_DISPONIBLE, "C" => ESTADO_LETRA_DISPONIBLE, "D" => ESTADO_LETRA_DISPONIBLE, "E" => ESTADO_LETRA_DISPONIBLE,
        "F" => ESTADO_LETRA_DISPONIBLE, "G" => ESTADO_LETRA_DISPONIBLE, "H" => ESTADO_LETRA_DISPONIBLE, "I" => ESTADO_LETRA_DISPONIBLE, "J" => ESTADO_LETRA_DISPONIBLE,
        "K" => ESTADO_LETRA_DISPONIBLE, "L" => ESTADO_LETRA_DISPONIBLE, "M" => ESTADO_LETRA_DISPONIBLE, "N" => ESTADO_LETRA_DISPONIBLE, "Ñ" => ESTADO_LETRA_DISPONIBLE,
        "O" => ESTADO_LETRA_DISPONIBLE, "P" => ESTADO_LETRA_DISPONIBLE, "Q" => ESTADO_LETRA_DISPONIBLE, "R" => ESTADO_LETRA_DISPONIBLE, "S" => ESTADO_LETRA_DISPONIBLE,
        "T" => ESTADO_LETRA_DISPONIBLE, "U" => ESTADO_LETRA_DISPONIBLE, "V" => ESTADO_LETRA_DISPONIBLE, "W" => ESTADO_LETRA_DISPONIBLE, "X" => ESTADO_LETRA_DISPONIBLE,
        "Y" => ESTADO_LETRA_DISPONIBLE, "Z" => ESTADO_LETRA_DISPONIBLE
    ];
    return $teclado;
}

/**
 * Escribe en pantalla el estado del teclado. Acomoda las letras en el orden del teclado QWERTY
 * @param array $teclado
 */
function escribirTeclado($teclado)
{
    //array $ordenTeclado (arreglo indexado con el orden en que se debe escribir el teclado en pantalla)
    //string $letra, $estado
    $ordenTeclado = [
        "salto",
        "Q", "W", "E", "R", "T", "Y", "U", "I", "O", "P", "salto",
        "A", "S", "D", "F", "G", "H", "J", "K", "L", "salto",
        "Z", "X", "C", "V", "B", "N", "M", "salto"
    ];

    foreach ($ordenTeclado as $letra) {
        switch ($letra) {
            case 'salto':
                echo "\n";
                break;
            default:
                $estado = $teclado[$letra];
                escribirSegunEstado($letra, $estado);
                break;
        }
    }
    echo "\n";
};


/**
 * Escribe en pantalla los intentos de Wordix para adivinar la palabra
 * @param array $estruturaIntentosWordix
 */
function imprimirIntentosWordix($estructuraIntentosWordix)
{
    $cantIntentosRealizados = count($estructuraIntentosWordix);
    //$cantIntentosFaltantes = CANT_INTENTOS - $cantIntentosRealizados;

    for ($i = 0; $i < $cantIntentosRealizados; $i++) {
        $estructuraIntento = $estructuraIntentosWordix[$i];
        echo "\n" . ($i + 1) . ")  ";
        foreach ($estructuraIntento as $intentoLetra) {
            escribirSegunEstado($intentoLetra["letra"], $intentoLetra["estado"]);
        }
        echo "\n";
    }

    for ($i = $cantIntentosRealizados; $i < CANT_INTENTOS; $i++) {
        echo "\n" . ($i + 1) . ")  ";
        for ($j = 0; $j < 5; $j++) {
            escribirGris(" ");
        }
        echo "\n";
    }
    //echo "\n" . "Le quedan " . $cantIntentosFaltantes . " Intentos para adivinar la palabra!";
}

/**
 * Dada la palabra wordix a adivinar, la estructura para almacenar la información del intento 
 * y la palabra que intenta adivinar la palabra wordix.
 * devuelve la estructura de intentos Wordix modificada con el intento.
 * @param string $palabraWordix
 * @param array $estruturaIntentosWordix
 * @param string $palabraIntento
 * @return array estructura wordix modificada
 */
function analizarPalabraIntento($palabraWordix, $estruturaIntentosWordix, $palabraIntento)
{
    $cantCaracteres = strlen($palabraIntento);
    $estructuraPalabraIntento = []; /*almacena cada letra de la palabra intento con su estado */
    for ($i = 0; $i < $cantCaracteres; $i++) {
        $letraIntento = $palabraIntento[$i];
        $posicion = strpos($palabraWordix, $letraIntento);
        if ($posicion === false) {
            $estado = ESTADO_LETRA_DESCARTADA;
        } else {
            if ($letraIntento == $palabraWordix[$i]) {
                $estado = ESTADO_LETRA_ENCONTRADA;
            } else {
                $estado = ESTADO_LETRA_PERTENECE;
            }
        }
        array_push($estructuraPalabraIntento, ["letra" => $letraIntento, "estado" => $estado]);
    }

    array_push($estruturaIntentosWordix, $estructuraPalabraIntento);
    return $estruturaIntentosWordix;
}

/**
 * Actualiza el estado de las letras del teclado. 
 * Teniendo en cuenta que una letra sólo puede pasar:
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_ENCONTRADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_DESCARTADA, 
 * de ESTADO_LETRA_DISPONIBLE a ESTADO_LETRA_PERTENECE
 * de ESTADO_LETRA_PERTENECE a ESTADO_LETRA_ENCONTRADA
 * @param array $teclado
 * @param array $estructuraPalabraIntento
 * @return array el teclado modificado con los cambios de estados.
 */
function actualizarTeclado($teclado, $estructuraPalabraIntento)
{
    foreach ($estructuraPalabraIntento as $letraIntento) {
        $letra = $letraIntento["letra"];
        $estado = $letraIntento["estado"];
        switch ($teclado[$letra]) {
            case ESTADO_LETRA_DISPONIBLE:
                $teclado[$letra] = $estado;
                break;
            case ESTADO_LETRA_PERTENECE:
                if ($estado == ESTADO_LETRA_ENCONTRADA) {
                    $teclado[$letra] = $estado;
                }
                break;
        }
    }
    return $teclado;
}

/**
 * Determina si se ganó una palabra intento posee todas sus letras "Encontradas".
 * @param array $estructuraPalabraIntento
 * @return bool
 */
function esIntentoGanado($estructuraPalabraIntento)
{
    $cantLetras = count($estructuraPalabraIntento);
    $i = 0;

    while ($i < $cantLetras && $estructuraPalabraIntento[$i]["estado"] == ESTADO_LETRA_ENCONTRADA) {
        $i++;
    }

    if ($i == $cantLetras) {
        $ganado = true;
    } else {
        $ganado = false;
    }

    return $ganado;
}

/**
 * Calcula el puntaje que se obtuvo en una partida de WORDIX
 * @param int $nroIntentos
 * @param int $palabraWordix
 * @return int 
 */
function obtenerPuntajeWordix($nroIntentos,$palabraWordix)  
{
    $puntajeFinal = 0;

    switch ($nroIntentos) {
        case 1:
            $puntajeFinal=6;
            break;
        
        case 2:
            $puntajeFinal=5;
            break;

        case 3:
            $puntajeFinal=4;
            break;

        case 4:
            $puntajeFinal=3;
            break;

        case 5:
            $puntajeFinal=2;
            break;

        case 6:
            $puntajeFinal=1;
            break;
        }
        $cantCaracteres = strlen($palabraWordix);
        $i = 0;
        while ($i < $cantCaracteres) {
            if ($palabraWordix[$i] == "a" || "e" || "i" || "o" || "u"){
                $puntajeFinal=$puntajeFinal+1;
            }else{
                if ($palabraWordix[$i]<="m") {
                    $puntajeFinal = $puntajeFinal+2;
                }else{
                    $puntajeFinal = $puntajeFinal+3;
                }
            }
            $i++;
        }

    
    
    return $puntajeFinal;
}
/**
 * Dada una palabra para adivinar, juega una partida de wordix intentando que el usuario adivine la palabra.
 * @param string $palabraWordix
 * @param string $nombreUsuario
 * @return array estructura con el resumen de la partida, para poder ser utilizada en estadísticas.
 */
function jugarWordix($palabraWordix, $nombreUsuario)
{
    /*Inicialización*/
    $arregloDeIntentosWordix = [];
    $teclado = iniciarTeclado();
    escribirMensajeBienvenida($nombreUsuario);
    $nroIntento = 1;
    do {

        echo "Comenzar con el Intento " . $nroIntento . ":\n";
        $palabraIntento = leerPalabra5Letras();
        $indiceIntento = $nroIntento - 1;
        $arregloDeIntentosWordix = analizarPalabraIntento($palabraWordix, $arregloDeIntentosWordix, $palabraIntento);
        $teclado = actualizarTeclado($teclado, $arregloDeIntentosWordix[$indiceIntento]);
        /*Mostrar los resultados del análisis: */
        imprimirIntentosWordix($arregloDeIntentosWordix);
        escribirTeclado($teclado);
        /*Determinar si la plabra intento ganó e incrementar la cantidad de intentos */

        $ganoElIntento = esIntentoGanado($arregloDeIntentosWordix[$indiceIntento]);
        $nroIntento++;
    } while ($nroIntento <= CANT_INTENTOS && !$ganoElIntento);


    if ($ganoElIntento) {
        $nroIntento--;
        $puntaje = obtenerPuntajeWordix($nroIntento,$palabraWordix);
        echo "Adivinó la palabra Wordix en el intento " . $nroIntento . "!: " . $palabraIntento . " Obtuvo $puntaje puntos!";
    } else {
        $nroIntento = 0; //reset intento
        $puntaje = 0;
        echo "Seguí Jugando Wordix, la próxima será! ";
    }

    $partida = [
        "palabraWordix" => $palabraWordix,
        "jugador" => $nombreUsuario,
        "intentos" => $nroIntento,
        "puntaje" => $puntaje
    ];

    return $partida;
}

/**
 * MODULO 3
 * Muestra en pantalla el menu de opiones de WORDIX, previamente definido
 * @return int;
 */
function seleccionarOpcion (){
    echo ("
    1) Jugar al Wordix con una palabra elegida\n
    2) Jugar al Wordix con una palabra aleatoria\n
    3) Mostrar una partida\n
    4) Mostrar la primer partida ganadora\n
    5) Mostrar resumen de Jugador\n
    6) Mostrar listado de partidas ordenadas por jugador y por palabra\n
    7) Agregar una palabra de 5 letras a Wordix\n
    8) Salir\n
    ");
    $num=solicitarNumeroEntre(1,8);
    return $num;
}

/**
 * MODULO 2
 * Obtiene una colección de partidas
 * @return array
 */
function cargarPartidas()
{
    $datosPartida1 = [ "palabraWordix" => "QUESO",
                        "jugador" => "majo",
                        "intentos" => 0,
                        "puntaje" => 0] ;

    $datosPartida2 = [ "palabraWordix" => "CASAS",
                        "jugador" => "rudolf",
                        "intentos" => 3,
                        "puntaje" => 14] ;

    $datosPartida3 = [ "palabraWordix" => "QUESO",
                        "jugador" => "pink200",
                        "intentos" => 6,
                        "puntaje" => 10] ;    
                        
    $datosPartida4 = [ "palabraWordix" => "MESSI",
                        "jugador" => "majo",
                        "intentos" => 2,
                        "puntaje" => 15] ;

    $datosPartida5 = [ "palabraWordix" => "QUESO",
                        "jugador" => "nacho",
                        "intentos" => 3,
                        "puntaje" => 14] ;

    $datosPartida6 = [ "palabraWordix" => "YERBA",
                        "jugador" => "joaco",
                        "intentos" => 6,
                        "puntaje" => 10] ;

    $datosPartida7 = [ "palabraWordix" => "AVION",
                        "jugador" => "joaco",
                        "intentos" => 2,
                        "puntaje" => 15] ;

    $datosPartida8 = [ "palabraWordix" => "MESSI",
                        "jugador" => "majo",
                        "intentos" => 3,
                        "puntaje" => 12] ;

    $datosPartida9 = [ "palabraWordix" => "GATOS",
                        "jugador" => "juli",
                        "intentos" => 1,
                        "puntaje" => 17] ;

    $datosPartida10 = [ "palabraWordix" => "GATOS",
                        "jugador" => "franco",
                        "intentos" => 6,
                        "puntaje" => 10] ;


    $coleccionPartidas = [];
    $coleccionPartidas  [0] = $datosPartida1;
    $coleccionPartidas  [1] = $datosPartida2;
    $coleccionPartidas  [2] = $datosPartida3;
    $coleccionPartidas  [3] = $datosPartida4;
    $coleccionPartidas  [4] = $datosPartida5;
    $coleccionPartidas  [5] = $datosPartida6;
    $coleccionPartidas  [6] = $datosPartida7;
    $coleccionPartidas  [7] = $datosPartida8;
    $coleccionPartidas  [8] = $datosPartida9;
    $coleccionPartidas  [9] = $datosPartida10;
    
  

    return ($coleccionPartidas);
}
/**
 * Modulo 7
 * @param array $coleccionPalabras;
 * @param string $palabra;
 * @return array;
 * Este modulo agrega una palabra a una lista de palabras;
 */
function agregarPalabra($coleccionPalabras,$palabra){
    array_push($coleccionPalabras ,$palabra);
    return $coleccionPalabras;
}
/**
 * Modulo 8
 * @param array $coleccionPartidas;
 * @param string $nombreUsuario;
 * Muestra el indice de la primer partida que gano el usuario ingresado. Si no hay dicha partida, muestra -1
 */
function primerPartidaGanada($coleccionPartidas,$nombreUsuario){
    //int $i,$n;
    //bool $bandera;
    $i=0;
    $n=count($coleccionPartidas);
    $bandera = true; 
    while(($i<$n)&&($bandera)){
        if(($coleccionPartidas[$i]["jugador"]==$nombreUsuario)&&($coleccionPartidas[$i]["puntaje"]>0)){
            $bandera=false;
        }
        $i++;
    }
    if($bandera){
        echo "-1";
    }else{
        echo $i;
    }
    
}
/**
 * Modulo 9
 * @param array $coleccionPartidas;
 * @param string $nombreUsuario;
 * Solicita coleccion de partidas y nombre de usuario para devolver el resumen de partidas del mismo
 **/
function mostrarResumen($coleccionPartidas,$nombreUsuario){
    //$int $partidas,$partidasGanadas,$acumPuntaje,$intento1,$intento2,$intento3,$intento4,$intento5,$intento6,$n,$i
    $partidas=0;
    $partidasGanadas= 0;
    $acumPuntaje=0;
    $intento1=0;
    $intento2=0;
    $intento3=0;
    $intento4=0;
    $intento5=0;
    $intento6=0;
    $n= count($coleccionPartidas);
    for($i=0;$i<$n;$i++){
        if($coleccionPartidas[$i]["jugador"]==$nombreUsuario){
            $partidas++;
            $acumPuntaje= $acumPuntaje + $coleccionPartidas[$i]["puntaje"];
            if($coleccionPartidas[$i]["puntaje"]>0){
                $partidasGanadas++;
                switch($coleccionPartidas[$i]["intentos"]){
                    case 1: $intento1++;
                        break;
                    case 2: $intento2++;
                        break;
                    case 3: $intento3++;
                        break;
                    case 4: $intento4++;
                        break;
                    case 5: $intento5++;
                        break;
                    case 6: $intento6++;
                        break;
                }
            }
        }
    }   echo ("\nJugador: ".$nombreUsuario."\n" .
                "Partidas: ".$partidas."\n" .
                "Puntaje Total: ".$acumPuntaje."\n". 
                "Victorias : " .$partidasGanadas."\n".
                "Porcentaje de victorias: ".round(($partidasGanadas*100)/$partidas)."%\n".
                "Adivinadas: "."\n".
                "   Intento 1:".$intento1."\n".
                "   Intento 2:".$intento2."\n".
                "   Intento 3:".$intento3."\n".
                "   Intento 4:".$intento4."\n".
                "   Intento 5:".$intento5."\n".
                "   Intento 6:".$intento6."\n");
    
    //$resumenJugadores=[];
        //$resumenJugadores[0]= [ "jugador" => $nombreUsuario,"partidas" => $partidas,"puntaje" => $acumPuntaje,"victorias" => $partidasGanadas,"intento1" => $intento1,"intento2" => $intento2,"intento3" => $intento3,"intento4" => $intento4,"intento5" => $intento5,"intento6" => $intento6,] ;
        //return $resumenJugadores;
    }



/**
 * MODULO 6
 * Solicita un numero de partida para visualizarla
 */
function mostrarPartidas()
{
    //$coleccionPartidasss = array();
    //int $numeroPartida,$puntajeWordix,$intentosWordix;
    //String $palabraWordix,$nombreUsuarioWordix;
    $coleccionPartidasss = cargarPartidas();
    echo("Ingrese un numero de partida para visualizarla: ");
    $numeroPartida = solicitarNumeroEntre(0,count($coleccionPartidasss));
    $palabraWordix = $coleccionPartidasss [$numeroPartida] ["palabraWordix"];
    $nombreUsuarioWoridx = $coleccionPartidasss [$numeroPartida] ["jugador"];
    $puntajeWordix = $coleccionPartidasss [$numeroPartida] ["puntaje"];
    $intentosWordix= $coleccionPartidasss [$numeroPartida] ["intentos"];

    if ($intentosWordix == 0){
        $intentosWordix = "No adivino la palabra";
    }

    echo ("\nPartida WORDIX " . $numeroPartida .": palabra ". $palabraWordix . "\n" .
           "Jugador: ". $nombreUsuarioWoridx . "\n" .
            "Puntaje: ". $puntajeWordix . "\n". 
            "Intento : " . $intentosWordix . "\n");

    
}

/**
 * MODULO 10
 * Solicita un nombre de usuario, verifica que este comience con una letra y devuelve el nombre en minisculas
 * @return string
 */
function solicitarJugador()
{
    /*  String $nombreUsuario / Bool $esLetra */
    echo ("Ingrese su nombre de usuario: ");
    $nombreUsuario = trim(fgets(STDIN));
    $esLetra = !(ctype_alpha($nombreUsuario[0]));

while ($esLetra){
    echo "Su nombre de usuario debe comenzar con una letra, ingrese nuevamente su nombre de usuario: ";
    $nombreUsuario = trim(fgets(STDIN));
    $esLetra = !(ctype_alpha($nombreUsuario[0]));
}
    strtolower ($nombreUsuario);
return ($nombreUsuario);}
/**
 * Modulo 11
 * @param array $coleccionPartidas;
 * uasort es una funcion que nos permite ordenar un arreglo mediante otra funcion de comparacion definida por nostoros.
 * Muestra muestra de forma ordenada,alfabeticamente, un arreglo de partidas
 */
function mostrarColeccionPartidasOrdenada($coleccionPartidas){
    $n=count($coleccionPartidas);
    $arreglo = [];
   
    for($i=0;$i<$n;$i++){
       $arreglo[$i] = ["jugador" => $coleccionPartidas[$i]["jugador"],"palabra" => $coleccionPartidas[$i]["palabraWordix"]];
    }
    uasort($arreglo,'cmp');
    print_r($arreglo);
}

function cmp($a,$b){
    if($a==$b){
        $orden=0;
    }elseif($a<$b){
        $orden=-1;
    }else{
        $orden=1;
    }
    return $orden;
}