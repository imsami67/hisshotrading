<body aling ="center">
<script type="text/javascript">

 	window.print()
  
</script>				
		
		<?php
			include_once "php_action/db_connect.php"; 
			?>		
	
<div align="center">
<form method="post">
 

	<button type="button" value="Print this page" onclick="printpage()" class="btn btn-info" />Print this page</button>
	</form>
<script type="text/javascript">
function printpage()
  {
  window.print()
  }
</script>			
	</div>			
<table  border="1px solid" width="50%" style="text-align: center;"  align="center"  >
<?php

// $mysql_path = mysql_connect('localhost','root','');
// $mysql_db = mysql_select_db('mursad_alimobile',$mysql_path);

// if(!$mysql_db){
// 	echo mysql_error();
// }
// else{
// 	//echo "Connection Established";
// }




$output = '';

	$sql = "SELECT * FROM product WHERE quantity <=1 AND status = 1";
	
	$result = mysqli_query($dbc, $sql);
	
	if ( mysqli_num_rows($result) > 0) {
		$output .='
		
				<tr>
				<thead>
					<td> Sr#</td>
					<td> Product Name</td>
					<td> selling Rate</td>
					
					<td> Quantity</td>
					
					<td> Totel By selling </td>
					
				</thead>
				</tr>
				';
				
				
				$totel_stock = 0 ;
				$number = 1;
				$totelbyitem_p = 0;
				$totelbyitem_s = 0;
				$totel_quantity = 0;
				$show = '';
				while($row = mysqli_fetch_array($result)){
				$output .='
				<tr>
				<td>'.$number.'</td>
					<td>'.$row["product_name"].'</td>
					<td>'.$row["rate"].'</td>
					
					<td>'.$row["quantity"].'</td>
					
					<td>'. $row["rate"] * $row["quantity"].'</td>					
					</tr>
			
					';
					
					$totelbyitem_s += $row["rate"] *  $row["quantity"];
					$totel_quantity  += $row["quantity"];
						$number ++;
				} // loop

				
                $output .='	
                    <tr >
                    	<td>' ."". '</td>
                    	<td>Totel Amounts</td>
                        <td>' ."". '</td>
                        
						 <td>' .  $totel_quantity   .'</td>
                        
                        <td>'.  $totelbyitem_s .' </td>
                    </tr>';
                    
                
				
	} //if
			echo $output;
	?>
    </table>				
</div>
	<div align="center">
	<strong>Software Developed By : Tameem sajid (sami) (+92-345-7573667)</strong>
	
	</div>
</body>