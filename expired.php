<?php  require_once 'php_action/core.php';  ?>

<!DOCTYPE html>
<html>
<head>

	<title>Stock Management System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

	<!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">

  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
	<div class="container"  style="margin-top: 100px;">
		<div class="row" >
		<div class="col-sm-3"></div>
			<div class="col-sm-6" align="center">
				<div class="panel panel-danger">
					<div class="panel-heading" >
						<h2>Software Expired.......!</h2>
					</div>
					<div class="panel-body" align="center">
						Software Expired ... :( <br/>
						Kindly Contact to developer..<br/>
						<h1>Call: 03457573667</h1>

					</div>
				</div>
			</div>
		</div>
	</div>




</div> <!-- container -->
<!-- container -->
		 <footer class="footer">

      <div class="container">
      <div class="well">
       <div class="row">
       
       		<div class="col-sm-6 text-center">
       		<br>
       			<strong>All Copyright &copy; Reserved by :  &reg;</strong>

       		</div>
       		<div class="col-sm-6 text-center">
       		<br>
       			<strong>Software Developed By : <a href="http://www.facebook.com/mheart12" target="_blank">Tameem sajid (sami)</a> (0345-7573667)</strong>
       		</div>

       </div>
      </div>
    </footer>

	

	<!-- file input -->
	<script src="assests/plugins/fileinput/js/plugins/canvas-to-blob.min.js'); ?>" type="text/javascript"></script>	
	<script src="assests/plugins/fileinput/js/plugins/sortable.min.js" type="text/javascript"></script>	
	<script src="assests/plugins/fileinput/js/plugins/purify.min.js" type="text/javascript"></script>
	<script src="assests/plugins/fileinput/js/fileinput.min.js"></script>	


	<!-- DataTables -->
	<script src="assests/plugins/datatables/jquery.dataTables.min.js"></script>

      <script type="text/javascript">

$(document).ready(function() {
       $("input:text:visible:first").focus();

// Map [Enter] key to work like the [Tab] key
// Daniel P. Clark 2014
 
// Catch the keydown for the entire document
$(document).keydown(function(e) {
 
  // Set self as the current item in focus
  var self = $(':focus'),
      // Set the form by the current item in focus
      form = self.parents('form:eq(0)'),
      focusable;
 
  // Array of Indexable/Tab-able items
  focusable = form.find('input,a,select,button,textarea,div[contenteditable=true]').filter(':visible');
 
  function enterKey(){
    if (e.which === 13 && !self.is('textarea,div[contenteditable=true]')) { // [Enter] key
 
      // If not a regular hyperlink/button/textarea
      if ($.inArray(self, focusable) && (!self.is('a,button'))){
        // Then prevent the default [Enter] key behaviour from submitting the form
        e.preventDefault();
      } // Otherwise follow the link/button as by design, or put new line in textarea
 
      // Focus on the next item (either previous or next depending on shift)
      focusable.eq(focusable.index(self) + (e.shiftKey ? -1 : 1)).focus();
 
      return false;
    }
  }
  // We need to capture the [Shift] key and check the [Enter] key either way.
  if (e.shiftKey) { enterKey() } else { enterKey() }
});

});

</script>

</body>
</html>