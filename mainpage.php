<?php
    if(!session_id()) session_start();
	
	include("connection.php");
	
	$query="SELECT * FROM `users` WHERE `id`='".$_SESSION['id']."' LIMIT 1";
	$getTimes="SELECT * FROM `times` WHERE `user_id`='".$_SESSION['id']."' ORDER BY `id` DESC";
	
	$result = mysqli_query($link,$query);
	$times = mysqli_query($link,$getTimes);
	
	$row = mysqli_fetch_array($result);
	
	$fullname=$row['name'];
	$company=$row['company'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>
      
        clockMiN &middot; <?php echo $fullname; ?>
      
    </title>

    
      <link href="http://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet">
      <link href="assets/css/bootstrap.min.css" rel="stylesheet">	
      <link href="assets/css/toolkit.css" rel="stylesheet">
      <link href="assets/css/application.css" rel="stylesheet">
    

    

    <style>
      /* note: this is a hack for ios iframe for bootstrap themes shopify page */
      /* this chunk of css is not part of the toolkit :) */
      /* …curses ios, etc… */
      @media (max-width: 768px) and (-webkit-min-device-pixel-ratio: 2) {
        body {
          width: 1px;
          min-width: 100%;
          *width: 100%;
        }
        #stage {
          height: 1px;
          overflow: auto;
          min-height: 100vh;
          -webkit-overflow-scrolling: touch;
        }
      }
    </style>
    <script src="assets/js/bootstrap.min.js async"></script>
    <script src="assets/js/jquery.min.js async"></script>
    <script src="assets/js/toolkit.js async"></script>
    <script src="assets/js/application.js async"></script>
  </head>


<body>

<nav class="navbar navbar-default navbar-static-top navbar-padded app-navbar">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed p-x-0" data-toggle="collapse" data-target="#navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">
        <span>clockMiN</span>
      </a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
              <a data-target="#" id="dLabel" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $fullname; ?><span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="dLabel">
                <li><a href="#">Edit Profile</a></li>
                <li><a href="#">Submit Bug</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="index.php?logout=1">Log Out</a></li>
              </ul>
          </li>     
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
    
<div class="block-nopad block-bordered-lg text-center">
  <div class="container-fluid">
    <h1 class="block-title">Time Clock for <?php echo $fullname; ?></h1>
        <h4 class="text-muted"><?php echo $company; ?></h4>

            <?php
                if ($error) {	
                    echo '<div class="alert alert-danger">'.addslashes($error).'</div>';	
                }
                if ($message) {	
                    echo '<div class="alert alert-success">'.addslashes($message).'</div>';
                }
            ?>
            
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel-default timeTab text-center">
              <!-- Default panel contents -->
              <div class="panel-heading">Your Recorded Times</div>
              <div class="panel-body">
                <p>Here are your recorded times, along with controls for you to use!
                    <ul class="control-group">
                        <li><a id="clockin" href="">Clock In</a></li>
                        <li><a id="lunchout" href="">Clock Out For Lunch</a></li>
                        <li><a id="lunchin" href="">Clock In From Lunch</a></li>
                        <li><a id="clockout" href="">Clock Out</a></li>
                    </ul>
                </p>
              </div>
        <?php
            echo "<div class='table-responsive' id='timetab'>
            <table class='table table-striped table-condensed table-hover'>
            <tr>
            <th class='text-md-center'>Date</th>
            <th class='text-md-center'>Clock In</th>
            <th class='text-md-center'>Lunch Out</th>
            <th class='text-md-center'>Lunch In</th>
            <th class='text-md-center'>Clock Out</th>
            </tr>";

             while($rows = mysqli_fetch_array($times))
             {
             echo "<tr>";
              echo "<td>" . $rows['date'] . "</td>";
              echo "<td>" . $rows['clock_in'] . "</td>";
              echo "<td>" . $rows['clock_out_lunch'] . "</td>";
              echo "<td>" . $rows['clock_in_lunch'] . "</td>";
              echo "<td>" . $rows['clock_out'] . "</td>";
              echo "</tr>";
             }
            echo "</table>
            </div>";

            mysqli_close($link)
        ?>
            </div>
            </div>             
        </div>
    </div>
  
   
<div class="block app-block-footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-2 m-b">
        <ul class="list-unstyled list-spaced">
          <li><h6 class="text-uppercase">Learn More</h6></li>
          <li>Todo</li>
          <li>Calendario</li>
          <li>Email Town</li>
          <li>Pomodorotary</li>
          <li>ChillTower</li>
        </ul>
      </div>
      <div class="col-sm-2 m-b">
        <ul class="list-unstyled list-spaced">
          <li><h6 class="text-uppercase">Extras</h6></li>
          <li>AutotuneU</li>
          <li>Freestyler</li>
          <li>Chillaxation</li>
        </ul>
      </div>
      <div class="col-sm-2 m-b">
        <ul class="list-unstyled list-spaced">
          <li><h6 class="text-uppercase">Support</h6></li>
          <li><a href="#">F.A.Q.</a></li>
          <li><a href="#">Help</a></li>
          <li><a href="#">Tutorials</a></li>
          <li><a href="#">Submit A Bug</a></li>
        </ul>
      </div>
       <div class="col-sm-6">
        <h6 class="text-uppercase">About</h6>
        <p>clockMiN was created out of neccessity! The necessity to have a quick and simple way to track your working time! I needed something I could pull up on my phone, be intuitive and easy-to-use! If this sounds like something you need; go ahead, sign-up and '<strong>Welcome to clockMiN!</strong>'
 </p>
        <!-- <p>Shoutout to Invision team for creating the <a href="http://www.invisionapp.com/do">Do UI kit</a> that we used to fake our app screenshots. Also to the Dribbble community for providing phone mockups that look amazing.</p> -->
        
      </div>
    </div>
  </div>
</div>
	 <script type="text/javascript">
		$(".contentCont").css("min-height",$(window).height());
		
		$("#clockin").click(function() {
			$.post("clock.php", {time:"clockin"}, 
			function(response,status){
			});
			$('.timeTab').load ('mainpage.php', 'update=true');
		});
		
		$("#lunchin").click(function() {
			$.post("clock.php", {time:"lunchin"}, 
			function(response,status){
			});
			$('.timeTab').load ('mainpage.php', 'update=true');
		});
		
		$("#lunchout").click(function() {
			$.post("clock.php", {time:"lunchout"}, 
			function(response,status){
			});
			$('.timeTab').load ('mainpage.php', 'update=true');
		});
		
		$("#clockout").click(function() {
			$.post("clock.php", {time:"clockout"}, 
			function(response,status){
			});
			$('.timeTab').load ('mainpage.php', 'update=true');
			
		$(document).ready (function () {
   			var updater = setTimeout (function () {
        	$('.timeTab').load ('mainpage.php', 'update=true');
    		}, 1000);
			});
		});
	</script>
  </body>
</html>