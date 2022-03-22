<?php #we start the session for use variable msg from upload.php
session_start();
?>

<!DOCTYPE html>
<html lang="fa">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>File Uploader</title>
  <link rel="stylesheet" href="assets\css\style.css">
</head>

<body>
  <div class="container">

    <?php #if value of the msg changed and its true show the msg 
    if (isset($_SESSION["msg"]) && $_SESSION["msg"]) {
      echo $_SESSION["msg"];
    }
    ?>
    <?php #delete the msg when we refresh the page 
    unset($_SESSION["msg"]);
    ?>
    <form method="POST" action="upload.php" enctype="multipart/form-data">
      <div class="upload-wrapper">
        <span class="file-name">Choose a file...</span>
        <label for="file-upload">Browse<input type="file" id="file-upload" name="uploadedFile"></label>
      </div>
      <input type="submit" name="uploadBtn" value="Upload" />
    </form>
  </div>

</body>

</html>