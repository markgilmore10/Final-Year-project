<header class="main-header">
	
	<a href="" class="logo">

		<span class="logo-mini">
			<img  class="img-responsive" src="views/images/logosmall.png" style="padding-top:10px">
		</span>

		<span class="logo-lg">
			<img class="img-responsive" src="views/images/cellarlong.png" style="padding: 0px">
		</span>

	</a>
	
	<!-- Navigation -->
	
	<nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Navigation Button -->
		<a class="sidebar-toggle" data-toggle="push-menu" role="button" href="#">
			<span class="sr-only">Navigation</span>
		</a>  

		<!-- User Profile -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">					
						<span class="hidden-xs"><?php echo $_SESSION["name"]; ?></span>
					</a>

					<!-- Dropdown Menu -->
					<ul class="dropdown-menu">
						<li class="user-body">
							<div>
								<a href="logout" class="btn-default btn-flat" href="logout">Logout</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>

	</nav>

</header>