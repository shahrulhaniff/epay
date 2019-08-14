<?
unset($_SESSION['id']);

/*ejas dekat cetakP004.php xperlu buat mcm ni dah*/
//$jab=getJabatan($_SESSION['user']); if($jab=="JPP"){ $kodcetak = "P004"; } else { $kodcetak = "P004v2";  } echo $kodcetak;
$kodcetak = "P004";


date_default_timezone_set("Asia/Kuala_lumpur");
	$date = new DateTime();
	$current_date=$date->format('Y-m-d');
    $crt_dt = date_format($date,"D d-F-Y");
	$month = date_format($date,"F Y");
    $bulan = date_format($date,"m");
	$tahun = date_format($date,"Y");
	
	
$KOD_PENGGUNA = $_SESSION['KOD_PENGGUNA'] ;

$status=$_GET['status'];			
		if($status==''){
			$status='1';
			// status 1 = aktif  
			// status 0 = tidak aktif
			}		
			
	$flag=$_GET['flg'];   
		if($flag==''){
			$flag='tb_1';
			}

 $sql1="SELECT kod_pengguna FROM akaun_pengguna
		WHERE ic_pengguna='".$_SESSION['user']."' AND kod_pengguna!='1'";
$result1=mysqli_query($conn,$sql1);
$kod_pengguna=mysqli_fetch_object($result1)->kod_pengguna; 
			
?>
							<!-- Modal Add Jenis Bayaran -->
					 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog">
									
									<div class="modal-content">
										<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" align="left" id="myModalLabel">Tambah Jenis Bayaran</h4>
										</div>
									
									<div class="modal-body">
									
									<form method="post" action="../web/controller/sa_sebut_harga_tambah_exec.php">     
											 <div class="form-group" align="left">
												
												<!-- <label><font color="red">** Maklumat Wajib Diisi.</font></label>
												<br>-->
													 
													<!-- <input type="hidden" name="id_kodtransaksi" id="id_kodtransaksi" class="form-control" value="<? echo $id;?>" readonly />-->
												
												
												<div class="form-group">
													<label for="comment">Kod Pengguna</label>
<? 
															$data = mysqli_query($conn,"SELECT * FROM kod_jenispengguna WHERE kod_pengguna='$kod_pengguna'");
															$rowKodPengguna = mysqli_fetch_assoc( $data );?>												
												
													<input type="hidden" class="form-control" name="kod_pengguna" id="kod_pengguna" size="20" value="<?=$kod_pengguna;?>" readonly>
														
												
													<span> : <?=$kod_pengguna;?> ( <? echo $rowKodPengguna['jenis_pengguna'];?> - <? echo $rowKodPengguna['jabatan'];?> )</span>
													
												</div>												
												
												<div class="form-group">
													<label for="comment">Nombor Rujukan</label>
													<input type="text" class="form-control" name="no_sb" id="no_sb" size="20">
												</div> 
												
												<div class="form-group">
													<label for="comment">Keterangan</label>
													<textarea class="form-control" rows="5" name="description" id="description"></textarea>
												</div>
												
												<div class="form-group" align="left">
													<label>Tarikh Buka</label><br>
													<input name="tarikhbuka" type="date" class="form-control" required/>
												</div>
												
												<div class="form-group" align="left">
													<label>Tarikh Tutup</label><br>
													<input name="tarikhtutup" type="date" class="form-control" required/>
												</div>
												
												<div class="form-group" align="left">
													<label>Jam</label><br>
													<input name="jam" type="time" class="form-control" required/>
												</div>
											
												<div class="form-group">
													<label for="comment">Harga (RM)</label>
													<input type="Number" class="form-control" name="harga" step="0.01" id="harga" size="20">
												</div> 
												
												<div class="form-group" align="left">
												<label for="comment">Jenis Transaksi</label>
															<select required class="form-control" name="id_jenistransaksi" value="" style="width: 270px">
														<?
															$jabatan2=$rowKodPengguna['jabatan'];														
															$data1 = mysqli_query($conn,"SELECT * FROM kod_jenistransaksi WHERE jabatan='$jabatan2'");
															while ($row1 = mysqli_fetch_assoc( $data1 )){ ?>
																<option value="<? echo $row1['id_jenistransaksi'];?>"><? echo $row1['jenistransaksi'];?> - <? echo $row1['jabatan'];?></option>
															<?}?>
															
															</select>
															</div>
															
												<div class="form-group">
													<label for="comment">Kelas</label>
													<input type="text" class="form-control" name="kelas" id="kelas" size="20">
												</div>		
												
												<!-- 3 = JPP -->
												<? if($KOD_PENGGUNA=="3"){  ?>
												<div class="form-group">
													<label for="comment">Status Sulit</label><br>
													<input type="radio" name="sulit" value="Y"> Ya<br>
													<input type="radio" name="sulit" value="T" checked> Tidak<br>
												</div>
												<? } else { ?><input type="hidden" name="sulit" value="T"><? }
												?>
															
												<div class="form-group">
													<label for="comment">Diisi Oleh</label>
													<? $ic_pengguna=$_SESSION['user'];
													$data2 = mysqli_query($conn,"SELECT * FROM maklumat_pengguna WHERE ic_pengguna = '$ic_pengguna'");// or die(mysqli_error());
													$row2 = mysqli_fetch_array( $data2 );
													?>
													<input type="text" class="form-control" name="keyin_by" id="keyin_by" size="20" value="<? echo $row2['nama'];?>" readonly>
													<!--<span> : <? echo $row2['nama'];?></span>-->
												</div>		
												
												 <div class="modal-footer">
													   <button type="submit" class="btn btn-primary" >Simpan</button>
													   <button type="reset" class="btn btn-info">Tetapan Semula</button>
												 </div>
							 
							 </form>
									</div><!--modal-body-->
							
									</div>
							<!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
							</div>
							</div><!-- /.modal -->
						
<!---------------------------------------------------------------------------------------->							
<div class="col-md-12">
	<div align="right">
							<button class="btn btn-primary" data-toggle="modal"  data-target="#myModal">Tambah Jenis Bayaran</button></a> <br>
			</div>
			
<!-- ---- -->
				
<div id='cssmenu'>
	<ul>
		<li class="<? echo ($flag=='tb_1'?'active':'') ?>"><a href="SA_P004.php?status=1&flg=tb_1">Aktif</a></li>
		<li class="<? echo ($flag=='tb_2'?'active':'') ?>"><a href="SA_P004.php?status=0&flg=tb_2">Tidak Aktif</a></li>
		
	</ul>
</div>
<!----------->

			
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
											<th>Bil.</th>
											<th>Nombor Rujukan</th>
											<th>Keterangan</th>
											<th>Tarikh Buka</th>
											<th>Tarikh Tutup</th>
											<th>Harga (RM)</th>
											<th>Tindakan</th>
										</tr>
                                    </thead>
                                    <tbody>
									<?php
									
			if($status=='1'){
						$data = mysqli_query($conn,"SELECT * FROM kod_transaksi WHERE kod_pengguna='$kod_pengguna' AND DATE_FORMAT(tarikhtutup,'%Y-%m-%d')>='$current_date' ORDER BY tarikhbuka ASC");
			}else if($status=='0'){
						$data = mysqli_query($conn,"SELECT * FROM kod_transaksi WHERE kod_pengguna='$kod_pengguna' AND DATE_FORMAT(tarikhtutup,'%Y-%m-%d')<='$current_date' ORDER BY tarikhtutup ASC");
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

	//					$tarikhbuka=$row['tarikhbuka']->format('d-m-Y');

							echo "<tr class='gradeA'>";
							$idk = $row['id_kodtransaksi'];
							array_push($idka,$idk);
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
							<button class="btn btn-primary" style="padding:1px 10px;" data-toggle="modal" data-target="#myModal1<?echo $row['id_kodtransaksi'];?>"><img src="imgs/edit2.png" height="20" border="0" title="Kemaskini">Kemaskini</button></td>
							<td>
								<a href="../web/controller/sa_sebut_harga_delete_exec.php?id=<? echo $row['id_kodtransaksi']; ?>&id_jenistransaksi=<?echo $row['id_jenistransaksi'];?>&desc=<?echo $row['description'];?>&tarikhbuka=<?echo $row['tarikhbuka'];?>&tarikhtutup=<?echo $row['tarikhtutup'];?>&harga=<?echo $row['harga'];?>&delete_by=<? echo $row2['nama'];?>&status=<? echo $status;?>"><button class="btn btn-danger" type="button" style="padding:1px 10px;" onclick="return confirm('Adakah anda pasti untuk padam rekod ini?');"><img src="imgs/del.png" height="20" border="0" title="Padam">Padam</button></a>
								
								</td></tr></table>
								
								<?if($row['sulit']=='Y'){
									?>
								<form action="sa_lawat_tapak.php?status=<?=$status?>" method="POST"><input type="hidden" name="id_kodtransaksi" value="<?=$row['id_kodtransaksi']?>"><!--<input type="hidden" name="jabatan" value="<?=$row['jabatan']?>">--><input type="submit" class="btn btn-warning" value="Lawatan Tapak"></form>
								<?}
                               
                                echo '</td>';
						echo "</tr>";
					
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
												<form method="post" action="../web/controller/sa_sebut_harga_kemaskini_exec.php">     
											 <div class="form-group" align="left">
												
											<!--	<label><font color="red">** Maklumat Wajib Diisi.</font></label>
												<br>-->
													 <!--hidden-->
													<input type="hidden" name="id_kodtransaksi" id="id_kodtransaksi" class="form-control" value="<?echo $row['id_kodtransaksi'];?>" readonly />
													<input type="hidden" class="form-control" name="keyin_by" id="keyin_by" size="20" value="<? echo $row['keyin_by'];?>" readonly>
													<input type="hidden" name="status" id="status" class="form-control" value="<?echo $status;?>">
												
												
												 <div class="form-group" align="left">
												<label for="comment">Kod Pengguna</label>
														<input type="hidden" class="form-control" name="kod_pengguna" id="kod_pengguna" size="20" value="<?=$kod_pengguna;?>" readonly>
														
												
													<span> : <?=$kod_pengguna;?> ( <? echo $rowKodPengguna['jenis_pengguna'];?> - <? echo $rowKodPengguna['jabatan'];?> )</span>
												
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
													<input type="Number" class="form-control" step="0.01" name="harga" id="harga" size="20" value="<? echo $row['harga'];?>">
												</div> 
												
												<div class="form-group" align="left">
												<label for="comment">Jenis Transaksi</label>
															<select required class="form-control" name="id_jenistransaksi" value="" style="width: 270px">
															
															<? $id_jenistransaksi1=$row['id_jenistransaksi'];
																$jabatan2=$rowKodPengguna['jabatan'];	
															$data_jenistransaksi = mysqli_query($conn,"SELECT * FROM kod_jenistransaksi WHERE id_jenistransaksi='$id_jenistransaksi1' AND jabatan='$jabatan2'");// or die(mysqli_error());
															while ($row_jenistransaksi = mysqli_fetch_assoc( $data_jenistransaksi )){ ?>
															
															<option value="<? echo $row_jenistransaksi['id_jenistransaksi'];?>"><? echo $row_jenistransaksi['jenistransaksi'];?> - <? echo $row_jenistransaksi['jabatan'];?></option>
															<? }
															$data1 = mysqli_query($conn,"SELECT * FROM kod_jenistransaksi WHERE id_jenistransaksi!='$id_jenistransaksi1' AND jabatan='$jabatan2'");// or die(mysqli_error());
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
													<span> : <?=$tarikhbuka?></span>
												</div>
												
												<div class="form-group" align="left">
													<label>Tarikh Tutup</label>
													<span> : <?=$tarikhtutup?></span>
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
													<span> : <?=$tarikh_keyin?></span>
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
											
										