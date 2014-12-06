<div id="content"  style="min-height:400px;"> 
	<div class="frametab">
			<h3 style="margin:5px 0 5px 5px;">Ubah Konten</h3>
			<?php echo form_open_multipart('admin/edit_post/'.$id);?>
				<!--<input type="hidden" name="post_id" value="<?php echo $id;?>">-->
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
						<td><input name="is_promo" id="is_promo-true" type="radio" value="true">Ya<br>
							<input name="is_promo" id="is_promo-false" type="radio" value="false">Tidak</td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Tampilkan di Image Slider</td>
						<td><input name="shown_in_image_slider" id="shown_in_image_slider-true" type="radio" value="true">Ya<br>
							<input name="shown_in_image_slider" id="shown_in_image_slider-false" type="radio" value="false">Tidak</td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto (max size 1MB, min 620 x 413, max 1140 x 600)</td>
						<td><div id="image-show"></div><input name="image" id="image" type="file" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td>Mata Uang</td>
						<td><select name="currency" id="currency">
								<option value="IDR">Rupiah</option>
								<option value="USD">Dolar</option>
							</select>
						</td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Harga Pembelian</td>
						<td><input name="purchasing_price" id="purchasing_price" type="text" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Harga Penjualan</td>
						<td><input name="price" id="price" type="text" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td>Rating</td>
						<td><select name="star_rating" id="star_rating">
								<option value="">--Pilih rating--</option>
								<?php 
								for($i=5;$i>0;$i--)
									echo '<option value='.$i.'>'.$i.'</option>';
								?>
									
							</select>
						</td>
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
						<td><input name="enabled" id="enabled-true" type="radio" value="true">Ya<br>
							<input name="enabled" id="enabled-false" type="radio" value="false">Tidak</td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto Tambahan 1 (max size 1MB, min 620 x 413, max 1140 x 600)</td>
						<td><div id="image-1-show"></div><input name="image_1" id="image_1" type="file" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto Tambahan 2 (max size 1MB, min 620 x 413, max 1140 x 600)</td>
						<td><div id="image-2-show"></div><input name="image_2" id="image_2" type="file" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto Tambahan 3 (max size 1MB, min 620 x 413, max 1140 x 600)</td>
						<td><div id="image-3-show"></div><input name="image_3" id="image_3" type="file" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto Tambahan 4 (max size 1MB, min 620 x 413, max 1140 x 600)</td>
						<td><div id="image-4-show"></div><input name="image_4" id="image_4" type="file" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Pasang Foto Tambahan 5 (max size 1MB, min 620 x 413, max 1140 x 600)</td>
						<td><div id="image-5-show"></div><input name="image_5" id="image_5" type="file" value="" size="60"></td>
					</tr>
				</table>
				<input type="submit" value="Submit">
			</form>		
	</div>
</div>
<script>
	$(".editor").jqte();
	var selected;
	$( window ).load(function() {
		load_content();
		simple_load('<?php echo base_url();?>index.php/admin/get_content_categories/true', '#category', selected);
	})
	
	function load_content(){
		var data = [];
		var d = new Date(); 
		var image_path = '<?php echo base_url();?>assets/uploads/posts/';
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_content_by_id/<?php echo $id;?>',
			dataType: "json",
			success:function(datajson){
				$('#category').val(datajson.category);
				selected = datajson.category;
				$('#title').val(datajson.title);
				$('#mini_slogan').val(datajson.mini_slogan);
				$(".editor").jqteVal(datajson.content);
				$('#currency').val(datajson.currency);
				$('#purchasing_price').val(datajson.purchasing_price);
				$('#price').val(datajson.price);
				$('#point_reward').val(datajson.point_reward);
				$('#status').val(datajson.status);
				$('#star_rating').val(datajson.star_rating);
				$("#is_promo-"+datajson.is_promo).prop("checked", true);
				$("#shown_in_image_slider-"+datajson.image_slider).prop("checked", true);
				$("#enabled-"+datajson.enabled).prop("checked", true);
				$("#image-show").append('<img src="'+image_path+datajson.image+'?ver='+d.getTime()+'" alt="no-picture" width="250px" height="250px" />');
				$("#image-1-show").append('<img src="'+image_path+datajson.image_1+'?ver='+d.getTime()+'" alt="no-picture" width="250px" height="250px" />');
				if(datajson.image_1!="")
					$("#image-1-show").append('<button type="button" id="btn1">Hapus</button><p id="p-1" style="color:red"></p><input type="hidden" name="image_1_delete" id="image_1_delete" value="">');
				
				$("#image-2-show").append('<img src="'+image_path+datajson.image_2+'?ver='+d.getTime()+'" alt="no-picture" width="250px" height="250px" />');
				if(datajson.image_2!="")
					$("#image-2-show").append('<button type="button" id="btn2">Hapus</button><p id="p-2" style="color:red"></p><input type="hidden" name="image_2_delete" id="image_2_delete" value="">');
				$("#image-3-show").append('<img src="'+image_path+datajson.image_3+'?ver='+d.getTime()+'" alt="no-picture" width="250px" height="250px" />');
				if(datajson.image_3!="")
					$("#image-3-show").append('<button type="button" id="btn3">Hapus</button><p id="p-3" style="color:red"></p><input type="hidden" name="image_3_delete" id="image_3_delete" value="">');
				$("#image-4-show").append('<img src="'+image_path+datajson.image_4+'?ver='+d.getTime()+'" alt="no-picture" width="250px" height="250px" />');
				if(datajson.image_4!="")
					$("#image-4-show").append('<button type="button" id="btn4">Hapus</button><p id="p-4" style="color:red"></p><input type="hidden" name="image_4_delete" id="image_4_delete" value="">');
				$("#image-5-show").append('<img src="'+image_path+datajson.image_5+'?ver='+d.getTime()+'" alt="no-picture" width="250px" height="250px" />');
				if(datajson.image_5!="")
					$("#image-5-show").append('<button type="button" id="btn5">Hapus</button><p id="p-5" style="color:red"></p><input type="hidden" name="image_5_delete" id="image_5_delete" value="">');
				$( "#btn1" ).click(function() {
					$('input#image_1_delete').val('delete');
					$('#p-1').text('*Telah ditandai untuk dihapus');
				});
				$( "#btn2" ).click(function() {
					$('input#image_2_delete').val('delete');
					$('#p-2').text('*Telah ditandai untuk dihapus');
				});
				$( "#btn3" ).click(function() {
					$('input#image_3_delete').val('delete');
					$('#p-3').text('*Telah ditandai untuk dihapus');
				});
				$( "#btn4" ).click(function() {
					$('input#image_4_delete').val('delete');
					$('#p-4').text('*Telah ditandai untuk dihapus');
				});
				$( "#btn5" ).click(function() {
					$('input#image_5_delete').val('delete');
					$('#p-5').text('*Telah ditandai untuk dihapus');
				});
			}
		});
	}
	
	
</script>