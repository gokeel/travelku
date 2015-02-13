<div class="navigator">
	<div class="pagetitle"></div>
	<div id="top_menu">
		<ul class="sub0 sortleftmenu" id="ul_0" >
			<?php echo (($active_submenu=='cms_page' or $active_submenu=='modify') ? '<li id="grp_5" class="selected">' : '<li id="grp_5">');?>
				<a href="<?php echo base_url();?>index.php/admin/cms_page" >Konten</a>
			</li>
			<?php echo ($active_submenu=='category' ? '<li id="grp_6" class="selected">' : '<li id="grp_6">');?>
				<a href="<?php echo base_url();?>index.php/admin/content_category_page" >Kategori Konten</a>
			</li>
			<?php echo ($active_submenu=='add_paket' ? '<li id="grp_4" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/content_add_page" >Tambah Konten Paket</a>
			</li>
			<?php echo ($active_submenu=='add_nonpaket' ? '<li id="grp_4" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/content_add_nonpaket_page" >Tambah Konten Non Paket</a>
			</li>
			<?php echo ($active_submenu=='review' ? '<li id="grp_7" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/content_review" >Komentar/Review</a>
			</li>
			<?php echo ($active_submenu=='option_setting' ? '<li id="grp_7" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/option_setting" >Pengaturan Opsi</a>
			</li>
			<?php echo ($active_submenu=='agent_news' ? '<li id="grp_7" class="selected">' : '<li id="grp_4">');?>
				<a href="<?php echo base_url();?>index.php/admin/agent_news" >Berita Agen</a>
			</li>
		</ul>
	</div>
</div>