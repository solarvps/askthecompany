<html>
  <head>
    <title>Answers</title>
    <script src="/assets/js/jquery-min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <script src="/assets/js/parsley.min.js"></script>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/animate.min.css">
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
	
	<script type="text/javascript">
	      $(function() {
	      	 $(".answerContainer").on(
			{
			    mouseenter: function() 
			    {
					$(this).css('background-color', '#FFFFCC');
					$(this).find('.permalink').css('visibility', 'visible');
			        //$(this).find('.permalink').show();
			    },
			    mouseleave: function()
			    {
					 $(this).css('background-color', '#f5f5f5');
					 $(this).find('.permalink').css('visibility', 'hidden');
			         //$(this).find('.permalink').hide();
			    }
			});
	      });
	</script>
	
	<style>
		.permalink
		{
			visibility: hidden;
		}
	</style>
	

  </head>
  <body>

	<h1 class="jumbotron"><a href="/answers">Answers</a></h1>
	<br><br>

    <div class="container">
      <div class="span12">
	
		<form method="post" action="answers" class="form">
			<table>
				<tr>
					<td>
			<label for="category">Category</label>
			<?php 
			$options = array(
							"All" => "All",
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
			
					
			echo form_dropdown('category', $options, $selectedCategory);
			?>
			</td>
			<td>
			<label for="contains">Contains</label>
			<input type="text" name="contains" id="contains" style="height: 28px;" value="<?php echo $contains; ?>">
			</td>
			<td>
			<input type="submit" class="btn btn-primary" value="Filter" style="margin-top: 14px;">
			</td>
			</tr>
			</table>
		</form>
	
       		<?php
				if (empty($answers))
				{
					echo "Sorry, there are no matches. ";
				}

       			foreach ($answers as $answer)
				{
					$answeredOn = strtotime($answer->timeAnswered);
					$answeredOn = date('F j, Y \a\t g:ia', $answeredOn);
					
					$askedOn = strtotime($answer->timeAsked);
					$askedOn = date('F j, Y \a\t g:ia', $askedOn);
					
					
					echo '<div class="well answerContainer">';
					echo "<div style=\"float:right;\"><span class=\"label\">$answer->category</span></div>";
					echo "<b>Asked on $askedOn by $answer->name:</b><br> " . nl2br($answer->question) . "<br><br>";
					echo "<b>Answered on $answeredOn:</b><br> " . nl2br($answer->answer) . "<br>";
					echo "<span class=\"permalink\"><br><a href=\"/answers/answer/" . $answer->id . "\" class=\"btn btn-mini\">Permalink</a></span>";
					echo "</div>";
				}
       		?>

			<a href="/">Ask</a> a question of your own.

      </div>

    </div>

  </body>
</html>