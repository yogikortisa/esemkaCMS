<?php

include('template/template.php');
include('template/index_var.php');

/* variabel-variabel untuk halaman bukutamu */
/*******************************************/
@ $bukutamu = $_GET['bukutamu_id'];
if ($bukutamu == '')
	$bukutamu = 'view';
	
@ $page = $_GET['page'];
if ($page == '')
	$page = 0;
	
// cegah Cross Site Scripting
$bukutamu = filter_str($bukutamu);
$page = filter_str($page);

// tentukan komentar yang ditampilkan per halaman
$komen_per_hal = 3;

// lakukan query lalu tentukan jumlah halaman dengan ceil()
konek_db(); // koneksi ke MySQL Server
$query_hal = mysql_query("SELECT * FROM bukutamu");
$jml_baris = mysql_num_rows($query_hal);
$jml_hal = ceil($jml_baris / $komen_per_hal);

// dapatkan nilai offset
$offset = $page * $komen_per_hal;

switch ($bukutamu)
{
	case 'view':
		// lakukan query untuk mendapatkan data dari bukutamu
		$query = "SELECT * FROM bukutamu ORDER BY id_bt DESC LIMIT $offset, $komen_per_hal";
		$hasil = mysql_query($query);
		mysql_close(); // tutup koneksi
		// tampilkan bukutamu
		$page_bt = '<p><center>Belum mengisi buku tamu? silahkan klik '
				  .'<a style="color:#333; text-decoration: none; font-weight: bold" href="bukutamu.php?bukutamu_id=form">disini</a> untuk mengisi.</center></p>'
				  .'<p><table border="0" cellpadding="4" align="center">';
		while ($data = mysql_fetch_array($hasil))
		{
			$komentar = str_replace("\n", "<br>", $data['komentar']);
			$page_bt .= '<tr bgcolor="#cccccc">'
						 .'<td colspan="2">'
						 .$data['tgl_post'].'</td></tr>'
					   .'<tr><td align="right">Nama: </td>'
					     .'<td>'.$data['nama'].'</td></tr>'
					   .'<tr><td align="right">Email: </td>'
					   	 .'<td><a style="color:#009999; text-decoration: none;" href="mailto:'.$data['email'].'">'
						 .$data['email'].'</a></td></tr>'
					   .'<tr><td valign="top">Komentar: </td>'
					     .'<td colspan="2">'.$komentar.'</td></tr>'
					   .'<tr><td height="10"></td></tr>'; // beri jarak
		}
		$page_bt .= '</table></p>';
		// tampilkan link halaman jika jumlahnya lebih dari 1
		if ($jml_hal > 1)
		{
			$page_bt .= 'Halaman: ';
			for ($i=0; $i<$jml_hal; $i++)
				$page_bt .= ' <a href="bukutamu.php?page='.$i.'">'.intval($i+1)
						   .'</a> ';
		}
	break; // akhir dari proses view
	
	case 'form':
		$page_bt = '<center>Silahkan mengisi form buku tamu berikut. Mohon komentar tidak '
				  .'mengandung unsur SARA!.'
				  .'<form action="bukutamu.php?bukutamu_id=proses_form" method="post">'
				  .'<table border="0" cellpadding="4">'
				  .'<tr bgcolor="#cccccc">'
				    .'<td colspan="2" align="center"><b>Form Buku Tamu</b></td> </tr>'
				  .'<tr><td>Nama: </td>'
				    .'<td><input type="text" name="nama"></td></tr>'
				  .'<tr><td>Email: </td>'
				  	.'<td><input type="text" name="email"></td></tr>'
				  .'<tr><td>Komentar: </td>'
				  	.'<td><textarea name="komentar" rows="8" cols="45"></textarea></td></tr>'
				  .'<tr><td><input type="submit" value="KIRIM"></td></tr>'
				  .'<tr bgcolor="#cccccc" height="30"><td colspan="2"> </td></tr>'
				  .'</table></form>';
	break; // akhir dari proses form
	
	case 'proses_form':
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$komentar = $_POST['komentar'];
		
		$pesan_error = '';
		// cek apakah ada field yang kosong
		if (!cek_field($_POST))
			$pesan_error = 'Error: masih ada field yang kosong<br>';
		// cek kevalidan format email
		if (!cek_email($email))
			$pesan_error .= 'Error: email tidak valid<br>';
		// cek kata-kata kotor, ganti dengan !@#$%
		$kotor = array('fuck', 'bangsat', 'bullshit', 'brengsek', 'ass');
		foreach ($kotor as $kata)
			$komentar = preg_replace('/'.$kata.'/i', '!@#$%', $komentar);
			
		// jika isi $pesan_error tidak kosong maka ada error
		if ($pesan_error != '')
			$page_bt = $pesan_error.$kembali;
		else
		{
			// lakukan query
			konek_db();
			$tgl = date('G:i, d-m-Y'); // format HH:MM, DD-MM-YY
			$query = "INSERT INTO bukutamu (tgl_post, nama, email, komentar) VALUES ('$tgl', '$nama', '$email', '$komentar')";
			$hasil = mysql_query($query);
			if (!$hasil)
				$page_bt = 'Error: gagal memasukkan data ke database.';
			else
			{
				$page_bt = 'Data anda berhasil dimasukkan ke database.'
						  .' <a href="bukutamu.php">Lihat buku tamu</a>.';
			}
		} // akhir dari else pertama
	break; // akhir dari proses proses_form
} // akhir dari switch

$judul = 'Buku Tamu';

	$skin = new skin;
	$skin->ganti_skin('template/smk4_skin.php');
	$skin->ganti_tag('/{JUDUL}/', $judul);
	$skin->ganti_tag('/{MENU}/', $menu);
	$skin->ganti_tag('/{UTAMA}/', $page_bt);
	$skin->ganti_tag('/{NEWS}/', $side_news);
	$skin->ganti_tampilan();
	
?>