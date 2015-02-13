<div class="navigator">
	<div class="pagetitle"></div>
	<div id="top_menu">
		<ul class="sub0 sortleftmenu" id="ul_0" >
			<?php echo ($active_submenu=='topup' ? '<li id="grp_5" class="selected">' : '<li>');?>
				<a href="<?php echo base_url();?>index.php/admin/setting_deposit_topup" >Top Up</a>
			</li>
			<?php echo ($active_submenu=='withdraw' ? '<li id="grp_6" class="selected">' : '<li>');?>
				<a href="<?php echo base_url();?>index.php/admin/setting_deposit_withdraw" >Withdraw</a>
			</li>
		</ul>
	</div>
</div>