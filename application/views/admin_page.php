<!--slidemenu--> 

<div class="navigator">
	<div class="pagetitle">HOME</div>
	<div style="float:right; padding5px; color:#888; margin:5px;">Your IP: <?php echo $ip_address;?></div>
</div>

<div id="content"  style="min-height:400px;"> 

  <div class="frametab">
		<h3 style="margin:5px 0 5px 5px;"><u>Dashboard</u></h3>
		<div id="data-booking"></div>
		<h3 style="margin:5px 0 5px 5px;"><u>Download Links</u></h3>
		<table>
			<tr>
				<th>Kategori</th>
				<th>Item</th>
				<th>Download Link</th>
			</tr>
			<tr>
				<td>Booking</td>
				<td>Semua Transaksi Booking</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_all_transaction" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
			<tr>
				<td>Keagenan</td>
				<td>Agen Request</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_all_agent" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Agen Aktif</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_active_agent" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
			<tr>
				<td>Top-Up</td>
				<td>Semua Permintaan Top-Up</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_all_topup/all" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Top-Up - Request Baru</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_all_topup/Requested" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Top-Up - Issued</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_all_topup/Issued" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Top-Up - Ditolak</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_all_topup/Rejected" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
			
			<tr>
				<td>Withdraw</td>
				<td>Semua Permintaan Withdraw</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_all_withdraw/all" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Withdraw - Request Baru</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_all_withdraw/Requested" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Withdraw - Issued</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_all_withdraw/Issued" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>Withdraw - Ditolak</td>
				<td align="center">
					<a href="<?php echo base_url();?>index.php/admin/excel_all_topup/Rejected" style="padding-top:30px"><img src="<?php echo IMAGES_DIR;?>/excel-icon.png" width="45" height="45"/></a>
				</td>
			</tr>
		</table>
	</div>
	<div id="end"></div>
  <!--&content--> 

</div>
<script>
	$( window ).load(function() {
		//load_booking();
	});
	(function load_booking() {
		$("#data-booking").empty();
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/order/get_booking_list',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {order_system_id: datajson[i].order_system_id, party_order_id: datajson[i].party_order_id, payment_status: datajson[i].payment_status, order_id: datajson[i].order_id, category:datajson[i].category, total_price: datajson[i].total_price, order_status: datajson[i].order_status, timestamp: datajson[i].timestamp, agent_name: datajson[i].agent_name};
			},
			complete: function() {
			// Schedule the next request when the current one's complete
				setTimeout(load_booking, 60000);
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			function formatCurrency(cell) {
				//console.log("column key : " + cell.column.key);
				if(cell.column.key == "imps"){
					console.log(JSON.stringify(cell));
				}
				format = {
					//prefix: "Rp ",
					thousandsSeparator: ".",
					decimalSeparator: ",",
					decimalPlaces: 2
				};
				cell.record.set(Number(cell.value));
				return Y.DataType.Number.format(Number(cell.value), format);
			}
			
			var data_order = data;
			var table = new Y.DataTable({
				columns: [
					{key:"order_id", label:"ID Pesanan"},
					{key:"agent_name", label:"Nama Agen"},
					{
						label:"Sistem Pemesanan",
						nodeFormatter:function (o) {
							if (o.data.order_system_id=="internal")
								o.cell.setHTML('<b>Internal</b>');
							else
								o.cell.setHTML('<i>'+o.data.order_system_id+'</i><br /><b>ID: '+o.data.party_order_id+'</b>');
							return false;
						}
					},
					{key:"category", label:"Kategori"},
					{key:"total_price", label:"Total Harga", formatter:formatCurrency},
					{key:"order_status", label:"Status Pesanan"},
					{key:"payment_status", label:"Status Pembayaran"},
					{key:"timestamp", label:"Tanggal Pemesanan"}
				],
				data: data_order,
				caption: "Daftar Pesanan Terbaru",
				rowsPerPage: 10
			});
			table.render("#data-booking");
		});
	})
	();
</script>