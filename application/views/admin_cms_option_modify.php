<div id="content"  style="min-height:400px;"> 
	<div class="frametab">
			<h3 style="margin:5px 0 5px 5px;">Ubah Konten</h3>

			<?php echo form_open_multipart('admin/edit_option/'.$this->uri->segment(3));?>
				<table cellpadding="5"  id="table-modify"   cellspacing="0" border="0px" bgcolor="#FFFFFF" class="myTable" >
					<tr class="editTR" >
						<td class="tdTitle">Parameter</td>
						<td><p id="parameter"></p></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Keterangan</td>
						<td><p id="readable"></p></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Teks/Gambar yang Ditampilkan</td>
						<td><div id="value-show"></div></td>
					</tr>
				</table>
				<input type="submit" value="Submit">
			</form>		
	</div>
</div>
<script>
	var selected;
	$( window ).load(function() {
		load_content();
	})
	
	function load_content(){
		var d = new Date(); 
		var image_path = '<?php echo base_url();?>assets/uploads/option_images/';
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_option_by_id/<?php echo $this->uri->segment(3);?>',
			dataType: "json",
			success:function(datajson){
				$('#parameter').text(datajson.parameter);
				$('#readable').text(datajson.readable);
				var param = datajson.parameter;
				if(param.indexOf("logo")>=0){ //generate the div showing the image and the input to change the picture
					$('#value-show').append('<div id="image-show"></div><input name="value" id="value" type="file" value="" size="60">\
							<input type="hidden" name="is_logo" value="yes">');
					$("#image-show").append('<img src="'+image_path+datajson.value+'?ver='+d.getTime()+'" alt="no-picture" width="250px" height="250px" />');
				}
				else {
					$('#value-show').append('<input type="text" name="value" id="value"><input type="hidden" name="is_logo" value="no">');
					$('#value').val(datajson.value);
				}
				//$('#value').val(datajson.value);
				//$("#image-show").append('<img src="'+image_path+datajson.image+'?ver='+d.getTime()+'" alt="no-picture" width="250px" height="250px" />');
			}
		});
	}
</script>