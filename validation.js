function validateForm(event) {
  var nameInput = document.getElementById("name");
  var firstnameInput = document.getElementById("firstname");
  var emailInput = document.getElementById("email");
  var fileInput = document.getElementById("file");
  var descriptionInput = document.getElementById("description");

  if (nameInput.value.length < 2 || nameInput.value.length > 255) {
    alert("Name must be between 2 and 255 characters long.");
    nameInput.focus();
    event.preventDefault(); // Prevent form submission
    return false;
  }

  if (firstnameInput.value.length < 2 || firstnameInput.value.length > 255) {
    alert("First name must be between 2 and 255 characters long.");
    firstnameInput.focus();
    event.preventDefault(); // Prevent form submission
    return false;
  }

  var email = emailInput.value.trim();
  if (email.length < 2 || !validateEmail(email)) {
    alert("Please enter a valid email address.");
    emailInput.focus();
    event.preventDefault(); // Prevent form submission
    return false;
  }

  if (fileInput.value) {
    var fileExtension = getFileExtension(fileInput.value);
    var allowedExtensions = ["jpg", "jpeg", "png", "gif"];
    if (!allowedExtensions.includes(fileExtension.toLowerCase())) {
      alert(
        "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed."
      );
      fileInput.value = "";
      fileInput.focus();
      event.preventDefault(); // Prevent form submission
      return false;
    }

    var fileSize = fileInput.files[0].size;
    var maxSize = 2000000; // 2MB
    if (fileSize > maxSize) {
      alert("File size exceeds the maximum limit of 2MB.");
      fileInput.value = "";
      fileInput.focus();
      event.preventDefault(); // Prevent form submission
      return false;
    }
  }

  if (
    descriptionInput.value.length < 2 ||
    descriptionInput.value.length > 1000
  ) {
    alert("Description must be between 2 and 1000 characters long.");
    descriptionInput.focus();
    event.preventDefault(); // Prevent form submission
    return false;
  }

  return true;
}

function getFileExtension(filename) {
  return filename.split(".").pop();
}

function validateEmail(email) {
  // Use a regular expression to validate email format
  var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailPattern.test(email);
}

var form = document.getElementById("myForm");
form.addEventListener("submit", validateForm);
