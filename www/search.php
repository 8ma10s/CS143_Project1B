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
    $actorKW = array();
    foreach ($keywords as $key => $keyword){
      $movieKW[$key] = ' title LIKE "%'.$keyword.'%" ';
      $actorKW[$key] = ' (last LIKE "%'.$keyword.'%" OR first LIKE "%'.$keyword.'%") ';
    }
    $movieCond = join('AND', $movieKW);
    $actorCond = join('AND', $actorKW);

    //search movies
    $movieQuery = "SELECT id, title, year
    FROM Movie
    WHERE".$movieCond."
    ORDER BY title, year";
    $movieResult = mysql_query($movieQuery, $db_connection);

    $actorQuery = "SELECT id, first, last, IF(dob,DATE_FORMAT(dob,'%m-%d-%Y'),NULL)
    FROM Actor
    WHERE".$actorCond;
    $actorResult = mysql_query($actorQuery, $db_connection);

    ?>
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
        <?php $row = checkNull($row,'<i>no data</i>'); ?>
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
     <th>Date of Birth</th>
 	</tr>
       </thead>
       <tbody>
         <?php
         // generate row with full name and year
         while($row = mysql_fetch_row($actorResult)): ?>
         <?php $row = checkNull($row,''); ?>
         <tr>
           <td>
             <a href="./actor.php?id=<?php echo $row[0];?>"><?php echo $row[1].' '.$row[2];?></a>
           </td>
           <td>
             <a href="./actor.php?id=<?php echo $row[0];?>"><?php echo $row[3];?></a>
           </td>
         </tr>
       <?php endwhile ?>
       </tbody>
     </table>

  <?php else: ?>

    <h2>Invalid search query.</h2>

  <?php endif; ?>
</div>

<?php mysql_close($db_connection); ?>
<?php include 'footer.php' ?>
