<?php
$conn = mysqli_connect("localhost", "root", "", "ryzyk_fizyk");
if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

$userNames = ['alan', 'kebab']; // Example usernames
$answers = []; // Array to store answers

// Check if a user has submitted an answer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answers'])) {
    $answers = $_POST['answers']; // Get all answers from the form
}

// Sort answers in ascending order
if (!empty($answers)) {
    asort($answers); // Sort the answers while maintaining key association
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
                form.style.display = 'none'; // Hide all user forms
            });
        }
    </script>
</head>
<body>
    <h1>Ryzyk fizyk</h1>

    <div id="lewy">
        <h4 id="question">Treść pytania</h4>

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
        
    <div id="prawy">
        <?php if (!empty($answers)): ?>
            <div>
                <?php foreach ($answers as $user => $answer): ?>
                    <button><?php echo htmlspecialchars($answer); ?></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
