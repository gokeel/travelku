<div id="content"  style="min-height:400px;"> 
	<div class="frametab">
			<h2 style="margin:5px 0 5px 5px;">Tambah Berita</h2>
			<?php echo form_open_multipart('admin/add_news_agent');?>
				<table cellpadding="5"  id="table-modify"   cellspacing="0" border="0px" bgcolor="#FFFFFF" class="myTable" >
					<tr class="editTR" >
						<td class="tdTitle">Titel</td>
						<td><input name="news_title" id="title" type="text" value="" size="60" required></td>
					</tr>
					<tr class="editTR" >
						<td class="tdTitle">Konten</td>
						<td><input class="editor" name="news_content" id="content" required></td>
					</tr>
					<tr class="editTR" >
						<td>Status</td>
						<td><select name="status" id="status" required>
								<option value=""></option>
								<option value="draft">Draft</option>
								<option value="publish">Publish</option>
							</select>
						</td>
					</tr>
				</table>
				<input type="submit" value="Submit">
			</form>		
	</div>
</div>
<script>
	$(".editor").jqte();
</script>