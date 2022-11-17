<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/
/* de la fuente Ignacio / FAI-4291 / TUDW / benjamindelafuente03@gmail.com / Chasli
/* Calvin Basualto Joaquin / FAI-4227 / TUDW / joaquin_calvin02@hotmail.com / JoaquinCalvin
/* Contreras Francisco Julian / FAI-1733 / TUDW / contrerasfjulian.1732@gmail.com / JulianContreras
/* Datos del francou
/* Apellido, Nombre. Legajo. Carrera. mail. Usuario Github */



/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

/**
 * Modulo 1
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




/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
// String $nombreUsuario, $nombreUsuarioPrimerJuegoGanado, $nombreUsuarioEstadisticas, $palabra, 
// Array $partida, $resumen, $arregloOrdenado
// Int $nuevoIndice,$numeroPalabraAJugar


//Inicialización de variables:
$coleccionPalabras = cargarColeccionPalabras();
$coleccionPartidasJugadas = cargarPartidas();


//Proceso:

/*$partida = jugarWordix("MELON", strtolower("MaJo"));*/
//print_r($partida);
//imprimirResultado($partida);






do {

    $opcion = seleccionarOpcion();

    
    switch ($opcion) {
        case 1: 
            $nombreUsuario = solicitarJugador();
            echo ("Ingrese un numero de palabra a jugar: ");
            $numeroPalabraAJugar = solicitarNumeroEntre(0,count($coleccionPalabras));
            $partida = jugarWordix($coleccionPalabras[$numeroPalabraAJugar], $nombreUsuario);
            $nuevoIndice = count($coleccionPartidasJugadas);
            $coleccionPartidasJugadas [$nuevoIndice] = $partida;
            

            break;
        case 2: 
            $nombreUsuario = solicitarJugador();
            $numeroAleatorio = rand(0,count($coleccionPalabras)); 
            $partida = jugarWordix($coleccionPalabras[$numeroAleatorio], $nombreUsuario);
            $nuevoIndice = count($coleccionPartidasJugadas);
            $coleccionPartidasJugadas [$nuevoIndice] = $partida;
            

            break;
        case 3: 
            ##echo("Ingrese un numero de partida para visualizarla: ");
            mostrarPartidas();
            

            break;
        case 4:
            echo ("Ingrese un nombre de usuario para visualizar el primer juego ganado del mismo: ");
            $nombreUsuarioPrimerJuegoGanado= trim(fgets(STDIN));
            primerPartidaGanada($coleccionPartidasJugadas,$nombreUsuarioPrimerJuegoGanado);


            break;
        case 5:
            echo ("Ingrese un nombre de usuario para visualizar sus estadisticas durante el juego: ");
            $nombreUsuarioEstadisticas = trim(fgets(STDIN));
            $resumen= mostrarResumen($coleccionPartidasJugadas,$nombreUsuarioEstadisticas);
            print_r($resumen);
            break;
        case 6:
            //uasort($coleccionPartidasJugadas,'cmp');
            mostrarColeccionPartidasOrdenada($coleccionPartidasJugadas);
            break;
        case 7:
            $palabra = leerPalabra5Letras();
            $coleccionPalabras = agregarPalabra($coleccionPalabras,$palabra);
             

            break;
        
            
    }
} while ($opcion != 8);