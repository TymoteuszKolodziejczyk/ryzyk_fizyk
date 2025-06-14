<?php
session_start();
$answers = isset($_SESSION['answers']) ? $_SESSION['answers'] : [];

// Retrieve the player names from the session
$userNames = isset($_SESSION['userNames']) ? $_SESSION['userNames'] : [];
$betPoints = isset($_SESSION['betPoints']) ? $_SESSION['betPoints'] : [];

// obsluga ze jak user ma 0 pkt to dodac 1

if (empty($betPoints)) {
    $betPoints = array_fill(0, count($userNames), 1);
    $_SESSION['betPoints'] = $betPoints;
}
echo json_encode($betPoints);

echo "<script>const userNames = " . json_encode($userNames) . "</script>";
echo "<script>const betPoints = " . json_encode($betPoints) . "</script>";


// Clear existing bets if starting a new game
if (!isset($_SESSION['bets']) || isset($_POST['new_game'])) {
    $_SESSION['bets'] = [];
}
$usersNotVoted = array_filter($userNames, function($name) {
    return !isset($_SESSION['bets'][$name]);
});

// Handle the betting form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['bet_number']) && isset($_POST['bet_amount']) && isset($_POST['user_name'])) {
    $userName = htmlspecialchars($_POST['user_name']);
    $betNumber = intval($_POST['bet_number']);
    $betAmount = intval($_POST['bet_amount']);

    // Store the bet for the specific user
    $_SESSION['bets'][$userName] = ['number' => $betNumber, 'amount' => $betAmount];

    // Check if all players have placed their bets
    if (count($_SESSION['bets']) === count($userNames)) {
        header("Location: results.php"); // Redirect to results.php if all bets are placed
        exit();
    }

    header("Location: voting.php"); // Redirect to avoid form resubmission
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki głosowania</title>
    <link rel="stylesheet" href="styles.css" type="text/css">
</head>
<body>
    <div class="box" style="width: 30%; margin: auto; text-align: center; margin-bottom: 20px;">
        <h1>Odpowiedzi</h1>

        <div id="results" style="text-align: center;">
            <?php if (!empty($answers)): ?>
                <div>
                    <?php foreach ($answers as $user => $answer): ?>
                        <button><?php echo htmlspecialchars($answer); ?></button>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Brak odpowiedzi do wyświetlenia.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="box" style="width: 30%; margin: auto; text-align: center; margin-bottom: 20px;">
        <h2>Postaw zakład</h2>
        <form action="voting.php" method="post">
            <label for="user_name">Wybierz gracza:</label>
            <select name="user_name" id="user_name" required onchange="enableSubmitButton();showBetPoints(this)">
                <option value="-" selected disabled>---</option>
                <?php foreach ($usersNotVoted as $name): ?>
                    <option value="<?php echo htmlspecialchars($name); ?>"><?php echo htmlspecialchars($name); ?></option>
                <?php endforeach; ?>
            </select>
            <span id="spanBetPoints"></span>
            <br><br>
            <label for="bet_number">Wybierz numer:</label>
            <select name="bet_number" id="bet_number" required>
                <?php if (!empty($answers)): ?>
                    <?php foreach ($answers as $answer): ?>
                        <option value="<?php echo htmlspecialchars($answer); ?>"><?php echo htmlspecialchars($answer); ?></option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="">Brak dostępnych numerów</option>
                <?php endif; ?>
            </select>
            <br><br>
            <label for="bet_amount">Liczba tokenów:</label>
            <input type="number" name="bet_amount" id="bet_amount" min="1" required disabled onblur="validateBetAmount(this)">
            <br><br>
            <input type="submit" value="Postaw zakład" id="submitBet" disabled>
        </form>
    </div>

    <div class="box" style="width: 30%; margin: auto; text-align: center;">
        <h2>Zakłady</h2>
        <?php if (!empty($_SESSION['bets'])): ?>
            <ul>
            <?php foreach ($_SESSION['bets'] as $user => $bet): ?>
                <li><?php echo htmlspecialchars($user); ?> postawił <?php echo htmlspecialchars($bet['amount']); ?> tokeny na liczbę <?php echo htmlspecialchars($bet['number']); ?></li>
            <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Brak zakładów do wyświetlenia.</p>
        <?php endif; ?>
    </div>
    <?php if (count($_SESSION['bets']) === count($userNames) && !empty($userNames)): ?>
        <div class="box" style="width: 30%; margin: auto; text-align: center; margin-top: 20px;">
            <form action="results.php" method="get">
                <input type="hidden" name="next_question" value="1"> <!-- Hidden field to indicate fetching the next question -->
                <input type="submit" value="Zadaj następne pytanie" style="background-color: #007bff; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">
            </form>
        </div>
    <?php endif; ?>
</body>
</html>
<script>

function enableSubmitButton(){
    document.getElementById("submitBet").disabled = false;
    document.getElementById("bet_amount").disabled = false;
}
function showBetPoints(select){
    const selectedUser = select.value;
    const userIndex = userNames.indexOf(selectedUser);
    const availablePoints = betPoints[userIndex];
    document.getElementById("spanBetPoints").innerHTML = "Tokeny: " + availablePoints;

    const inputBetAmount = document.getElementById("bet_amount");
    inputBetAmount.max = availablePoints;
}

function validateBetAmount(input){
    if(input.value > parseInt(input.max)){
        input.value = input.max;
    }
    if(input.value < 0){
        input.value = 0;
    }
}
</script>
<?php print_r($_SESSION);?>