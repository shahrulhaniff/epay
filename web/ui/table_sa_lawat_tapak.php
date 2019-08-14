
<!-- Modal Add Sub-Admin -->
 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" align="left" id="myModalLabel">Tambah Sub-Admin</h4>
                    </div>
                
                <div class="modal-body">
                
                <form method="post" action="../web/controller/sa_lawat_tapak_tambah.php">     
                         <div class="form-group" align="left">
                            
							<label><font color="red">** Maklumat Wajib Diisi.</font></label>
							<br>
								 
								 <input type="hidden" name="id_kodtransaksi" id="id_kodtransaksi" class="form-control" value="<? echo $id_kodtransaksi;?>" readonly />
							
							 
							<div class="form-group">
								<label for="comment">Nombor Kad Pengenalan<font color="red">**</font></label>
								<input type="text" class="form-control" name="ic_pengguna" id="ic_pengguna" size="20" required>
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
		
		
			  <div class="w3-panel">
			 
				<div class="w3-row-padding" style="margin:0 -16px">
				 
			<div class="col-md-12">
			<? if ($status=='1'){?>
			<div align="right">
							<button class="btn btn-primary" data-toggle="modal"  data-target="#myModal">Tambah Pelawat Tapak</button></a> <br>
			</div>
			<?}?>
								<!-- Advanced Tables -->
								<div class="panel panel-default">
									<div class="panel-heading">
										 Senarai Pelawat Tapak
									</div>
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-striped table-bordered table-hover" id="dataTables-example">
												<thead>
													<tr>
														<th>Bil</th>
														<th>Nombor Berdaftar</th>
														<th>Nama</th>
														<th>Email</th>
														<th>Nombor Telefon</th>
													<? if ($status=='1'){?>
														<th>Tindakan</th>
													<?}?>
													</tr>
												</thead>
												<tbody>
												
												
			<?php // Connects to your Database 
			 $data = mysqli_query($conn,"SELECT sv.ic_pengguna AS ic_site_visit, mp.* 
									FROM site_visit sv, maklumat_pengguna mp
									WHERE sv.ic_pengguna = mp.ic_pengguna AND sv.id_kodtransaksi = '$id_kodtransaksi'") 
			?>
													
													<?php
													$i= 1;
													while($info = mysqli_fetch_array( $data )) {
														echo "<tr class='gradeA'>";
														echo "<td>".$i."</td>";
														echo "<td>".$info['ic_site_visit'] . " </td>";
														echo "<td>".$info['nama'] . " </td>";
														echo "<td>".$info['email'] . " </td>";
														echo "<td>".$info['no_telefon'] . " </td>";
														
													if ($status=='1'){?>
														<td>
															<a href="../web/controller/sa_lawat_tapak_delete.php?ic_pengguna=<?echo $info['ic_site_visit']; ?>"><button type="button" class="btn btn-danger" onclick="return confirm('Anda pasti untuk padam data ini?');">Padam</button></a>
														</td>
													<? } ?>
												
					
													 <?
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
		