<?php include 'header.php';?>
<?php include 'database.php';?>

<div class="row">
  <h2>Add New Movie</h2>
  <?php if(!empty($_POST)) :?>
    <?php
    $iError = 0; //input error
    $movieInfo = array(); //array to store all information from _POST after formatting
    $outStr = ''; //this is used as an output of error message (if any)

    //check that each necessary field is not empty. if empty, set error message
    //title
    if(empty($_POST['title'])){
      $outStr = $outStr."<strong>Error!</strong> Movie title cannot be empty.<br>";
      $iError=1;
    }
    $movieInfo['title']=$_POST['title'];

    //year is empty
    if(empty($_POST['year'])){
      $outStr = $outStr."<strong>Error!</strong> Release year cannot be empty.<br>";
      $iError=1;
    }
    //else if year is not in yyyy format
    else if(!preg_match("/^[0-9]{4}$/",$_POST['year'])){
      $outStr = $outStr."<strong>Error!</strong> Release year must be in the form yyyy.<br>";
      $iError=1;
    }
    $movieInfo['year']=$_POST['year'];

    //no need to worry about MPAA rating because field only allows selection of predetermined VALUES
    $movieInfo['rating'] = $_POST['rating'];

    //production company is empty
    if(empty($_POST['company'])){
      $outStr = $outStr."<strong>Error!</strong> Production Company cannot be empty.<br>";
      $iError=1;
    }
    $movieInfo['company'] = $_POST['company'];

    //no genre selected
    if(empty($_POST['genre'])){
      $outStr = $outStr."<strong>Error!</strong> You must select at least one genre<br>";
      $iError=1;
    }
    $movieInfo['genre'] = $_POST['genre'];
    ?>

    <?php //check for errors ?>
    <?php if($iError == 0) :?>
      <?php
      //open connection to database
      $db_connection = connectToDB();

      // increment maxPersonID
      $maxID;
      $maxIDQuery = 'UPDATE MaxMovieID
      SET id = id + 1';
      //if incrementind id succeeds, get that incremented maxID
      if(mysql_query($maxIDQuery, $db_connection)){
        $maxIDQuery = 'SELECT MAX(id) as maxID
        FROM MaxMovieID';
        $result = mysql_query($maxIDQuery, $db_connection);
        $row = mysql_fetch_row($result);
        $maxID = $row[0];

        //insert movie information
        $insertQuery = 'INSERT INTO Movie
        VALUES ('.$maxID.',"'.$movieInfo['title'].'",'.$movieInfo['year'].',"'.$movieInfo['rating'].'", "'.$movieInfo['company'].'")';
        mysql_query($insertQuery, $db_connection);

        //insert selected genre
        foreach($movieInfo['genre'] as $genre){
          $insertQuery = 'INSERT INTO MovieGenre
          VALUES ('.$maxID.', "'.$genre.'")';
          mysql_query($insertQuery, $db_connection);
        }

      }
      else{
        echo "Your input was correct, but the server failed to insert your input. Try again.<br>";
      }
      //close connection
      mysql_close($db_connection);
      ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
        <strong>Success!</strong> Movie added to database.<br>
      </div>
    <?php else :?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
        <?php echo $outStr; ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>

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
      <select name="genre[]" class="select2 form-control" multiple="multiple">
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
