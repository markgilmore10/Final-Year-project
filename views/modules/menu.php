<aside class="main-sidebar">

	<section class="sidebar">
		
		<ul class="sidebar-menu">

		<?php

		if ($_SESSION["profile"] == "administrator") {
		
			echo '<li class="active">
				<a href="dashboard">
					<i class="fa fa-home"></i>
					<span>Dashboard</span>
				</a>
			</li>

			<li>
				<a href="users">
					<i class="fa fa-user"></i>
					<span>Users</span>
				</a>
			</li>';
		}

		if($_SESSION["profile"] == "administrator" || $_SESSION["profile"] == "staff"){
			echo '

			<li>
				<a href="customers">
					<i class="fa fa-users"></i>
					<span>Customers</span>
				</a>
			</li>';

		}

		if($_SESSION["profile"] == "administrator" || $_SESSION["profile"] == "manager"){

			echo '

			<li>
				<a href="categories">
					<i class="fa fa-th"></i>
					<span>Categories</span>
				</a>
			</li>

			<li>
				<a href="products">
                    <i class="fa fa-coffee"></i>
					<span>Products</span>
				</a>
			</li>';

		}

		if($_SESSION["profile"] == "administrator" || $_SESSION["profile"] == "staff"){

			echo'

			<li>
				<a href="till">
					<i class="fa fa-calculator"></i>
					<span>Till</span>
				</a>
			</li>

			<li>
						<a href="sales">
							<i class="fa fa-credit-card-alt"></i>
							<span>Sales</span>
						</a>
					</li>
					
					<li>
				<a href="open-tables">
					<i class="fa fa-edit"></i>
					<span>Open Tables</span>
				</a>
			</li>';

		}

		if($_SESSION["profile"] == "administrator"){

			echo '

					<li>
						<a href="reports">
						<i class="fa fa-book"></i>
							<span>Reports</span>
						</a>
					</li>';

		}

		echo '</ul>

			</li>';

			?>
		</ul>

	</section>
	
</aside>