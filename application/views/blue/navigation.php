
			  <div class="navbar-header">
				<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<!--<a href="index.html" class="navbar-brand"><img src="<?php echo BLUE_THEME_DIR;?>/images/logo.png" alt="Travel Agency Logo" class="logo"/></a>-->
				<a href="<?php echo base_url();?>" class="navbar-brand"><img src="<?php echo base_url();?>assets/uploads/option_images/<?php echo $company_logo;?>?ver=<?php echo rand(1000, 1000000);?>" alt="logo" class="logo"/></a>
			  </div><br/>
			  <div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
				  <li><a href="<?php echo base_url();?>">Home</a></li>
				  <li><a href="<?php echo base_url();?>index.php/webfront/show_regular_packages/0/9">Paket Reguler</a></li>
				  <li><a href="<?php echo base_url();?>index.php/webfront/show_packages/promo/0/9">Paket Promo</a></li>
				  <li><a href="<?php echo base_url();?>index.php/webfront/show_packages/hotel/0/9">Paket Hotel</a></li>			  
				  <!--<li><a href="<?php echo base_url();?>index.php/webfront/load_faq_content">FAQ</a></li>			  -->
				  <li><a href="<?php echo base_url();?>index.php/webfront/agent_registration">Registrasi Agen</a></li>			  
				  <li>
				  <?php if ($this->session->userdata('account_id')=='') {?>
					<a href="<?php echo base_url();?>index.php/admin">Login</a>
				  <?php
				  }
				  else{
				  ?>
					<a href="<?php echo base_url();?>index.php/admin/logout">Logout</a>
				  <?php } ?>
				  </li>			  
				</ul>
			  </div>