<?php include 'header.php';?>

<div class="row">
  <h2>Add Actor/Movie Relation</h2>
  <?php if (!empty($_GET['movie'])): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
      <strong>Success!</strong> Movie/Director relation added to database.
    </div>
  <?php endif; ?>
  <form method="GET" action="#">
    <div class="form-group">
      <label for="movie">Movie</label>
      <select name="movie" class="fancy-dropdown form-control">
	<option value="1">Titanic</option>
	<option value="2">Avatar</option>
      </select>
    </div>
    <div class="form-group">
      <label for="director">Director</label>
      <select name="director" class="fancy-dropdown form-control">
	<option value="1">Johnny Depp</option>
	<option value="2">Brad Pitt</option>
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

<?php include 'footer.php' ?>
