<?php
	$uri2 = $this->uri->segment(2);
	$uri3 = ($uri2=='booking_page' ? '' : $this->uri->segment(3));
?>
<!--slidemenu--> 
<div class="navigator">
	<div class="pagetitle"></div>
	<div id="top_menu">
		<ul class="sub0 sortleftmenu" id="ul_0" >
			<?php echo ($active_submenu=='booking_page' ? '<li id="grp_5" class="selected">' : '<li id="grp_5">');?>
				<a href="<?php echo base_url();?>index.php/admin/booking_page" >Pesanan Terbaru</a>
			</li>
			<?php echo ($active_submenu=='validate_payment' ? '<li id="grp_6" class="selected">' : '<li id="grp_6">');?>
				<a href="<?php echo base_url();?>index.php/admin/validate_payment" >Validasi Pembayaran Pelanggan</a>
			</li>
			<?php echo ($active_submenu=='booking_issued' ? '<li id="grp_4" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/booking_issued" >Pesanan Issued</a>
			</li>
			<?php echo ($active_submenu=='booking_cancel' ? '<li id="grp_12" class="selected">' : '<li id="grp_12">');?>
				<a href="<?php echo base_url();?>index.php/admin/booking_cancelled" >Pesanan Batal</a>
			</li>
		</ul>
	</div>
</div>