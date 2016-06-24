<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Projector</title>
	<link rel="stylesheet" href="css/projects.css">
	<script type="text/javascript" src="/../js/jquery-1.8.2.min.js"></script>

	<script>
		function go(link) {
		    //alert(link.parent().parent().find('td:first').text());
		    document.cookie = "project_to_add_to=" + link.parent().parent().find('td:first').text();
		}
	</script>

</head>

<body>

	<ul>
		<li><img src="/../img/projector-logo.png" alt="Projector Logo"></li>
		<li><a class="active" href="#">View Projects</a></li>
		<li><a href="projects/create">Create Project</a></li>
		<li><a href="persons/create">Create Person</a></li>
		<li><a href="secure/log-out">Log-out</a></li>
	</ul>

	<div class="layout">
		<h1>Projects</h1>
	    <p class="welcome_user">Welcome, <?php echo $_SESSION["current_user"];?>!</p>

		<?php
		$project_empty = $_SESSION["project_empty"];

	    if ($project_empty == 1) {
	    	echo "<h3>No projects available.</h3>";
	    }

	    else {
	    	$projects = $_SESSION["projects"];

			echo "<table border='1' class=\"viewproj_table\">
			<tr>
				<th>Code</th>
				<th>Project Name</th>
				<th>Budget</th>
				<th>Remarks</th>
				<th>Tasks</th>
			</tr>";

			foreach ($projects as $row) {
				echo "<tr>";
					echo "<td>" . $row['code'] . "</td>";
					echo "<td class=\"proj-name\">" . $row['name'] . "</td>";
					echo "<td>" . number_format($row['budget'], 2) . "</td>";
					echo "<td>" . $row['remarks'] . "</td>";
					echo "<td> <a href=\"/projects/assign\" onclick=\"go($(this))\">Assignments</a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		?>

	</div>

</body>
</html>