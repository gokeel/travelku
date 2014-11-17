			<div id="content">
			<!-- KONTEN MULAI -->
				<div id="kolom1-second-faq">
					<div id="kontenkolom1">
					<!-- KOLOM 1 mulai --> 
						<div id="faqkonten">
						</div>
					</div>
				<!-- KONTEN end -->
				</div>
			</div>
<script>
	$( window ).load(function() {
		<?php
			$get = $this->input->get(NULL,TRUE);
			$input = '';
			foreach($get as $key => $value)
				$input .= $key.'='.$value.'&';
			echo 'var input="'.rtrim($input,'&').'";';
			
			echo 'detail_hotel(input);';
		?>
	});
	
	function detail_hotel(params){
			//cindy nordiansyah
			
			$('#faqkonten').empty();
						
			
			$.ajax({
				type : "GET",
				url: '<?php echo base_url();?>index.php/hotel/tiketcom_show_hotel_rooms/<?php echo $this->uri->segment(3);?>',
				data: params,
				cache: false,
				dataType: "json",
				success:function(data){
						if(data==''){
							$('#faqkonten').append('<p>Maaf, data tidak ada untuk pencarian ini.<p>');
						}
						else{
							//$('#faqkonten').append('<p>Berhasil Hore hore.<p>');
							//$('#faqkonten').append('<p>Harga mulai dari IDR '+currency_separator(data.items[0].search_queries.minprice, '.')+' - IDR '+currency_separator(data.items[0].search_queries.maxprice, '.')+'</p>');
							$('#faqkonten').append('<span class="judul20">'+data.items[0].breadcrumb.business_name+' '+data.items[0].breadcrumb.area_name+' '+data.items[0].breadcrumb.province_name+'<br /><br> <?php echo $this->input->get('startdate',TRUE);?> - <?php echo $this->input->get('enddate',TRUE);?> Kamar:<?php echo $this->input->get('room',TRUE);?> Malam:<?php echo $this->input->get('night',TRUE);?> Dewasa:<?php echo $this->input->get('adult',TRUE);?> Anak:<?php echo $this->input->get('child',TRUE);?></span><br /><br>');
							if(data.items[0].diagnostic.status=="200"){
								var div = $("#faqkonten");
								var table = document.createElement('table');
								table.setAttribute('id', 'search-result');
								var tbody = document.createElement('tbody');
								for(var i=0; i<data.items[0].results.result.length;i++){
									var tr_body = document.createElement('tr');
									
									var td1 = document.createElement('td');
									var img = document.createElement('img');
									var path = data.items[0].results.result[i].photo_url;
									img.src = path.replace(/\\/g, '')
									img.setAttribute('width', '120px');
									img.setAttribute('height', '100px');
									td1.appendChild(img);
									var p1 = document.createElement('p');
									p1.appendChild(document.createTextNode(data.items[0].results.result[i].room_name));
									td1.appendChild(p1);
									var p2 = document.createElement('p');
									if (data.items[0].results.result[i].with_breakfasts == 1) {
										p2.appendChild(document.createTextNode('termasuk sarapan'));
									} else {
										p2.appendChild(document.createTextNode('tidak termasuk sarapan'));
									}
									td1.appendChild(p2);
																		
									var td2 = document.createElement('td');
									td2.setAttribute('width', '250px');
									var p3 = document.createElement('p');
									p3.appendChild(document.createTextNode('Harga: IDR '+currency_separator(data.items[0].results.result[i].price, '.')));
									td2.appendChild(p3);
									var p4 = document.createElement('p');
									p4.appendChild(document.createTextNode('Kamar Tersedia: '+data.items[0].results.result[i].room_available));
									td2.appendChild(p4);
									var p5 = document.createElement('p');
									p5.appendChild(document.createTextNode('Fasilitas: '+data.items[0].results.result[i].room_facility));
									td2.appendChild(p5);
									
									tr_body.appendChild(td1);
									tr_body.appendChild(td2);
									
									var el_td = document.createElement('td');
									var link_order = document.createElement('a');
									var str = document.createTextNode('Pesan');
									link_order.appendChild(str);
									
									//https://api.master18.tiket.com/order/add/hotel?startdate=2012-06-11&enddate=2012-06-12&night=1&room=1&adult=2&child=0&minstar=0&maxstar=5&minprice=0&maxprice=1000&hotelname=0&room_id=666&hasPromo=0&token=1c78d7bc29690cd96dfce9e0350cfc51&output=json
									var book_uri = data.items[0].results.result[i].bookUri;
									var book_uri_split = book_uri.split("?");
																		
									//link_order.setAttribute('href', '<?php echo base_url();?>index.php/hotel/tiketcom_add_order_hotel?'+book_uri_split[1]);
									link_order.setAttribute('href', '<?php echo base_url();?>index.php/webfront/form_passengers/hotel?'+book_uri_split[1]+'&token='+data.items[0].token);

									link_order.setAttribute('class', 'tombol-pesan');
									el_td.appendChild(link_order);
									tr_body.appendChild(el_td);
									
									table.appendChild(tr_body);
									
								}
								
								
								div.append(table);
							}
							else {
							$('#faqkonten').append('<p style="color:red">'+data.items[0].diagnostic.error_msgs+'</p>'); 
							}
						}
					}
			})
	
			
			
			
	}
	
	$(document).ready(function() {

		/* This is basic - uses default settings */
		$('.fancybox').fancybox();
	});
</script>	