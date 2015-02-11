<div id="content"  style="min-height:400px;"> 
	<div class="frametab">
			<h2 style="margin:5px 0 5px 5px;">Tambah Konten</h2>
			<h3>Petunjuk:</h3>
			<h3>Email akan dikirim ke email penerima sesuai yang terdaftar di pesanan.</h3>
			<h3>Gunakan kolom "cc" untuk tujuan tracking email. Gunakan tanda koma sebagai pemisah untuk tujuan cc lebih dari satu.</h3>
			<form method="post" action="<?php echo base_url();?>index.php/admin/send_email_issued">
				<input type="hidden" name="id" value="<?php echo $this->uri->segment(3);?>">
				<input type="hidden" name="page" value="<?php echo $this->uri->segment(4);?>">
				<table cellpadding="5"  id="table-modify"   cellspacing="0" border="0px" bgcolor="#FFFFFF" class="myTable" >
					<tr class="editTR" >
						<td class="tdTitle">Penerima CC:</td>
						<td><input name="cc" id="cc" type="text" value="" size="60"></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Konten</td>
						<td><input class="editor" name="email_content" id="email_content"></td>
					</tr>
				</table>
				<input type="submit" value="Submit">
			</form>		
	</div>
</div>
<script>
	$(".editor").jqte();
</script>