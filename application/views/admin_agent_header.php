<div class="navigator">	<div class="pagetitle"></div>	<div id="top_menu">		<ul class="sub0 sortleftmenu" id="ul_0" >			<?php echo ($active_submenu=='agent_page' ? '<li id="grp_5" class="selected">' : '<li>');?>				<a href="<?php echo base_url();?>index.php/admin/agent_page" >Semua Agen</a>			</li>			<?php echo ($active_submenu=='Yes' ? '<li id="grp_4" class="selected">' : '<li>');?>				<a href="<?php echo base_url();?>index.php/admin/agent_page_by_status/Yes" > Agen Aktif</a>			</li>			<?php echo ($active_submenu=='Rejected' ? '<li id="grp_12" class="selected">' : '<li>');?>				<a href="<?php echo base_url();?>index.php/admin/agent_page_by_status/Rejected" >Agen Ditolak</a>			</li>			<?php echo ($active_submenu=='Trial' ? '<li id="grp_401" class="selected">' : '<li>');?>				<a href="<?php echo base_url();?>index.php/admin/agent_page_by_status/Trial" >Agen Trial</a>			</li>			<?php echo ($active_submenu=='No' ? '<li id="grp_401" class="selected">' : '<li>');?>				<a href="<?php echo base_url();?>index.php/admin/agent_page_by_status/No" >Agen Tidak Aktif</a>			</li>			<?php echo ($active_submenu=='reset_password' ? '<li id="grp_401" class="selected">' : '<li>');?>				<a href="<?php echo base_url();?>index.php/admin/agent_reset_password" >Reset Password Agen</a>			</li>		</ul>	</div></div>