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
	       	// ..
	      });
	</script>
	
  </head>
  <body>

	<h1 class="jumbotron"><a href="/answers">Answers</a></h1>
	<br><br>

    <div class="container">
      <div class="span12">
		
    		<?php
				if (empty($answer))
				{
					echo "Sorry, that does not exist. ";
				}
				else
				{
					$answeredOn = strtotime($answer->timeCreated);
					$answeredOn = date('F j, Y \a\t g:ia', $answeredOn);
					
					$askedOn = strtotime($question->timeCreated);
					$askedOn = date('F j, Y \a\t g:ia', $askedOn);
					
					echo '<div class="well answerContainer">';
					echo "<div style=\"float:right;\"><span class=\"label\">" . $question->category . "</span></div>";
					echo "<b>Asked on $askedOn by $question->name:</b><br> " . nl2br($question->question) . "<br><br>";
					echo "<b>Answered on $answeredOn:</b><br> " . nl2br($answer->answer) . "<br>";
					echo "</div>";
				}
       		?>

			<a href="/">Ask</a> a question of your own or <a href="/answers">find answers</a>.

      </div>

    </div>

  </body>
</html>