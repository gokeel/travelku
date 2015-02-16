<div id="content"  style="min-height:400px;"> 
  <div class="frametab">
		<h3 style="margin:5px 0 5px 5px;">Daftar Konfirmasi Pembayaran oleh Pelanggan</h3>
		<div id="data-payment"></div>
	</div>
	<div id="end"></div>
	<div id="send-email"></div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_payment();
	});
	
	var modal = (function(){
		
	})();
	function load_payment(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/order/get_payment_list',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row:datajson[i].number_row, payment_id: datajson[i].payment_id, order_id: datajson[i].order_id, category:datajson[i].category, sender: datajson[i].sender, bank_name: datajson[i].bank_name, transfer_date: datajson[i].transfer_date, total_paid: datajson[i].total_paid, status: datajson[i].status, total_price: datajson[i].total_price, validated_by: datajson[i].validated_by, not_valid_datetime: datajson[i].not_valid_datetime};
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
					{key:"category", label:"Kategori"},
					{key:"sender", label:"Pengirim"},
					{key:"bank_name", label:"Bank Penerima"},
					{key:"transfer_date", label:"Tanggal Transaksi"},
					{key:"total_price", label:"Total Harga"},
					{key:"total_paid", label:"Total Pembayaran"},
					{key:"status", label:"Status Pembayaran"},
					{key:"not_valid_datetime", label:"Waktu Tidak Valid"},
					{
						label:"Tidak Valid",
						nodeFormatter:function (o) {
							if (o.data.status=="validated")
								o.cell.setHTML('<button disabled>Validasi</button>');
							else
								o.cell.setHTML('<a href="<?php echo base_url();?>index.php/order/validate_payment_id/'+o.data.payment_id+'" style="color:red"><button>Validasi</button></a>');
							return false;
						}
					},
					{
						label:"Tidak Valid",
						nodeFormatter:function (o) {
							if (o.data.status=="validated")
								o.cell.setHTML('<a href="<?php echo base_url();?>index.php/order/unvalidate_payment_id/'+o.data.order_id+'" style="color:red"><button disabled>Tidak Valid</button></a>');
							else
								//o.cell.setHTML('<a href="<?php echo base_url();?>index.php/order/unvalidate_payment_id/ero/'+o.data.order_id+'" style="color:red"><button id="not-valid-'+o.data.order_id+'" onclick="set_panel_div_id('+o.data.order_id+')">Tidak Valid</button></a>');
								o.cell.setHTML('<button id="not-valid-'+o.data.payment_id+'" onclick="open_dialog('+o.data.payment_id+')">Tidak Valid</button>');
							return false;
						}
					},
					{key:"validated_by", label:"Divalidasi oleh"}
				],
				data: data_order,
				caption: "Daftar Konfirmasi Pembayaran",
				rowsPerPage: 10
			});
			table.render("#data-payment");
		});
	}
	function open_dialog(value){
		$('#send-email').empty();
		$('#send-email').append('<div id="panel-send-bc">\
				<div class="yui3-widget-bd">\
					<form id="form-send-bc" name="form-send-bc">\
						<input type="hidden" name="id" value="'+value+'">\
						<fieldset>\
							<p>\
								<label for="bank-name">Penerima cc:</label>\
								<td><input type="text" name="cc" id="cc"></td>\
							</p>\
							<p>\
								<label for="bank-name">Konten Email</label>\
								<td><input class="editor" name="email_content" id="email_content"></td>\
							</p>\
						</fieldset>\
					</form>\
				</div>\
			</div>');
		$(".editor").jqte();
		YUI().use('panel', 'dd-plugin', function (Y) {
			function send_bc(){
				var form = $('#form-send-bc').serialize();
				$.ajax({
					type : "POST",
					url: '<?php echo base_url();?>index.php/order/unvalidate_payment_id',
					data: form,
					cache: false,
					async: false,
					dataType: "json",
					success:function(data){
						alert("Email telah dikirimkan ke email customer.");
						window.location.assign('<?php echo base_url();?>index.php/admin/validate_payment');
					}
				});
			}
			
			var addRowBtn  = Y.one('#not-valid-'+value);
			// Create the main modal form for add bank
			var panel = new Y.Panel({
				srcNode      : '#panel-send-bc',
				headerContent: 'Masukkan Konten Email yang diinginkan',
				width        : 750,
				zIndex       : 5,
				centered     : true,
				modal        : true,
				visible      : false,
				render       : true,
				plugins      : [Y.Plugin.Drag]
			});
			panel.addButton({
				value  : 'Submit',
				section: Y.WidgetStdMod.FOOTER,
				action : function (e) {
					send_bc();
				}
			});
			panel.addButton({
				value  : 'Tutup',
				section: Y.WidgetStdMod.FOOTER,
				action : function (e) {
					panel.hide();
				}
			});
			
			panel.show();
		});
	}
</script>