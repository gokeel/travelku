<div id="content"  style="min-height:400px;"> 
	<div class="frametab">
			<h2 style="margin:5px 0 5px 5px;">Tambah Konten</h2>
			<h3>Petunjuk:</h3>
			<h3>Field Harga dan Poin Reward khusus untuk konten yang berhubungan dengan paket.</h3>
			<?php echo form_open_multipart('admin/add_post');?>
				<input type="hidden" name="post_id" value="<?php echo $id;?>">
				<input type="hidden" name="author" value="<?php echo $this->session->userdata('account_id');?>">
				<table cellpadding="5"  id="table-modify"   cellspacing="0" border="0px" bgcolor="#FFFFFF" class="myTable" >
					<tr class="editTR" >
						<td>Kategori</td>
						<td><select name="category" id="category"></select></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Titel</td>
						<td><input name="title" id="title" type="text" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Mini Slogan</td>
						<td><input name="mini_slogan" id="mini_slogan" type="text" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Konten</td>
						<td><input class="editor" name="content" id="content"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Hot Promo</td>
						<td><input name="is_promo" id="is_promo" type="radio" value="true">Ya<br>
							<input name="is_promo" id="is_promo" type="radio" value="false">Tidak</td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Tampilkan di Image Slider</td>
						<td><input name="shown_in_image_slider" id="is_promo" type="radio" value="true">Ya<br>
							<input name="shown_in_image_slider" id="is_promo" type="radio" value="false">Tidak</td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto (ukuran max 1MB)</td>
						<td><input name="image" id="image" type="file" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Harga</td>
						<td><input name="price" id="price" type="text" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Poin Reward</td>
						<td><input name="point_reward" id="point_reward" type="text" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td>Status</td>
						<td><select name="status" id="status">
								<option value=""></option>
								<option value="draft">Draft</option>
								<option value="publish">Publish</option>
							</select>
						</td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Ditampilkan</td>
						<td><input name="enabled" id="enabled" type="radio" value="true">Ya<br>
							<input name="enabled" id="enabled" type="radio" value="false">Tidak</td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto Tambahan 1 (ukuran max 1MB)</td>
						<td><input name="image_1" id="image_1" type="file" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto Tambahan 2 (ukuran max 1MB)</td>
						<td><input name="image_2" id="image_2" type="file" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto Tambahan 3 (ukuran max 1MB)</td>
						<td><input name="image_3" id="image_3" type="file" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto Tambahan 4 (ukuran max 1MB)</td>
						<td><input name="image_4" id="image_4" type="file" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto Tambahan 5 (ukuran max 1MB)</td>
						<td><input name="image_5" id="image_5" type="file" value="" size="60"></td>
					</tr>
				</table>
				<input type="submit" value="Submit">
			</form>		
	</div>
</div>
<script>
	$(".editor").jqte();
	
	$( window ).load(function() {
		simple_load('<?php echo base_url();?>index.php/admin/get_content_categories', '#category', '');
	})
	
	function load_categories(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_content_categories',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row: datajson[i].number_row, id:datajson[i].id, category:datajson[i].category, description: datajson[i].description, removable: datajson[i].removable};
			}
		});
	}
</script>