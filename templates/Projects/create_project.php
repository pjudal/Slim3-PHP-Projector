<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Projector</title>
  <link rel="stylesheet" href="/../css/projects.css">
</head>

<body>

	<ul>
		<li><img src="/../img/projector-logo.png" alt="Projector Logo"></li>
		<li><a href="/">View Projects</a></li>
		<li><a class="active" href="#">Create Project</a></li>
		<li><a href="/../persons/create">Create Person</a></li>
		<li><a href="/../secure/log-out">Log-out</a></li>
	</ul>

	<div class="layout">
		<h1>Create Project</h1>
	    <p class="welcome_user">Welcome, <?php echo $_SESSION["current_user"];?>!</p>
	    <form action="#" method="post">
	      <input name="code" type="text" value="" placeholder="Project Code (Text)"
	      	required>
	      <input name="name" type="text" value="" placeholder="Project Name (Text)"
	      	required>
	      <input name="budget" type="text"
	      	pattern="^(?=.?\d)\d{0,18}(\.?\d{0,4})?$" value="" placeholder="Budget (Integer/Decimal)"
	      	required>
	      <input name="remarks" type="text" value="" placeholder="Remarks (Text)"
	      	required>
	      <input class="button" type="submit" value="Save">
	    </form>
	</div>

</body>
</html>