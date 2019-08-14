<div class="panel panel-default">
        <div class="panel-heading"><i class="fas fa-lock"></i> Lupa Kata Laluan</div>
            <div class="panel-body">
				<form action="../web/controller/send_email.php" method="POST">
						<table align="center" width="500px" cellspacing="10px">
							<tr>
								<td width="150px">IC No. :</td>
								<td width="350px"><input name="icNo" size="40" class="form-control" placeholder="Masukkan No. IC" required></td> 
							</tr>
							<tr>
								<td width="150px">Email :</td>
								<td width="350px"><input name="emel" size="40" class="form-control" placeholder="Masukkan Email" required></td> 
							</tr>
							<tr>
							<td colspan="2"><br>
								<input type="submit" class="btn btn-success" name="submit" value="Hantar Email">
								<a class="btn btn-danger" href="../web/login.php">Batal</a>
							</td>
							</tr>
						</table>
				</form>
			</div>
     </div>