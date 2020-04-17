<?php

//mulai session
session_start();
include('fungsi.php');
konek_db(); // koneksikan ke MySQL Server

@ $proses = $_GET['proses'];
if ($proses == '')
	$proses = 'view';

// cegah cross site scripting
$proses = filter_str($proses);

// cek apakah user sudah login atau belum
if (!cek_session('admin'))
	echo 'Anda belum login. Silahkan <a href="index.php">Login</a> dulu';
else
{
	switch ($proses)
	{
		case 'view':
			$hasil = mysql_query("SELECT * FROM bukutamu ORDER BY id_bt DESC");
			// tampilkan semua bukutamu
			echo '<h3>Daftar Buku Tamu</h3>';
			while ($data = mysql_fetch_array($hasil))
			{
				echo 'Nama: '.$data['nama'].'<br>'
					.'Email: '.$data['email'].'<br>'
					.'Isi: '.$data['komentar'].'<br>'
					.'<a href="bukutamu.php?proses=hapus&id='.$data['id_bt'].'">Hapus</a> '
					.'<hr>';
			}
			echo '<p><a href="index.php">Halaman Utama</a></p>';
		break; // akhir dari proses view
		
		case 'hapus':
			// dapatkan id untuk bukutamu yang akan dihapus
			$id = $_GET['id'];
			// lakukan query DELETE
			$hasil = mysql_query("DELETE FROM bukutamu WHERE id_bt='$id'");
			if (!$hasil)
				echo 'Error: Tidak dapat menghapus data dari database';
			else
				echo 'Data berhasil dihapus. <a href="index.php">Lihat</a>';
		
		break; // akhir dari proses hapus
	} // akhir dari switch
} // akhir dari else

mysql_close(); // tutup koneksi

?>