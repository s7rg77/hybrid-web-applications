<?php
if(isset($_GET['pokemonName'])) {
    $pokemonName = $_GET['pokemonName'];
    echo getPokemonData($pokemonName);
}

/**
 * Recupera datos de un Pokémon de la API PokeAPI según el nombre proporcionado.
 *
 * @param string $pokemonName El nombre del Pokémon del que se desea obtener información.
 * @return string JSON que contiene los datos del Pokémon si se encuentra, 
 * o un mensaje de error si no se encuentran datos.
 */
function getPokemonData($pokemonName) {
    $apiUrl = "https://pokeapi.co/api/v2/pokemon/{$pokemonName}";
    $r = file_get_contents($apiUrl);
    if ($r !== false) {
        $pokemonData = json_decode($r, true);
        return json_encode($pokemonData);
    } else {
        return json_encode(['error' => 'error datos']);
    }
}
?>