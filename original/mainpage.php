<? 

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
<? include("header.php"); ?>

            <div class="collapse navbar-collapse">
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
           </div>
        </div>
    </nav>
    
    <div class="container" id="topCont">
    	<div class="row" id="topRowMain">
        	<div class="col-lg-6 col-lg-offset-3">
            	<h3>Time Clock for <?php echo $fullname; ?></h3>
                <h4 id="compname"><?php echo $company; ?></h4>
                <p>Here are your recorded times, along with controls to "Clock In" and "Clock Out" for both lunch and the day.</p>
                
					<?php
                        if ($error) {	
                            echo '<div class="alert alert-danger">'.addslashes($error).'</div>';	
                        }
                        if ($message) {	
                            echo '<div class="alert alert-success">'.addslashes($message).'</div>';
                        }
                    ?>
                    
                <div class="col-xs-4 col-md-4 controls marginTop">
                Controls
                <ul class="control-group">
                	<li><a id="clockin" href="">Clock In</a></li>
                    <li><a id="lunchout" href="">Clock Out For Lunch</a></li>
                    <li><a id="lunchin" href="">Clock In From Lunch</a></li>
                    <li><a id="clockout" href="">Clock Out</a></li>
                </ul>
                </div>
                
                <div class="col-xs-8 col-sm-6 col-md-8 controls marginTop">
                    <div class="panel panel-default">
                      <!-- Default panel contents -->
                      <div class="panel-heading">Your Recorded Times</div>
                      <div class="panel-body">
                        <p>This is a list of every time you've ever recorded. Soon, you'll be able to filter these results.</p>
                      </div>
                <?php
					echo "<div class='table-responsive timeTab' id='timetab'>
					<table class='table table-striped table-condensed table-hover'>
					<tr>
					<th>Date</th>
					<th>Clock In</th>
					<th>Lunch Out</th>
					<th>Lunch In</th>
					<th>Clock Out</th>
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