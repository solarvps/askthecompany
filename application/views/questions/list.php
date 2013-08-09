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
	      	$('.questionAdminRow').click(function()
			{
				var id = $(this).attr('data-id');
				window.location = '/admin/manage/' + id;
			});
	      });
	  </script>
	
	 <style>
		.questionAdminRow:hover { cursor: pointer; }
	 </style>
	

  </head>
  <body>

	<h1 class="jumbotron">Admin</h1>
	<br><br>

    <div class="container">
      <div class="span12">
	
		<?php if ($saved == 1 && $emailed == 1) { ?>
			<div class="alert alert-success">Saved and emailed!</div>
		<?php } else if ($saved == 1) { ?>
			<div class="alert alert-success">Saved!</div>
		<?php } ?>
	
	<h3>Click on a question to answer it... </h3>
	<br>
	
        <table class="table">
          <tr>
          <th>Asked on</th>
          <th>Asked by</th>
          <th>Question</th>
          <th>&nbsp;</th>
          <?php foreach ($questions as $question): 
	
					$askedOn = strtotime($question->timeAsked);
					$askedOn = date('F j, Y \a\t g:ia', $askedOn);
					$questionText = nl2br($question->question);
	
			?>
            <tr class="questionAdminRow" data-id="<?= $question->id ?>">
              <td><?= $askedOn ?></td>
              <td><?= $question->name ?></td>
              <td><?= $questionText ?></td>
              <td>
                <?php if ($question->answered == 1): ?>
                  <span class="label label-success">Answered</span>
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </table>
      </div>
    </div>

  </body>
</html>