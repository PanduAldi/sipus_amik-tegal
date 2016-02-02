<?php  
	error_reporting(E_ALL^E_NOTICE);
	include "utiliti/koneksi.php";

	if (isset($_POST['cari'])) {
		
		?>
													<!-- katalog buku -->
													<div class="panel panel-primary">
														<div class="panel-heading"><h4><i class="fa fa-book"></i> <b>Hasil Pencarian Katalog</b></h4></div>
													</div>
													
													<div class="panel panel-primary">
														<div class="panel-body">
															<table class="table table-bordered table-striped" id="tabel_data">
																<thead>
																	<tr><th>Cover</th><th>Deskripsi</th></tr>
																</thead>
																<tbody>
																	<?php 
																	    $fields = array('judul', 'kd_penerbit', 'kd_pengarang', 'isbn', 'kd_kategori');
																	    $conditions = array();

																	    // loop through the defined fields
																	    foreach($fields as $field){
																	        // if the field is set and not empty
																	        if(isset($_POST[$field]) && $_POST[$field] != '') {
																	            // create a new condition while escaping the value inputed by the user (SQL Injection)
																	            $conditions[] = "t_buku.$field LIKE '%" . mysql_real_escape_string($_POST[$field]) . "%'";
																	        }
																	    }

																	    // builds the query
																	    $query = "SELECT * FROM t_buku JOIN t_penerbit ON t_buku.kd_penerbit = t_penerbit.kd_penerbit JOIN t_pengarang ON t_buku.kd_pengarang = t_pengarang.kd_pengarang ";
																	    // if there are conditions defined
																	    if(count($conditions) > 0) {
																	        // append the conditions
																	        $query .= "WHERE " . implode (' AND ', $conditions); // you can change to 'OR', but I suggest to apply the filters cumulative
																	    }

																	    $query_buku = mysql_query($query);
																		
																		$cek = mysql_num_rows($query_buku);
																		if ($cek >0) {
																			# code...
																		
																		while ($data_buku = mysql_fetch_array($query_buku)) {
																			?>
																			<tr>
																				<td>
																					<?php  
																						if (empty($data_buku['cover'])) {
																						   echo '<img src="sipusadmin/image/buku/Logo.png" class="img-thumbnail" width="150" height="130"  alt="">';
																						} else {
																							echo '<img src="sipusadmin/image/buku/'.$data_buku['cover'].'" class="img-thumbnail" width="150" height="130"  alt="">';
																						}
																					?>
																				</td>
																				<td>
																					Kode Buku : <?php echo $data_buku['kd_buku'] ?> <br>
																					Judul Buku : <?php echo $data_buku['judul'] ?> <br>
																					Pengarang  : <?php echo $data_buku['penerbit'] ?><br>
																					Penerbit   : <?php echo $data_buku['pengarang'] ?><br>
																					<br>
																					<a title="Klik Untuk Melihat Detail" onclick="pop_up('page/det_buku.php?id=<?php echo $data_buku[0] ?>','','800','450','yes')">Detail Selengkapnya</a> 
																					<?php  
																						if (!$_SESSION['nim']) {
																							echo "";
																						} else {
																							if ($data_buku['status'] == "sudah dibooking" || $data_buku['status'] == "sedang dipinjam") {
																								echo ' | Sudah dibooking';
																							} else {
																								?>
																								| <a title="Klik Untuk Melihat Detail" onclick="pop_up('page/proses_booking.php?id=<?php echo $data_buku[0] ?>','','800','450','yes')">Booking buku</a>
																								<?php
																							}																						
																						}
																					?>
																				</td>
																			</tr>
																			<?php
																		}
																	} else {
																		echo "<h2> Empty Result </h2>";
																	}
																	?>														
																</tbody>
															</table>

														</div>
													</div>

		<?php
	}
?>	