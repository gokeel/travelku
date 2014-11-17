<?php
	$id = $this->uri->segment(3);
?>
<div id="content"  style="min-height:400px;"> 
  <!--content--> 
	
	<div class="frametab">
		<h3 style="margin:5px 0 5px 5px;">Ubah Data Distribusi Email</h3>
		<h2 id="id"></h2>
		<h2 id="category"></h2>
		<p>Petunjuk: </p>
		<ul>
			<li>Isi daftar penerima dengan alamat email yang valid</li>
			<li>Pisahkan dengan tanda koma untuk mengisi lebih dari 1 penerima</li>
			<li>Alamat email pengirim harap diisi hanya dengan 1 alamat email</li>
		</ul>
		<form class="myform" id="edit_form" method="post" action="<?php echo base_url().'index.php/admin/email_dist_edit/'.$id;?>">
			
			<table cellpadding="5"  id="table-modify"   cellspacing="0" border="0px" bgcolor="#FFFFFF" class="myTable" >
				<tr class="editTR" >
					<td class="tdTitle">Daftar Penerima To</td>
					<td><input type="text" name="to" id="to" placeholder=""></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Daftar Penerima Cc</td>
					<td><input type="text" name="cc" id="cc" placeholder=""></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Daftar Penerima Bcc</td>
					<td><input type="text" name="bcc" id="bcc" placeholder=""></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Email Pengirim</td>
					<td><input type="text" name="email_sender" id="email_sender" placeholder=""></td>
				</tr>
				<tr class="editTR" >
					<td class="tdTitle">Nama Pengirim</td>
					<td><input type="text" name="sender_name" id="sender_name" placeholder=""></td>
				</tr>
			</table>
			<div id="status"></div>
			<div class="formFooter">
				<input class="mybutton" style="float:left" name="dbproses" type="button" value="Cancel" onclick="document.location.href='<?php echo base_url();?>index.php/admin/setting_email_dist';" />
				<input class="mybutton" id="edit_data" type="submit" value="Ubah Data" />
			</div>
		</form>
	</div> 

</div>

<script>
	function load_data(){
		$.ajax({
			type : "GET",
			url: '<?php echo base_url();?>index.php/admin/get_email_dist_by_id/<?php echo $id;?>',
			async: false,
			dataType: "json",
			success:function(data){
				$('#id').html('ID: '+data.id);
				$('#category').html('Kategori: '+data.category);
				$('#to').val(data.to);
				$('#cc').val(data.cc);
				$('#bcc').val(data.bcc);
				$('#email_sender').val(data.email_sender);
				$('#sender_name').val(data.sender_name);
			}
		})
	}
	
	$( window ).load(function() {
	 load_data();	
	});
</script>