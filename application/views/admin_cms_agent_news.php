<script type="text/javascript">
YUI().use('tabview', function(Y) {
    var tabview = new Y.TabView({srcNode:'#tabs'});
    tabview.render();
});
</script>
<div id="content"  style="min-height:400px;"> 
	<div class="frametab">
		<input type="button" onclick="document.location='<?php echo base_url('index.php/admin/agent_news_add');?>'" value="Tambah Berita" name="add" style="margin:10px; float:right;">
		<h3 style="margin:5px 0 5px 5px;">List Berita Agen</h3>
		<div id="data-news-agents"></div>
	</div>
	<div id="end"></div>
  <!--&content--> 
</div>
<script>
	$( window ).load(function() {
		load_agent_news();
	})
	
	function load_agent_news(){
		var data = [];
		$.ajax({
			type : "GET",
			async: false,
			url: '<?php echo base_url();?>index.php/admin/get_news_agents',
			dataType: "json",
			success:function(datajson){
				for(var i=0; i<datajson.length;i++)
					data[i] = {id:parseInt(datajson[i].id), content:datajson[i].content, title: datajson[i].title, status: datajson[i].status, creation_date: datajson[i].creation_date, publish_date: datajson[i].publish_date};
			}
		});
		var column_paket ;
		column_paket = [
			{key:"title", label:"Judul"},
			{key:"content", label:"Konten"},
			{key:"status", label:"Status"},
			{key:"creation_date", label:"Tgl Dibuat"},
			{key:"publish_date", label:"Tgl Publish"},
			{
				key:"id", 
				label: "Ubah",
				formatter:'<a href="<?php echo base_url();?>index.php/admin/agent_news_modify/{value}"><img src="<?php echo IMAGES_DIR;?>/edit.ico"/ class="crud-btn"></a>&nbsp;&nbsp;&nbsp;&nbsp;',
				allowHTML: true
			},
			{
				key:"id",
				label:"Hapus",
				formatter:'<a href="<?php echo base_url();?>index.php/admin/agent_news_delete/{value}" onclick="return prompt_delete_item();" ><img src="<?php echo IMAGES_DIR;?>/delete.ico"/ class="crud-btn"></a>',
				allowHTML: true
			}
		]
		
		
		YUI({gallery: 'gallery-2013.01.09-23-24'}).use('datatable','datatable-sort','datatype-number','datatype-date','datatable-paginator', function (Y) {
			/*------------------------------------*/
			var data_user = data;
			var table = new Y.DataTable({
				columns: column_paket,
				data: data_user,
				caption: "",
				rowsPerPage: 50
			});
			table.render("#data-news-agents");
		});
	}
	
</script>