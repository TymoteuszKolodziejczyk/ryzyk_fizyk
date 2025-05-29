<?php
$conn = mysqli_connect("localhost", "root", "", "ryzyk_fizyk");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


///sdusdhfyweyf7asb7r6v7nayvbuasastr6vbsub6v6sv6sv7iea7u

$userNames = [];
foreach ($_GET as $key => $value) {
    if (strpos($key, 'gracz') === 0) { // Sprawdzenie, czy klucz zaczyna się od 'item'
        $userNames[] = urldecode($value); // Dekodowanie wartości
    }
}

// TODO
// walidacja ilosci graczy
// + zapisywanei graczy do localstorage zeby po odsieweniy strony dzialalo

///sdusdhfyweyf7asb7r6v7nayvbuasastr6vbsub6v6sv6sv7iea7u


//$userNames = ['alan', 'kebab', 'żyd'];
$answers = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answers'])) {
    $answers = $_POST['answers'];
}

if (!empty($answers)) {
    asort($answers);
    // Redirect to voting.php with POST data
    // Since we cannot pass POST data via URL, we will handle it differently
    // You can store the answers in the session or database if needed
    session_start();
    $_SESSION['answers'] = $answers; // Store answers in session
    header("Location: voting.php");
    exit();
}
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
    <script>
        function hideUserForms() {
            const userForms = document.querySelectorAll('.user-form');
            userForms.forEach(form => {
                form.style.display = 'none';
            });
        }
    </script>
</head>
<body>
    <h1>Ryzyk fizyk</h1>

    <div class="box" style="width: 30%; margin: auto; text-align: center;">
        <h2 id="question">Treść pytania</h2>

        <form action="gra.php" method="post" onsubmit="hideUserForms()">
            <?php if (!empty($userNames)): ?>
                <?php foreach ($userNames as $userName): ?>
                    <div class="user-form">
                        <h4><?php echo htmlspecialchars($userName); ?></h4>
                        <input type="password" name="answers[<?php echo htmlspecialchars($userName); ?>]" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Wpisz liczbę" autocomplete="off">
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Brak graczy do wyświetlenia.</p>
            <?php endif; ?>
            <br><br><input type="submit" value="Prześlij">
        </form>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
