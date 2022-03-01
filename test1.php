<!DOCTYPE html>

<html lang="en">

  <head>

    <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  </head>

  <body style="background-color: #f2fafc;">

    <table align="center"  cellspacing="0" cellpadding="10" >

      



      <tr>



        <th style="padding-right: 20px;"><img src="https://nexcojapan.com/admin/img/logo.png" alt="" height="80" width="80"></th>

        <th style="font-family: Nunito, Arial, Helvetica Neue, Helvetica; font-size: 24px;">NEXCO COMAPANY LTD</th>

      </tr>

    </table>

    <table align="center" cellspacing="0" width="600"  cellpadding="10" style="background-color: #fff; border-radius: 15px;">
    	
      <tr>

        <th colspan="4" align="center">Your Invoice Has been been Submited Successfully</th>

      </tr>
       <tr>

        <th colspan="4" align="center"><h3>Vehicle Details</h3></th>

      </tr>



      <tr>

        <td  align="left"  width="93px">

          Vehicle Name: 

        </td>

        <td width="93px">'.@$brand['brand_name'].' '.@$maker['maker_name'].'</td>

   

        <td width="93px">

         Chassis No.

        </td>
<td width="93px">'.@$models['model_name'].'-'.@$v['vehicle_chassis_no'].'</td>
       


      </tr>

      <tr>

        <td  align="left"  width="93px">

          Vehicle Type: 

        </td>

         <td width="93px">'.@$body_type['body_type_name'].'</td><!-- input -->




        <td width="93px">

          Vehicle Color:

        </td>

        <td width="93px">'.@$v['vehicle_color'].'</td>



      </tr>
       <tr>

        <th colspan="4" align="center"><h3>Payment Details</h3></th>

      </tr>
      <tr>
      	

        <td  align="left"  width="93px">

        Paid Amount 

        </td>

         <td width="93px">'.@$body_type['body_type_name'].'</td><!-- input -->




        <td width="93px">

          Remaining Amount:

        </td>

        <td width="93px">'.@$v['vehicle_color'].'</td>



      
      </tr>
      <tr>
        

        <td  align="left" colspan="2"  width="93px">

           Next Due Date

        </td>

         <td  width="186px" align="left" colspan="2">'.@$v['invoice_next_due'].'</td><!-- input -->

      
      </tr>
    </table>

    



    

  </body>

</html>