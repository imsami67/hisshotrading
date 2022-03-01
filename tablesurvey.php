<div class="col-sm-6" >
		
		<div class="col-sm-12">
		<?php
		 $thisMonth = date('Y-m-d');
		 $thisMonth2 = date('F,d-m-Y');
		$sql= "SELECT * FROM budget ";
				$result = mysqli_query($dbc, $sql);
	
	if ( mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_array($result)){

			 $show =  $row[3];
			
			if ($show == 'income') {

				  @$ActiveClients = count($show);
						@$temp = $temp+$ActiveClients;
						@$ammountincom =$row[2];
						@$ammountincomnow = $ammountincomnow+$ammountincom; 								
							}				
			elseif ($show == 'expense') {
						
			 @$Noportalaccess = count($show);
			 @$temp2 = $temp2+$Noportalaccess;	
			 @$ammountexp =$row[2];
						@$ammountexpnow = $ammountexpnow+$ammountexp; 					# code...
			

 }
}
}
$dataPoints = array( 
	array("label"=>"Income", "y"=> $ammountincomnow),
	array("label"=>"Expenses", "y"=>$ammountexpnow)
	
);


//echo $temp;
?>
			
			<div id="chartContainer" style="height: 100%; width: 100%;"></div>



			</div>
			
			
			


		</div>
	


	<div class="col-sm-6">
		<div class="info-box bg-blue ">
				<div class="panel panel-heading text-center" style="color: black">Analysis </div>
				<div class="panel panel-body">
					<div class="col-sm-12">

						<div class="info-box bg-blue">
					            <span class="info-box-icon push-bottom"><i class="material-icons">done</i></span>
					            <div class="info-box-content">
					              <span class="info-box-text">Income</span>
					              <span class="info-box-number"><?php echo $ammountincomnow ?></span>	
				
					              
					            </div>
					            <!-- /.info-box-content -->
					          </div>

					          <div class="info-box bg-orange">
					            <span class="info-box-icon push-bottom"><i class="material-icons">explore</i></span>
					            <div class="info-box-content">
					              <span class="info-box-text">Expense</span>
					              <span class="info-box-number"><?php echo $ammountexpnow ?></span>
					              
					            </div>
					            <!-- /.info-box-content -->
					          </div>


					           <div class="info-box bg-success">
					            <span class="info-box-icon push-bottom"><i class="material-icons">card_travel</i></span>
					            <div class="info-box-content">
					              <span class="info-box-text">Total Profit</span>
					              <span class="info-box-number"><?= $ammountincomnow - $ammountexpnow?></span>
					              
					            </div>
					            <!-- /.info-box-content -->
					          </div>
		
		
		
		
		
	</div> <!--/col-md-4-->

	
				</div>
		</div>
	</div>


	<script>
window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title: {
    text: " Profit And Expenses"
  },
  subtitles: [{
    text: "<?=$thisMonth2?>"
  }],
  data: [{
    type: "pie",
    yValueFormatString: "#,##0.\"\"",
    indexLabel: "{label} ({y})",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();
 
}
</script>