<?php include 'database.php'; ?>

<?php
$customStyles = '<link rel="stylesheet" href="./css/bootstrap-stars.css">';
?>

<?php include 'header.php'; ?>

<?php
function ratingToStars($rating) {
  $stars = "";
  $selectedStar = '<span class="glyphicon glyphicon-star star star-selected" aria-hidden="true"></span>';
  $deselectedStar = '<span class="glyphicon glyphicon-star star star-deselected" aria-hidden="true"></span>';
  $starIndex = 0;
  for (; $starIndex < $rating; $starIndex++) {
    $stars .= $selectedStar;
  }
  for (; $starIndex < 10; $starIndex++) {
    $stars .= $deselectedStar;
  }
  return $stars;
}

$isValid = true;
if (!empty($_GET['id'])) {
  $movieID = $_GET['id'];

  $db_connection = connectToDB();

  // Movie Info
  $movieQuery = "SELECT * FROM Movie WHERE Movie.id = $movieID";
  $movieResults =  mysql_query($movieQuery, $db_connection);
  $numRows = mysql_num_rows($movieResults);
  if ($numRows < 1) {
    $isValid = false;
  }
  else {
    $movieInfo = mysql_fetch_assoc($movieResults);
  }

  // Genres
  $genreQuery = "SELECT genre FROM MovieGenre WHERE mid = $movieID";
  $genreResults = mysql_query($genreQuery, $db_connection);

  // Director
  $directorQuery = "SELECT Director.first as first, Director.last as last FROM MovieDirector, Director 
WHERE MovieDirector.mid = $movieID 
AND MovieDirector.did = Director.id";
  $directorResults = mysql_query($directorQuery, $db_connection);
  if ($row = mysql_fetch_assoc($directorResults)) {
    $director = $row['first'].' '.$row['last'];
  }
  

  // Actors
  $actorsQuery = "SELECT Actor.first as first, Actor.last as last, Actor.id as aid, MovieActor.role as role 
FROM Movie, MovieActor, Actor 
WHERE Movie.id = $movieID 
AND MovieActor.mid = Movie.id 
AND MovieActor.aid = Actor.id";
  $actorsResults = mysql_query($actorsQuery, $db_connection);

  // check if review posted
  if (!empty($_POST['reviewerName'])) {
    $didReview = true;
    $reviewerName = $_POST['reviewerName'];
    $reviewRating = $_POST['reviewRating'];
    $reviewComment = $_POST['reviewComment'];
    $date = date('Y-m-d H:i:s');

    $insertReviewQuery = "INSERT INTO Review (name, time, mid, rating, comment)
VALUES ('$reviewerName', '$date', '$movieID', '$reviewRating', '$reviewComment')";
    if (mysql_query($insertReviewQuery, $db_connection)) {
      $reviewSuccessful = true;
    }
    else {
      $reviewSuccessful = false;
    }
  }

  // Reviews
  $reviewsQuery = "SELECT * FROM Review WHERE mid = $movieID ORDER BY time";
  $reviewsResults = mysql_query($reviewsQuery, $db_connection);

  // Average review rating
  $avgRatingQuery = "SELECT IFNULL(AVG(rating), 0) as avgRating FROM Review WHERE mid = $movieID";
  $avgRatingResults = mysql_query($avgRatingQuery, $db_connection);
  $averageRating = 0;
  if ($row = mysql_fetch_assoc($avgRatingResults)) {
    $averageRating = $row['avgRating'];
  }
}
else {
  $isValid = false;
}

mysql_close($db_connection);
?>
<?php if ($isValid): ?>
<div class="row">
  <div class="page-header">
    <h1><?php echo $movieInfo['title'].' ('.$movieInfo['year'].')'; ?></h1>
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
	<?php
	while ($row = mysql_fetch_assoc($actorsResults)) {
	  echo '<tr>
	<td><a href="./actor.php?id='.$row['aid'].'">'.$row['first'].' '.$row['last'].'</a></td>
	<td>'.$row['role'].'</td>
        </tr>';
	}
	?>
      </tbody>
    </table>
  </div>
  <div class="col-md-3">
    <ul class="list-group">
      <li class="list-group-item"><strong>Producer: </strong><?php echo $movieInfo['company']; ?></li>
      <li class="list-group-item"><strong>Director: </strong><?php echo $director; ?></li>
      <li class="list-group-item"><strong>MPAA Rating: </strong><?php echo $movieInfo['rating']; ?></li>
      <li class="list-group-item"><strong>Genres: </strong>
	<?php
	// first result doesn't have comma
	if ($row = mysql_fetch_assoc($genreResults)) {
	  echo $row['genre'];
	}
	while ($row = mysql_fetch_assoc($genreResults)) {
	  echo ', '.$row['genre'];
	}
	?>
      </li>
    </ul>
  </div>
</div>

<div class="row">
  <h2>User Reviews</h2>
  <span class="h4">Average Rating: <?php echo $averageRating; ?>/10</span>
  
  <br />
  <br />
  <?php while ($row = mysql_fetch_assoc($reviewsResults)): ?>
    <div class="panel panel-default">
      <div class="panel-body">
	<span class="h5">Reviewer Name:</span>
	<?php echo $row['name']; ?>
	<br />
	<span class="h5">Date:</span>
	<?php echo $row['time']; ?>
	<br />
	<span class="h5">Rating:</span>
	<?php echo ratingToStars($row['rating']); ?>
	<h5>Comment:</h5>
	<p><?php echo $row['comment']; ?></p>
      </div>
    </div>
  <?php endwhile; ?>
  
  <h3>Add Your Review</h3>

  <?php if ($didReview && $reviewSuccessful): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
      <strong>Success!</strong> Review submitted.
    </div>
  <?php elseif ($didReview): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
      <strong>Error!</strong> Review could not be submitted.
    </div>
  <?php endif; ?>
  
  <form id="submitReview" method="POST" action="#submitReview">
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
<?php endif; // isValid ?>

<script src="./js/jquery.barrating.min.js"></script>
<script type="text/javascript">
 $(function() {
   $('.star-rating').barrating({
     theme: 'bootstrap-stars'
   });
 });
</script>

<?php include 'footer.php'; ?>
