<?php $get_nav = (empty($_REQUEST['nav']))?"home":$_REQUEST['nav'];
	$page = "pages/".$get_nav.".php";
 ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>

			</button>
			<a href="index.php?nav=checkout">
      <button type="btn btn-danger" class="navbar-toggle collapsed" >
       <img src="img/cart.png" style="width: 30px;" /> <span class="badge badge-danger cart_badge"><?=@$_SESSION['item_total_qty']?></span>

      </button>
       </a>
			
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
		<a class="navbar-brand" href="./"><img src="img/minilogo.png" class="img-responsive" style="margin-top: -10px;"></a>
			<ul class="nav navbar-nav">
				<li class="active"><a href="./">Home</a></li>
				<li><a href="index.php?nav=shop">Shop</a></li>
				<li><a href="index.php?nav=sale">Sale Products</a></li>
				
				
			</ul>
			<form class="navbar-form navbar-right" role="search">
				<input type="hidden" value="search" name="nav">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search" name="search_query" value="<?=@$_REQUEST['search_query']?>">
				</div>
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					
						<li><a href="login.php">Login</a></li>
					
				</li>
				<li><a href="index.php?nav=checkout"><img src="img/cart.png" style="width: 30px;" /> <span class="badge badge-danger cart_badge"><?=@$_SESSION['item_total_qty']?></span></a></li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>