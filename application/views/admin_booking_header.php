<?php
	$uri2 = $this->uri->segment(2);
	$uri3 = ($uri2=='booking_page' ? '' : $this->uri->segment(3));
?>
<!--slidemenu--> 
<div class="navigator">
	<div class="pagetitle"></div>
	<div id="top_menu">
		<ul class="sub0 sortleftmenu" id="ul_0" >
			<?php echo ($active_submenu=='booking_page' ? '<li class="selected">' : '<li>');?>
				<a href="<?php echo base_url();?>index.php/admin/booking_page" >Pesanan Terbaru</a>
			</li>
			<?php echo ($active_submenu=='validate_payment' ? '<li class="selected">' : '<li>');?>
				<a href="<?php echo base_url();?>index.php/admin/validate_payment" >Validasi Pembayaran Pelanggan</a>
			</li>
			<?php echo ($active_submenu=='booking_issued' ? '<li class="selected">' : '<li>');?>
				<a href="<?php echo base_url();?>index.php/admin/booking_issued" >Pesanan Issued</a>
			</li>
			<?php echo ($active_submenu=='booking_cancel' ? '<li class="selected">' : '<li>');?>
				<a href="<?php echo base_url();?>index.php/admin/booking_cancelled" >Pesanan Batal</a>
			</li>
			<?php echo ($active_submenu=='booking_reject' ? '<li class="selected">' : '<li>');?>
				<a href="<?php echo base_url();?>index.php/admin/booking_rejected" >Pesanan Ditolak</a>
			</li>
		</ul>
	</div>
</div>