<!--Cindy Nordiansyah--> 
<?php
	//$uri2 = $this->uri->segment(2);
	$id = $this->uri->segment(3);
	//if ($uri2=='bank_edit')
	//	$msg = 'Data Bank';
	//else $msg = 'Data Bank Via';
?>
<div id="content"  style="min-height:400px;"> 
  <!--content--> 
	
	<div class="frametab">
		<form class="myform" id="edit_form">
			<h3 style="margin:5px 0 5px 5px;">Ubah Rute Airline</h3>
			<table cellpadding="5"  id="table-modify"   cellspacing="0" border="0px" bgcolor="#FFFFFF" class="myTable" >
				<tr class="editTR" >
					<td class="tdTitle">Nama Airline</td>
					<td><input name="nama" id="nama" type="text" value="" size="60"></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Origin City</td>
					<td><input name="origin" id="origin" type="text" value="" size="60"></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Destination City</td>
					<td><input name="destination" id="destination" type="text" value="" size="60"></td>
				</tr>
			</table>
			<div id="status"></div>
			<div class="formFooter">
				<input class="mybutton" style="float:left" name="dbproses" type="button" value="Cancel" onclick="document.location.href='<?php echo base_url();?>index.php/admin/assets_airlines/rute';" />
				<input class="mybutton" name="edit_data" id="edit_data" type="submit" value="Ubah Data" />
			</div>
		</form>
	</div> 

</div>

<script>
	function load_data_rute(uri){
		$.ajax({
			type : "GET",
			url: uri,
			dataType: "json",
			success:function(data){
				for(var i=0; i<data.length;i++){
					$('#nama').val(data[i].name);
					$('#origin').val(data[i].origin);
					$('#destination').val(data[i].destination);
				}
			}
		})
	}
	
	$( window ).load(function() {
	 <?php
		// if ($uri2=='bank_edit')
			// echo 'load_data_bank("'.base_url().'index.php/admin/bank_details/'.$id.'");';
		// else
			// echo 'load_data_bank_via("'.base_url().'index.php/admin/bank_via_details/'.$id.'");';
			
		echo 'load_data_rute("'.base_url().'index.php/admin/airline_rute_details/'.$id.'");';
	 ?>	
	});
	$(document).ready(function() {
		$('#edit_data').click(function(event) {
			$('#status').empty();
			$('#status').append('<p>Sedang memproses, mohon tunggu...</p>');
			var form = $('#edit_form').serialize();
			event.preventDefault();
			$.ajax({
				type : "GET",
				url: "<?php echo base_url().'index.php/admin/airline_rute_edit/'.$id;?>",
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
						if(data==false){
							alert('Data tidak berhasil dimasukkan. Mohon contact system administrator anda.');
						}
						else{
							var hel = 'temp';
							window.location.assign("<?php echo base_url('index.php/admin/assets_airlines/rute');?>");
						}
					}
			})
		});
	});
</script>