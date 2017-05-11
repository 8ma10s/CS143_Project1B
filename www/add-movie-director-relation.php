<?php include 'database.php'; ?>

<?php

$db_connection = connectToDB();

if (!empty($_POST['mid'])) {
  $isValid = true;

  $mid = $_POST['mid'];
  $did = $_POST['did'];

  $relationQuery = "INSERT INTO MovieDirector (mid, did) 
VALUES ('$mid', '$did')";

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

// get all directors
$directorQuery = "SELECT id, first, last FROM Director";
$directorResults = mysql_query($directorQuery, $db_connection);

?>

<?php include 'header.php';?>

<div class="row">
  <h2>Add Director/Movie Relation</h2>
  <?php if ($isValid): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
      <strong>Success!</strong> Movie/Director relation added to database.
    </div>
  <?php endif; ?>
  <form method="POST" action="#">
    <div class="form-group">
      <label for="mid">Movie</label>
      <select name="mid" class="fancy-dropdown form-control">
	<?php
	while ($row = mysql_fetch_assoc($movieResults)) {
	  echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
	}
	?>
      </select>
    </div>
    <div class="form-group">
      <label for="did">Director</label>
      <select name="did" class="fancy-dropdown form-control">
	<?php
	while ($row = mysql_fetch_assoc($directorResults)) {
	  echo '<option value="'.$row['id'].'">'.$row['first'].' '.$row['last'].'</option>';
	}
	?>
      </select>
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

<?php include 'footer.php'; ?>
