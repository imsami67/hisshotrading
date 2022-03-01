<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/head.php'; ?>
  <body class="horizontal light  ">
    <div class="wrapper">
  <?php include_once 'includes/header.php'; ?>
      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-bg" align="center">

            <div class="row">
              <div class="col-12 mx-auto h4">
                <b class="text-center card-text">Backup and Restore Database</b>
           
             
              </div>
            </div>
  
          </div>
           <div class="card-body">
<?php include_once 'includes/backup_code.php'; ?>
 
        <style>
          .box{
            padding-top: 50px;
            padding-bottom: 50px;
            padding-left: 10px;
            padding-right: 10px;
            text-decoration: none !important;
            text-align: center;
            font-size: 1.4em;

          }
          .box:hover{
            background-color: #eee;
          }
           <?php $settings = explode('|', file_get_contents("settings.txt")) ; 
             $label=["server","user","password","database","directory"]; 
            ?>
        </style>
        <div class="row">
        
          <div class="col-sm-8 mx-auto">
            <br> <br> <br> <br> 
            <div class="row">
              <div class="col-sm-4">
                <form action="" method="post">
                <button type="submit" name="action" value="backup" class="box btn btn-admin">
                  Backup Database
                </button>
              </form>
              </div><!-- col -->
              <div class="col-sm-4">
                <div class="btn-group">
                  <button class="box btn btn-admin2 btn-lg dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Restore Backup <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a href="#">
                      <form action="" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                          <input type="file" name="f"> 
                          <span class="input-group-btn"><button type="submit" name="upload_back_file" class="btn btn-success btn-xs">Upload</button></span>
                        </div>
                        <input type="hidden" value="<?=@$settings[4]?>/" name="backup_dir">
                        <p class="text-muted">Upload File .sql , sql..gz</p>
                      </form>
                    </a></li>
                    <?php
                    if(is_dir($settings[4])):
                     $opendir = opendir($settings[4]);
                    while($r = readdir($opendir)):
                      $file_address=$settings[4]."/".$r;
                      if($r=="." OR $r==".."){continue;}
                     ?>
                   <li>
                     <div class="input-group">
                     <a href="backup.php?action=restore&backupfile=<?=$r?>"><?=$r?></a>
                       <span class="input-group-btn"> <a href="<?=$file_address?>" download class="btn btn-danger btn-xs center-block"><span class="glyphicon glyphicon-download"></span></a></span>
                     </div>
                   </li>
                 <?php endwhile; ?>
                 <?php else: ?>
                  <li><a href="#">No File Found</a></li>
               <?php endif; ?>
                  </ul>
                </div>
              </div><!-- col -->
            </div><!-- row -->
          </div><!-- col -->
        </div><!-- row -->

           </div>
          </div> <!-- .card -->
        </div> <!-- .container-fluid -->
       
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    
  </body>
</html>
<?php include_once 'includes/foot.php'; ?>