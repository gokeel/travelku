<style type="text/css">
.yui3-panel {
    outline: none;
}
.yui3-panel-content .yui3-widget-hd {
    font-weight: bold;
}
.yui3-panel-content .yui3-widget-bd {
    padding: 15px;
}
.yui3-panel-content label {
    margin-right: 30px;
}
.yui3-panel-content fieldset {
    border: none;
    padding: 0;
}
.yui3-panel-content input[type="text"] {
    border: none;
    border: 1px solid #ccc;
    padding: 3px 7px;
    -webkit-border-radius: 2px;
    -moz-border-radius: 2px;
    border-radius: 2px;
    font-size: 100%;
    width: 200px;
}

#addRow {
    margin-top: 10px;
}

</style>
<div id="content"  style="min-height:400px;"> 
	<div class="frametab">
		<h3 style="margin:5px 0 5px 5px;">Daftar Semua Komentar</h3>
		<div id="list"></div>
	</div>
	<div id="end"></div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_reviews();
	})
	
	function prompt_approve()
	{
		var answer = confirm("Approve komentar ini?")
		if (answer){
			document.messages.submit();
		}
			
		return false;  
	}
	function load_reviews(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_content_reviews',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {number_row: datajson[i].number_row, id:datajson[i].id, content_title:datajson[i].content_title, score: datajson[i].score, name: datajson[i].name, title: datajson[i].title, content: datajson[i].content, approved: datajson[i].approved, submit_date: datajson[i].submit_date};
			}
		});
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_user = data;
			var table = new Y.DataTable({
				columns: [
					{key:"number_row", label:"No.", width:"60px"},
					//{key:"id", label:"ID"},
					{key:"content_title", label:"Nama Paket"},
					{key:"name", label:"Reviewer"},
					{key:"title", label:"Judul Review"},
					{key:"content", label:"Isi Review"},
					{key:"score", label:"Skor"},
					{label:"Status Approve?",
						nodeFormatter:function(o){
							if(o.data.approved=="true")
								o.cell.set('text', 'Ya');
							else
								o.cell.set('text', 'Tidak');
						}
					},
					{key:"submit_date", label:"Tanggal Review"},
					{
						label:"Approve",
						nodeFormatter:function (o) {
							if (o.data.approved=="false")
								o.cell.setHTML('<a href="<?php echo base_url();?>index.php/admin/approve_review/'+o.data.id+'" onclick="return prompt_approve();"><img src="<?php echo IMAGES_DIR;?>/check.ico"/ class="crud-btn"></a>');
							return false;
						}
					},
					{
						key:"id", 
						label: "Hapus",
						formatter:'<a href="<?php echo base_url();?>index.php/admin/delete_review/{value}" onclick="return prompt_delete_item();"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>',
						allowHTML: true
					}
				],
				data: data_user,
				caption: "Diurutkan dari yang terbaru",
				rowsPerPage: 50
			});
			table.render("#list");
		});
	}
</script>