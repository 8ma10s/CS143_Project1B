
<?php
$customStyles = '<link rel="stylesheet" href="./css/bootstrap-stars.css">';
?>

<?php include 'header.php';?>

<?php
if (!empty($_GET['id'])) {
  $movieId = $_GET['id'];
}

?>

<div class="row">
  <div class="page-header">
    <h1>Titanic (YEAR)</h1>
  </div>
</div>

<div class="row">
  <div class="col-md-9">
    <h2>Actors</h2>
    <table class="table table-hover">
      <thead>
	<tr>
	  <th>Name</th>
	  <th>Role</th>
	</tr>
      </thead>
      <tbody>
	<tr>
	  <td><a href="./actor.php?id=1">Johnny Depp</a></td>
	  <td>The Iceberg</td>
	</tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-3">
    <ul class="list-group">
      <li class="list-group-item"><strong>Producer: </strong>asdf</li>
      <li class="list-group-item"><strong>Director: </strong>asdf</li>
      <li class="list-group-item"><strong>MPAA Rating: </strong>asdf</li>
      <li class="list-group-item"><strong>Genre: </strong>asdf</li>
    </ul>
  </div>
</div>

<div class="row">
  <h2>User Reviews</h2>
  <div class="panel panel-default">
    <div class="panel-body">
      <span class="h5">Reviewer Name:</span>
      asdf
      <br />
      <span class="h5">Date:</span>
      2017-01-01
      <br />
      <span class="h5">Rating:</span>
      <span class="glyphicon glyphicon-star star star-selected" aria-hidden="true"></span>
      <span class="glyphicon glyphicon-star star star-deselected" aria-hidden="true"></span>
      <span class="glyphicon glyphicon-star star star-deselected" aria-hidden="true"></span>
      <span class="glyphicon glyphicon-star star star-deselected" aria-hidden="true"></span>
      <span class="glyphicon glyphicon-star star star-deselected" aria-hidden="true"></span>
      <h5>Comment:</h5>
      <p>asdf</p>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-body">
      <span class="h5">Reviewer Name:</span>
      asdf
      <br />
      <span class="h5">Date:</span>
      2017-01-01
      <br />
      <span class="h5">Rating:</span>
      <span class="glyphicon glyphicon-star star star-selected" aria-hidden="true"></span>
      <span class="glyphicon glyphicon-star star star-deselected" aria-hidden="true"></span>
      <h5>Comment:</h5>
      <p>asdf</p>
    </div>
  </div>
  
  <h3>Add Your Review</h3>
  <form method="POST" action="#">
    <div class="form-group">
      <label for="reviewerName">Your Name</label>
      <input name="reviewerName" type="text" class="form-control" placeholder="Carlo Zaniolo">
    </div>
    <div class="form-group">
      <label for="reviewRating">Rating</label>
      <select name="reviewRating" class="star-rating">
	<option value="1">1</option>
	<option value="2">2</option>
	<option value="3">3</option>
	<option value="4">4</option>
	<option value="5">5</option>
	<option value="6">6</option>
	<option value="7">7</option>
	<option value="8">8</option>
	<option value="9">9</option>
	<option value="10">10</option>
      </select>
    </div>
    <div class="form-group">
      <label for="reviewComment">Comment</label>
      <textarea name="reviewComment" class="form-control" rows="4"></textarea>
    </div>
    <button type="submit" class="btn btn-default">Submit Review</button>
  </form>
  
</div>

<script src="./js/jquery.barrating.min.js"></script>
<script type="text/javascript">
 $(function() {
   $('.star-rating').barrating({
     theme: 'bootstrap-stars'
   });
 });
</script>

<?php include 'footer.php' ?>
