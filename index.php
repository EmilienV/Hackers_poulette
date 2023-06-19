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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $sanitizedName = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $sanitizedFirstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $sanitizedEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);


  // header("Location: ".$_SERVER['PHP_SELF']);
  // exit();
}
?>



<body>
<h1 id="title">Contact me</h1>
    <div class="form_container">
    <form action="/submit-form" method="post">
  <div class="name_area">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required minlength="2" maxlength="255">
  </div>

<div class="firstname_area">
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" required minlength="2" maxlength="255">
  </div>

  <div class="email_area">
    <label for="email">Email Address:</label>
    <input type="email" id="email" name="email" required minlength="2" maxlength="255">
  </div>

  <div class="file_area">
    <label for="file">File (optional):</label>
    <input type="file" id="file" name="file" accept=".jpg, .jpeg, .png, .gif" size="2000000" value ="">
  </div>



  <div class="description_area">
    <label for="description">Description:</label>
    <textarea id="description" name="description" required minlength="2" maxlength="1000"></textarea>
  </div>



  <button type="submit" id="submit_btn">Submit</button>
</div>
</form>
</body>
</html>