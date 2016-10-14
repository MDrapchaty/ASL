<?php
//Drapchaty Matthew
defined('BASEPATH') OR exit('No direct script access allowed');

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
</head>
<body>
	<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=211684055910887";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
			<div id="header">
				<h1>TipKno</h1>
				<h3>the free and easy to use tip manager</h3>
				<div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false"></div>
				<a href="#">Logout</a>
	</div>
	<div id="main">
		<section>
			<h2>choose a job</h2>
			<div>
				<ul>
					<?php
				    	foreach ($jobs as $job) {
				    		$path3 = site_url('Welcome/deletejob/'. $job->jobid);
				    		echo '<li>' . $job->jobname . '<a href="' . $path3 .  '">Delete</a> </li>';
				    	}
				    ?>
			    </ul>
				<a href="">+ Add Job</a>
				<?php
                 $this->load->helper('form');
                 echo form_open('Welcome/addjob');
				?>
				<p>Enter Job Name:</p>
				<? echo form_input('jobname', '', 'placeholder="Company Name"');
				   echo form_submit('submit', 'Add Job'); 
			   	   echo form_close();
				?>
		    </div>
		</section>
		<section>
			<div>
			<p>View Tips:</p>
			<a href="#">+ Add Tip</a>
			</div>
			<table>
			<tr>
				<th>Day</th>
				<th>Tips</th>
				<th>Hours</th>
				<th>Week</th>
				<th>Month</th>
			</tr>


			<?php
		    	foreach ($tips as $object) {
		    		$path = site_url('Welcome/deletetip/'. $object->tipid);
		    		echo '<tr><td>' . $object->dayname . '</td><td>' . $object->tipamount . '</td><td>' . $object->hours . '</td><td>'  . $object->week . '</td><td>' . $object->monthname . '</td><td><a href=" ' . $path . '"><button>Delete</button></a></td></tr>' ;
		    	}

		    	?>
		    </table>

		
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

		  <?php echo form_submit('submit', 'Add Tip'); 
		   echo form_close(); 
		 	echo base_url();

		 	//SAME ERROR FOR THIS TEST
		 	 $test1 = site_url('Welcome/login');
		 	echo ' <a href="' . $test1 . ' ">Test</a>' ;
		   ?>
			
		</section>


	</div>

	

</body>
</html>