<html>
  <head>
    <title>Ask the Company: Admin</title>
    <script src="/assets/js/jquery-min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/parsley.min.js"></script>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">

	<script type="text/javascript">
	      $(function() {
		
			 $('#answer').focus();
			
	      	 $('#save').click(function() {
				$('#manageForm').submit();
			 });
			
			$("input[name=answered]").change(function () {
				answeredVal = $(this).val();
				
				if (answeredVal == 1)
				{
					$('#sendContainer').fadeIn();
				}
				else
				{
					$('#sendContainer').fadeOut();
				}
				
			});
			
			$("input[name=sendEmail]").change(function () {
				sendVal = $(this).val();
				
				if (sendVal == 1)
				{
					$('#recipientContainer').fadeIn();
					$('#sendAddress').focus();
				}
				else
				{
					$('#recipientContainer').fadeOut();
				}
			});
				
	      });
	  </script>

	  <style>
		input { height: 28px; }
		
		#recipientContainer
		{
			display: none; 
			margin-top: 5px;
			padding-left: 16px; 
			padding-top: 5px; 
			background: #FFFFCC; 
			width: 50%; 
			-moz-border-radius:10px;  /* for Firefox */
			-webkit-border-radius:10px; /* for Webkit-Browsers */
			border-radius:10px; /* regular */
		}
	  </style>

  </head>
  <body>

	<h1 class="jumbotron"><a href="/admin">Admin</a></h1>
	<br><br>

    <div class="container">
      <div class="span12 well">
		<b><?php echo nl2br($question->question); 
		
			$askedOn = strtotime($question->timeCreated);
			$askedOn = date('F j, Y \a\t g:ia', $askedOn);
		
		?></b>
		<br>
        -- Asked by <?php echo $question->name; ?> on <?php echo $askedOn; ?>

		<br><br>

		<form class="form" id="manageForm" method="post" action="/admin/saveManageForm" data-validate="parsley">
			
			<input type="hidden" name="id" value="<?php echo $question->id;?>">
			<label for="answer">Answer</label>
			<textarea name="answer" id="answer" data-required="true" autocomplete="off" style="width: 100%; height: 125px;"><?php if (isset($answer->answer)) { echo $answer->answer; } ?></textarea>
			
			<br><br>
			
			<label for="category">Category</label>
			<?php 
			$options = array(
							"Uncategorized" => "Uncategorized",
			                "Sales" => "Sales",
							"Marketing" => "Marketing",
							"Billing" => "Billing",
							"Technical Support" => "Technical Support",
							"Data Centers" => "Data Center",
							"Financial" => "Financial",
							"General" => "General",
							"Human Resources" => "Human Resources",
							"Customer Service" => "Customer Service",
							"Vendors and Partners" => "Vendors and Partners",
							"Company Owners" => "Company Owners"
			                );
			
					
			echo form_dropdown('category', $options, $question->category);
			?>
			
			<br><br>
			
			<label for="answered">Flag this as answered so that it can be seen by employees?</label>
			<input type="radio" name="answered" value="1" checked> Yes
			<input type="radio" name="answered" value="0"> No
			
			<br><br>
			
			<div id="sendContainer">
				<label for="sendEmail">Send an email containing this question and answer after saving?</label>
				<input type="radio" name="sendEmail" value="1"> Yes
				<input type="radio" name="sendEmail" value="0" checked> No
			
				<div id="recipientContainer">
					<label for="sendAddress">Recipient:</label>
					<input type="text" id="sendAddress" name="sendAddress" value="CZy9ZvqiVhQeb0@fortressitx.com">
				</div>
			
				<br><br>
			</div>
			
			<a href="#" class="btn btn-primary" id="save">Save</a>
			<a href="/admin" class="btn" id="cancel">Cancel</a>
		</form>
		
		<?php
		  	if (!empty($activity))
			{
				echo "<h3>Previous Activity</h3>";
				echo "<table class=\"table table-condensed\">";
				echo "<th>Timestamp</th><th>User</th><th>Action</th>";
				foreach ($activity as $actionRecord)
				{
					$actionTs = strtotime($actionRecord->ts);
					$actionTs = date('F j, Y \a\t g:ia', $actionTs);
					$user = $actionRecord->user;
					$action = $actionRecord->action;

					echo "<tr>";
					echo "<td>$actionTs</td>";
					echo "<td>$user</td>";
					echo "<td>$action</td>";
					echo "</tr>";
				}
				echo "</table>";
			}
		  ?>
		
      </div>
	
    </div>

  </body>
</html>
