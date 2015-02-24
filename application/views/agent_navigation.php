<!-- Sidebar/drop-down menu -->
<section id="menu" role="complementary">

	<!-- This wrapper is used by several responsive layouts -->
	<div id="menu-content">

		<!--tpl:web/side_menu-->
		<header>
			<div> &nbsp; &nbsp; &nbsp; [ <a href="<?php echo base_url();?>index.php/admin/logout" style="color: #F70;">logout</a> ]</div>
		</header>

		<div id="profile">
			<!--<img src="<?php echo base_url();?>assets/profile/thumb_IMG_20140225_1346171.jpg" width="50" height="50" alt="User name" class="user-icon">-->
				<span class="name">
					<a href="<?php echo base_url();?>/profile_edit" style="color:#fff">ONLINE TRAINING SYSTEM</a>
				</span>
		</div>
		<section class="navigable">
			<ul class="big-menu">
				<li>
					<a href="<?php echo base_url();?>index.php/agent/home" class="current navigable-current">Dashboard</a>
				</li>
				<!--<li>
					<a href="<?php echo base_url();?>form_issued_tiket" >Cart</a>
				</li>-->
				<li>
					<a href="<?php echo base_url();?>index.php/agent/login_airlines_page" >Login Airlines</a>
				</li>
				<li class="with-right-arrow">
					<span>
						<span class="list-count">3</span>
						Deposit Menu
					</span>
					<ul class="big-menu">
						<li>
							<a href="<?php echo base_url();?>index.php/agent/topup_page" >Topup Deposit</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/withdraw_page" >Tarik Deposit</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>reedem_point" >Reedem Point</a>
						</li>
					</ul>
				</li>
				<li class="with-right-arrow">
					<span>
						<span class="list-count">11</span>
						Laporan
					</span>
					<ul class="big-menu">
						<li>
							<a href="<?php echo base_url();?>index.php/agent/report_order/flight" >Booking Pesawat</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/report_order/train" >Booking Kereta</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/report_order/hotel" >Booking Hotel</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/report_order/tour" >Booking Tour</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/report_order/travel" >Booking Travel</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/report_order/rental" >Booking Rental</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/report_order/umrah" >Booking Umrah</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/report_deposit/topup" >Laporan Topup</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/report_deposit/withdraw" >Laporan Withdraw</a>
						</li>
					</ul>
				</li>
				<!--<li class="with-right-arrow">
					<span>
						<span class="list-count">3</span>
						Tiket Advance
					</span>
					<ul class="big-menu">
						<li>
							<a href="<?php echo base_url();?>tiket_group_booking" >Tiket Group Booking</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>form_refund" >Refund</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>form_reschedule" >Reschedule</a>
						</li>
					</ul>
				</li>-->
				<li class="with-right-arrow">
					<span>
						<span class="list-count">4</span>
						Profile
					</span>
					<ul class="big-menu">
						<!--<li>
							<a href="<?php echo base_url();?>index.php/agent/manage_staff" >Manage Staff</a>
						</li>-->
						<li>
							<a href="<?php echo base_url();?>index.php/agent/profile_edit" >Edit Profil</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/edit_logo" >Ubah Logo</a>
						</li>
						<li>
							<a href="<?php echo base_url();?>index.php/agent/change_password" >Ubah Password</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="<?php echo base_url();?>index.php/agent/landing_page" >Landing Page</a>
				</li>
			</ul>
		</section>
		<ul class="unstyled-list">
			<li class="title-menu">Nominal Deposit</li>
			<li>
				<div id="deposit_amount" class="amount_div"><?php echo $money['deposit'];?></div>
			</li>
			
		</ul>

		<ul class="unstyled-list">
			<li class="title-menu">Nominal Voucher</li>
			<li>
				<div id="voucher_amount" class="amount_div"><?php echo $money['voucher'];?></div>
			</li>
			
		</ul>
		<ul class="unstyled-list">
			<li class="title-menu">Point Reward</li>
			<li>
				<div id="voucher_amount" class="amount_div"><?php echo $money['point_reward'];?> Poin</div>
			</li>
			
		</ul>
		<ul class="unstyled-list">
			<li class="title-menu">Support</li>
			<li>
				<div style="padding: 5px;" id="ym-support">
					<div id="ym_list" ></div>
				</div>
			</li>
			
		</ul>
		<ul class="unstyled-list">
			<li class="title-menu">Rekening Bank</li>
			<li><div style="margin: 10px 10px -2px 16px;">AN: HALO WISATAWAN INDONESIA</div>
			
				<div style="padding: 5px;">
					<ul id="ym_list">
						<?php foreach($bank->result_array() as $row){?>
						<li>
							<label class="rek_num"><?php echo $row['bank_name']?> </label>Cabang <?php echo $row['bank_branch'].', '.$row['bank_city'];?><br /> a/n. <?php echo $row['bank_holder_name'];?><br />
							Norek:<?php echo $row['bank_account_number'];?>
						</li>
						<?php } ?>
					</ul>
				</div>
			</li>
			
		</ul>
		<!--&tpl:web/side_menu-->

	</div>
		<!-- End content wrapper -->

		<!-- This is optional -->
	<footer id="menu-footer"></footer>
		 
</section>
	<!-- End sidebar/drop-down menu -->
<script>
	$( window ).load(function() {
		load_ym_sidebar();
	});
	
	function load_ym_sidebar(){
		var data_ym = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/other/get_yahoo_by_type/customer-service',
			dataType: "json",
			success:function(datajson){
				var div = $('#ym_list');
				var str_output = '<ul>';
				//for(var i=0; i<datajson.length;i++) 
					//data_ym[i] = {name:datajson[i].name};
				for(var i=0; i<datajson.length;i++){
					//data_via[i] = {number_row: datajson[i].number_row, id:datajson[i].id, name:datajson[i].name, type:datajson[i].type};
					str_output += '<li><a href="ymsgr:SendIM?'+datajson[i].username+'">\
						<img border=0 src="http://opi.yahoo.com/online?u='+datajson[i].username+'&m=g&t=1"></a>&nbsp;&nbsp;'+datajson[i].username+'</li>';
				}
				str_output += '</ul>';
				div.append(str_output);
			}
		});
	}
	
</script>	