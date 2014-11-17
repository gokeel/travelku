<script type="text/javascript">
YUI().use('tabview', function(Y) {
    var tabview = new Y.TabView({srcNode:'#tabs'});
    tabview.render();
});
</script>
<div id="content"  style="min-height:400px;"> 
  <div class="frametab">
		
		<h3 style="margin:5px 0 5px 5px;">Daftar Antrian Pesanan</h3>
		<div id="tabs">
			<ul>
				<li><a href="#tab-1">Pesawat</a></li>
				<li><a href="#tab-2">Kereta Api</a></li>
				<li><a href="#tab-3">Hotel</a></li>
				<li><a href="#tab-4">Paket Tur</a></li>
				<li><a href="#tab-5">Paket Pesawat</a></li>
				<li><a href="#tab-6">Paket Hotel</a></li>
				<!--<li><a href="#tab-7">Paket Promo</a></li>-->
			</ul>
			<div>
				<div id="tab-1">
					<div id="order-flight"></div>
					
				</div>
				<div id="tab-2">
					<div id="order-train"></div>
				</div>
				<div id="tab-3">
					<div id="order-hotel"></div>
				</div>
				<div id="tab-4">
					<div id="order-paket-tour"></div>
				</div>
				<div id="tab-5">
					<div id="order-paket-pesawat"></div>
				</div>
				<div id="tab-6">
					<div id="order-paket-hotel"></div>
				</div>
				<!--<div id="tab-7">
					<div id="order-paket-promo"></div>
				</div>-->
			</div>
		</div>
		
		
	</div>
	<div id="end"></div>
  <!--&content--> 
</div>

<script>
	$( window ).load(function() {
		load_order_flight();
		load_order_train();
		load_order_hotel();
		load_order_paket('tour-umrah-travel', 'tour');
		load_order_paket('pesawat', 'pesawat');
		load_order_paket('hotel', 'hotel');
	});
	function load_order_paket(category, list){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_registered_order_paket/'+category,
			dataType: "json",
			success:function(datajson){
				var div = $('#faqkonten');
				for(var i=0; i<datajson.length; i++){
					data[i] = {number_row: datajson[i].number_row, order_id: datajson[i].order_id, agent_name:datajson[i].agent_name, category: datajson[i].category, description: datajson[i].category, title: datajson[i].title, price: datajson[i].price, payment_status: datajson[i].payment_status};
				}
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
					{key:"category", label:"Kategori Paket"},
					{key:"description", label:"Paket"},
					{key:"title", label:"Nama Paket"},
					{key:"price", label:"Total Harga", formatter:formatCurrency},
					{key:"payment_status", label:"Status Pembayaran"},
					{
						key:"order_id", 
						label: "Issued",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/proceed_order/paket/{value}" style="color:red"><button>Issued</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Batal",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/cancel_order/{value}" style="color:red"><button>Batal</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Tolak",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/reject_order/{value}" style="color:red"><button>Tolak</button></a>',
						allowHTML: true
					}
				],
				data: data_order,
				caption: "Daftar Antrian Pesanan",
				rowsPerPage: 10
			});
			table.render("#order-paket-"+list);
		});
	}
	function load_order_flight(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_registered_order/flight',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row:datajson[i].number_row ,order_id: datajson[i].order_id, agent_name:datajson[i].agent_name, airline_name: datajson[i].airline_name, flight_id: datajson[i].flight_id, route: datajson[i].route, full_via: datajson[i].departing_date+'-'+datajson[i].time_travel, total_price: datajson[i].total_price, adult: datajson[i].adult, price_adult: datajson[i].price_adult, child: datajson[i].child, price_child: datajson[i].price_child, infant: datajson[i].infant, price_infant: datajson[i].price_infant, payment_status: datajson[i].payment_status};
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
					{key:"airline_name", label:"Maskapai"},
					{key:"route", label:"Rute"},
					{key:"full_via", label:"Waktu"},
					{key:"total_price", label:"Total Harga", formatter:formatCurrency},
					{key:"payment_status", label:"Status Pembayaran"},
					{
						key:"order_id", 
						label: "Issued",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/proceed_order/flight/{value}" style="color:red"><button>Issued</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Batal",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/cancel_order/{value}" style="color:red"><button>Batal</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Tolak",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/reject_order/{value}" style="color:red"><button>Tolak</button></a>',
						allowHTML: true
					}
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
					data[i] = {number_row:datajson[i].number_row ,order_id: datajson[i].order_id, agent_name:datajson[i].agent_name, name: datajson[i].name, train_id: datajson[i].id, subclass: datajson[i].subclass, route: datajson[i].route, full_via: datajson[i].departing_date+' '+datajson[i].time_travel, total_price: datajson[i].total_price, adult: datajson[i].adult, price_adult: datajson[i].price_adult, child: datajson[i].child, price_child: datajson[i].price_child, infant: datajson[i].infant, price_infant: datajson[i].price_infant, payment_status: datajson[i].payment_status};
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
					{
						key:"order_id", 
						label: "Issued",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/proceed_order/train/{value}" style="color:red"><button>Issued</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Batal",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/cancel_order/{value}" style="color:red"><button>Batal</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Tolak",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/reject_order/{value}" style="color:red"><button>Tolak</button></a>',
						allowHTML: true
					}
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
					data[i] = {number_row:datajson[i].number_row ,order_id: datajson[i].order_id, agent_name:datajson[i].agent_name, name: datajson[i].name, hotel_id: datajson[i].id, address: datajson[i].address, regional: datajson[i].regional, book_date: datajson[i].checkin+' / '+datajson[i].checkout, night: datajson[i].night, room: datajson[i].room, total_price: datajson[i].total_price, adult: datajson[i].adult, child: datajson[i].child, payment_status: datajson[i].payment_status};
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
					{
						key:"order_id", 
						label: "Issued",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/proceed_order/hotel/{value}" style="color:red"><button>Issued</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Batal",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/cancel_order/{value}" style="color:red"><button>Batal</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Tolak",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/reject_order/{value}" style="color:red"><button>Tolak</button></a>',
						allowHTML: true
					}
				],
				data: data_order,
				caption: "Daftar Antrian Pesanan",
				rowsPerPage: 10
			});
			table.render("#order-hotel");
		});
	}
</script>