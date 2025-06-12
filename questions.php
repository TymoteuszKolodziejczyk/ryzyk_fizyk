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
?>