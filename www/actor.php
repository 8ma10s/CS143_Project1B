<?php include 'header.php';?>

<?php
if (!empty($_GET['id'])) {
  $actorId = $_GET['id'];
}

?>

<div class="row">
  <div class="page-header">
    <h1>Johnny Depp</h1>
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
      <tr>
	<td><a href="./movie.php?id=1">Alice in Wonderland</a></td>
	<td>Alice</td>
      </tr>
    </tbody>
  </table>
  
</div>

<?php include 'footer.php' ?>
