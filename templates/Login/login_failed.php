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
          if (count($_SESSION["loginErrors"]) != 0) {
            foreach ($_SESSION["loginErrors"] as $error) {
              echo $error . "</p><p>";
            }
          }
        ?>
      </p>
    </form>

    <a href="log-in" class="button-fail">Back to Log-in Page</a>
    

  </div>

</body>
</html>