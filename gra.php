<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "ryzyk_fizyk");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT IdQuestion, Content, Answer FROM questions";
$result = $conn->query($sql);

// Inicjalizacja tablicy
$questions = [];

// Sprawdzanie, czy są wyniki
if ($result->num_rows > 0) {
    // Pobieranie danych i dodawanie do tablicy
    while ($row = $result->fetch_assoc()) {
        $questions[] = [
            "question" => $row['Content'],
            "answer" => $row['Answer']
        ];
    }
} else {
    echo "Brak wyników";
    exit(); // Zakończ skrypt, jeśli nie ma pytań
}

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
</head>
<body>
    <h1>Ryzyk fizyk</h1>

    <div class="box" style="width: 30%; margin: auto; text-align: center;">
        <?php if ($_SESSION['current_question_index'] >= 0): ?>
            <h2 id="question"><?php echo htmlspecialchars($currentQuestion); ?></h2>
        <?php endif; ?>

        <form action="gra.php" method="post">
            <?php $playerCount=0; if (!empty($_SESSION['userNames'])): ?>
                <?php foreach ($_SESSION['userNames'] as $userName): $playerCount++;?>
                    <div class="user-form">
                        <h4><?php echo htmlspecialchars($userName); ?></h4>
                        <input type="password" name="answers[<?php echo htmlspecialchars($userName); ?>]" required placeholder="Wpisz liczbę" autocomplete="off" class="answerInput" onfocus="showInput(this)" onfocusout="hideAnswer(this)">
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
<script>
    const playerCount = <?php echo $playerCount ?>;
    const anwerInputs = document.getElementsByClassName('answerInput');

    function showInput(input){
        input.type = "number"
    }
    function hideAnswer(input){
        input.type = "password"
    }
</script>
<?php mysqli_close($conn); print_r($_SESSION);?>
