    
<?php include_once "php_action/core.php"; 
$user = $_SESSION['userId'];


$fetch_globeluser = mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM users WHERE user_id = '$user'"));
    $fetchedUserRole=$fetch_globeluser['user_role'];
     $getpage = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
    // echo $getpage;
     if($getpage != 'dashboard.php' AND $fetch_globeluser['user_role']!="admin"){
  $checkurlvalid = mysqli_query($dbc, "SELECT privileges.*,menus.*  FROM privileges INNER JOIN menus ON privileges.nav_id=menus.id WHERE privileges.user_id = '$_SESSION[userId]' AND menus.page='$getpage' ");
  if (mysqli_num_rows($checkurlvalid)==0) {?>
  <script type="text/javascript">window.history.back();</script>

   <?php }else{
        $userPrivileges=mysqli_fetch_assoc($checkurlvalid);

   }
}
$globel_id = $fetch_globeluser['user_id'];
$globel_username = $fetch_globeluser['username'];
$glober_role = $fetch_globeluser['user_role'];

?>
<!doctype html>
<html lang="en">
  <?php include_once 'includes/head.php'; ?>
  <body class="vertical  dark  ">
    <div class="wrapper">
  <?php //include_once 'includes/header.php'; ?>




      <nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <form class="form-inline mr-auto searchform text-muted">
          <input class="form-control mr-sm-2 bg-transparent border-0 pl-4 text-muted" type="search" placeholder="Type something..." aria-label="Search">
        </form>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
              <i class="fe fe-sun fe-16"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
              <span class="fe fe-grid fe-16"></span>
            </a>
          </li>
          <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
              <span class="fe fe-bell fe-16"></span>
              <span class="dot dot-md bg-success"></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="index.php?nav=profile">Profile</a>
              <a class="dropdown-item" href="#">Settings</a>
              <a class="dropdown-item" href="../logout.php">Logout</a>
            </div>
          </li>
        </ul>
      </nav>
         <?php include_once 'includes/sidebar.php'; ?>
      <main role="main" class="main-content">