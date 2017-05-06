<?php include 'database.php'; ?>

<?php

$db_connection = connectToDB();

if (!empty($_POST['mid'])) {
  $isValid = true;

  $mid = $_POST['mid'];
  $aid = $_POST['aid'];
  $role = $_POST['role'];

  $relationQuery = "INSERT INTO MovieActor (mid, aid, role) 
VALUES ('$mid', '$aid', '$role')";

  $relationResult = mysql_query($relationQuery, $db_connection);
  if (!$relationResult) {
    $isValid = false;
  }
}
else {
  $isValid = false;
}

// get all movies
$movieQuery = "SELECT id, title FROM Movie";
$movieResults = mysql_query($movieQuery, $db_connection);

// get all actors
$actorQuery = "SELECT id, first, last FROM Actor";
$actorResults = mysql_query($actorQuery, $db_connection);

?>

<?php include 'header.php';?>

<div class="row">
  <h2>Add Actor/Movie Relation</h2>
  <?php if ($isValid): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
      <strong>Success!</strong> Actor/Movie relationship added to database.
    </div>
  <?php endif; ?>
  <form method="POST" action="#">
    <div class="form-group">
      <label for="movie">Movie</label>
      <select name="mid" class="fancy-dropdown form-control">
	<?php
	while ($row = mysql_fetch_assoc($movieResults)) {
	  echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
	}
	?>
      </select>
    </div>
    <div class="form-group">
      <label for="actor">Actor</label>
      <select name="aid" class="form-control">
	<?php
	while ($row = mysql_fetch_assoc($actorResults)) {
	  echo '<option value="'.$row['id'].'">'.$row['first'].' '.$row['last'].'</option>';
	}
	?>
      </select>
    </div>
    <div class="form-group">
      <label for="role">Role</label>
      <input type="text" name="role" class="form-control" placeholder="Wicked Witch">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<script type="text/javascript">
 $(document).ready(function(){
   $( ".fancy-dropdown" ).select2({
     theme: "bootstrap"
   })
 })
</script>

<?php include 'footer.php' ?>
