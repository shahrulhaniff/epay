

<div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Senarai Jenis Transaksi <b><? echo $_SESSION['JABATAN'];?></b>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th width="4%">Bil</th>
                                            <th width="36%">Jenis Transaksi</th>
                                            <th width="30%">Kod-QR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
								
<?php 
 $jabatan2=$_SESSION['JABATAN'];

// Connects to your Database 
 $data = mysqli_query($conn,"SELECT * FROM kod_jenistransaksi WHERE jabatan='$jabatan2'"); 
 //or die(mysqli_error()); ?>
                                        
										<?php
										$i=1;
										while($info = mysqli_fetch_array( $data )) {
											echo "<tr class='gradeA'>";
											echo "<td>".$i." </td>";
                                            echo "<td>".$info['jenistransaksi'] . " </td>";
										?><td>
										<form action="QRLogo.php" method="POST" target="_blank"><input type="hidden" name="id_jenistransaksi" value="<?echo $info['id_jenistransaksi'];?>"><input type="submit" value="Jana Kod QR"></form>
										</td>
										 <?
											echo "</tr>";
										$i++;}
										?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
	