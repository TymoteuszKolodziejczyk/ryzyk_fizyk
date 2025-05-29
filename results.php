<?php
session_start();

// Check if bets are set
$bets = isset($_SESSION['bets']) ? $_SESSION['bets'] : [];

// Reset session values for a new game
if (isset($_POST['reset'])) {
    session_destroy(); // Destroy the session to reset all values
    header("Location: gra.php"); // Redirect to gra.php
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div class="box" style="width: 30%; margin: auto; text-align: center;">
        <h1>Wyniki</h1>
        <?php if (!empty($bets)): ?>
            <ul>
                <?php foreach ($bets as $user => $bet): ?>
                    <li><?php echo htmlspecialchars($user); ?> postawił <?php echo htmlspecialchars($bet['amount']); ?> tokeny na liczbę <?php echo htmlspecialchars($bet['number']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Brak zakładów do wyświetlenia.</p>
        <?php endif; ?>
    </div>

    <div class="box" style="width: 30%; margin: auto; text-align: center; margin-top: 20px;">
        <form action="results.php" method="post">
            <input type="submit" name="reset" value="Powrót do gry" style="background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">
        </form>
    </div>
</body>
</html>
