<?php
session_start();
include "../server.php";
$pagenow="P003";

if (empty($_SESSION['user'])) {
	header('Location:login.php'); }


?>
<?php include "ui/header.php"; ?>
<?php include "ui/menu.php"; ?>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><a href="P003.php"><i class="fa fa-dashboard"></i>Senarai Pusat Tanggungjawab</a> / <b><i class="fa fa-laptop"></i>Kemaskini Senarai</b></h5>
  </header>

<!-- Modal Add -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" align="left" id="myModalLabel">Tambah Baru</h4>
                    </div>

                <div class="modal-body">

                <form method="post" action="../web/controller/P002_add_exec.php">

							<div class="form-group" align="left">
								<label><font color="red">** Maklumat Wajib Diisi.</font></label>
							</div>
							
							<div class="form-group">
								<label for="comment">Singkatan<font color="red">**</font></label>
								<input type="text" class="form-control" name="singkatan" id="singkatan" size="20" required>
							</div>
							
							<div class="form-group">
								<label for="comment">Nama PTj<font color="red">**</font></label>
								<input type="text" class="form-control" name="namaptj" id="namaptj" size="20" required>
							</div> 
							
							

                             <div class="modal-footer">
                                   <button type="submit" class="btn btn-primary" >Simpan</button>
                                   <button type="reset" class="btn btn-info">Tetapan Semula</button>
                             </div>
         
         </form>
                </div><!--modal-body-->
        
        
        </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
		
		
			  <div class="w3-panel">
			 
				<div class="w3-row-padding" style="margin:0 -16px">
				 
			<div class="col-md-12">
			<div align="right">
							 <button class="btn btn-primary" data-toggle="modal"  data-target="#myModal">Tambah Baru</button> 
							
						
			</div>
								<!-- Advanced Tables -->
								<div class="panel panel-default">
									<div class="panel-heading">
									</div>
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover" id="dataTables-example">
												<thead>
													<tr>
														<th>Bil</th>
														<th>Singkatan</th>
														<th>Nama PTj</th>
														<th>Tindakan</th>
													</tr>
												</thead>
												<tbody>
												
												
			<?php // Connects to your Database 
			 
			$data = mysqli_query($conn,"SELECT * FROM kod_jabatan"); 
			 
		
													$i= 1;
													while($info = mysqli_fetch_array( $data )) {
														echo "<tr class='gradeA'>";
														echo "<td>".$i."</td>";
														echo "<td>".$info['singkatan'] . " </td>";
														echo "<td>".$info['namaptj'] . " </td>";
														?><td>
													  <button class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $i;?>">Kemaskini</button>
													<a href="../web/controller/P002_delete_exec.php?idptj=<?php echo $info['idptj'];?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda pasti untuk padam data ini?');">Padam</button></a>
													 </td>
			<!-- Modal update Sub-Admin -->
			<div class="modal fade" id="myModal<?php echo $i; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			 
							<div class="modal-dialog">
							
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								<h4 class="modal-title" align="left" id="myModalLabel">Kemaskini Maklumat</h4>
								</div>
							
							<div class="modal-body">
							
							<form method="post" action="../web/controller/P002_kemaskini_exec.php"> 
							
										<div class="form-group" align="left">
											<label><font color="red">** Maklumat Wajib Diisi.</font></label>
											<br><input type="hidden" name="idptj" id="idptj" class="form-control" value="<? echo $info['idptj'];?>" readonly />
										</div>
										 
										<div class="form-group">
											<label for="comment">Singkatan</label>
											<input type="text" class="form-control" name="singkatan" id="singkatan" size="20" value="<?php echo $info['singkatan']; ?>">
										</div> 
										
										<div class="form-group">
											<label for="comment">Nama<font color="red">**</font></label>
											<input type="text" class="form-control" name="namaptj" id="namaptj" size="20" value="<?php echo $info['namaptj']; ?>" required>
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
        </div><!-- /.modal -->
														
														
													 <?php
														echo "</tr>";
														
													 $i++;
													 }
													?>
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
								<!--End Advanced Tables -->
							</div>
			  </div>
			  </div>
			  
<?php include "ui/footer.php"; ?>
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="assets/js/bootstrap.js"></script>
    <!-- DATATABLE SCRIPTS  -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      <!-- CUSTOM SCRIPTS  -->
    <script src="assets/js/custom.js"></script>
	
<!-- End page content -->
  <!-- last skali paste preloader js punya sebelum tutup body -->
  <script src="pre/jquery.magnific-popup.min.js"></script>
  <script src="pre/main.js"></script>
</div>
</body>
</html>
