<?php include 'header.php';?>

<div class="row">
  <h2>Add New Movie</h2>
  <form method="GET" action="#">
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
      <input type="text" name="rating" class="form-control" placeholder="PG-13">
    </div>
    <div class="form-group">
      <label for="company">Production Company</label>
      <input type="text" name="company" class="form-control" placeholder="Twentieth Century Fox">
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<?php include 'footer.php' ?>
