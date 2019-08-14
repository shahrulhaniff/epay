<?
	date_default_timezone_set("Asia/Kuala_lumpur");
	$date = new DateTime();
?>

<div class="col-md-12">

                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
					
                        <div class="panel-heading">
                             Trek Jenis Bayaran
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Bil</th>
                                            <th>Jabatan</th>
											 <th>Keterangan</th>
                                            <th>Tarikh Buka</th>
                                            <th>Tarikh Tutup</th>
											<th>Harga (RM)</th>
											<th>Tindakan</th>
											<th>Pegawai</th>
											<th>Tarikh Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
<?php // Connects to your Database 
							$data = mysqli_query($conn,"SELECT * FROM tracking ORDER BY created_date DESC");
										$i=1;
										while($info = mysqli_fetch_array( $data )) {
$tarikhbuka=$info['tarikhbuka'];
$tarikhtutup=$info['tarikhtutup'];
$created_date=$info['created_date'];
//$tarikhbuka = substr($tarikhbuka,8,10).'/'.substr($tarikhbuka,5,10).'/'.substr($tarikhbuka,0,4);

$tarikhbuka= DateTime::createFromFormat('Y-m-d', $tarikhbuka)->format('d/m/Y');
$tarikhtutup= DateTime::createFromFormat('Y-m-d', $tarikhtutup)->format('d/m/Y');
$created_date= DateTime::createFromFormat('Y-m-d H:i:s', $created_date)->format('d/m/Y g:i a');

											
											echo "<tr class='gradeA'>";
											echo "<td>".$i." </td>";
											echo "<td>".$info['jabatan']." </td>";
											
											// $data3 = mysqli_query($conn,"SELECT * FROM kod_jenistransaksi WHERE id_jenistransaksi='".$info['id_jenistransaksi']."'");	
											// $info3 = mysqli_fetch_array( $data3 );
                                            // echo "<td>".$info3['jabatan'] . " </td>";
											
                                            echo "<td>".$info['description'] . " </td>";
											echo "<td>".$tarikhbuka . " </td>";
											echo "<td>".$tarikhtutup . " </td>";
											echo "<td>".$info['harga'] . " </td>";
											echo "<td>".$info['tindakan'] . " </td>";
											echo "<td>".$info['edit_by'] . " </td>";
											echo "<td>".$created_date . " </td>";
                                            ?>
											
										 </tr>
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

</script>