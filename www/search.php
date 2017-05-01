<?php include 'header.php';?>
<?php include 'database.php'; ?>

<?php

$db_connection = connectToDB();
$validSearch = !empty($_GET['query']);

if ($validSearch) {
  $query = $_GET['query'];
}
?>

<div class="row">
  <?php if ($validSearch):
    // search movie
    $movieQuery = "SELECT id, title, year
    FROM Movie
    WHERE title LIKE '%$query%'";
    $movieResult = mysql_query($movieQuery, $db_connection); ?>

    <h2>Showing Results For "<?php echo $query; ?>"</h2>
    <h3>Movies</h3>
    <table class="table table-hover">
      <thead>
	<tr>
	  <th>Title</th>
    <th>Year</th>
	</tr>
      </thead>
      <tbody>
        <?php
        // generate each row with Movie title and Year
           while($row = mysql_fetch_row($movieResult)){
             echo "<tr>";
             echo "<td>";
             echo "<a href=\"./movie.php?id=".$row[0]."\">".$row[1]."</a>";
             echo "</td>";

             echo "<td>";
             echo $row[2];
             echo "</td>";

             echo "</tr>";
           } ?>
      </tbody>
    </table>

    <h3>Actors</h3>
    <table class="table table-hover">
      <thead>
	<tr>
	  <th>Full Name</th>
	</tr>
      </thead>
      <tbody>
	<tr>
	  <td>
	    <a href="./actor.php?id=1">Tom Hanks</a>
	  </td>
	</tr>
      </tbody>
    </table>

  <?php else: ?>

    <h2>Invalid search query.</h2>

  <?php endif; ?>
</div>

<?php mysql_close($db_connection); ?>
<?php include 'footer.php' ?>
