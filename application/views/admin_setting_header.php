<div class="navigator">
	<div class="pagetitle"></div>
	<div id="top_menu">
		<ul class="sub0 sortleftmenu" id="ul_0" >
			<?php echo ($active_submenu=='email_dist' ? '<li id="grp_133" class="selected">' : '<li id="grp_133">');?>
				<a href="<?php echo base_url();?>index.php/admin/setting_email_dist" >Email Distribution</a>
			</li>
			<?php echo ($active_submenu=='bank' ? '<li id="grp_5" class="selected">' : '<li id="grp_5">');?>
				<a href="<?php echo base_url();?>index.php/admin/setting_bank_page/bank_list" >Bank</a>
			</li>
			<?php echo ($active_submenu=='user' ? '<li id="grp_4" class="selected">' : '<li id="grp_4">');?>
				<span >User Management
					<div class="nextrow">&nbsp;</div>
				</span>
				<ul class="sub1 sortleftmenu" id="ul_394" >
					<li id="grp_423">
						<a href="<?php echo base_url();?>index.php/admin/setting_user_page/office" >Office</a>
					</li>
					<li id="grp_424">
						<a href="<?php echo base_url();?>index.php/admin/setting_user_page/tiket" >Tiket</a>
					</li>
					<li id="grp_424">
						<a href="<?php echo base_url();?>index.php/admin/setting_user_page/uas" >UAS</a>
					</li>
				</ul>
			</li>
			<!--<?php echo ($active_submenu=='commission' ? '<li id="grp_12" class="selected">' : '<li id="grp_12">');?>
				<a href="<?php echo base_url();?>index.php/admin/setting_commission_page" >Commission</a>
				<span >Commission
					<div class="nextrow">&nbsp;</div>
				</span>
				<ul class="sub1 sortleftmenu" id="ul_394" >
					<li id="grp_423">
						<a href="<?php echo base_url();?>index.php/admin/setting_commission_page/airline" >Pesawat</a>
					</li>
					<li id="grp_424">
						<a href="<?php echo base_url();?>index.php/admin/setting_commission_page/hotel" >Hotel</a>
					</li>
					<li id="grp_424">
						<a href="<?php echo base_url();?>index.php/admin/setting_commission_page/train" >Kereta</a>
					</li>
				</ul>
			</li>-->
			<?php echo ($active_submenu=='city' ? '<li id="grp_401" class="selected">' : '<li id="grp_401">');?>
				<a href="<?php echo base_url();?>index.php/admin/setting_city_page" >City</a>
			</li>
			<?php echo ($active_submenu=='yahoo' ? '<li id="grp_426" class="selected">' : '<li id="grp_426">');?>
				<a href="<?php echo base_url();?>index.php/admin/setting_yahoo_page" >YM!</a>
			</li>
			<?php echo ($active_submenu=='kurs' ? '<li id="grp_426" class="selected">' : '<li id="grp_426">');?>
				<a href="<?php echo base_url();?>index.php/admin/setting_kurs_page" >Kurs</a>
			</li>
			<?php echo ($active_submenu=='switch_order' ? '<li id="grp_426" class="selected">' : '<li id="grp_426">');?>
				<a href="<?php echo base_url();?>index.php/admin/setting_switch_order_page" >Switch Order System</a>
			</li>
		</ul>
	</div>
</div>