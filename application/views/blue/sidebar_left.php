	
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
					<div class="tip-arrow"></div>
				</div>
				<div class="line2"></div>
				<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#tiketing">
				  Tiket <span class="collapsearrow"></span>
				</button>
				<div id="tiketing" class="collapse in">
					<div class="bookfilters hpadding20">
						
							<div class="w100percent">
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
									<!--<span class="hotel-ico"></span>--> Hotel
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
									Pesawat
								  </label>
								</div>
								<div class="radio">
								  <label>
									<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
									Kereta
								  </label>
								</div>
							</div>
							
							<div class="clearfix"></div><br/>
							
							<!-- HOTELS TAB -->
							<div class="hotelstab2 none">
								<span class="opensans size13">Kota/Nama Hotel</span>
								<input type="text" class="form-control" placeholder="denpasar">
								
								<div class="clearfix pbottom15"></div>
								
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Check in</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker" placeholder="yyyy-mm-dd"/>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13">Check out</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker2" placeholder="yyyy-mm-dd"/>
									</div>
								</div>
								
								<div class="clearfix pbottom15"></div>
								
								<div class="room1" >
									<div class="w50percent">
										<div class="wh90percent textleft right">
												<div class="w50percent">
													<div class="wh90percent textleft left">
														<span class="opensans size13"><b>Kamar</b></span>
														<select class="form-control mySelectBoxClass">
														  <option selected>1</option>
														  <option>2</option>
														  <option>3</option>
														  <option>4</option>
														  <option>5</option>
														</select>
													</div>
												</div>							
												<div class="w50percentlast">
													<div class="wh90percent textleft right">
													<span class="opensans size13"><b>Malam</b></span>
														<select class="form-control mySelectBoxClass">
														  <option>0</option>
														  <option selected>1</option>
														  <option>2</option>
														  <option>3</option>
														  <option>4</option>
														  <option>5</option>
														</select>
													</div>
												</div>
											</div>
									</div>

									<div class="w50percentlast">	
										<div class="wh90percent textleft right ohidden">
											<div class="w50percent">
												<div class="wh90percent textleft left">
													<span class="opensans size13">Dewasa</span>
													<select class="form-control mySelectBoxClass">
													  <option selected>1</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													</select>
												</div>
											</div>							
											<div class="w50percentlast">
												<div class="wh90percent textleft right ohidden">
												<span class="opensans size13">Anak</span>
													<select class="form-control mySelectBoxClass">
													  <option selected>0</option>
													  <option>1</option>
													  <option>2</option>
													  <option>3</option>
													  <option>4</option>
													  <option>5</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>		

								<div class="clearfix"></div>
								<button type="submit" class="btn-search3">Search</button>
							</div>
							<!-- END OF HOTELS TAB -->
							
							<!-- FLIGHTS TAB -->
							<div class="flightstab2 none">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Dari</span>
										<select name="dari" id="flight-from" class="form-control"></select>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13">Ke</span>
										<select name="ke" id="flight-to" class="form-control"></select>
									</div>
								</div>
								
								
								<div class="clearfix pbottom15"></div>
								
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Berangkat</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker3" placeholder="yyyy-mm-dd"/>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13">Kembali</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker4" placeholder="yyyy-mm-dd"/>
									</div>
								</div>
								
								<div class="clearfix pbottom15"></div>
								
								<div class="room1" >
									<div class="w40percent">
										<div class="wh90percent textleft">
											<span class="opensans size13">Dewasa</span>
											<select class="form-control mySelectBoxClass">
											  <option>1</option>
											  <option selected>2</option>
											  <option>3</option>
											  <option>4</option>
											  <option>5</option>
											</select>
										</div>
									</div>

									<div class="w60percentlast">	
										<div class="wh90percent textleft right">
												<div class="w50percent">
													<div class="wh90percent textleft left">
														<span class="opensans size13"><b>Anak</b></span>
														<select class="form-control mySelectBoxClass">
														  <option selected>1</option>
														  <option>2</option>
														  <option>3</option>
														  <option>4</option>
														  <option>5</option>
														  <option>6</option>
														</select>
													</div>
												</div>							
												<div class="w50percentlast">
													<div class="wh90percent textleft right">
													<span class="opensans size13"><b>Bayi</b></span>
														<select class="form-control mySelectBoxClass">
														  <option>0</option>
														  <option selected>1</option>
														  <option>2</option>
														  <option>3</option>
														  <option>4</option>
														  <option>5</option>
														  <option>6</option>
														</select>
													</div>
												</div>
											</div>
									</div>
								</div><div class="clearfix"></div>
								<button type="submit" class="btn-search3">Search</button>
							</div>
							<!-- END OF FLIGHTS TAB -->
							
							<!-- TRAINS TAB -->
							<div class="vacationstab2 none">
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Dari</span>
										<select name="dari" id="train-from" class="form-control"></select>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13">Ke</span>
										<select name="ke" id="train-to" class="form-control"></select>
									</div>
								</div>
								
								
								<div class="clearfix pbottom15"></div>
								
								<div class="w50percent">
									<div class="wh90percent textleft">
										<span class="opensans size13">Berangkat</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker5" placeholder="yyyy-mm-dd"/>
									</div>
								</div>

								<div class="w50percentlast">
									<div class="wh90percent textleft right">
										<span class="opensans size13">Kembali</span>
										<input type="text" class="form-control mySelectCalendar" id="datepicker6" placeholder="yyyy-mm-dd"/>
									</div>
								</div>
								
								<div class="clearfix pbottom15"></div>
								
								<div class="room1" >
									<div class="w40percent">
										<div class="wh90percent textleft">
											<span class="opensans size13">Dewasa</span>
											<select class="form-control mySelectBoxClass">
											  <option>1</option>
											  <option selected>2</option>
											  <option>3</option>
											  <option>4</option>
											  <option>5</option>
											</select>
										</div>
									</div>

									<div class="w60percentlast">	
										<div class="wh90percent textleft right">
												<div class="w50percent">
													<div class="wh90percent textleft left">
														<span class="opensans size13"><b>Anak</b></span>
														<select class="form-control mySelectBoxClass">
														  <option selected>1</option>
														  <option>2</option>
														  <option>3</option>
														  <option>4</option>
														  <option>5</option>
														  <option>6</option>
														</select>
													</div>
												</div>							
												<div class="w50percentlast">
													<div class="wh90percent textleft right">
													<span class="opensans size13"><b>Bayi</b></span>
														<select class="form-control mySelectBoxClass">
														  <option>0</option>
														  <option selected>1</option>
														  <option>2</option>
														  <option>3</option>
														  <option>4</option>
														  <option>5</option>
														  <option>6</option>
														</select>
													</div>
												</div>
											</div>
									</div>
								</div><div class="clearfix"></div>
								<button type="submit" class="btn-search3">Search</button>
							</div>
							<!-- END OF TRAINS TAB -->
							
					</div>
				</div>
				
				<div class="line2"></div>
				<!-- END OF BOOK FILTERS -->	
				<?php if($pesawat_status=='200'){?>
				<button type="button" class="collapsebtn" data-toggle="collapse" data-target="#promo-pesawat">
				  Promo Penerbangan <span class="collapsearrow"></span>
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
				
				<div class="clearfix"></div>
				<br/>
				<br/>
				<br/>
				
				
			</div>
			<!-- END OF FILTERS -->
			