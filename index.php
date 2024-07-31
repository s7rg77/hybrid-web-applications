<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hybrid web applications</title>
    <style>
        body {
            margin: 0px;
            padding: 0px;
            background-color: lightgreen;
            font-family: 'Comic Sans MS';
        }

        header {
            margin: 10px 0px;
            height: 125px;
            background-image: url('bg.jpg');
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
        }

        h1 {
            margin-left: 200px;
            color: white;
            font-weight: normal;
            text-shadow: 2px 2px 2px black;
        }

        #head {
            margin-top: 10px;
            margin-right: 10px;
            display: flex;
            justify-content: flex-end;
        }

        .home,
        .doc,
        .git {
            margin-left: 10px;
            width: 100px;
        }

        .list select {
            margin-left: 10px;
            padding: 5px;
            font-size: large;
        }

        button {
            padding: 5px;
            border: none;
            background-color: grey;
            color: white;
            cursor: pointer;
            transition: background-color 0.5s;
        }

        button:hover {
            background-color: lightgrey;
        }

        #info {
            margin-left: 50px;
            font-size: large;
            font-weight: bold;
        }

        footer {
            bottom: 0px;
            width: 100%;
            background-color: grey;
            color: white;
            text-align: center;
            position: fixed;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function () {
    $("#select").on("change", function () {
        var selectedPokemon = $(this).val();
        if (selectedPokemon.trim() !== '') {
            getPokemonData(selectedPokemon);
        }
    });
    function getPokemonData(pokemonName) {
        $.ajax({
            url: "get_pokemon.php",
            type: "GET",
            data: {
                pokemonName: pokemonName
            },
            dataType: "json",
            success: function (data) {
                displayPokemonInfo(data);
            },
        });
    }
    function displayPokemonInfo(pokemonData) {
        $("#info").html(`
            <p><strong>nombre:</strong> ${pokemonData.name}</p>
            <p><strong>altura:</strong> ${pokemonData.height}</p>
            <p><strong>peso:</strong> ${pokemonData.weight}</p>
            <p><strong>experiencia base:</strong> ${pokemonData.base_experience}</p>
            <p><strong>habilidades:</strong> ${pokemonData.abilities.map(ability => 
                ability.ability.name).join(', ')}</p>
            <img src="${pokemonData.sprites.front_default}" alt="img">
        `);
    }
    });

    function goHome() {

        window.location.href = '/';

    }

    function goGit() {

        window.location.href = 'https://github.com/s7rg77/hybrid-web-applications';

    }

    function goDoc() {

        window.location.href = '/doc';

    }
    </script>
</head>

<body>
    <div id="head">
        <button class="doc" onclick="goDoc()">doc</button>
        <button class="git" onclick="goGit()">git</button>
        <button class="home" onclick="goHome()">back</button>
    </div>
    <header>
    <h1>selecciona pokemon</h1>
    </header>
    <div class="list">
        <select id="select">
            <option value=""></option>
            <?php
            $pokemonNames = file_get_contents('https://pokeapi.co/api/v2/pokemon?limit=151');
            $pokemonNames = json_decode($pokemonNames, true);
            foreach ($pokemonNames['results'] as $pokemon) {
                echo "<option value='" . $pokemon['name'] 
                . "'>" . ucfirst($pokemon['name']) . "</option>";
            }
            ?>
        </select>
    </div>
    <div id="info"></div>
</body>

<footer>
    <h3>desarrollo web entorno servidor</h3>
</footer>

</html>