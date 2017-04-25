<html>
  <head>
    <title>BMDb: The Bruin Movie Database</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/select2.min.css">
    <link rel="stylesheet" href="./css/select2-bootstrap.min.css">

    <script src="./js/jquery-3.2.1.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/select2.min.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="./index.php">BMDb</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-navbar-collapse">
	  <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">Add <span class="caret"></span></a>
              <ul class="dropdown-menu">
		<li><a href="./add-actor.php">Actor</a></li>
		<li><a href="./add-director.php">Director</a></li>
		<li><a href="./add-movie.php">Movie</a></li>
		<li role="separator" class="divider"></li>
		<li><a href="./add-movie-actor-relation.php">Movie/Actor Relation</a></li>
		<li><a href="./add-movie-director-relation.php">Movie/Director Relation</a></li>
              </ul>
            </li>
	  </ul>
	  <form class="navbar-form navbar-left">
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
	  </form>
	</div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
    <div class="container">
      
