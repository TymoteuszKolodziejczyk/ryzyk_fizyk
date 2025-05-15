<?php
	$conn =  mysqli_connect("localhost", "root", "", "ryzyk_fizyk");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ryzyk fizyk</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
    <link href="img/logo.png" rel="icon">
    <link href="img/logo.png" rel="apple-touch-icon">
</head>
<body>
    <h1>Ryzyk fizyk</h1>
    <div id="start">
        <h2>Krok 1: Podaj liczbę graczy</h3>
        <input type="number" name="l_graczy" id="l_graczy" min="2" max="10">
        <button id="btnLGraczy">Zatwierdź</button>
        <div id="divNazwyGraczy" style="background-color: black; visibility: hidden">
            <h3>Wprowadź nazwy graczy:</h3>
            <form id="formGracze" action="javascript:;" onsubmit="formGraczeSubmit( this )">
            
            </form> 
        </div>
    </div>
</body>
<script src="script.js" defer></script>
</html>

<?php
	mysqli_close($conn);
?>