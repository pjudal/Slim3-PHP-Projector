<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Projector</title>
  <link rel="stylesheet" href="/../css/persons.css">
  <script type="text/javascript" src="/../js/jquery-1.8.2.min.js"></script>
</head>

<body>

	<ul>
		<li><img src="/../img/projector-logo.png" alt="Projector Logo"></li>
		<li><a href="/">View Projects</a></li>
		<li><a href="../projects/create">Create Project</a></li>
		<li><a class="active" href="#">Create Person</a></li>
		<li><a href="/../secure/log-out">Log-out</a></li>
	</ul>

	<div class="layout">
		<h1>Create Person</h1>
	    <p class="welcome_user">Welcome, <?php echo $_SESSION["current_user"];?>!</p>
	    <form action="#" method="post" onsubmit="return myFunction()">
			<input name="last_name" type="text" value="" placeholder="Last Name"
				required>
			<input name="first_name" type="text" value="" placeholder="First Name"
				required>
			<input name="username" type="text" value="" placeholder="Username"
				required>
			<input name="password" type="password" id="password"
				value="" placeholder="Password" required>
			<input name="password_confirm" type="password" id="password_confirm"
				value="" placeholder="Password" onChange="checkPasswordMatch();" required>

			<input class="button" type="submit" value="Save">

			<script>
				function myFunction() {
				    var password = document.getElementById("password").value;
				    var password_confirm = document.getElementById("password_confirm").value;
				    var ok = true;
				    if (password != password_confirm) {
				        alert("Passwords do not match. Please try again.");
				        document.getElementById("password").style.borderColor = "#E34234";
				        document.getElementById("password_confirm").style.borderColor = "#E34234";
				        ok = false;
				    }
				    else {
				        // continue to next page
				    }
				    return ok;
				}
			</script>
	    </form>
	</div>

</body>
</html>