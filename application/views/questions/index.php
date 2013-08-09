<html>
<head>
  <title>Ask the Company!</title>
  <script src="/assets/js/jquery-min.js"></script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/parsley.min.js"></script>
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/css/animate.min.css">
  <link rel="stylesheet" href="/assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="/assets/css/style.css">

  <script type="text/javascript">
      $(function() {
        function askQuestion()
        {
          $('#questionForm').parsley('validate');

          if ($('#questionForm').parsley('isValid'))
          {
            $.ajax({type:'POST', url: '/index.php/questions/create', data:$('#questionForm').serialize(), success: function(response)
            {
              $('#questionWell').fadeOut(500, function() {
                $('#successAlert').fadeIn();
                 setTimeout(function() { $('#successAlert').fadeOut(500, function() { location.reload(); }); }, 3000);
              });
            }});
          }
          return false;
        }

        $('#name').focus();

        $('#questionButton').click(function() {
          askQuestion();
        });

      });
  </script>

</head>

<body>
<h1 class="jumbotron">Ask the Company!</h1>
<br><br>	
	
<div class="container">

  <div class="row" style="display: none;" id="successAlert">
    <div class="span12 alert alert-success">
      <h2>Your question has been asked. Thanks for asking!</h2>
    </div>
  </div>

  <div class="row">
    <div class="span12 well animated fadein" id="questionWell">
      <form method="post" id="questionForm" data-validate="parsley" onsubmit="return false;">
          <label for="name"><h2>Who are you? Or, leave this blank to be anonymous.</h2></label>
          <input type="text" name="name" id="name" autocomplete="off" style="width: 25%; height: 38px; font-size: 24px;">

          <label for="question"><h2>What is your question?</h2></label>
          <textarea name="question" id="question" data-required="true" autocomplete="off" style="width: 100%; height: 125px; font-size: 24px;"></textarea>


          <a class="btn btn-primary btn-large" id="questionButton"><i class="icon-question-sign"></i> Ask</a>
      </form>
<hr>
		 <p class="muted">
			Anonymously asked questions are just that, anonymous. We DO NOT track ip addresses, computer or browser types or any personally identifiable information. The 
			point of asking anonymously is to ask a question you may be uncomfortable with asking in person. Please DO NOT hesitate to ask the questions you have 
			ALWAYS WANTED TO ASK! 
			<br><br>
			Please note that while we may not be able to answer every question, we WILL make every effort to provide an explanation why.
		</p>
		
		<br><br>
		
		Looking for <a href="/answers">answers</a>?
		
    </div>
  </div>

</div>

</body>

</html>