<style>
#wgtmsr{
 width:150px;   
}

#wgtmsr option{
 width:100px;   
}
</style>
<div class="col-sm-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Senarai Jenis Transaksi
							 
									<a href="../web/P002.php"><button class="btn btn-success" style="padding:1px 10px;"><img src="imgs/edit2.png" height="20" border="0" title="Kemaskini senarai"> Senarai PTj</button></a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th style="width:20px;">Bil</th>
                                            <th style="width:200px;">Pusat Tanggungjawab (PTj)</th>
                                            <th style="width:300px;">Jenis Transaksi</th>
                                            <th style="width:10px;">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>

									<tr class='gradeA'>
									<td><i class="fa fa-user w3-text-blue w3-large"></i></td>

									<form method="post" action="../web/controller/jenis_transaksi_add_exec.php">
									<td>
											<div class="form-group" align="left">
											<select required class="form-control" name="jabatan" value="" name="wgtmsr" id="wgtmsr">
											<option value="">--Pilih--</option>
											<?php 
											$data3 = mysqli_query($conn,"SELECT * FROM kod_jabatan") 
											 or die(mysqli_error()); 
											 while($row3 = mysqli_fetch_array( $data3 )) {
												echo "<option value='".$row3['idptj']."'>".$row3['namaptj']."</option>";
											}
											?>
											</select>
											</div>
									</td>


											<td><div class="form-group" align="left">
											<select required class="form-control" name="jenistransaksi" value="">
												<option value="">--Pilih--</option>
												<option value="SBT">Sebut Harga/Tender</option>
												<option value="SYD">Seminar/Yuran/Denda</option>
												<option value="D">Derma</option>
											</select>
											</div></td>											
									<td><a><button type="submit" class="btn btn-primary">Tambah</button></a></td>
									</form>
									</tr>
<?php // Connects to your Database 
$data = mysqli_query($conn,"SELECT * FROM kod_jenistransaksi GROUP BY jabatan");
$i=1;
while($info = mysqli_fetch_array( $data )) {
$jaba = $info['jabatan'];
$ptj  = getNamaPtj($jaba);

echo "<tr class='gradeA'>";
echo "<td>".$i." </td>"; //column satu
//echo "<td>".$jaba."</td>";
/* ?><td><?=$info['jabatan']?></td><? */ //column dua
echo "<td>".$ptj . " </td>"; //column tiga
echo "<td>"; 
//////////////////////////////////////////////////// MULA

$countz = "1";
$qK="SELECT * FROM kod_jenistransaksi";
$resK=mysqli_query($conn,$qK) or die(mysqli_error());
while($fetchK=mysqli_fetch_array($resK)){
if ($jaba==$fetchK['jabatan']){
?><table border="0" class="table-striped" width="100%" style="border-collapse: separate; border-spacing: 2px;"><tr>
<td width="70%"><?
$namajenist = getNamaJenisT($fetchK['jenistransaksi']);
echo "(".$countz.")  ".$namajenist ;
?></td>
<td align="right" width="15%">

<!--<input type="image" src="../web/imgs/edit2.png" height="20" title="Kemaskini" data-toggle="modal" data-target="#myModal<?echo $fetchK['id_jenistransaksi'];?>"> -->
<button class="btn btn-primary" style="padding:1px 10px;" data-toggle="modal" data-target="#myModal<?echo $fetchK['id_jenistransaksi'];?>"><img src="imgs/edit2.png" height="20" border="0" title="Kemaskini">Kemaskini</button>

</td>
<td align="right" width="15%">
<a href="../web/controller/jenis_transaksi_delete_exec.php?id_jenistransaksi=<?echo $fetchK['id_jenistransaksi']; ?>"><button class="btn btn-danger" style="padding:1px 10px;" onclick="return confirm('Anda pasti untuk padam data ini?');"><img src="imgs/del.png" height="20" border="0" title="Hapus Data">Padam</button></a>
</td>
</tr></table>


<!-- srow3 #bug fixed! -->


<?
$countz++; }
}mysqli_free_result($resK);
//////////////////////////////////////////////////// TAMAT
echo "</td>"; //column dua

?>
<td>
<table border="0"><tr>
<td>
<form action="senarai_sa.php" method="POST"><input type="hidden" name="id_jenistransaksi" value="<?=$info['id_jenistransaksi']?>"><input type="hidden" name="jabatan" value="<?=$info['jabatan']?>">
<button class="btn btn-info" style="padding:1px 10px;"><input type="image" src="../web/imgs/keys.png" alt="Submit" height="18" title="Senarai Sub-Admin">Sub-Admin</button>
</form>
</td><td width="10px">&nbsp;</td><td>
<? $idd = $info['id_jenistransaksi']; ?>
<!-- <a href="../extension/html2pdf/cetakQR.php?idd='.$idd.'"><button class="btn btn-info">QR mod</button></a> -->
<form action="../extension/html2pdf/cetakP003.php" method="GET" target="_blank">
<input type='hidden' value='<?=$info['id_jenistransaksi']?>' name='id'>
<button class="btn btn-default" style="padding:1px 10px;"><input type="image" src="../web/imgs/print.gif" alt="Submit" height="18" title="Cetak">Cetak</button>
</form>
</td>
</tr></table>
</td> <? //column lima  ?>

											
										 <?
											echo "</tr>";
										$i++;
										}
										?>

                                    </tbody>
                                </table>
<? //srow3 open
$countz = "1";
$qK="SELECT * FROM kod_jenistransaksi";
$resK=mysqli_query($conn,$qK) or die(mysqli_error());
while($fetchK=mysqli_fetch_array($resK)){ 
//if ($jaba==$fetchK['jabatan']){ ?>
								<!-- Modal Kemaskini-->
											<div class="modal fade" id="myModal<?php echo $fetchK['id_jenistransaksi']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title" align="left" id="myModalLabel">Kemaskini</h4>
												</div>
												
											 <div class="modal-body">
												<form method="post" action="../web/controller/jenis_transaksi_kemaskini_exec.php?id_jenistransaksi=<?php echo $fetchK['id_jenistransaksi'];?>" >
											
											<!-- type hidden -->
											<input class="form-control" type="hidden" id="current_jabatan" name="current_jabatan" value="<?php echo $fetchK['jabatan']; ?>" readonly >
											<input class="form-control" type="hidden" id="id_jenistransaksi" name="id_jenistransaksi" value="<?php echo $fetchK['id_jenistransaksi']; ?>" readonly >
											
											
											<? $namajenist2 = getNamaJenisT($fetchK['jenistransaksi']); ?>
												<div class="form-group" align="left">
												<label>Jenis Transaksi</label>
											<select required class="form-control" name="jenistransaksi" value="">
												<option value="<?php echo $fetchK['jenistransaksi']; ?>"><?php echo $namajenist2; ?></option>
												<option value="SBT">Sebut Harga/Tender</option>
												<option value="SYD">Seminar/Yuran/Denda</option>
												<option value="D">Derma</option>
											</select>
											</div>
<!--								
												<div class="form-group" align="left">
												<label>Jenis Transaksi</label>
												<?php 
												$dataJenistransaksi = mysqli_query($conn,"SELECT DISTINCT(jenistransaksi)AS jenistransaksi FROM kod_jenistransaksi WHERE jenistransaksi != '".$fetchK['jenistransaksi']."'");
											?>
											<select required class="form-control" name="jenistransaksi" value="">
											<option value="<?php echo $fetchK['jenistransaksi']; ?>"><?php echo $fetchK['jenistransaksi']; ?></option>
												
											<?while($infoJenistransaksi = mysqli_fetch_array( $dataJenistransaksi )) {?>
												<option value="<?php echo $infoJenistransaksi['jenistransaksi']; ?>"><?php echo $infoJenistransaksi['jenistransaksi']; ?></option>
												<?}?>
											</select>
														
											</div>
						-->					
										<div class="form-group" align="left">
										<label>Pusat Tanggungjawab (PTj)</label>
										
<select required class="form-control" name="jabatan" value="">
<option value="<?php echo $fetchK['jabatan']; ?>"><?php echo $fetchK['jabatan']; ?></option>

<?php
$data3 = mysqli_query($conn,"SELECT * FROM kod_jabatan") or die(mysqli_error()); 
 while($row3 = mysqli_fetch_array( $data3 )) {
	echo "<option value='".$row3['idptj']."'>".$row3['namaptj']."</option>";
}//mysqli_free_result($row3);
?>
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
											
<? // srow3 close
$countz++; 
}mysqli_free_result($resK); ?>			
											
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
				
				