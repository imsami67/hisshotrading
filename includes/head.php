 <?php include_once 'php_action/core.php';
       $get_company =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM company ORDER BY id DESC LIMIT 1"));

  ?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="img/logo/<?=$get_company['logo']?>" type="image/gif" sizes="16x16"> 
    <title><?=$get_company['name']?></title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="assets/css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/feather.css">
    <link rel="stylesheet" href="assets/css/select2.css">
    <link rel="stylesheet" href="assets/css/dropzone.css">
    <link rel="stylesheet" href="assets/css/uppy.min.css">
    <link rel="stylesheet" href="assets/css/jquery.steps.css">
    <link rel="stylesheet" href="assets/css/jquery.timepicker.css">
    <link rel="stylesheet" href="assets/css/quill.snow.css">
        <link rel="stylesheet" href="custom/dropzone/dist/dropzone.css" />
            

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="assets/css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="assets/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="assets/css/app-dark.css" id="darkTheme" disabled>
    <script src="assets/js/sweetalert2.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <link rel="stylesheet" href="assets/css/sweetalert2.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.css">
         <link rel="stylesheet" href="assets/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
           <link rel="stylesheet" href="assets/plugins/material-datetimepicker/bootstrap-material-datetimepicker.css" />





    <style type="text/css">

        .btn-admin{
                color: #ffffff; 
                background-color: #ff1a1a; 
                border-color: #ff1a1a;
        }
         .btn-admin2{
                color: white; 
                background-color: black; 
                border-color: black;
        }
        .card-bg{
                
                background-color: black; 
               
        }
        .card-text{
         color: white;    
        }
      
    </style>
  </head>
  