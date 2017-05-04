<?php include 'header.php';?>

<div class="row">
  <h2>Add New Actor</h2>
  <?php
  //if not the first time you open the page
  if(!empty($_GET)): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
      <?php
      $iError= 0; //input error
      $actorInfo = array(); //store all info about actor being added
      // check that each necessary field is not empty. if empty, return error
      if(empty($_GET['firstName'])){
        echo "<strong>Error!</strong> First name cannot be empty.<br>";
        $iError=1;
      }
      $actorInfo['first'] = $_GET['firstName'];

      if(empty($_GET['lastName'])){
        echo "<strong>Error!</strong> Last name cannot be empty.<br>";
        $iError=1;
      }
      $actorInfo['last'] = $_GET['lastName'];

      if(empty($_GET['sex'])){
        echo "<strong>Error!</strong> You must specify male/female.<br>";
        $iError=1;
      }
      $actorInfo['sex'] = $_GET['sex'];

      if(empty($_GET['dob'])){
        echo "<strong>Error!</strong> Date of birth cannot be empty.<br>";
        $iError=1;
      }

      //dob must match format and be in the correct range
      else if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$_GET['dob'])){
        echo "<strong>Error!</strong> Date of birth must be in the format yyyy-mm-dd.<br>";
        $iError=1;
      }
      else{
        $actorInfo['dob'] = str_replace("-","",$_GET['dob']);
        $yr = substr($actorInfo['dob'], 0, 4);
        $mo = substr($actorInfo['dob'],4,2);
        $da = substr($actorInfo['dob'],6,2);
        if(!checkdate($mo,$da,$yr)){
          echo "<strong>Error!</strong> Invalid date of birth range.<br>";
          $iError=1;
        }
      }

      //if dod is empty, null should be inserted
      if(empty($_GET['dod'])){
        $actorInfo['dod'] = '\\N';
      }
      //if nonempty, dod must match format and be in the correct range
      else{
        if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$_GET['dod'])){
          echo "<strong>Error!</strong> Date of death must be in the format yyyy-mm-dd.<br>";
          $iError=1;
        }
        else{
          $actorInfo['dod'] = str_replace("-","",$_GET['dod']);
          $yr = substr($actorInfo['dod'], 0, 4);
          $mo = substr($actorInfo['dod'],4,2);
          $da = substr($actorInfo['dod'],6,2);
          if(!checkdate($mo,$da,$yr)){
            echo "<strong>Error!</strong> Invalid date of death range.<br>";
            $iError=1;
          }
          //if correct, dod must be before dob
          else if($actorInfo['dod'] < $actorInfo['dob']){
            echo "<strong>Error!</strong> Date of death must be same as or after date of birth.<br>";
            $iError=1;
          }
        }
      }

      //if no error, success
      if($iError==0){
        echo "<strong>Success!</strong> Actor added to database.<br>";
      }
      ?>
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
      <input type="radio" name="sex" value="m" checked="checked"> Male
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
