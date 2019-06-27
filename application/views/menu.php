<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<div class="container-fluid">
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="navbar-nav">
				<li class="nav-item active"><a class="nav-link" href="<?php echo site_url('home/index'); ?>">Index <span class="sr-only">(current)</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo site_url('home/ItemsList'); ?>">Get All Items</a></li>
					<li class="nav-item"><a class="nav-link" href="<?php echo site_url('home/getItemInfo'); ?>">Get Item</a></li>
					<li class="nav-item">
						<a class="nav-link" href="<?php echo site_url('home/selectImages');?> ">Upload Image</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>