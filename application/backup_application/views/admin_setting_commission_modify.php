<?php
	$id = $this->uri->segment(3);
?>
<div id="content"  style="min-height:400px;"> 
  <!--content--> 
	
	<div class="frametab">
		<h3 style="margin:5px 0 5px 5px;">Ubah Data Komisi</h3>
		<h2 id="id-comm"></h2>
		<h2 id="type-comm"></h2>
		<h2 id="slug-comm"></h2>
		
		<form class="myform" id="edit_form" method="post" action="<?php echo base_url().'index.php/admin/commission_edit/'.$id;?>">
			
			<table cellpadding="5"  id="table-modify"   cellspacing="0" border="0px" bgcolor="#FFFFFF" class="myTable" >
				<tr class="editTR" >
					<td class="tdTitle">Label Komisi</td>
					<td><input type="text" name="name" id="name" placeholder=""></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Nominal</td>
					<td><input type="text" name="nominal" id="nominal" placeholder=""></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Untuk Agen</td>
					<td>
						<select id="is_for_agent" name="is_for_agent">
							<option value="true">True</option>
							<option value="false">False</option>
						</select>
					</td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Aktif?</td>
					<td>
						<select id="is_active" name="is_active">
							<option value="true">True</option>
							<option value="false">False</option>
						</select>
					</td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Keterangan</td>
					<td><input type="text" name="notes" id="note" placeholder=""></td>
				</tr>
			</table>
			<div id="status"></div>
			<div class="formFooter">
				<input class="mybutton" style="float:left" name="dbproses" type="button" value="Cancel" onclick="document.location.href='<?php echo base_url();?>index.php/admin/setting_commission_page';" />
				<input class="mybutton" id="edit_data" type="submit" value="Ubah Data" />
			</div>
		</form>
	</div> 

</div>

<script>
	function load_data_comm(){
		$.ajax({
			type : "GET",
			url: '<?php echo base_url();?>index.php/admin/get_commission_by_id/<?php echo $id;?>',
			async: false,
			dataType: "json",
			success:function(data){
				$('#id-comm').html('ID: '+data.id);
				$('#type-comm').html('Category: '+data.type);
				$('#slug-comm').html('Filter Name: '+data.slug);
				$('#name').val(data.name);
				$('#nominal').val(data.nominal);
				$('#note').val(data.note);
				$('#is_for_agent').val(data.is_for_agent);
				$('#is_active').val(data.is_active);
			}
		})
	}
	
	$( window ).load(function() {
	 load_data_comm();	
	});
</script>