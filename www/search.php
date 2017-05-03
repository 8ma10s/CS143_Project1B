<?php include 'header.php';?>
<?php include 'database.php'; ?>

<?php

$db_connection = connectToDB();
$validSearch = !empty($_GET['query']);

if ($validSearch) {
  $query = $_GET['query'];

  //split the words (KW=keywords)
  $keywords = split(' ', $query);
}
?>

<div class="row">
  <?php
  //if search is valid (that is, the search query is not empty)
  if ($validSearch):
    // make a string of "title LIKE [keyword]" ANDed with each other
    $movieKW = array();
    foreach ($keywords as $key => $keyword){
      $movieKW[$key] = ' title LIKE "%'.$keyword.'%" ';
    }
    $movieCond = join('AND', $movieKW);

    //search movies
    $movieQuery = "SELECT id, title, year
    FROM Movie
    WHERE".$movieCond;
    $movieResult = mysql_query($movieQuery, $db_connection); ?>
    <h2>Showing Results For "<?php echo $query; ?>"</h2>
    <h3>Movies</h3>
    <table class="table table-hover">
      <thead>
	<tr>
	  <th>Title</th>
    <th>Year</th>
	</tr>
      </thead>
      <tbody>
        <?php
        // generate each row with Movie title and Year
        while($row = mysql_fetch_row($movieResult)): ?>
           <tr>
             <td>
               <!-- Moie name with link to the page of specific movie -->
               <a href="./movie.php?id=<?php echo $row[0];?>"><?php echo $row[1];?></a>
             </td>
             <td>
               <!-- Movie Year -->
               <?php echo $row[2];?>
             </td>
           </tr>
         <?php endwhile ?>
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

<?php mysql_close($db_connection); ?>
<?php include 'footer.php' ?>
