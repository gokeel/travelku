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
				<li><a href="#tab-1">Tiket Pesawat</a></li>
				<!--<li><a href="#tab-2">Tiket Kereta Api</a></li>-->
				<li><a href="#tab-3">Tiket Hotel</a></li>
				<li><a href="#tab-4">Paket</a></li>
				<li><a href="#tab-5">Tiket.com</a></li>
			</ul>
			<div>
				<div id="tab-1">
					<div id="order-flight"></div>
					
				</div>
				<!--<div id="tab-2">
					<div id="order-train"></div>
				</div>-->
				<div id="tab-3">
					<div id="order-hotel"></div>
				</div>
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
  <!--&content--> 
</div>

<script>
	$( window ).load(function() {
		load_order_flight();
		//load_order_train();
		load_order_hotel();
		load_order_paket();
		load_order_tiketcom();
	});
	
	function load_order_paket(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_registered_order_paket',
			dataType: "json",
			success:function(datajson){
				var div = $('#faqkonten');
				for(var i=0; i<datajson.length; i++){
					data[i] = {number_row: datajson[i].number_row, order_id: datajson[i].order_id, agent_name:datajson[i].agent_name, category: datajson[i].category, description: datajson[i].category, title: datajson[i].title, price: currency_separator(datajson[i].price, '.'), payment_status: datajson[i].payment_status, currency: datajson[i].currency, total_person: datajson[i].total_person, locked_by_name: datajson[i].locked_by_name};
				}
			}
		});
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			var data_order = data;
			var table = new Y.DataTable({
				columns: [
					{key:"order_id", label:"ID", sortable:true},
					{key:"agent_name", label:"Nama Agen", sortable:true},
					{key:"category", label:"Kategori Paket", sortable:true},
					{key:"description", label:"Paket"},
					{key:"title", label:"Nama Paket"},
					{key:"total_person", label:"Jml Peserta"},
					{key:"currency", label:"Mata Uang"},
					{key:"price", label:"Total Harga"},
					{key:"payment_status", label:"Status Pembayaran"},
					{
						label:"Book",
						nodeFormatter:function (o) {
							if(o.data.locked_by_name==null || o.data.locked_by_name==""){
								o.cell.setHTML('<a href="<?php echo base_url();?>index.php/admin/proceed_order/paket/'+o.data.order_id+'" style="color:red"><button>Book</button></a>');
							}
							else{
								var str = '';
								var disabled = '';
								if(o.data.locked_by_name=="<?php echo $this->session->userdata('user_name');?>" || o.data.locked_by_name=="admin")
									disabled = '';
								else
									disabled = 'disabled';
								o.cell.setHTML('<i>Locked by: '+o.data.locked_by_name+'</i><br /><a href="<?php echo base_url();?>index.php/admin/proceed_order/paket/'+o.data.order_id+'" style="color:red"><button '+disabled+'>Book</button></a><br /><br /><a href="<?php echo base_url();?>index.php/admin/unlock_user_at_order/'+o.data.order_id+'"><button '+disabled+'>Unlock</button></a>');
							}
							
							return false;
						}
					},
					{
						key:"order_id", 
						label: "Batal",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/cancel_order/{value}" onclick="return prompt_confirmation();" style="color:red"><button>Batal</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Tolak",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/reject_order/{value}" onclick="return prompt_confirmation();" style="color:red"><button>Tolak</button></a>',
						allowHTML: true
					}
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
			url: '<?php echo base_url();?>index.php/admin/get_registered_order/flight',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {order_id: datajson[i].order_id, is_round_trip: datajson[i].is_round_trip,agent_name:datajson[i].agent_name, airline_name_depart: datajson[i].airline_name_depart,airline_name_return: datajson[i].airline_name_return, flight_id: datajson[i].flight_id, route: datajson[i].route, datetime_depart: datajson[i].departing_date+' '+datajson[i].time_travel, datetime_return: datajson[i].returning_date+' '+datajson[i].time_travel_ret, total_price: datajson[i].total_price, adult: datajson[i].adult, price_adult: datajson[i].price_adult, child: datajson[i].child, price_child: datajson[i].price_child, infant: datajson[i].infant, price_infant: datajson[i].price_infant, payment_status: datajson[i].status, locked_by_name: datajson[i].locked_by_name};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			var data_order = data;
			var table = new Y.DataTable({
				columns: [
					{key:"order_id", label:"ID"},
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
						label:"Waktu Penerbangan",
						nodeFormatter:function (o) {
							var str = '<p><b>Dep:</b><br/> '+o.data.datetime_depart;
							if (o.data.is_round_trip=="true")
								str += '<br /><b>Ret:</b><br/> '+o.data.datetime_return;
							str += '</p>';
							
							o.cell.setHTML(str);
							return false;
						}
					},
					{key:"total_price", label:"Total Harga"},
					{key:"payment_status", label:"Status Pembayaran"},
					{
						label:"Book",
						nodeFormatter:function (o) {
							if(o.data.locked_by_name==null || o.data.locked_by_name==""){
								o.cell.setHTML('<a href="<?php echo base_url();?>index.php/admin/proceed_order/flight/'+o.data.order_id+'" style="color:red"><button>Book</button></a>');
							}
							else{
								var str = '';
								var disabled = '';
								if(o.data.locked_by_name=="<?php echo $this->session->userdata('user_name');?>" || o.data.locked_by_name=="admin")
									disabled = '';
								else
									disabled = 'disabled';
								o.cell.setHTML('<i>Locked by: '+o.data.locked_by_name+'</i><br /><a href="<?php echo base_url();?>index.php/admin/proceed_order/flight/'+o.data.order_id+'" style="color:red"><button '+disabled+'>Book</button></a><br /><br /><a href="<?php echo base_url();?>index.php/admin/unlock_user_at_order/'+o.data.order_id+'"><button '+disabled+'>Unlock</button></a>');
							}
							
							return false;
						}
					},
					{
						key:"order_id", 
						label: "Batal",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/cancel_order/{value}" onclick="return prompt_confirmation();" style="color:red"><button>Batal</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Tolak",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/reject_order/{value}" onclick="return prompt_confirmation();" style="color:red"><button>Tolak</button></a>',
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
					data[i] = {order_id: datajson[i].order_id, agent_name:datajson[i].agent_name, name: datajson[i].name, train_id: datajson[i].id, subclass: datajson[i].subclass, route: datajson[i].route, full_via: datajson[i].departing_date+' '+datajson[i].time_travel, total_price: datajson[i].total_price, adult: datajson[i].adult, price_adult: datajson[i].price_adult, child: datajson[i].child, price_child: datajson[i].price_child, infant: datajson[i].infant, price_infant: datajson[i].price_infant, payment_status: datajson[i].payment_status};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			var data_order = data;
			var table = new Y.DataTable({
				columns: [
					{key:"order_id", label:"ID"},
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
						formatter:'<a href="<?php echo base_url();?>index.php/admin/cancel_order/{value}" onclick="return prompt_confirmation();" style="color:red"><button>Batal</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Tolak",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/reject_order/{value}" onclick="return prompt_confirmation();" style="color:red"><button>Tolak</button></a>',
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
					data[i] = {order_id: datajson[i].order_id, agent_name:datajson[i].agent_name, name: datajson[i].name, hotel_id: datajson[i].id, address: datajson[i].address, regional: datajson[i].regional, book_date: datajson[i].checkin+' / '+datajson[i].checkout, night: datajson[i].night, room: datajson[i].room, total_price: datajson[i].total_price, adult: datajson[i].adult, child: datajson[i].child, payment_status: datajson[i].payment_status, room_name: datajson[i].room_name};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			var data_order = data;
			var table = new Y.DataTable({
				columns: [
					{key:"order_id", label:"ID"},
					{key:"agent_name", label:"Nama Agen"},
					{key:"name", label:"Hotel"},
					{key:"room_name", label:"Kamar"},
					{key:"address", label:"Alamat"},
					{key:"regional", label:"Regional"},
					{key:"book_date", label:"Checkin / Checkout"},
					{label:"Detail",
						nodeFormatter:function(o){
							o.cell.setHTML('Malam:'+o.data.night+'<br>Kamar:'+o.data.room+'<br>Dewasa:'+o.data.adult+'<br>Anak:'+o.data.child);
							return false;
						}
					},
					{key:"total_price", label:"Total Harga"},
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
						formatter:'<a href="<?php echo base_url();?>index.php/admin/cancel_order/{value}" onclick="return prompt_confirmation();" style="color:red"><button>Batal</button></a>',
						allowHTML: true
					},
					{
						key:"order_id", 
						label: "Tolak",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/reject_order/{value}" onclick="return prompt_confirmation();" style="color:red"><button>Tolak</button></a>',
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
	
	function load_order_tiketcom(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/tiketcom_get_order_list/booked',
			dataType: "json",
			success:function(datajson){
				var div = $('#faqkonten');
				for(var i=0; i<datajson.length; i++){
					data[i] = {order_system_id: datajson[i].order_system_id, party_order_id: datajson[i].party_order_id, payment_status: datajson[i].payment_status, order_id: datajson[i].order_id, category:datajson[i].category, total_price: datajson[i].total_price, order_status: datajson[i].order_status, timestamp: datajson[i].timestamp, agent_name: datajson[i].agent_name};
				}
			}
		});
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			var data_order = data;
			var table = new Y.DataTable({
				columns: [
					{key:"order_id", label:"ID Internal"},
					{key:"party_order_id", label:"ID Tiketcom"},
					{key:"agent_name", label:"Nama Agen"},
					{key:"category", label:"Kategori"},
					{key:"total_price", label:"Total Harga"},
					{key:"order_status", label:"Status Pesanan"},
					{key:"payment_status", label:"Status Pembayaran"},
					{key:"timestamp", label:"Tanggal Pemesanan"}
				],
				data: data_order,
				caption: "Daftar Antrian Pesanan",
				rowsPerPage: 10
			});
			table.render("#order-tiketcom");
		});
	}
</script>