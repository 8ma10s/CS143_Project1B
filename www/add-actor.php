<?php include 'header.php';?>

<div class="row">
  <h2>Add New Actor</h2>
  <?php if (!empty($_GET['firstName'])): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
      <strong>Success!</strong> Actor added to database.
    </div>
  <?php endif; ?>
  <form method="GET" action="#">
    <div class="form-group">
      <label for="firstName">First Names</label>
      <input type="text" name="firstName" class="form-control" placeholder="Johnny">
    </div>
    <div class="form-group">
      <label for="lastName">Last Name</label>
      <input type="text" name="lastName" class="form-control"  placeholder="Depp">
    </div>
    <label class="radio-inline">
      <input type="radio" name="sex" value="m"> Male
    </label>
    <label class="radio-inline">
      <input type="radio" name="sex" value="f"> Female
    </label>
    <div class="form-group">
      <label for="dob">Date of Birth</label>
      <input type="text" name="dob" class="form-control" placeholder="YYYY-MM-DD">
    </div>
    <div class="form-group">
      <label for="dod">Date of Death</label>
      <input type="text" name="dod" class="form-control" placeholder="YYYY-MM-DD">
      <span id="helpBlock" class="help-block">Leave blank if actor is still alive.</span>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<?php include 'footer.php' ?>
