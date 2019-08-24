
<?php  
date_default_timezone_set("Asia/Kuala_lumpur");
	$date = new DateTime();
	$current_date=$date->format('Y-m-d');
    $crt_dt = date_format($date,"D d-F-Y");
	$month = date_format($date,"F Y");
    $bulan = date_format($date,"m");
	$tahun = date_format($date,"Y");
	
	 	 
	$flag=$_GET['flg'];   
		if($flag==''){
			$flag='tb_1';
			}
			
	$dateSelection=$_GET['dt'];   
	if($dateSelection==''){
			$dateSelection='tiada';
			}
	$flagScreen=$_GET['flagScreen'];
		if($flagScreen==''){
			$flagScreen='tab_1';
			}
			
	$status=$_GET['status'];			
		if($status==''){
			$status='NO';
			}		
 
?>

<div class="col-md-12">
				
<div id='cssmenu'>
	<ul>
		<li class="<? echo ($flag=='tb_1'?'active':'') ?>"><a href="P005.php?status=<?echo $status;?>&dt=tiada&flg=tb_1&flagScreen=<?echo $flagScreen;?>">Papar Semua</a></li>
		<? if ($dateSelection=='tiada' || $dateSelection==''){
			
			?>
		<li class="<? echo ($flag=='tb_2'?'active':'') ?>"><a href="P005.php?status=<?echo $status;?>&dt=<? echo $current_date;?>&flg=tb_2&flagScreen=<?echo $flagScreen;?>">Carian Mengikut Tarikh</a></li>
		<? }else {?>
		<li class="<? echo ($flag=='tb_2'?'active':'') ?>"><a href="P005.php?status=<?echo $status;?>&dt=<? echo $dateSelection;?>&flg=tb_2&flagScreen=<?echo $flagScreen;?>">Carian Mengikut Tarikh</a></li>
		<?}?>
		
	</ul>
</div>
<div id='cssmenu'>
	<ul>
	 

		<li class="<? echo ($flagScreen=='tab_1'?'active':'') ?>"><a href="P005.php?status=NO&dt=<? echo $dateSelection;?>&flg=<? echo $flag; ?>&flagScreen=tab_1">Dokumen Belum Dituntut</a></li>
		<li class="<? echo ($flagScreen=='tab_2'?'active':'') ?>"><a href="P005.php?status=YES&dt=<? echo $dateSelection;?>&flg=<? echo $flag; ?>&flagScreen=tab_2">Dokumen Telah Dituntut</a></li>
	
	</ul>
</div>
 
<!-- carian-->
<? if ($dateSelection!='tiada'){?>
<div align="center">
				<h4>Carian**</h4>
				<table>
				<tr><? if ($dateSelection==''){?>
					<td><input class="form-control" required type="date" placeholder="cari" id="dateSelection" name="dateSelection" value="<?echo $current_date?>"></td>
					
				<?}else {?>
					<td><input class="form-control" required type="date" placeholder="cari" id="dateSelection" name="dateSelection" value="<?echo $dateSelection;?>"></td>
				<?}?>
				<td><center> <button onclick="submit_cari()" align="right" class="btn btn-warning">Cari</button></center></td>
				</tr>
				
				</table>
				<h6>** masukkan tarikh carian anda</h6>
</div>
<?}?>





                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
					
                        <div class="panel-heading">
                             Senarai Dokumen
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Nombor Rujukan</th>
											 <th>Pusat Tanggungjawab (PTj)</th>
                                            <th>Penerima</th>
                                            <th>Harga (RM)</th>
											<!--<th>Status</th>-->
											<th>Tarikh & Masa</th>
											<th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
<?php // Connects to your Database 

if($dateSelection=='tiada'){
	$data = mysqli_query($conn,"SELECT * FROM transaksi WHERE id_jenistransaksi='SB' AND status_dokumen='$status'");
}else if($dateSelection!='tiada'){
 $data = mysqli_query($conn,"SELECT * FROM transaksi WHERE id_jenistransaksi='SB' AND DATE_FORMAT(tarikh,'%Y-%m-%d')='$dateSelection' AND status_dokumen='$status'");
} ?>
                                        
										<?php
										$i=1;
										while($info = mysqli_fetch_array( $data )) {
											
$tarikh=$info['tarikh'];
//$tarikhbuka = substr($tarikhbuka,8,10).'/'.substr($tarikhbuka,5,10).'/'.substr($tarikhbuka,0,4);
$tarikh= DateTime::createFromFormat('Y-m-d H:i:s', $tarikh)->format('d/m/Y g:i a');


											echo "<tr class='gradeA'>";
											echo "<td>".$i." </td>";
											echo "<td>".$info['norujukan']." </td>";
											
											$data3 = mysqli_query($conn,"SELECT * FROM kod_jenistransaksi WHERE id_jenistransaksi='".$info['id_jenistransaksi']."'");	
											$info3 = mysqli_fetch_array( $data3 );
                                            echo "<td>".$info3['jabatan'] . " </td>";
											
                                            echo "<td>".$info['doc_acceptby_nama'] . " </td>";
											echo "<td>".$info['jumlah'] . " </td>";
											// echo "<td>".$info['status_dokumen'] . " </td>";
											 echo "<td>".$tarikh . " </td>";
                                            ?>
											<td>
											<button class="btn btn-info" data-toggle="modal" data-target="#myModalInfo<?echo $info['id_transaksi'];?>">Papar</button>
											<button class="btn btn-primary" data-toggle="modal" data-target="#myModal<?echo $info['id_transaksi'];?>">Kemaskini</button>
                                
										 </td>
										 </tr>
			<!-- Modal Papar Maklumat-->
											<div class="modal fade" id="myModalInfo<?echo $info['id_transaksi'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" align="left" id="myModalLabel">Paparan Maklumat</h4>
												</div>
												
											<div class="modal-body">	
												<div class="form-group">
													<label for="comment">Nombor Rujukan</label>
													<span> : <? echo $info['norujukan'];?></span>
												</div> 
																								
												<div class="form-group">
													<label for="comment">Jenis Transaksi</label>
													<?
														$dataJT = mysqli_query($conn,"SELECT jenistransaksi FROM kod_jenistransaksi WHERE id_jenistransaksi='".$info['id_jenistransaksi']."' order by id_jenistransaksi");	
														$infoJT = mysqli_fetch_array( $dataJT );
													?>
													<span> : <? echo $infoJT['jenistransaksi'];?></span>
													
												</div>	
											
												<div class="form-group">
													<label for="comment">Tarikh</label>
													<span> : <? echo $tarikh;?></span>
												</div> 
												
												<div class="form-group">
													<label for="comment">Harga</label>
													<span> : RM <? echo $info['jumlah'];?></span>
													
												</div>
												
												<div class="form-group" align="left">
													<label>Pegawai yang menyerahkan dokumen</label>
													<?
													$data1 = mysqli_query($conn,"SELECT max(nama) AS nama FROM maklumat_pengguna WHERE ic_pengguna='".$info['doc_giveby']."' ORDER BY ic_pengguna");	
													$info1 = mysqli_fetch_array( $data1 );
												?>
												<? if($info1['nama']!=null){ ?>
													<span> : <? echo $info1['nama'];?> (<? echo $info['doc_giveby'];?>)</span>
												<? } else {?><span> : Tiada<? } ?>
												</div>
												
												<div class="form-group" align="left">
													<label>Diambil Oleh</label>
													<? if($info['doc_acceptby_nama']!=null){ ?>
													<span> : <? echo $info['doc_acceptby_nama'];?> (<? echo $info['doc_acceptby'];?>)</span>
													<? } else {?><span> : Belum dituntut<? } ?>
												</div>
												
												<div class="form-group" align="left">
													<label for="comment">Status Transaksi</label>
													<span> : <? echo $info['statustransaction'];?></span>
												</div>
												
												<div class="form-group" align="left">
													<label>Status Dokumen</label>
													<span> : <? echo $info['status_dokumen'];?></span>
												</div>
													
												 <div class="modal-footer">
													  <button type="button" class="btn btn-success" data-dismiss="modal">Kembali</button>
												 </div>
											
							 
											</div><!--modal-body-->
											</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
											
					<!-- Modal Kemaskini-->
											<div class="modal fade" id="myModal<?php echo $info['id_transaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" align="left" id="myModalLabel">Kemaskini</h4>
													<font color="red">***Sila semak dan maklumat dokumen yang diterima dengan sistem ini sebelum kemaskini</font>
												</div>
												
											 <div class="modal-body">
												<form method="post" action="../web/controller/P005_kemaskini_exec.php?id_transaksi=<?php echo $info['id_transaksi'];?>" >
												
												<div class="form-group">
													<label for="comment">Nombor Rujukan</label>
													<span> : <? echo $info['norujukan'];?></span>
												</div> 
												
												<div class="form-group">
													<label for="comment">Jenis Transaksi</label>
													<?
														$dataJenistransaksi = mysqli_query($conn,"SELECT jenistransaksi FROM kod_jenistransaksi WHERE id_jenistransaksi='".$info['id_jenistransaksi']."' order by id_jenistransaksi"); 
														//or die(mysqli_error());	
														$infoJenistransaksi = mysqli_fetch_array( $dataJenistransaksi );
													?>
													<span> : <? echo $infoJenistransaksi['jenistransaksi'];?></span>
												</div>	
												
												<div class="form-group">
													<label for="comment">Tarikh</label>
													<span> : <? echo $tarikh;?></span>
												</div> 
												
												<div class="form-group">
													<label for="comment">Harga</label>
													<span> : RM <? echo $info['jumlah'];?></span>
													
												</div>
													
												<div class="form-group" align="left">
													<label>Daripada</label>
												<?
													$data1 = mysqli_query($conn,"SELECT max(nama) AS nama FROM maklumat_pengguna WHERE ic_pengguna='".$_SESSION['user']."' ORDER BY ic_pengguna");	
													$info1 = mysqli_fetch_array( $data1 );
												?>
												<input type="hidden" class="form-control" id="doc_giveby" name="doc_giveby" value="<?echo $_SESSION['user'];?>" required >
													<span> : <? echo $info1['nama'];?> (<? echo $_SESSION['user'];?>)</span>
												</div>

												<div class="form-group" align="left">
													<label>Nama Penerima</label>
													<input class="form-control" id="doc_acceptby_nama" name="doc_acceptby_nama" value="<?=$info['doc_acceptby_nama']?>" required >
												</div>
												
												<div class="form-group" align="left">
													<label>Nombor Kad pengenalan Penerima</label>
													<input class="form-control" id="doc_acceptby" name="doc_acceptby" value="<? echo $info['doc_acceptby'];?>" required >
												</div>
												<div class="form-group" align="left">
												<label for="comment">Status Dokumen</label>
															<select required class="form-control" name="status_dokumen" value="" style="width: 270px">
															<option value="<? echo $info['status_dokumen'];?>"><? if($info['status_dokumen']=="NO"){ echo "Belum diambil"; } else { echo "Dituntut"; }?></option>	
															<?
																if ($info['status_dokumen']=="YES"){
															?>
															<option value="NO">Belum diambil</option>
															<?
																}if ($info['status_dokumen']=="NO"){
															?>
															<option value="YES">Dituntut</option>
															<?}?>
															</select>
															</div>
											
												<div class="modal-footer">
													<button type="submit" class="btn btn-primary">Kemaskini Maklumat</button></a>
												</div>  
												</form>
											</div><!--modal-body-->
											</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
											</div><!-- /.modal -->
			<!--/tamat modal kemaskini-->
										 <?
										$i++;}
										?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>

	<script>
$(document).ready(function() {
	$('#dataTables-example').DataTable({
		responsive: true
	});
	
	 //$('[data-toggle="popover"]').popover();  
});

 function submit_cari(){
		var dateSelection=$('#dateSelection').val();
		
		
		 var flg = "<? echo $flag; ?>";
		 var flagScreen = "<?echo $flagScreen;?>";
		 var status = "<?php echo $status ?>";
		 if (dateSelection!=''){ 
			// location.href='P005.php?dateSelection='+dateSelection+'&user_id='+user_id+'&groups_id='+groups_id+'&nama_pengawal='+nama_pengawal;
			location.href='P005.php?status='+status+'&dt='+dateSelection+'&flg='+flg+'&flagScreen='+flagScreen;
		 }else{
			 alert("Fill the form1!");
		 }	
	} 

</script>