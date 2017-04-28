<?php include 'database.php' ?>

<?php
$isValid = true;
if (!empty($_GET['id'])) {
  $actorID = $_GET['id'];

  $db_connection = connectToDB();

  $query = "SELECT last, first FROM Actor WHERE id = $actorID";
  $rs = mysql_query($query, $db_connection);
  $numRows = mysql_num_rows($rs);
  if ($numRows < 1) {
    $isValid = false;
  }
  else {
    $row = mysql_fetch_assoc($rs);
    $lastName = $row["last"];
    $firstName = $row["first"];
  }

  $query = "SELECT Movie.title as title, Movie.id as mid, MovieActor.role as role
FROM Movie, Actor, MovieActor 
WHERE Actor.id = $actorID
AND MovieActor.aid = Actor.id
AND Movie.id = MovieActor.mid";
  $movieRoleResults = mysql_query($query, $db_connection);
  
  
}
else {
  $isValid = false;
}

?>

<?php include 'header.php';?>

<div class="row">
  <?php if ($isValid): ?>
  <div class="page-header">
    <h1><?php echo "$firstName $lastName"; ?></h1>
  </div>
  <h3>Filmography</h3>
  <table class="table table-hover">
    <thead>
      <tr>
	<th>Movie</th>
	<th>Role</th>
      </tr>
    </thead>
    <tbody>
      <?php
      while ($row = mysql_fetch_assoc($movieRoleResults)) {
	echo '<tr>
	<td><a href="./movie.php?id='.$row['mid'].'">'.$row['title'].'</a></td>
	<td>'.$row['role'].'</td>
      </tr>';
      }
      ?>
    </tbody>
  </table>
  <?php else: ?>
  <h1>Invalid Actor ID</h1>
  <?php endif; ?>
  
</div>

<?php include 'footer.php' ?>
