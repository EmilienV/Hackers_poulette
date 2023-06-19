<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets\css\style.css">
    <!-- <script defer src="assets/validation.js"></script> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald&display=swap" rel="stylesheet">
    <title>Hackers Poulette</title>
</head>

<?php
$dbh = new PDO('mysql:host=localhost;dbname=hackers_poulette', "Evolkaert","E6adn019_");
?>


<body>
    <div class="form_container">
    <form action="/submit-form" method="post">
  <div>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required minlength="2" maxlength="255">
  </div>
  <div>
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" required minlength="2" maxlength="255">
  </div>
  <div>
    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required minlength="2" maxlength="255">
  </div>
  <div>
    <label for="file">File (optional):</label>
    <input type="file" id="file" name="file" accept=".jpg, .jpeg, .png, .gif" size="2000000" value ="">
  </div>
  <div>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required minlength="2" maxlength="1000"></textarea>
  </div>
  <button type="submit">Submit</button>
</div>
</form>
</body>
</html>