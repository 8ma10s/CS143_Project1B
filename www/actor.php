<?php include 'database.php' ?>

<?php
$isValid = true;
if (!empty($_GET['id'])) {
  $actorID = $_GET['id'];

  $db_connection = connectToDB();

  $query = "SELECT * FROM Actor WHERE id = $actorID";
  $rs = mysql_query($query, $db_connection);
  $numRows = mysql_num_rows($rs);
  if ($numRows < 1) {
    $isValid = false;
  }
  else {
    $actorInfo = mysql_fetch_assoc($rs);
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
    <h1><?php echo $actorInfo['first']." ".$actorInfo['last']; ?></h1>
  </div>
  <div class="row">
    <div class="col-md-9">
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
    </div>
    <div class="col-md-3">
      <h3>Actor Info</h3>
      <ul class="list-group">
	<li class="list-group-item"><strong>Sex: </strong><?php echo $actorInfo['sex']; ?></li>
	<li class="list-group-item"><strong>Date of birth: </strong><?php echo $actorInfo['dob']; ?></li>
	<li class="list-group-item"><strong>Date of death: </strong>
	  <?php
	  if (is_null($actorInfo['dod'])) {
	    echo "Still alive";
	  }
	  else {
	    echo $actorInfo['dod'];
	  }
	  ?>
	</li>
      </ul>
    </div>
  </div>
  
  <?php else: ?>
  <h1>Invalid Actor ID</h1>
  <?php endif; ?>
  
</div>

<?php include 'footer.php' ?>
