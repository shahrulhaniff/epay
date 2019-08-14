	<div class="panel panel-default">
        <div class="panel-heading"><i class="fas fa-edit"></i> Ubah Kata Laluan</div>
            <div class="panel-body">
				<form action="../web/controller/sa_change_password_process.php" method="POST">
						<table align="center" width="500px" cellspacing="10px">
							<tr>
								<td width="150px">Kata Laluan Semasa :</td>
								<td width="350px"><input type="password" name="password_lama" size="40" class="form-control" placeholder="Masukkan Kata Laluan Semasa" required></td> 
							</tr>
							<tr>
								<td width="150px">Kata Laluan Baru :</td>
								<td width="350px"><input type="password" name="password_baru"  minlength="6" class="form-control" placeholder="Masukkan Kata Laluan Baru" required></td>
							</tr>
							<tr>
								<td width="150px">Sah Kata Laluan Baru :</td>
								<td width="350px"><input type="password" name="reenter_password_baru"  minlength="6" class="form-control" placeholder="Masukkan Semula Kata Laluan Baru" required></td>
							</tr>
							<tr>
							<td colspan="2"><br>
								<input type="submit" class="btn btn-success" name="submit" value="Simpan">&nbsp;
								<input type="reset" class="btn btn-primary" name="reset" value="Batal">
							</td>
							</tr>
						</table>
				</form>
			</div>
     </div>