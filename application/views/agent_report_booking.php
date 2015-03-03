<section role="main" id="main"><!--tpl:web/dasboard-->
<!-- Main content -->

	<noscript class="message black-gradient simpler">
		Your browser does not support JavaScript! Some features won't work as expected...
	</noscript>
	<hgroup id="main-title" class="thin">
		<h1 style="color:white">Order status of <?php echo $uri;?></h1>
	</hgroup>

	<div class="with-padding">
		<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
			<p> </p>
			<h3 class="thin underline">Daftar pesanan <?php 
				if($uri=='flight') echo 'Penerbangan'; 
				elseif($uri=='train') echo 'Kereta Api';
				elseif($uri=='hotel') echo 'Hotel';
				elseif($uri=='paket') echo 'Paket';
			?>
			</h3>
			<div id="list" style="width:100%"></div>
			<p></p>
		</div>
	</div>
	<div style="clear:both;"></div>
</section>
<script>
	$( window ).load(function() {
		var category = '';
		<?php 
		if($uri=='flight')
			echo 'category = "flight";';
		else if($uri=='train')
			echo 'category = "train";';
		else if($uri=='hotel')
			echo 'category = "hotel";';
		else if($uri=='paket')
			echo 'category = "paket";';
		?>
		load_order(category);
	});
	function load_order(category){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/agent/get_order_list/'+category,
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++){
					if(category=='flight')
						data[i] = {order_id: datajson[i].order_id, order_system_id: datajson[i].order_system_id, booking_code: datajson[i].booking_code, booking_code_ret: datajson[i].booking_code_ret, customer_email: datajson[i].customer_email, is_round_trip:datajson[i].is_round_trip, airline_name_depart: datajson[i].airline_name_dep, airline_name_return: datajson[i].airline_name_ret, flight_id_dep: datajson[i].flight_id_depart, flight_id_ret: datajson[i].flight_id_return, route: datajson[i].route, full_via_dep: datajson[i].departing_date+' '+datajson[i].time_travel, full_via_ret: datajson[i].returning_date+' '+datajson[i].time_travel_ret, total_price_dep: datajson[i].total_price_dep, total_price_ret: datajson[i].total_price_ret, payment_status: datajson[i].payment_status, order_status: datajson[i].order_status, registered_date: datajson[i].registered_date};
					else if(category=='paket')
						data[i] = {order_id: datajson[i].order_id, category: datajson[i].category, title: datajson[i].title, customer_email: datajson[i].customer_email, total_price: datajson[i].currency+' '+datajson[i].total_price, payment_status: datajson[i].payment_status, order_status: datajson[i].order_status, registered_date: datajson[i].registered_date};
					else if(category=='hotel')
						data[i] = {order_id: datajson[i].order_id, order_system_id: datajson[i].order_system_id, booking_code: datajson[i].booking_code, customer_email: datajson[i].customer_email, hotel_name: datajson[i].hotel_name+', '+datajson[i].hotel_regional, hotel_room_name: datajson[i].hotel_room_name, datetime: datajson[i].checkin+' - '+datajson[i].checkout, night: datajson[i].night, room: datajson[i].room, total_price: datajson[i].total_price, payment_status: datajson[i].payment_status, order_status: datajson[i].order_status, registered_date: datajson[i].registered_date};
				}
					
			}
		});
		var cols;
		if(category=='flight')
			cols = [
					{key:"order_id", label:"ID"},
					{
						label:"Trip",
						nodeFormatter:function (o) {
							if (o.data.is_round_trip=="true")
								o.cell.setHTML('<img src="<?php echo IMAGES_DIR;?>/icon_round_trip.jpg" width="45px" height="45px" title="round-trip">');
							else
								o.cell.setHTML('<img src="<?php echo IMAGES_DIR;?>/icon_single_trip.jpg" width="45px" height="45px" title="single-trip">');
							return false;
						},
						resizeable:true
					},
					{
						label:"Booking Code",
						nodeFormatter:function (o) {
							var str = '<p><b>Dep:</b> '+o.data.booking_code;
							if (o.data.is_round_trip=="true")
								str += '<br /><b>Ret:</b> '+o.data.booking_code_ret;
							str += '</p>';
							
							o.cell.setHTML(str);
							return false;
						}
					},
					{
						label:"Maskapai",
						nodeFormatter:function (o) {
							var str = '<p><b>Dep:</b> '+o.data.airline_name_depart;
							if (o.data.is_round_trip=="true")
								str += '<br /><b>Ret:</b> '+o.data.airline_name_return;
							str += '</p>';
							
							o.cell.setHTML(str);
							return false;
						}
					},
					{key:"route", label:"Rute"},
					{
						label:"Waktu Penerbangan",
						nodeFormatter:function (o) {
							var str = '<p><b>Dep:</b><br/> '+o.data.full_via_dep;
							if (o.data.is_round_trip=="true")
								str += '<br /><b>Ret:</b><br/> '+o.data.full_via_ret;
							str += '</p>';
							
							o.cell.setHTML(str);
							return false;
						}
					},
					{
						label:"Harga",
						nodeFormatter:function (o) {
							var str = '<p><b>Dep:</b> '+o.data.total_price_dep;
							if (o.data.is_round_trip=="true")
								str += '<br /><b>Ret:</b> '+o.data.total_price_ret;
							str += '</p>';
							
							o.cell.setHTML(str);
							return false;
						}
					},
					{key:"order_status", label:"Status Pemesanan"},
					{key:"registered_date", label:"Tanggal Pesan"},
					{key:"payment_status", label:"Status Pembayaran"}
				];
				
		else if(category=='hotel')
			cols = [
					{key:"order_id", label:"ID"},
					{key:"booking_code", label:"Booking Code"},
					{
						label:"Detil Hotel",
						nodeFormatter:function (o) {
							var str = o.data.hotel_name+'<br/>'+o.data.hotel_room_name;
							o.cell.setHTML(str);
							return false;
						}
					},
					{
						label:"Detil Waktu Menginap",
						nodeFormatter:function (o) {
							var str = o.data.datetime+'<br/>Malam: '+o.data.night+'<br/>Kamar: '+o.data.room;
							o.cell.setHTML(str);
							return false;
						}
					},
					{key:"total_price", label:"Harga"},
					{key:"order_status", label:"Status Pemesanan"},
					{key:"registered_date", label:"Tanggal Pesan"},
					{key:"payment_status", label:"Status Pembayaran"}
				];
		
		else if(category=='paket')
			cols = [
					{key:"order_id", label:"ID Pesanan"},
					{key:"category", label:"Kategori"},
					{key:"title", label:"Nama Paket"},
					{key:"total_price", label:"Harga"},
					{key:"order_status", label:"Status Pemesanan"},
					{key:"registered_date", label:"Tanggal Pesan"},
					{key:"payment_status", label:"Status Pembayaran"}
				];
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatable-paginator', function (Y) {
			var data_order = data;
			var table = new Y.DataTable({
				columns: cols,
				data: data_order,
				caption: "Daftar Pesanan",
				rowsPerPage: 10
			});
			table.render("#list");
		});
	}
</script>