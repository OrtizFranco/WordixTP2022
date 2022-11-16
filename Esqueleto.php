<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/
/* de la fuente Ignacio / FAI-4291 / TUDW / benjamindelafuente03@gmail.com / Chasli
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

$coleccionPalabras = cargarColeccionPalabras();
$coleccionPartidasJugadas = cargarPartidas();




do {

    $opcion = seleccionarOpcion();

    
    switch ($opcion) {
        case 1: 
            echo ("Ingrese su nombre de usuario: ");
            $nombreUsuario = trim(fgets(STDIN));
            echo ("Ingrese un numero de palabra a jugar: ");
            ##$numPalabraAJugar = trim(fgets((STDIN))); 
            $num12 = solicitarNumeroEntre(0,count($coleccionPalabras));
            $partida = jugarWordix($coleccionPalabras[$num12], strtolower($nombreUsuario));
            $nuevoIndice = count($coleccionPartidasJugadas);
            $coleccionPartidasJugadas [$nuevoIndice] = $partida;
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            echo ("Ingrese su nombre de usuario: ");
            $nombreUsuario = trim(fgets(STDIN));
            $numeroAleatorio = rand(0,count($coleccionPalabras)); 
            $partida = jugarWordix($coleccionPalabras[$numeroAleatorio], strtolower($nombreUsuario));
            $nuevoIndice = count($coleccionPartidasJugadas);
            $coleccionPartidasJugadas [$nuevoIndice] = $partida;
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            ##echo("Ingrese un numero de partida para visualizarla: ");
            mostrarPartidas();
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        case 4:
            echo ("Ingrese un nombre de usuario para visualizar el primer juego ganado del mismo: ");
            $nombreUsuarioPrimerJuegoGanado= trim(fgets(STDIN));

            break;
        case 5:
            echo ("Ingrese un nombre de usuario para visualizar sus estadisticas durante el juego: ");
            $nombreUsuarioEstadisticas = trim(fgets(STDIN));

            break;
        case 6:


            break;
        case 7:
            leerPalabra5Letras();
            // falta guardar la misma 

            break;
        
            //...
    }
} while ($opcion != 8);