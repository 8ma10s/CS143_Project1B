<?php include 'header.php';?>

<?php

$validSearch = !empty($_GET['query']);

if ($validSearch) {
  $query = $_GET['query'];
}
?>

<div class="row">
  <?php if ($validSearch): ?>

    <h2>Showing Results For "<?php echo $query; ?>"</h2>
    <h3>Movies</h3>
    <table class="table table-hover">
      <thead>
	<tr>
	  <th>Title</th>
	</tr>
      </thead>
      <tbody>
	<tr>
	  <td>
	    <a href="./movie.php?id=1">Titanic</a>
	  </td>
	</tr>
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

<?php include 'footer.php' ?>
