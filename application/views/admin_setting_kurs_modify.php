<?php
	$id = $this->uri->segment(3);
?>
<div id="content"  style="min-height:400px;"> 
  <!--content--> 
	
	<div class="frametab">
		<form class="myform" id="edit_form" method="post" action="<?php echo base_url().'index.php/admin/kurs_edit/'.$id;?>">
			<h3 style="margin:5px 0 5px 5px;">Ubah Konversi Kurs</h3>
			<table cellpadding="5"  id="table-modify"   cellspacing="0" border="0px" bgcolor="#FFFFFF" class="myTable" >
				<tr class="editTR" >
					<td class="tdTitle">Kode Mata Uang - A</td>
					<td><input type="text" name="currency_a" id="currency_a" placeholder=""></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Negara - A</td>
					<td><input type="text" name="country_a" id="country_a" placeholder=""></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Kode Mata Uang - B</td>
					<td><input type="text" name="currency_b" id="currency_b" placeholder=""></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Negara - B</td>
					<td><input type="text" name="country_b" id="country_b" placeholder=""></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Nilai Kurs</td>
					<td><input type="text" name="rate_in_b" id="rate" placeholder=""></td>
				</tr>
			</table>
			<div id="status"></div>
			<div class="formFooter">
				<input class="mybutton" style="float:left" name="dbproses" type="button" value="Cancel" onclick="document.location.href='<?php echo base_url();?>index.php/admin/setting_kurs_page';" />
				<input class="mybutton" id="edit_data" type="submit" value="Ubah Data" />
			</div>
		</form>
	</div> 

</div>

<script>
	function load_data_kurs(){
		$.ajax({
			type : "GET",
			url: '<?php echo base_url();?>index.php/admin/get_exchange_by_id/<?php echo $id;?>',
			dataType: "json",
			success:function(data){
				$('#country_a').val(data.country_a);
				$('#country_b').val(data.country_b);
				$('#currency_a').val(data.currency_a);
				$('#currency_b').val(data.currency_b);
				$('#rate').val(data.rate);
			}
		})
	}
	
	$( window ).load(function() {
	 load_data_kurs();	
	});
	$(document).ready(function() {
		$('#editdata').click(function(event) {
			$('#status').empty();
			$('#status').append('<p>Sedang memproses, mohon tunggu...</p>');
			var form = $('#edit_form').serialize();
			//event.preventDefault();
			$.ajax({
				type : "GET",
				url: "<?php echo base_url().'index.php/admin/kurs_edit/'.$id;?>",
				data: form,
				cache: false,
				dataType: "json",
				success:function(data){
						if(data==false){
							alert('Data tidak berhasil dimasukkan. Mohon contact system administrator anda.');
						}
						else{
							var hel = 'temp';
							window.location.assign("<?php echo base_url('index.php/admin/setting_kurs_page');?>");
						}
					}
			})
		});
	});
</script>