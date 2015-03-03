	
			<!-- FILTERS -->
			<div class="col-md-3 filters offset-0">
			
				<!-- TOP TIP -->
				<div class="filtertip"> <!-- putih = filtertip2 ; biru = filtertip-->
					<div class="padding20">
						<!--<p class="size13"><span class="size18 bold counthotel">53</span> Hotels starting at</p>
						<p class="size30 bold">$<span class="countprice"></span></p>
						<p class="size13">Narrow results or <a href="#">view all</a></p>-->
						<p class="size13">Kami menyediakan</p>
						<p class="size30 bold">Tiket & Paket</p>
					</div>
					<!--<div class="tip-arrow"></div>-->
				</div>
				<div class="line2"></div>
					
				<?php if($pesawat_status=='200'){?>
				<button type="button" class="collapsebtn box-biru-miring" data-toggle="collapse" data-target="#promo-pesawat">
				  <span style="color:white">Promo Penerbangan</span> <span class="collapsearrow"></span>
				</button>
				<div id="promo-pesawat" class="collapse in">
					<div class="padding20">
						<div style="width:100%; font-size:12px">
                            <ul>
							<?php for($i=0;$i<sizeof($pesawat);$i++){?>
								<li> <span class="right-irfan color1">IDR <?php echo $pesawat[$i]['price'];?></span> <a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $pesawat[$i]['id'];?>"><?php echo $pesawat[$i]['title'];?></a> </li>
								
							<?php } ?>
							</ul>
                        </div>
					</div>
				</div>
			
				<div class="line2"></div>
				<?php } ?>
				<button type="button" class="collapsebtn box-biru-miring" data-toggle="collapse" data-target="#paket-promo">
				  <span style="color:white">Paket Promo</span> <span class="collapsearrow"></span>
				</button>
				<div id="paket-promo" class="collapse in">
					<div class="padding20">
						<div style="width:100%; font-size:12px">
                            <ul style="list-style-type:none;padding-left:5px">
							<?php for($i=0;$i<sizeof($promo);$i++){?>
								<li style="padding-bottom:45px"> <a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $promo[$i]['id'];?>"><img src="<?php echo base_url();?>/assets/uploads/posts/<?php echo $promo[$i]['image'];?>" width="100%" height="134" /></a>
								<a style="float:left" href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $promo[$i]['id'];?>"><?php echo $promo[$i]['title'];?></a>
								<span style="float:right;color:green"><?php echo $promo[$i]['currency'].' '.$promo[$i]['price'];?></span><br/><br/>
								<span class="grey" style="float:left"><?php echo $promo[$i]['category'];?></span>
								<?php if($promo[$i]['star_rating']<>'') {?>
									<img style="float:right;padding-top:15px" src="<?php echo BLUE_THEME_DIR;?>/images/smallrating-<?php echo $promo[$i]['star_rating'];?>.png" alt="" class="mt-10"/>
								<?php } //end of checking star rating ?>
								</li>
								
							<?php } ?>
							</ul>
                        </div>
						<a href="<?php echo base_url();?>index.php/webfront/show_packages/promo/0/9"><span style="float:right;color:green;font-size:12px"><i>Lainnya...</i></span></a>
					</div>
				</div>
				<div class="line2"></div>
				<button type="button" class="collapsebtn box-biru-miring" data-toggle="collapse" data-target="#paket-regular">
				  <span style="color:white">Paket Reguler</span> <span class="collapsearrow"></span>
				</button>
				<div id="paket-regular" class="collapse in">
					<div class="padding20">
						<div style="width:100%; font-size:12px">
                            <ul style="list-style-type:none;padding-left:5px">
							<?php for($i=0;$i<sizeof($regular);$i++){?>
								<li style="padding-bottom:45px"> <a href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $regular[$i]['id'];?>"><img src="<?php echo base_url();?>/assets/uploads/posts/<?php echo $regular[$i]['image'];?>" width="100%" height="134" /></a>
								<a style="float:left" href="<?php echo base_url();?>index.php/webfront/show_package_content/<?php echo $regular[$i]['id'];?>"><?php echo $regular[$i]['title'];?></a>
								<span style="float:right;color:green"><?php echo $regular[$i]['currency'].' '.$regular[$i]['price'];?></span><br/><br/>
								<span class="grey" style="float:left"><?php echo $regular[$i]['category'];?></span>
								<?php if($regular[$i]['star_rating']<>'') {?>
									<img style="float:right;padding-top:15px" src="<?php echo BLUE_THEME_DIR;?>/images/smallrating-<?php echo $regular[$i]['star_rating'];?>.png" alt="" class="mt-10"/>
								<?php } //end of checking star rating ?>
								</li>
								
							<?php } ?>
							</ul>
                        </div>
						<a href="<?php echo base_url();?>index.php/webfront/show_regular_packages/0/9"><span style="float:right;color:green;font-size:12px"><i>Lainnya...</i></span></a>
					</div>
				</div>
				<div class="line2"></div>
				
				<div class="clearfix"></div>
				<br/>
				<br/>
				<br/>
				
				
			</div>
			<!-- END OF FILTERS -->
			