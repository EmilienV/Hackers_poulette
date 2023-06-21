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


$dbh = new PDO('mysql:host=localhost;dbname=hackers_poulette', "Dbconnect", "password");
$response = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitize the inputs
  $sanitizedName = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $sanitizedFirstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $sanitizedEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $sanitizedDescription = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

  $fileContent = null;
  if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $uploadedFile = $_FILES['file'];
    $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    if (in_array(strtolower($fileExtension), $allowedExtensions) && $uploadedFile['size'] <= $maxFileSize) {
      $fileContent = file_get_contents($uploadedFile['tmp_name']);
    }
  }


  // reCAPTCHA validation
  if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {

    $secretAPIkey = '6LeIoLImAAAAACESnT4uRUJzpKAHJ_Z831h-UKX0';
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretAPIkey . '&response=' . $_POST['g-recaptcha-response']);
    $responseAPI = json_decode($verifyResponse);

    if ($responseAPI->success) {

      // Insert the data into the database
      $stmt = $dbh->prepare("INSERT INTO form_data (name, firstname, email, description, file) VALUES (:name, :firstname, :email, :description, :file)");
      $stmt->bindParam(':name', $sanitizedName);
      $stmt->bindParam(':firstname', $sanitizedFirstname);
      $stmt->bindParam(':email', $sanitizedEmail);
      $stmt->bindParam(':description', $sanitizedDescription);
      $stmt->bindParam(':file', $fileContent, PDO::PARAM_LOB);

      if ($stmt->execute()) {
        $response = "Your message has been sent, we'll reach out to you as soon as possible.";

      }
    } else {
      $response = "CAPTCHA verification failed. Please try again.";
    }
  } else {
    $response = "Please fill out the CAPTCHA.";
  }
}
?>

<body>
  <h1 id="title">Contact me</h1>
  <div class="form_container">
    <form action="" method="post">
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
        <input type="file" id="file" name="file" accept=".jpg, .jpeg, .png, .gif" size="2000000">
      </div>

      <div class="description_area">
        <label for="description">Description:</label>
        <textarea id="description" name="description" required minlength="2" maxlength="1000"></textarea>
      </div>

      <div class="g-recaptcha" data-sitekey="6LeIoLImAAAAAMf0LPL1QoadU0SIjjV5Von4UBh4"></div>

      <button type="submit" id="submit_btn">Submit</button>
      <div id="response_msg"><?php echo $response; ?></div>
  </div>
  </form>

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</body>

</html>