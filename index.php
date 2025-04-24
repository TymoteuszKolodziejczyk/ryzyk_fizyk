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
    
</body>
</html>

<?php
	mysqli_close($conn);
?>