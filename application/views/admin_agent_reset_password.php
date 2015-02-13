<div id="content"  style="min-height:400px;"> 
  <div class="frametab">
		<h3 style="margin:5px 0 5px 5px;">Reset Password Agen</h3>
		<form name="form-reset" id="form-reset">
			<table style="float:left">
				<tr>
					<td>Masukkan Username</td>
					<td><input type="text" name="username" id="username" style="margin-top:20px" /></td>
				</tr>
				<tr>
					<td>Masukkan Password Baru</td>
					<td><input type="password" name="password" id="password" style="margin-top:20px" /></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="button" value="Reset" id="reset" name="reset" style="margin:10px;"></td>
				</tr>
			</table>
		</form>
	</div>
	<div id="end"></div>
  <!--&content--> 
</div>
<script>
	$('#reset').click(function() {
		$.ajax({
			type : "POST",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/reset_password_for_agent',
			data: $('#form-reset').serialize(),
			dataType: "json",
			success:function(data){
				if(data.response==false)
					alert('User tidak ditemukan');
				else{
					alert('Password berhasil di-reset, dan email telah dikirimkan.');
					$('#username').val('');
					$('#password').val('');
				}
					
			}
		});
	});
</script>