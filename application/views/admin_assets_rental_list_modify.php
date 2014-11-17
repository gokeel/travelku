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
			<h3 style="margin:5px 0 5px 5px;">Ubah Data Rental List</h3>
			<table cellpadding="5"  id="table-modify"   cellspacing="0" border="0px" bgcolor="#FFFFFF" class="myTable" >
				<tr class="editTR" >
					<td class="tdTitle">Agent Supplier</td>
					<td><input name="supplier" id="supplier" type="text" value="" size="60"></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Kota</td>
					<td><input name="kota" id="kota" type="text" value="" size="60"></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Kendaraan</td>
					<td><input name="vehicle" id="vehicle" type="text" value="" size="60"></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Is Active</td>
					<td><input name="isactive" id="isactive" type="text" value="" size="60"></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Bensin</td>
					<td><input name="bensin" id="bensin" type="text" value="" size="60"></td>
				</tr>
			</table>
			<div id="status"></div>
			<div class="formFooter">
				<input class="mybutton" style="float:left" name="dbproses" type="button" value="Cancel" onclick="document.location.href='<?php echo base_url();?>index.php/admin/assets_rental/list';" />
				<input class="mybutton" name="edit_data" id="edit_data" type="submit" value="Ubah Data" />
			</div>
		</form>
	</div> 

</div>

<script>
	function load_data_room_hotel(uri){
		$.ajax({
			type : "GET",
			url: uri,
			dataType: "json",
			success:function(data){
				for(var i=0; i<data.length;i++){
					$('#supplier').val(data[i].supplier);
					$('#kota').val(data[i].kota);
					$('#vehicle').val(data[i].vehicle);
					$('#isactive').val(data[i].isactive);
					$('#bensin').val(data[i].bensin);
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
			
		echo 'load_data_room_hotel("'.base_url().'index.php/admin/rental_list_details/'.$id.'");';
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
				url: "<?php echo base_url().'index.php/admin/rental_list_edit/'.$id;?>",
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
						if(data==false){
							alert('Data tidak berhasil dimasukkan. Mohon contact system administrator anda.');
						}
						else{
							var hel = 'temp';
							window.location.assign("<?php echo base_url('index.php/admin/assets_rental/list');?>");
						}
					}
			})
		});
	});
</script>