<?php
//Drapchaty Matthew
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

</head>
<body>
	
    


<!--
	
		<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '211684055910887',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
-->	

<div id="fb-root"></div>
<script src="//connect.facebook.net/en_US/all.js"></script>
<script>
FB.init({
appId      : '211684055910887',
channelUrl : 'http://localhost:8888/ASL/assignment1/index.php', // Channel File
status     : true, // check login status
cookie     : true, // enable cookies to allow the server to access the session
xfbml      : true  // parse XFBML
});
</script>


	<div id="header">
				<h1>TipKno</h1>
				<h3>the free and easy to use tip manager</h3>
				<button id="logOff" onclick="javascript:logout();">Logout</button>
			<!--	<div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false"></div>
				  -->
	</div>

	<div id="login">
	<h2>Login To Your Facebook Account</h2>
	<script>
	function checkFacebookLogin() 
	    {
	        FB.getLoginStatus(function(response) {
	          if (response.status === 'connected') {
	            	document.getElementById("login").style.display = 'none';
					document.getElementById("main").style.display = 'block';
	          } 
	          else 
	          {
	            initiateFBLogin();
	            
	          }
	         });
	    }


	function initiateFBLogin()
	    {
	        FB.login(function(response) {
					if (response.status === 'connected') {
	            	document.getElementById("login").style.display = 'none';
					document.getElementById("main").style.display = 'block';
	          } 
	         });
	    }


	</script>
	<img src="fb.png" alt="fb">
	<input type="button" value="Log In" onclick="checkFacebookLogin();"/>

	</div>
	<script>
		function logout() {
            FB.logout(function(response) {
              // user is now logged out
            });
            document.getElementById("main").style.display = 'none';
			document.getElementById("login").style.display = 'block';
        }


        function showDiv() {
		   document.getElementById('tipform').style.display = "block";
		}

		function hideDiv() {
		   document.getElementById('tipform').style.display = "none";
		}


        function showDiv2() {
		   document.getElementById('jobform').style.display = "block";
		}

		function hideDiv2() {
		   document.getElementById('jobform').style.display = "none";
		}
	</script>


	<div id="main" style="display:none">

		<section>
			
			<div id="jobs">
				<h2>Your Job's</h2>
				<input type="button" value="+Add Job" onclick="showDiv2()" />
				<ul>
					<?php
				    	foreach ($jobs as $job) {
				    		$path3 = site_url('Welcome/deletejob/'. $job->jobid);
				    		echo '<li>' . $job->jobname . '<a href="' . $path3 .  '";">Delete</a> </li>';
				    	}
				    ?>
			    </ul>
			    </div>
			    <div id="jobform" style="display: none;">
				
				<?php
                 $this->load->helper('form');
                 echo form_open('Welcome/addjob');
				?>
				<p>Enter Job Name:</p>
				<? echo form_input('jobname', '', 'placeholder="Company Name"');
				   echo form_submit('submit', 'Save Job'); 
				   echo '<input type="button" value="Cancel" onclick="hideDiv2()" />';
			   	   echo form_close();
				?>
		    	</div><!-- jobform -->
		</section>
		<section>
			<div id="tips">
				<h4>View Tips:</h4>
				<input type="button" value="+Add Tip" onclick="showDiv()" />
				
				<table id="tipsTab">
				<tr>
					<th>Day</th>
					<th>Tips</th>
					<th>Hours</th>
					<th>Week</th>
					<th>Month</th>
					<th>Job</th>
				</tr>


				<?php
			    	foreach ($tips as $object) {
			    		$path = site_url('Welcome/deletetip/'. $object->tipid);
			    		echo '<tr><td>' . $object->dayname . '</td><td>' . $object->tipamount . '</td><td>' . $object->hours . '</td><td>'  . $object->week . '</td><td>' . $object->monthname . '</td><td>' . $object->jobname  .'</td><td><a href=" ' . $path . '"><button>Delete</button></a></td></tr>' ;
			    	}

			    	?>
			    </table>
			</div>
		<div id="tipform" style="display: none;">
		<?php 
		
		echo form_open('Welcome/addtip'); ?>
		   
		   <p>Enter Tip Amount:</p>
		   <? echo form_input('tipamount', '', 'placeholder="##.## ex.76.34"'); ?>
		   </br>
		   <p>Hours Worked:</p>
		   <? echo form_input('hours', '', 'placeholder="#.# ex.4.5"'); ?>
		   </br>
		   <p>Day:</p>
		   <? $options = array(
		        '1' => 'Sunday',
		      	'2' => 'Monday',
		        '3' =>'Tuesday',
		        '4' => 'Wednesday',
		        '5' => 'Thursday',
		        '6' =>'Friday',
		        '7' => 'Saturday'
				);
		    
		    echo form_dropdown('day', $options, '1'); ?>
		   </br>
			<p>Week Of the Month:</p>
			<? $options2 = array(
		        '1' => 'First Week',
		      	'2' => 'Second Week',
		        '3' =>'Third Week',
		        '4' => 'Fourth Week'
		        
				);
		    echo form_dropdown('week', $options2, '1'); ?>
		   </br>
		    <p>Month:</p>
		    <? $options3 = array(
		        '1' => 'January',
		      	'2' => 'February',
		        '3' =>'March',
		        '4' => 'April',
		        '5' => 'May',
		        '6' => 'June',
		        '7' => 'July',
		        '8' => 'August',
		        '9' => 'September',
		        '10' => 'October',
		        '11' => 'November',
		        '12' => 'December'
				);
		    echo form_dropdown('month', $options3, '1'); ?>
		   </br>
		   <p>Select Job:</p>
		   <?php 
		   $jobarr = array();
		   foreach ($jobs as $job) {
		   		$value1 = $job->jobid;
		   		$value2 = $job->jobname;
		   		$jobarr[$value1] = $value2; 
		   }
		   
		   echo form_dropdown('job', $jobarr, '1');?> 
		   </br>
		   </br>

		  <?php echo form_submit('submit', 'Save This Tip'); 
		   echo '<input type="button" value="Cancel" onclick="hideDiv()" />';
		   echo form_close(); 
		 

		 	//SAME ERROR FOR THIS TEST
		 	 //$test1 = site_url('Welcome/login');
		 	//echo ' <a href="' . $test1 . ' ">Test</a>' ;
		   
		   ?>
		
		</div><!-- tipform-->
		
			<table id="bestTab">
			<caption>Best Days:</caption>
			<tr>
				<th>AVG $ Per Hour</th>
				<th>Job</th>
				<th>Day</th>
				<th>Week</th>
				<th>Month</th>
				
			</tr>
			<?php
			foreach ($results as $result) {
				    		echo '<tr><td>' . $result->result . '</td><td>' . $result->jobname . '</td><td>' . $result->dayname . '</td><td>' . $result->week  . '</td><td>'. $result->monthname . '</td></tr>';
				    	}

			?>

			</table>

		</section>
		

	</div>
	<footer>
			<p>&copy Matt Drapchaty 2016</p>
	</footer>
<script>
	window.onload = checkFacebookLogin();
</script>
	






	<style>
		html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}


body{
	background-color: #BFDBFF;
	font-family: 'Roboto', sans-serif;
	font-weight: bold;
	color: White;
	max-height: 100%;
}

html, body{
	margin: 0;
	height: 100%; 
	overflow: hidden
}


#header{
	background-color: #39587F;
	overflow: auto;
}

#header button{
	background:none!important;
     border:none; 
     padding:0!important;
     font: inherit;
     cursor: pointer;
     color: white;
     float: right;
     margin-right: 1.4em;
     margin-top: 1em;
     font-size: 1.3em;
}

h1{
	float: left;
	font-size: 3.2em;
	margin-left: 1em;
}

h3{
float: left;
margin-top: 2.2em;
margin-left: .6em;
text-transform: capitalize;
}

#login{
	background-color: #606E7F;
	width: 35%;
	height: 12em;
	margin: 8em auto 0;
	padding: 1em;
	text-align: center;
}

#login h2{
	font-size: 1.8em;
}

#login input{
	background-color: #73B0FF;
	color: white;
	border-radius: 25px;
	border: 1px solid black;
	width: 30%;
	height: 25%;
	font-size: 1.1em;
	font-weight: bold;
	position: relative;
	top: -1em;
	left: -2em;
}

img{
	width: 20%;
	position: relative;
	left: -4em;
}

#jobs{
	background-color: #606E7F;
	width: 23%;
	margin-left: 2.5em;
	margin-top: 2.2em;
	height: 24em;
	text-align: center;
}

#jobs h2{
	color: white;
	font-size: 2em;
	margin-bottom: -1em;
}

#jobs ul{
	list-style: none;
}

#jobs ul li{
	display: block;
	background-color: #99AFCC;
	height: 2em;
	margin: .5em auto;
	font-size: 1.7em;
	font-weight: bold;
	width: 75%;
}

#jobs ul li a{
	font-size: .5em;
	margin-left: 1em;
}

#jobs input{
	background:none!important;
     border:none; 
     padding:0!important;
     font: inherit;
     cursor: pointer;
     text-decoration: underline;
     color: white;
     position: relative;
     top: 16em;
     left: -3.5em;
     font-size: 1.3em;
}

#tips input{
	background:none!important;
     border:none; 
     padding:0!important;
     font: inherit;
     cursor: pointer;
     text-decoration: underline;
     color: white;
     position: relative;
     top: -19.3em;
     left: 43.5em;
     font-size: 1.3em;
     z-index: 1;
}

div h4{
	position: absolute;
	top: 4.2em;
	right: 25em;
	color: #606E7F;
}

caption{
	color: #606E7F;
}

th{
	font-size: 1.2em;
	font-weight: bold;
	color: #39587F;
}

#tipsTab{
	background-color: #99AFCC;
	float: right;
	position: relative;
	top: -25em;
	left: -9em;
	height: 15em;
	max-height: 15em;
	width: 50%;
	overflow: scroll;
	padding: 1em;
	
}

#tipsTab tr:nth-child(even){
	background-color: #73B0FF;
}

#bestTab{
	background-color: #99AFCC;
	float: right;
	position: relative;
	top: -10em;
	left: 26.5em;
	height: 5em;
	max-height: 5em;
	width: 50%;
	overflow: scroll;
	padding: 1em;
}

#bestTab tr:nth-child(even){
	background-color: #73B0FF;
}

#jobform{
	width: 23%;
	float: left;
	z-index: 2;
	position: relative;
	right: -2.5em;
	background-color: #73B0FF;
}

#tipform{
	width: 50%;
	position: relative;
	top: -24em;
	right: -26.6em;
	z-index: 3;
	background-color: #73B0FF;
	text-align: center;
}

footer{
	background-color: #39587F;
	position: absolute;
	bottom: 0;
	width: 100%;
	height: 2em;
	text-align: center;
}

	</style>

</body>
</html>