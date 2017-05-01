<?php include 'header.php';?>

<div class="row">
  <h2>Add New Movie</h2>
  <form method="POST" action="#">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" name="title" class="form-control" placeholder="Titanic">
    </div>
    <div class="form-group">
      <label for="year">Release Year</label>
      <input type="number" name="year" class="form-control"  placeholder="1997">
    </div>
    <div class="form-group">
      <label for="rating">MPAA Rating</label>
      <select name="rating" class="select2 form-control">
	<option value="G">G</option>
	<option value="PG">PG</option>
	<option value="PG-13">PG-13</option>
	<option value="R">R</option>
	<option value="NC-17">NC-17</option>
      </select>
    </div>
    <div class="form-group">
      <label for="company">Production Company</label>
      <input type="text" name="company" class="form-control" placeholder="Twentieth Century Fox">
    </div>
    <div class="form-group">
      <label for="genre">Genres</label>
      <select name="genre" class="select2 form-control" multiple="multiple">
	<option value="Action">Action</option>
	<option value="Adult">Adult</option>
	<option value="Animation">Animation</option>
	<option value="Comedy">Comedy</option>
	<option value="Crime">Crime</option>
	<option value="Documentary">Documentary</option>
	<option value="Drama">Drama</option>
	<option value="Family">Family</option>
	<option value="Fantasy">Fantasy</option>
	<option value="Horror">Horror</option>
	<option value="Musical">Musical</option>
	<option value="Mystery">Mystery</option>
	<option value="Romance">Romance</option>
	<option value="Sci-Fi">Sci-Fi</option>
	<option value="Short">Short</option>
	<option value="Thriller">Thriller</option>
	<option value="War">War</option>
	<option value="Western">Western</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<script type="text/javascript">
 $(document).ready(function(){
   $( ".select2" ).select2({
     theme: "bootstrap"
   })
   
 })
</script>
<?php include 'footer.php' ?>
