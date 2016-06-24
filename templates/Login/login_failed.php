<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Log-in</title>
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <?php $args = $_SESSION["args"]; ?>
  <div class="log-in">
    <div class="log-in-bg"></div>
    <h1>Log-in to <span>PROJECTOR</span></h1>
    <form action="#" method="post">
      <hr>
      <h3>LOGIN FAILED</h3>
      <p>
        <?php
          if ($args["valid_email"] == 0) {
            echo "Unregistered email.</p><p>";
          }

          if ($args["valid_pass"] == 0) {
            echo "Incorrect password.</p><p>";
          }

          if ($args["email_format"] == 0) {
            echo "Incorrect e-mail format.</p><p>";
          }

          if ($args["email_length"] == 0) {
            echo "E-mail length must be between 5 - 200 characters.</p><p>";
          }

          if ($args["pass_length"] == 0) {
            echo "Passwords must be 7 - 11 characters long.";
          }
        ?>
      </p>
    </form>

    <a href="log-in" class="button-fail">Back to Log-in Page</a>
    

  </div>

</body>
</html>