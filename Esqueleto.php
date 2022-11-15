<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/
/* de la fuente Ignacio / FAI-4291 / TUDW / benjamindelafuente03@gmail.com / Chasli
/* COMPLETEN SUS COSAS */
/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */
/* ... COMPLETAR ... */



/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "YERBA", "MESSI", "DULCE", "NARIZ", "AVION"
    ];

    return ($coleccionPalabras);
}

/* ... COMPLETAR ... */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:

/*$partida = jugarWordix("MELON", strtolower("MaJo"));*/
//print_r($partida);
//imprimirResultado($partida);




do {
    /**
 *  Solicita un numero dentro de un rango previamente definido
 * @param float $min
 * @param float $max
 * @return float
 */
/*function solicitarNumeroEntre($min, $max)
{
    //int $numero
    $numero = trim(fgets(STDIN));
    while (!is_int($numero) && !($numero >= $min && $numero <= $max)) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}*/


/**
 * Muestra en pantalla el menu de opiones de WORDIX, previamente definido 
 */
/*function seleccionarOpcion (){
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
}*/


$numeroSeleccionado=seleccionarOpcion();

    $opcion = $numeroSeleccionado;

    
    switch ($opcion) {
        case 1: 
            echo ("ingrese su nombre");
            $nombreUsuario = trim(fgets(STDIN));
            /*echo ("Ingrese un numero de palabra a jugar: ");
            $numPalabraAJugar = trim(fgets((STDIN)));
            $palabraAJugar= cargarColeccionPalabras($numPalabraAJugar);*/

            
            $partida = jugarWordix("MESSI", strtolower($nombreUsuario));
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            echo ("nono");
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != 8);

