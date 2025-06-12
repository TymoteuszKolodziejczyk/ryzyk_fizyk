<?php
session_start();
$bets = isset($_SESSION['bets']) ? $_SESSION['bets'] : [];
$answers = isset($_SESSION['answers']) ? $_SESSION['answers'] : [];

// Retrieve the current question index
$currentQuestionIndex = $_SESSION['current_question_index'];
$questions = [
    ["question" => "What is the capital of France?", "answer" => 1],
    ["question" => "What is 2 + 2?", "answer" => 4],
    ["question" => "What is the largest planet in our solar system?", "answer" => 5],
    // Add more questions and answers as needed
];

// Check if the current question index is valid
$currentAnswer = null;
if ($currentQuestionIndex >= 0 && $currentQuestionIndex < count($questions)) {
    $currentAnswer = $questions[$currentQuestionIndex]['answer'];
}

// Calculate points for each player based on their bets
$points = [];
foreach ($bets as $user => $bet) {
    if ($bet['number'] < $currentAnswer) {
        // Calculate points based on the difference and the amount bet
        $points[$user] = ($currentAnswer - $bet['number']) * $bet['amount'];
    } else {
        $points[$user] = 0; // No points if the bet is not below the answer
    }
}

// Clear bets after displaying results
unset($_SESSION['bets']);
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
                    <li><?php echo htmlspecialchars($user); ?> postawił <?php echo htmlspecialchars($bet['amount']); ?> tokeny na liczbę <?php echo htmlspecialchars($bet['number']); ?>. 
                    Punkty: <?php echo isset($points[$user]) ? htmlspecialchars($points[$user]) : 0; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Brak zakładów do wyświetlenia.</p>
        <?php endif; ?>
    </div>

    <?php if ($currentQuestionIndex >= count($questions)): ?>
        <div class="box" style="width: 30%; margin: auto; text-align: center; margin-top: 20px;">
            <h2>Koniec gry!</h2>
            <p>Dziękujemy za grę!</p>
        </div>
    <?php else: ?>
        <div class="box" style="width: 30%; margin: auto; text-align: center; margin-top: 20px;">
            <form action="gra.php" method="get">
                <input type="hidden" name="next_question" value="1"> <!-- Hidden field to indicate fetching the next question -->
                <input type="submit" value="Zadaj następne pytanie" style="background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">
            </form>
        </div>
    <?php endif; ?>
</body>
</html>
<?php print_r($_SESSION);?>