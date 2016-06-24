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
		<li><a href="../projects/create">Create Project</a></li>
		<li><a class="active" href="#">Create Person</a></li>
		<li><a href="/../secure/log-out">Log-out</a></li>
	</ul>

	<div class="layout">
		<h1>Create Project</h1>
	    <p class="welcome_user">Welcome, <?php echo $_SESSION["current_user"];?>!</p>
	    <figure class="success_gif">
	    	<img src="/../img/success.gif" alt="Success!">
	    	<figcaption><span class="success_span">Success!</span> Your entry has been recorded.</figcaption>
	    </figure>
	</div>

</body>
</html>