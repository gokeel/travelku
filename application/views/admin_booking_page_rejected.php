<script type="text/javascript">
YUI().use('tabview', function(Y) {
    var tabview = new Y.TabView({srcNode:'#tabs'});
    tabview.render();
});
</script>
<div id="content"  style="min-height:400px;"> 
  <div class="frametab">
		
		<h3 style="margin:5px 0 5px 5px;">Daftar Pesanan yang Ditolak</h3>
		<button id="add-reason">Tambah/Ubah Alasan</button>
		<div id="tabs">
			<ul>
				<li><a href="#tab-1">Tiket Pesawat</a></li>
				<!--<li><a href="#tab-2">Tiket Kereta Api</a></li>
				<li><a href="#tab-3">Tiket Hotel</a></li>-->
				<li><a href="#tab-4">Paket</a></li>
				<li><a href="#tab-5">Tiketcom</a></li>
			</ul>
			<div>
				<div id="tab-1">
					<div id="order-flight"></div>
				</div>
				<!--<div id="tab-2">
					<div id="order-train"></div>
				</div>
				<div id="tab-3">
					<div id="order-hotel"></div>
				</div>-->
				<div id="tab-4">
					<div id="order-paket"></div>
				</div>
				<div id="tab-5">
					<div id="order-tiketcom"></div>
				</div>
			</div>
		</div>
		
		
	</div>
	<div id="end"></div>
	<div id="panel-reason">
		<div class="yui3-widget-bd">
			<form id="form-add-reason" name="form-add-reason">
				<fieldset>
					<p>
						<label for="bank-name">ID Pesanan</label>
						<input type="text" name="order-id" id="order-id" placeholder="">
					</p>
					<p>
						<label for="account-no">Alasan</label>
						<input type="text" name="reason" id="reason" value="" placeholder="">
					</p>
				</fieldset>
			</form>
		</div>
	</div>
  <!--&content--> 
</div>

<script>
	YUI().use('panel', 'dd-plugin', function (Y) {
		function add_reason(){
			var form = $('#form-add-reason').serialize();
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/admin/add_reason',
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
					window.location.assign("<?php echo base_url('index.php/admin/booking_rejected');?>");
				}
			})
		}
		
		var addRowBtn  = Y.one('#add-reason');
		// Create the main modal form for add bank
		var panel = new Y.Panel({
			srcNode      : '#panel-reason',
			headerContent: 'Tambah/Ubah Alasan',
			width        : 250,
			zIndex       : 5,
			centered     : true,
			modal        : true,
			visible      : false,
			render       : true,
			plugins      : [Y.Plugin.Drag]
		});
		panel.addButton({
			value  : 'Simpan',
			section: Y.WidgetStdMod.FOOTER,
			action : function (e) {
				e.preventDefault();
				add_reason();
			}
		});
		panel.addButton({
			value  : 'Batal',
			section: Y.WidgetStdMod.FOOTER,
			action : function (e) {
				panel.hide();
			}
		});
		// When the addRowBtn is pressed, show the modal form.
		addRowBtn.on('click', function (e) {
			panel.show();
		});
	});
	$( window ).load(function() {
		load_order_flight();
		//load_order_train();
		//load_order_hotel();
		load_order_paket();
		load_order_tiketcom();
	});
	
	function load_order_tiketcom(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/tiketcom_get_order_list/rejected',
			dataType: "json",
			success:function(datajson){
				var div = $('#faqkonten');
				for(var i=0; i<datajson.length; i++){
					data[i] = {order_system_id: datajson[i].order_system_id, party_order_id: datajson[i].party_order_id, payment_status: datajson[i].payment_status, order_id: datajson[i].order_id, category:datajson[i].category, total_price: currency_separator(datajson[i].total_price, '.'), order_status: datajson[i].order_status, timestamp: datajson[i].timestamp, agent_name: datajson[i].agent_name};
				}
			}
		});
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			
			var data_order = data;
			var table = new Y.DataTable({
				columns: [
					{key:"order_id", label:"ID Pesanan"},
					{key:"agent_name", label:"Nama Agen"},
					{key:"category", label:"Kategori"},
					{key:"total_price", label:"Total Harga"},
					{key:"order_status", label:"Status Pesanan"},
					{key:"payment_status", label:"Status Pembayaran"},
					{key:"timestamp", label:"Tanggal Pemesanan"}
				],
				data: data_order,
				caption: "Daftar Pesanan Cancelled",
				rowsPerPage: 10
			});
			table.render("#order-tiketcom");
		});
	}	
	
	function load_order_paket(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_cancelled_rejected_order_paket/Rejected',
			dataType: "json",
			success:function(datajson){
				var div = $('#faqkonten');
				for(var i=0; i<datajson.length; i++){
					data[i] = {order_id: datajson[i].order_id, agent_name:datajson[i].agent_name, category: datajson[i].category, description: datajson[i].category, title: datajson[i].title, price: datajson[i].price, payment_status: datajson[i].payment_status, order_status: datajson[i].order_status, reason: datajson[i].reason};
				}
			}
		});
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			
			var data_order = data;
			var table = new Y.DataTable({
				columns: [
					{key:"order_id", label:"ID Pesanan"},
					{key:"agent_name", label:"Nama Agen"},
					{key:"category", label:"Kategori Paket"},
					{key:"description", label:"Paket"},
					{key:"title", label:"Nama Paket"},
					{key:"price", label:"Total Harga"},
					{key:"payment_status", label:"Status Pembayaran"},
					{key:"order_status", label:"Status Pesanan"},
					{key:"reason", label:"Alasan"}
				],
				data: data_order,
				caption: "Daftar Antrian Pesanan",
				rowsPerPage: 10
			});
			table.render("#order-paket");
		});
	}
	function load_order_flight(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_cancelled_rejected_order_internal_nonpaket/flight/Rejected',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {order_id: datajson[i].order_id, is_round_trip: datajson[i].is_round_trip,agent_name:datajson[i].agent_name, airline_name_depart: datajson[i].airline_name_depart,airline_name_return: datajson[i].airline_name_return, flight_id: datajson[i].flight_id, route: datajson[i].route, datetime_depart: datajson[i].departing_date+' '+datajson[i].time_travel, datetime_return: datajson[i].returning_date+' '+datajson[i].time_travel_ret, total_price: datajson[i].total_price, adult: datajson[i].adult, price_adult: datajson[i].price_adult, child: datajson[i].child, price_child: datajson[i].price_child, infant: datajson[i].infant, price_infant: datajson[i].price_infant, payment_status: datajson[i].status, locked_by_name: datajson[i].locked_by_name, reason: datajson[i].reason};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			var data_order = data;
			var table = new Y.DataTable({
				columns: [
					{key:"order_id", label:"ID Pesanan"},
					{key:"agent_name", label:"Agen"},
					{
						label:"Single/Round",
						nodeFormatter:function (o) {
							if (o.data.is_round_trip=="true")
								o.cell.setHTML('<img src="<?php echo IMAGES_DIR;?>/icon_round_trip.jpg" width="60px" height="25px" title="round-trip">');
							else
								o.cell.setHTML('<img src="<?php echo IMAGES_DIR;?>/icon_single_trip.jpg" width="60px" height="25px" title="single-trip">');
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
						label:"Waktu",
						nodeFormatter:function (o) {
							var str = '<p><b>Dep:</b> '+o.data.datetime_depart;
							if (o.data.is_round_trip=="true")
								str += '<br /><b>Ret:</b> '+o.data.datetime_return;
							str += '</p>';
							
							o.cell.setHTML(str);
							return false;
						}
					},
					//{key:"total_price", label:"Total Harga", formatter:formatCurrency},
					{key:"payment_status", label:"Status Pembayaran"},
					{key:"reason", label:"Alasan"}
				],
				data: data_order,
				caption: "Daftar Antrian Pesanan",
				rowsPerPage: 10
			});
			table.render("#order-flight");
		});
	}
	function load_order_train(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_registered_order/train',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row:datajson[i].number_row ,order_id: datajson[i].order_id, agent_name:datajson[i].agent_name, name: datajson[i].name, train_id: datajson[i].id, subclass: datajson[i].subclass, route: datajson[i].route, full_via: datajson[i].departing_date+' '+datajson[i].time_travel, total_price: datajson[i].total_price, adult: datajson[i].adult, price_adult: datajson[i].price_adult, child: datajson[i].child, price_child: datajson[i].price_child, infant: datajson[i].infant, price_infant: datajson[i].price_infant, payment_status: datajson[i].payment_status, order_status: datajson[i].order_status, reason: datajson[i].reason};
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
					{key:"number_row", label:"No.", width:"10px"},
					{key:"order_id", label:"ID Pesanan"},
					{key:"agent_name", label:"Nama Agen"},
					{key:"name", label:"Kereta"},
					{key:"route", label:"Rute"},
					{key:"full_via", label:"Waktu"},
					{key:"total_price", label:"Total Harga", formatter:formatCurrency},
					{key:"payment_status", label:"Status Pembayaran"},
					{key:"order_status", label:"Status Pesanan"},
					{key:"reason", label:"Alasan"}
				],
				data: data_order,
				caption: "Daftar Antrian Pesanan",
				rowsPerPage: 10
			});
			table.render("#order-train");
		});
	}
	function load_order_hotel(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_registered_order/hotel',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row:datajson[i].number_row ,order_id: datajson[i].order_id, agent_name:datajson[i].agent_name, name: datajson[i].name, hotel_id: datajson[i].id, address: datajson[i].address, regional: datajson[i].regional, book_date: datajson[i].checkin+' / '+datajson[i].checkout, night: datajson[i].night, room: datajson[i].room, total_price: datajson[i].total_price, adult: datajson[i].adult, child: datajson[i].child, payment_status: datajson[i].payment_status, order_status: datajson[i].order_status, reason: datajson[i].reason};
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
					{key:"number_row", label:"No.", width:"10px"},
					{key:"order_id", label:"ID Pesanan"},
					{key:"agent_name", label:"Nama Agen"},
					{key:"name", label:"Hotel"},
					{key:"address", label:"Alamat"},
					{key:"regional", label:"Regional"},
					{key:"book_date", label:"Checkin / Checkout"},
					{label:"Detail",
						nodeFormatter:function(o){
							o.cell.setHTML('Malam:'+o.data.night+'<br>Kamar:'+o.data.room+'<br>Dewasa:'+o.data.adult+'<br>Anak:'+o.data.child);
							return false;
						}
					},
					{key:"total_price", label:"Total Harga", formatter:formatCurrency},
					{key:"payment_status", label:"Status Pembayaran"},
					{key:"order_status", label:"Status Pesanan"},
					{key:"reason", label:"Alasan"}
				],
				data: data_order,
				caption: "Daftar Antrian Pesanan",
				rowsPerPage: 10
			});
			table.render("#order-hotel");
		});
	}
</script>