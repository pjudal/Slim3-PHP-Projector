<!DOCTYPE html>
<html lang="en" ng-app="assignProjectApp">
<head>
  <meta charset="UTF-8">
  <title>Projector</title>
  <link rel="stylesheet" href="/../css/projects.css">
  <!--script type="text/javascript" src="/../js/jquery-1.8.2.min.js"></script-->
  <script src="/../js/angular.js"></script>
  <script type="text/javascript" src="/../js/app.js"></script>
</head>

<body ng-controller="assignProjectController">

	<ul>
		<li><img src="/../img/projector-logo.png" alt="Projector Logo"></li>
		<li><a href="/">View Projects</a></li>
		<li><a href="/projects/create">Create Project</a></li>
		<li><a href="/../persons/create">Create Person</a></li>
		<li><a href="/../secure/log-out">Log-out</a></li>
	</ul>

	<div class="layout">
		<h1>Project Assignments</h1>
	    <p class="welcome_user">Welcome, <?php echo $_SESSION["current_user"];?>!</p>

		<form action="/projects/assign" id="assign_form">
			<?php
			$proj_name = $_SESSION["proj_name"];
			$assigned = $_SESSION["assigned_persons"];
			$unassigned = $_SESSION["unassigned_persons"];

			echo "<h2>Assign to Project ";
			echo $proj_name;
			echo "</h2>";

			echo "<div id=\"content\">";
		    ?>
		    <div ng-include src="'/../load.php'"></div>
		    
			</div>
		<!--script src="/../js/general.js"></script-->
	</div>

</body>
</html>