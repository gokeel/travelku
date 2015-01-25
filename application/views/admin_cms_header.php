<?php
	$uri2 = $this->uri->segment(2);
	$uri3 = ($uri2=='booking_page' ? '' : $this->uri->segment(3));
?>
<!--slidemenu--> 
<div class="navigator">
	<div class="pagetitle"></div>
	<div id="top_menu">
		<ul class="sub0 sortleftmenu" id="ul_0" >
			<?php echo ($uri2=='cms_page' ? '<li id="grp_5" class="selected">' : '<li id="grp_5">');?>
				<a href="<?php echo base_url();?>index.php/admin/cms_page" >Konten</a>
			</li>
			<?php echo ($uri2=='content_category_page' ? '<li id="grp_6" class="selected">' : '<li id="grp_6">');?>
				<a href="<?php echo base_url();?>index.php/admin/content_category_page" >Kategori Konten</a>
			</li>
			<?php echo ($uri2=='content_add_page' ? '<li id="grp_4" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/content_add_page" >Tambah Konten Paket</a>
			</li>
			<?php echo ($uri2=='content_add_nonpaket_page' ? '<li id="grp_4" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/content_add_nonpaket_page" >Tambah Konten Non Paket</a>
			</li>
			<?php echo ($uri2=='content_review' ? '<li id="grp_7" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/content_review" >Komentar/Review</a>
			</li>
			<?php echo ($uri2=='option_setting' ? '<li id="grp_7" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/option_setting" >Pengaturan Opsi</a>
			</li>
			<?php echo ($uri2=='agent_news' ? '<li id="grp_7" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/agent_news" >Berita Agen</a>
			</li>
		</ul>
	</div>
</div>