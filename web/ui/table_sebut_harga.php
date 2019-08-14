<?
$kodcetak = "P004";
date_default_timezone_set("Asia/Kuala_lumpur");
	$date = new DateTime();
	$current_date=$date->format('Y-m-d');
    $crt_dt = date_format($date,"D d-F-Y");
	$month = date_format($date,"F Y");
    $bulan = date_format($date,"m");
	$tahun = date_format($date,"Y");
	
	$status=$_GET['status'];			
		if($status==''){
			$status='aktif';
			}		
			
	$flag=$_GET['flg'];   
		if($flag==''){
			$flag='tb_1';
			}
	
	$flagScreen=$_GET['flagScreen'];
		if($flagScreen==''){
			$flagScreen='tab_1';
			}
			
				
?>
						
<div class="col-md-12">
<? include ('global/menu_jenis_bayaran_carian.php'); ?>
<? include ('global/menu_jenis_bayaran_status.php'); ?>

			
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Senarai Jenis Bayaran
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th width="5%">Bil.</th>
											<th width="15%">Nombor Rujukan</th>
											<th width="30%">Keterangan</th>
											<th width="15%">Tarikh Buka</th>
											<th width="15%">Tarikh Tutup</th>
											<th width="10%">Harga (RM)</th>
											<th width="10%">Tindakan</th>
										</tr>
                                    </thead>
                                    <tbody>
									<?php
									
					
				
							if($status=='aktif'){
								$data = mysqli_query($conn,"SELECT * FROM kod_transaksi WHERE DATE_FORMAT(tarikhtutup,'%Y-%m-%d')>='$current_date' ORDER BY tarikhbuka ASC");
							}else if($status=='tak_aktif'){
								$data = mysqli_query($conn,"SELECT * FROM kod_transaksi WHERE DATE_FORMAT(tarikhtutup,'%Y-%m-%d')<='$current_date' ORDER BY tarikhtutup ASC");
							}
			
						
						$i=1;
						$idka = array();
						while($row = mysqli_fetch_array( $data )) {
							
							
$tarikhbuka=$row['tarikhbuka'];
$tarikhtutup=$row['tarikhtutup'];
$tarikh_keyin=$row['tarikh_keyin'];
//$tarikhbuka = substr($tarikhbuka,8,10).'/'.substr($tarikhbuka,5,10).'/'.substr($tarikhbuka,0,4);

$tarikhbuka= DateTime::createFromFormat('Y-m-d', $tarikhbuka)->format('d/m/Y');
$tarikhtutup= DateTime::createFromFormat('Y-m-d', $tarikhtutup)->format('d/m/Y');
$tarikh_keyin= DateTime::createFromFormat('Y-m-d H:i:s', $tarikh_keyin)->format('d/m/Y g:i a');
							echo "<tr class='gradeA'>";
							
							$idk = $row['id_kodtransaksi'];
							array_push($idka,$idk);
							//echo $idka[$loop];
							//print_r($idka);
							//echo '<td>'. $i . '</td>';
							?><td>
							<table><tr><td width="40px"><input id="<?=$idk?>" value="<?=$idk?>"  name="invite[]" type="checkbox" class="chk"></td><td width="40px"><?=$i;?>.</td></tr></table>
							</td>
							<?
							
							echo '<td>'. $row['no_sb'] . '</td>';
							echo '<td>'. $row['description'] . '</td>';
							echo '<td>'. $tarikhbuka . '</td>';
							echo '<td>'. $tarikhtutup . '</td>';
							echo '<td>'. $row['harga'] . '</td>';
						    echo '<td>';
                            ?>
							<table><tr><td>
							<button class="btn btn-info" style="padding:1px 10px;" data-toggle="modal" data-target="#myModal<?echo $row['id_kodtransaksi'];?>"><img src="imgs/papar.png" height="20" border="0" title="Papar">Papar</button></td><td>
							<button class="btn btn-primary" style="padding:1px 10px;" data-toggle="modal" data-target="#myModal1<?echo $row['id_kodtransaksi'];?>"><img src="imgs/edit2.png" height="20" border="0" title="Kemaskini">Kemaskini</button></td></tr></table>
							<?
                                echo '</td>';
						
					
					?>
                                        <!-- Modal Kemaskini-->
											<div class="modal fade" id="myModal1<?echo $row['id_kodtransaksi'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" align="left" id="myModalLabel">Kemaskini</h4>
												</div>
												
											 <div class="modal-body">
												<form method="post" action="../web/controller/sebut_harga_kemaskini_exec.php">     
											 <div class="form-group" align="left">
												
												<!--<label><font color="red">** Maklumat Wajib Diisi.</font></label>
												<br>-->
													 
													 <input type="hidden" name="id_kodtransaksi" id="id_kodtransaksi" class="form-control" value="<?echo $row['id_kodtransaksi'];?>" readonly />
													 <input type="hidden" name="status" id="status" class="form-control" value="<?echo $status;?>" readonly />
												
												 <div class="form-group" align="left">
												<label for="comment">Kod Pengguna</label>
															<select required class="form-control" name="kod_pengguna" value="" style="width: 270px">
															
															<? $kod_pengguna1=$row['kod_pengguna'];
															$data_pengguna = mysqli_query($conn,"SELECT * FROM kod_jenispengguna WHERE kod_pengguna='$kod_pengguna1'");
															while ($row_pengguna = mysqli_fetch_assoc( $data_pengguna )){ ?>
															
															<option value="<? echo $row_pengguna['kod_pengguna'];?>"><? echo $row_pengguna['kod_pengguna'];?> ( <? echo $row_pengguna['jenis_pengguna'];?> - <? echo $row_pengguna['jabatan'];?> )</option>
															
															<? }
															$datas = mysqli_query($conn,"SELECT * FROM kod_jenispengguna WHERE kod_pengguna!='$kod_pengguna1' AND kod_pengguna!='1' AND kod_pengguna!='2'");
															while ($rows = mysqli_fetch_assoc( $datas )){ ?>
																<option value="<? echo $rows['kod_pengguna'];?>"><? echo $rows['kod_pengguna'];?> ( <? echo $rows['jenis_pengguna'];?> - <? echo $rows['jabatan'];?> )</option>
															<?}?>
															</select>
												</div>
															
												<div class="form-group">
													<label for="comment">Nombor Rujukan</label>
													<input type="text" class="form-control" name="no_sb" id="no_sb" size="20" value="<? echo $row['no_sb'];?>">
												</div> 
												
												<div class="form-group">
													<label for="comment">Keterangan</label>
													<textarea class="form-control" rows="5" name="description" id="description"><? echo $row['description'];?></textarea>
												</div>
												
												<div class="form-group" align="left">
													<label>Tarikh Buka</label><br>
													<input name="tarikhbuka" type="date" class="form-control" value="<? echo $row['tarikhbuka'];?>" required/>
												</div>
												
												<div class="form-group" align="left">
													<label>Tarikh Tutup</label><br>
													<input name="tarikhtutup" type="date" class="form-control" value="<? echo $row['tarikhtutup'];?>" required/>
												</div>
											
												<div class="form-group" align="left">
													<label>Jam</label><br>
													<input name="jam" type="time" class="form-control" value="<? echo $row['jam'];?>" required/>
												</div>
												
												<div class="form-group">
													<label for="comment">Harga (RM)</label>
													<input type="number" class="form-control" step="0.01" name="harga" id="harga" size="20" value="<? echo $row['harga'];?>">
												</div> 
												
												<div class="form-group" align="left">
												<label for="comment">Jenis Transaksi</label>
															<select required class="form-control" name="id_jenistransaksi" value="" style="width: 270px">
															
															<? $id_jenistransaksi1=$row['id_jenistransaksi'];
															$data_jenistransaksi = mysqli_query($conn,"SELECT * FROM kod_jenistransaksi WHERE id_jenistransaksi='$id_jenistransaksi1'");
															while ($row_jenistransaksi = mysqli_fetch_assoc( $data_jenistransaksi )){ ?>
															
															<option value="<? echo $row_jenistransaksi['id_jenistransaksi'];?>"><? echo $row_jenistransaksi['jenistransaksi'];?> - <? echo $row_jenistransaksi['jabatan'];?></option>
															<? }
															$data1 = mysqli_query($conn,"SELECT * FROM kod_jenistransaksi WHERE id_jenistransaksi!='$id_jenistransaksi1'");
															while ($row1 = mysqli_fetch_assoc( $data1 )){ ?>
																<option value="<? echo $row1['id_jenistransaksi'];?>"><? echo $row1['jenistransaksi'];?> - <? echo $row1['jabatan'];?></option>
															<?}?>
															
															</select>
															</div>
															
												<div class="form-group">
													<label for="comment">Kelas</label>
													<input type="text" class="form-control" name="kelas" id="kelas" size="20" value="<? echo $row['kelas'];?>">
												</div>		
															
												<div class="form-group">
													<label for="comment">Dikemaskini Oleh</label>
													<? $ic_pengguna=$_SESSION['user'];
													$data2 = mysqli_query($conn,"SELECT * FROM maklumat_pengguna WHERE ic_pengguna = '$ic_pengguna'");
													$row2 = mysqli_fetch_array( $data2 );
													?>
													<input type="text" class="form-control" name="edit_by" id="edit_by" size="20" value="<? echo $row2['nama'];?>" readonly>
												</div>		
													
												 <div class="modal-footer">
													   <button type="submit" class="btn btn-primary" >Simpan</button>
													   <button type="reset" class="btn btn-info">Tetapan Semula</button>
												 </div>
												 </div>
							 
											</form>
											</div><!--modal-body-->
											</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
											
		
								<!-- Modal Papar Maklumat-->
											<div class="modal fade" id="myModal<?echo $row['id_kodtransaksi'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" align="left" id="myModalLabel">Paparan Maklumat</h4>
												</div>
												
											 <div class="modal-body">
												<div class="form-group">
													<label for="comment">Nombor Rujukan</label>
													<span> : <? echo $row['no_sb'];?></span>
												</div> 
												
												<div class="form-group">
													<label for="comment">Keterangan</label>
													<span> : <? echo $row['description'];?></span>
													
												</div>
												
												<div class="form-group" align="left">
													<label>Tarikh Buka</label>
													<span> : <? echo $tarikhbuka;?></span>
												</div>
												
												<div class="form-group" align="left">
													<label>Tarikh Tutup</label>
													<span> : <? echo $tarikhtutup;?></span>
												</div>
												
												<div class="form-group" align="left">
													<label>Jam</label>
													<span> : <? echo $row['jam'];?></span>
												</div>
												
												<div class="form-group">
													<label for="comment">Harga</label>
													<span> : RM <? echo $row['harga'];?></span>
												</div> 
												
												<div class="form-group" align="left">
													<label for="comment">Jenis Transaksi</label>
													<span> : <? echo $row['id_jenistransaksi'];?></span>
												</div>
															
												<div class="form-group">
													<label for="comment">Kelas</label>
													<span> : <? echo $row['kelas'];?></span>
												</div>		
															
												<div class="form-group">
													<label for="comment">Diisi Oleh</label>
													<span> : <? echo $row['keyin_by'];?></span>
												</div>		
														
												<div class="form-group" align="left">
													<label>Diisi Pada</label>
													<span> : <? echo $tarikh_keyin;?></span>
												</div>
												
												 <div class="modal-footer">
													  <button type="button" class="btn btn-success" data-dismiss="modal">Kembali</button>
												 </div>


											</div><!--modal-body-->
											</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
										
								
									<?$i++;}?>
                                    </tbody>
                                </table>
								
									
									<button target="_blank" class="btn btn-default" type="button" id="getValue"><img src="imgs/print.gif" width="18" height="18" border="0" alt=""> CETAK</button>
									Pilih Semua<input type="checkbox" name="select-all" id="select-all"/>
									
								
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
		