<form action="php_action/custom_action.php" class="dropzone" id="dropzoneFrom" method="post" enctype="multipart/form-data">
<?php 
  @$id = $_GET['vehicle_id'];


?>
<input type="text" value="<?=@$id?>"  class="vehicle_idMain d-none" name="vehicle_id" id="vehicle_idMain">
   <div class="fallback">
    <input type="hidden" name="vehicle_images_get" value="ac">
    <input name="file[]" type="file" multiple / >
  </div>
</form>
<br>
<div class="row">
  <div class="col-sm-6">
     <button type="button" class="btn btn-success btn-sm float-right" id="reloadimg" onclick="reloaded()">Reload</button>
  </div>
  <div class="col-sm-4">
    
 
  <form method="post" action="downloadZip.php">

          <input type="hidden"  name="vehicle_id" value="<?=$_REQUEST['vehicle_id']?>" />


          <input type="hidden" name="DownloadImagesZip" value="DownloadImagesZip">
          <button type="submit" class="btn btn-info btn-sm float-left"  >Download Images as Zip</button>

          </form>

  </div>
</div>

<style>
.row {
  display: flex;
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.column {
  flex: 25%;
  max-width: 25%;
  padding: 0 4px;
}

.column img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
}

/* Responsive layout - makes a two column-layout instead of four columns */
@media screen and (max-width: 800px) {
  .column {
    flex: 50%;
    max-width: 50%;
  }
}

/* Responsive layout - makes the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .column {
    flex: 100%;
    max-width: 100%;
  }
}

/* Container holding the image and the text */
.container2 {
  position: relative;
  text-align: center;
  color: white;
}

/* Top left text */
.top-left {
  position: absolute;
  top: 15px;
  left: 12px;
  background-color: yellow;
  border: 1px solid red;
  border-radius: 50%;
  color: black;
  padding: 5px 10px;
}

/* Top right text */
.top-right {
  position: absolute;
  bottom: 5px;
  left: 12px;
  color: black;
  font-size: 12px;
  cursor: pointer;
  background-color: white;
  border-radius: 2%;
  color: black;
  padding: 2px 7px;

}
.top-right >input{
  position: relative;
  top: 2px;
}

/* Centered text */
.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

</style> 

	<ul class="row imageGallery list-unstyled" id="post_list">

	</ul>
            

  <script type="text/javascript">
    function reloaded(){
      var id = $(".vehicle_idMain").val();

    
     // $("#imageGallery").load(" #imageGallery > *");
      loadImageGallery(id);
    }
  </script>