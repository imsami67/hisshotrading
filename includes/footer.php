   
  </main> <!-- main -->
    </div> <!-- .wrapper -->
  
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/simplebar.min.js"></script>
    <script src='assets/js/daterangepicker.js'></script>
    <script src='assets/js/jquery.stickOnScroll.js'></script>
    <script src="assets/js/tinycolor-min.js"></script>
    <script src="assets/js/config.js"></script>
    <script src="assets/js/d3.min.js"></script>
    <script src="assets/js/topojson.min.js"></script>
    <script src="assets/js/datamaps.all.min.js"></script>
    <script src="assets/js/datamaps-zoomto.js"></script>
    <script src="assets/js/datamaps.custom.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script>
      /* defind global options */
      Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
      Chart.defaults.global.defaultFontColor = colors.mutedColor;
    </script>
    <script src="assets/js/gauge.min.js"></script>
    <script src="assets/js/jquery.sparkline.min.js"></script>
    <script src="assets/js/apexcharts.min.js"></script>
    <script src="assets/js/apexcharts.custom.js"></script>
    <script src='assets/js/jquery.mask.min.js'></script>
    <script src='assets/js/select2.min.js'></script>
    <script src='assets/js/jquery.steps.min.js'></script>
    <script src='assets/js/jquery.validate.min.js'></script>
    <script src='assets/js/jquery.timepicker.js'></script>
    <script src='assets/js/dropzone.min.js'></script>
    <script src='assets/js/uppy.min.js'></script>
    <script src='assets/js/quill.min.js'></script>
       <script src='assets/js/jquery.dataTables.min.js'></script>
    <script src='assets/js/dataTables.bootstrap4.min.js'></script>
    <script src="assets/js/apps.js"></script>
      <script src="assets/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
          <script  src="assets/plugins/material-datetimepicker/moment-with-locales.min.js"></script>

  <script  src="assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.js"></script>

  <script  src="assets/plugins/material-datetimepicker/datetimepicker.js"></script>



    <script src="assets/js/custom.js"></script>
    <script src="assets/js/panel.js"></script>


    <script>

  

    Dropzone.options.dropzoneFrom = {

      autoProcessQueue: true,

      acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",

        init: function(){

            var submitButton = document.querySelector('#submit-all');

            myDropzone = this;

            submitButton.addEventListener("click", function(){

              myDropzone.processQueue();

              alert($('.vehicle_idMain').val());

            });

            this.on("complete", function(){

            if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0){

              var _this = this;

              _this.removeAllFiles();

            $(".nav_customer_info").addClass('active');

                    $("#customer-tab").addClass('active');

                    $("#customer_info").addClass('show active');

            }

            // list_image();

          });

        },

    };



  // var DrZone = new Dropzone(document.getElementById("dropzone"), {

 //      url: "../php_action/custom_action.php",

 //      uploadMultiple: true,

 //      parallelUploads: 100,

 //      maxFiles: 100,

 //      autoProcessQueue: false

 //    });

  

    </script>

   
    </body>
</html>
