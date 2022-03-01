<!DOCTYPE>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>New Gmail Style Login Form with Material CSS and jQuery - Demo</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/normalize.css">
  <link rel="stylesheet" type="text/css" href="css/materialize.min.css">
  <link rel="stylesheet" type="text/css" href="css/loginStyle.css">
  <style type="text/css">
    .gmailStyle input[type=text]:not(.browser-default):focus:not([readonly]), .gmailStyle input[type=password]:not(.browser-default):focus:not([readonly]){
      box-shadow: 0px 0 1px #1A73E8;
        border: 1px solid #1A73E8;

    }
    .input-field>label{
      

    }
    .gmailStyle .input-field>label:not(.label-icon).active{
      color: #1A73E8 !important;
    }
  </style>
</head>
<body>
  <div class="row gmailStyle">
    <div class="container-fluid">
      <div class="valign-wrapper screenHeight">
          <div class="col card s12 m8 l6 xl4 autoMargin setMaxWidth overflowHidden">
            <div class="row hidden" id="progress-bar">
              <div class="progress mar-no">
                <div class="indeterminate"></div>
              </div>
            </div>
            <div class="clearfix mar-all pad-all"></div>

            <img src="images/Googlelogo.png" class="logoImage" />
            <h5 class="center-align mar-top mar-bottom formTitle">Sign In</h5>
            <p class="center-align pad-no mar-no">Use your Google Account</p>

            <div class="clearfix mar-all pad-all"></div>

            <div id="formContainer" class="goRight">

              <form class="loginForm" action="" id="loginForm">
                <div class="input-fields-div autoMargin">
                  <div class="input-field">
                    <input id="user_name" type="text" class="validate">
                    <label for="user_name">Email or Phone</label>
                  </div>
                  <div id="passwordDiv" class="input-field scale-transition scale-out">
                    <input id="pass_word" type="password" class="validate">
                    <label for="pass_word">Password</label>
                    <a href="javascript:void(0)" class="showPassword" onclick="showPassword()"><i class="material-icons md-18">visibility</i></a>
                  </div>

                  
                  
                   <div class="row">
                   <div class="col 6">
                     <a href="#" class=" font-weight-bold left-align" >Forgot email?</a>
                   </div>
                 </div>
                </div>
                 <div class="row mt-5">
                   <div  class="col s12">
                     <p class="center-align">Not your computer? Use Guest mode to sign in privately.
                     </p>
                   </div>
                   <div class="col s6">
                     <a href="#" class=" center-align" style="margin-left: 40px;">Learn more</a>
                   </div>
                 </div>
                 <div class="row  mt-5">
                   <div class="col s8">
                      <a href="#" class=" font-weight-bold left" style="margin-left: 40px;">Create Account</a>
                   </div>
                    <div class="col s4"><button type="submit"  class=" btn  right " style="background-color: #1A73E8;">Login</button></div>
                 </div>
                
              </form>

              
            </div>


            <div class="clearfix mar-all pad-all"></div>
          </div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="js/routie.min.js"></script>
  <script type="text/javascript" src="js/loginScript.js"></script>
</body>
</html>
