 <?php 
include_once "includes/header.php";
include_once "inc/code.php";

?>
<!-- start page content -->
            <div class="page-content-wrapper">
                <div class="page-content">
             <div class="page-bar">
                        <div class="page-title-breadcrumb">
                            <div class=" pull-left">
                                <div class="page-title">Refund Docs</div>
                            </div>
                            <ol class="breadcrumb page-breadcrumb pull-right">
                                <li><i class="fa fa-home"></i>&nbsp;<a class="parent-item" href="dashboard.php">Home</a>&nbsp;<i class="fa fa-angle-right"></i>
                                </li>
                                <li class="active">Refund Docs</li>
                            </ol>
                        </div>
                    </div>

<div class="col-sm-12">
    <div class="panel">
      <div class="msg"></div>
  <div class="panel-body"><div class="modal-content">
          <div class="modal-header"></div>
        <form  action="php_action/custom_action.php" id="document_file_form"  enctype="multipart/form-data">
        

      <div class="modal-body">
       <div class="row form-group">
        <label>Title</label>
        <input type="text" name="add_document_title_d" class="form-control" required>
        <input type="hidden" name="request_id" id="request_id" class="form-control" value="<?=$_REQUEST['id']?>" required>
       
       </div>
        <div class="row form-group">
        <label>File</label>
        <input type="file" name="refund_docs_file" id="refund_docs_file" class="form-control" required>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="document_file_btn" class="btn btn-primary">Save changes</button>
      </div>
    
      </form>
    </div></div>
</div>

    <div class="panel">

    <div class="panel-heading bg-orange" align="center">

      <h5><span class="glyphicon glyphicon-user"></span> Customer Bank Management system</h5>

    </div>

  
    <div class="panel-body"><table class="table  data-table" id="doc_fund_tb">

  <thead>

    <tr class="">

      

      <th>#</th>

      <th>Title</th>

      <th>Document</th>

      <th>Time</th>

    

  </thead>

  <tbody>
    <?php $reqest_docq=mysqli_query($dbc,"SELECT * FROM  refund_docs WHERE request_id='".$_REQUEST['id']."' ");$c=0;

      while ($reqest_doc=mysqli_fetch_assoc($reqest_docq)):
        $c++;
    
     ?>
     <tr>
      <td><?=$c?></td>
      <td><?=$reqest_doc['document_title']?></td>
      <td><a target="_blank" href="<?=$reqest_doc['document_file']?>"><?=$reqest_doc['document_file']?></a></td>
      <td><?=$reqest_doc['timestamp']?></td>
      
      
     </tr>
    <?php endwhile; ?>
  </tbody>

</table></div>

        

  </div>


</div>
  </div></div>

<?php

include_once "includes/footer.php";
?>

