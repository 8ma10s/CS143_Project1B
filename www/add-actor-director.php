<?php include 'header.php';?>
<?php include 'database.php';?>



<div class="row">
  <h2>Add New Actor/Director</h2>
  <?php //if not the first time you open the page ?>
  <?php if(!empty($_POST)) :?>
    <?php
    $iError= 0; //input error
    $actorInfo = array(); //store all info about actor being added
    $outStr = ""; //store all strings that need to be outputted at the end
    // check that each necessary field is not empty. if empty, return error
    if(empty($_POST['firstName'])){
      $outStr = $outStr."<strong>Error!</strong> First name cannot be empty.<br>";
      $iError=1;
    }
    $actorInfo['first'] = $_POST['firstName'];

    if(empty($_POST['lastName'])){
      $outStr = $outStr."<strong>Error!</strong> Last name cannot be empty.<br>";
      $iError=1;
    }
    $actorInfo['last'] = $_POST['lastName'];

    if(empty($_POST['sex']) and $_POST['type'] == 'Actor'){
      $outStr = $outStr."<strong>Error!</strong> You must specify male/female.<br>";
      $iError=1;
    }
    $actorInfo['sex'] = $_POST['sex'];

    if(empty($_POST['dob'])){
      $outStr = $outStr."<strong>Error!</strong> Date of birth cannot be empty.<br>";
      $iError=1;
    }

    //dob must match format and be in the correct range
    else if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$_POST['dob'])){
      $outStr = $outStr."<strong>Error!</strong> Date of birth must be in the format yyyy-mm-dd.<br>";
      $iError=1;
    }
    else{
      $actorInfo['dob'] = str_replace("-","",$_POST['dob']);
      //separate year, month, and day component of the string dob
      $yr = substr($actorInfo['dob'], 0, 4);
      $mo = substr($actorInfo['dob'],4,2);
      $da = substr($actorInfo['dob'],6,2);
      if(!checkdate($mo,$da,$yr)){
        $outStr = $outStr."<strong>Error!</strong> Invalid date of birth range.<br>";
        $iError=1;
      }
    }

    //if dod is empty, null should be inserted
    if(empty($_POST['dod'])){
      $actorInfo['dod'] = '\\N';
    }
    //if nonempty, dod must match format and be in the correct range
    else{
      if(!preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/",$_POST['dod'])){
        $outStr = $outStr."<strong>Error!</strong> Date of death must be in the format yyyy-mm-dd.<br>";
        $iError=1;
      }
      else{
        $actorInfo['dod'] = str_replace("-","",$_POST['dod']);
        //separate year, month, and day component of the string dod
        $yr = substr($actorInfo['dod'], 0, 4);
        $mo = substr($actorInfo['dod'],4,2);
        $da = substr($actorInfo['dod'],6,2);
        if(!checkdate($mo,$da,$yr)){
          $outStr = $outStr."<strong>Error!</strong> Invalid date of death range.<br>";
          $iError=1;
        }
        //if correct, dod must be before dob
        else if($actorInfo['dod'] < $actorInfo['dob']){
          $outStr = $outStr."<strong>Error!</strong> Date of death must be same as or after date of birth.<br>";
          $iError=1;
        }
      }
    }
    //if no error, success ?>
    <?php if($iError==0) :?>
      <?php
      //open connection
      $db_connection = connectToDB();
      // increment maxPersonID
      $maxID;
      $maxIDQuery = 'UPDATE MaxPersonID
      SET id = id + 1';
      //if incrementind id succeeds, get that incremented maxID
      if(mysql_query($maxIDQuery, $db_connection)){
        $maxIDQuery = 'SELECT MAX(id) as maxID
        FROM MaxPersonID';
        $result = mysql_query($maxIDQuery, $db_connection);
        $row = mysql_fetch_row($result);
        $maxID = $row[0];

        //insert actor/director

        $actorInfo['type'] = $_POST['type'];
        $insertQuery = '';

        //if actor
        if ($actorInfo['type'] == 'Actor'){
          $insertQuery = 'INSERT INTO Actor
          VALUES ('.$maxID.',"'.$actorInfo['last'].'","'.$actorInfo['first'].'","'.$actorInfo['sex'].'",'.$actorInfo['dob'].','.$actorInfo['dod'].')';
        }
        //if director
        else{
          $insertQuery = 'INSERT INTO Director
          VALUES ('.$maxID.',"'.$actorInfo['last'].'","'.$actorInfo['first'].'",'.$actorInfo['dob'].','.$actorInfo['dod'].')';
        }

        mysql_query($insertQuery,$db_connection);
      }
      //if query for maxID failed, return error
      else{
        echo "Your input was correct, but the server failed to insert your input. Try again.<br>";
      }

      //either way, close connection
      mysql_close($db_connection);
      ?>
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
        <strong>Success!</strong> Actor/Director added to database.<br>
      </div>
    <?php else :?>
      <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" ><span>&times;</span></button>
        <?php echo $outStr; ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>

  <form method="POST" action="#">
    <label class="radio-inline">
      <input type="radio" name="type" value="Actor" checked="checked"> Actor
    </label>
    <label class="radio-inline">
      <input type="radio" name="type" value="Director"> Director
    </label>
    <div class="form-group">
      <label for="firstName">First Names</label>
      <input type="text" name="firstName" class="form-control" placeholder="Johnny">
    </div>
    <div class="form-group">
      <label for="lastName">Last Name</label>
      <input type="text" name="lastName" class="form-control"  placeholder="Depp">
    </div>
    <label class="radio-inline">
      <input type="radio" name="sex" value="Male"> Male
    </label>
    <label class="radio-inline">
      <input type="radio" name="sex" value="Female"> Female
    </label>
    <div class="form-group">
      <label for="dob">Date of Birth</label>
      <input type="text" name="dob" class="form-control" placeholder="YYYY-MM-DD">
    </div>
    <div class="form-group">
      <label for="dod">Date of Death</label>
      <input type="text" name="dod" class="form-control" placeholder="YYYY-MM-DD">
      <span id="helpBlock" class="help-block">Leave blank if actor/director is still alive.</span>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

<?php include 'footer.php' ?>
