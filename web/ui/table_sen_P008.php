
<?  
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
?>
<div class="col-md-12">
				
<div id='cssmenu'>
	<ul>
		<li class="<? echo ($flag=='tb_1'?'active':'') ?>"><a href="P008.php?dt=tiada&flg=tb_1">Papar Semua</a></li>
		<? if ($dateSelection=='tiada' || $dateSelection==''){
			
			?>
		<li class="<? echo ($flag=='tb_2'?'active':'') ?>"><a href="P008.php?dt=<? echo $current_date; //21-03-2019?>&flg=tb_2">Carian Mengikut Tarikh</a></li>
		<? }else {?>
		<li class="<? echo ($flag=='tb_2'?'active':'') ?>"><a href="P008.php?dt=<? echo $dateSelection; //21-03-2019?>&flg=tb_2">Carian Mengikut Tarikh</a></li>
		<?}?>
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
                             Senarai Transaksi
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Nombor Rujukan</th>
                                            <th>Penerima</th>
                                            <th>Harga (RM)</th>
											<th>Tarikh & Masa</th>
											<th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
<?php // Connects to your Database 

if($dateSelection=='tiada'){
	$data = mysqli_query($conn,"SELECT * FROM transaksi WHERE id_jenistransaksi='JT20190511183008'"); //DENDA PELAJAR SAHAJA
}else if($dateSelection!='tiada'){
 $data = mysqli_query($conn,"SELECT * FROM transaksi WHERE DATE_FORMAT(tarikh,'%Y-%m-%d')='$dateSelection' AND id_jenistransaksi='JT20190511183008'"); //DENDA PELAJAR SAHAJA
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
											
                                            echo "<td>".$info['doc_acceptby_nama'] . " </td>";
											echo "<td>".$info['jumlah'] . " </td>";
											echo "<td>".$tarikh . " </td>";
                                            ?>
											<td>
											<button style="padding:1px 10px;" class="btn btn-info" data-toggle="modal" data-target="#myModalInfo<?echo $info['id_transaksi'];?>"><img src="imgs/papar.png" WIDTH='16' HEIGHT='16' border="0" title="Papar">Papar</button>

										
									<A HREF='../extension/html2pdf/cetakP006_Resit.php?idt=<?=$info['id_transaksi'];?>' target='_blank' style="padding:1px 10px;" class="btn btn-default"><IMG SRC='imgs/print.gif' WIDTH='16' HEIGHT='16' BORDER='0' ALT='cetak' TITLE='Cetak'>Cetak</A>
									
									
									
										
										<!--<a href="../web/controller/jenis_transaksi_delete_exec.php?id_jenistransaksi=<?echo $info['id_jenistransaksi']; ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda pasti untuk padam data ini?');">Padam</button></a>-->
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
													<label>Daripada</label>
													<?
													$data1 = mysqli_query($conn,"SELECT max(nama) AS nama FROM maklumat_pengguna WHERE ic_pengguna='".$info['doc_giveby']."' ORDER BY ic_pengguna");	
													$info1 = mysqli_fetch_array( $data1 );
												?>
													<span> : <? echo $info1['nama'];?> (<? echo $info['doc_giveby'];?>)</span>
												</div>
												
												<div class="form-group" align="left">
													<label>Diambil Oleh</label>
													<span> : <? echo $info['doc_acceptby_nama'];?> (<? echo $info['doc_acceptby'];?>)</span>
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
		 if (dateSelection!=''){ 
			// location.href='P006.php?dateSelection='+dateSelection+'&user_id='+user_id+'&groups_id='+groups_id+'&nama_pengawal='+nama_pengawal;
			location.href='P006.php?dt='+dateSelection+'&flg='+flg;
		 }else{
			 alert("Fill the form1!");
		 }	
	} 

</script>