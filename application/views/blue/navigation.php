			<div class="navbar-header">
				<a href="<?php echo base_url();?>" class="navbar-brand"><img src="<?php echo base_url();?>assets/images/logo head web.png" height="100px" alt="logo" class="logo"/></a>
			</div><br/>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right font-arial-very-bold">
					<li><a href="<?php echo base_url();?>">Home</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/umrah/0/9">Umrah & Haji</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/show_regular_packages/0/9">Reguler</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/promo/0/9">Promo</a></li>
					<li><a href="<?php echo base_url();?>index.php/webfront/show_packages/hotel/0/9">Hotel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
					<li>
						<?php if ($this->session->userdata('account_id')=='') {?>
							<a href="<?php echo base_url();?>index.php/admin"><span style="color:red">Login</span></a>
						<?php
						}
							else{
						?>
							<a href="<?php echo base_url();?>index.php/admin/logout"><span style="color:red">Logout</span></a>
						<?php } ?>
					</li>			  
				</ul>
			</div>