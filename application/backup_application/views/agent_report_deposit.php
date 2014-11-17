<section role="main" id="main"><!--tpl:web/dasboard-->
<!-- Main content -->

	<noscript class="message black-gradient simpler">
		Your browser does not support JavaScript! Some features won't work as expected...
	</noscript>
	<hgroup id="main-title" class="thin">
		<h1 style="color:white">Deposit status of <?php echo $uri;?></h1>
	</hgroup>

	<div class="with-padding">
		<div class="twelve-columns twelve-columns-tablet twelve-columns-mobile">
			<p> </p>
			<h3 class="thin underline">Daftar <?php if($uri=='topup') echo 'Top-Up'; elseif($uri=='withdraw') echo 'Withdraw';?></h3>
			<div id="list"></div>
			<p></p>
		</div>
	</div>
	<div style="clear:both;"></div>
</section>
<script>
	$( window ).load(function() {
		<?php 
		if($uri=='topup')
			echo 'load_topup();';
		else if($uri=='withdraw')
			echo 'load_withdraw();';
		?>
	});
	function load_topup(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/agent/get_topup_by_agent',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row:datajson[i].number_row ,id: datajson[i].id, agent_name:datajson[i].agent_name, bank_from: datajson[i].bank_from, sender_number: datajson[i].sender_number, sender_name: datajson[i].sender_name, bank_name: datajson[i].bank_name, transfer_date: datajson[i].transfer_date, nominal: datajson[i].nominal, status: datajson[i].status, request_date: datajson[i].request_date};
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
					{key:"number_row", label:"No."},
					{key:"request_date", label:"Tanggal Request"},
					{key:"agent_name", label:"Nama Agen"},
					{key:"bank_from", label:"Bank Pengirim"},
					{key:"sender_name", label:"Nama Pengirim"},
					{key:"sender_number", label:"No Rekening Pengirim"},
					{key:"bank_name", label:"Bank Penerima"},
					{key:"transfer_date", label:"Tanggal Pengiriman"},
					{key:"nominal", label:"Nominal", formatter:formatCurrency},
					{key:"status", label:"Status"}
				],
				data: data_order,
				caption: "Daftar Top-Up yang telah dilakukan",
				rowsPerPage: 10
			});
			table.render("#list");
		});
	}
	function load_withdraw(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/agent/get_withdraw_by_agent',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row:datajson[i].number_row ,id: datajson[i].id, agent_name:datajson[i].agent_name, bank_to: datajson[i].bank_to, receiver_number: datajson[i].receiver_number, receiver_name: datajson[i].receiver_name, message: datajson[i].message, nominal: datajson[i].nominal, status: datajson[i].status, request_date: datajson[i].request_date};
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
					{key:"number_row", label:"No."},
					{key:"request_date", label:"Tanggal Request"},
					{key:"agent_name", label:"Nama Agen"},
					{key:"bank_to", label:"Bank Tujuan"},
					{key:"receiver_name", label:"Nama Penerima"},
					{key:"receiver_number", label:"No Rekening Penerima"},
					{key:"nominal", label:"Nominal", formatter:formatCurrency},
					{key:"message", label:"Catatan"},
					{key:"status", label:"Status"}
				],
				data: data_order,
				caption: "Daftar Pesanan",
				rowsPerPage: 10
			});
			table.render("#list");
		});
	}
</script>