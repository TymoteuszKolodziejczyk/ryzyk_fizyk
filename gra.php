<?php
session_start(); // Start the session
$conn = mysqli_connect("localhost", "root", "", "ryzyk_fizyk");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT IdQuestion, Content, Answer FROM questions";
$result = $conn->query($sql);

// Inicjalizacja nowej tablicy
$questions = [];

// Sprawdzanie, czy są wyniki
if ($result->num_rows > 0) {
    // Pobieranie danych i dodawanie do nowej tablicy w odpowiednim formacie
    while ($row = $result->fetch_assoc()) {
        $questions[] = [
            "question" => $row['Content'], // Zakładam, że 'Content' zawiera treść pytania
            "answer" => $row['Answer']      // Zakładam, że 'Answer' zawiera odpowiedź
        ];
    }
} else {
    echo "Brak wyników";
}
var_dump($questions);
// Teraz $questions zawiera pytania w odpowiednim formacie


/*
// Define an array of questions and their corresponding answers
$questions = [
    ["question" => "What is the capital of France?", "answer" => 1], // Example: 1 for Paris
    ["question" => "What is 2 + 2?", "answer" => 4],
    ["question" => "What is the largest planet in our solar system?", "answer" => 5], // Example: 5 for Jupiter
    // Add more questions and answers as needed
];*/

// Store the current question index in the session
if (!isset($_SESSION['current_question_index'])) {
    $_SESSION['current_question_index'] = 0; // Start from the first question
}

// Check if we need to move to the next question
if (isset($_GET['next_question'])) {
    $_SESSION['current_question_index']++;
    
    // Clear the bets array when moving to the next question
    unset($_SESSION['bets']);
}

// Reset the question index if it exceeds the number of questions
if ($_SESSION['current_question_index'] >= count($questions)) {
    $_SESSION['current_question_index'] = -1; // Set to -1 to indicate end of game
}

// Get the current question
$currentQuestion = $_SESSION['current_question_index'] >= 0 ? $questions[$_SESSION['current_question_index']]['question'] : null;
$currentAnswer = $_SESSION['current_question_index'] >= 0 ? $questions[$_SESSION['current_question_index']]['answer'] : null;

// Handle player names
$userNames = [];
foreach ($_GET as $key => $value) {
    if (strpos($key, 'gracz') === 0) { // Check if the key starts with 'gracz'
        $userNames[] = urldecode($value); // Decode the value
    }
}

// Store user names in session
if (!empty($userNames)) {
    $_SESSION['userNames'] = $userNames; // Store user names in session
}

$answers = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answers'])) {
    $answers = $_POST['answers'];
}

if (!empty($answers)) {
    asort($answers);
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
        <?php if ($_SESSION['current_question_index'] >= 0): ?>
            <h2 id="question"><?php echo htmlspecialchars($currentQuestion); ?></h2>

            <form action="gra.php" method="post" onsubmit="hideUserForms()">
                <?php if (!empty($_SESSION['userNames'])): ?>
                    <?php foreach ($_SESSION['userNames'] as $userName): ?>
                        <div class="user-form">
                            <h4><?php echo htmlspecialchars($userName); ?></h4>
                            <input type="number" name="answers[<?php echo htmlspecialchars($user)?>]" required placeholder="Wpisz liczbę" autocomplete="off">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Brak graczy do wyświetlenia.</p>
                <?php endif; ?>
                <br><br><input type="submit" value="Prześlij">
            </form>
        <?php else: ?>
            <h2>Koniec gry!</h2>
            <p>Dziękujemy za grę!</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php mysqli_close($conn); ?>
