<?php

//mulai session
session_start();
include('fungsi.php');
konek_db(); // koneksikan ke MySQL Server

@ $proses = $_GET['proses'];
if ($proses == '')
	$proses = 'view';

// cegah Cross Site Scripting
$proses = filter_str($proses);

// cek user apakah sudah login atau belum
if (!cek_session('admin'))
	echo 'Anda belum login. Silahkan <a href="index.php">Login</a> dulu';
else
{
	switch ($proses)
	{
		case 'view':
			$hasil = mysql_query("SELECT * FROM member ORDER BY nama");
			// tampilkan semua member
			echo '<h2>Daftar Member</h2><hr>'
				.'<table border="1" cellpadding="4" style="border-collapse: collapse">'
				.'<tr bgcolor="#cccccc">'
				 .'<th>Username</th><th>Password</th><th>Nama</th><th>Email</th>'
				 .'<th>Alamat</th><th>Kode Pos</th><th>Kota</th><th>Hapus?</th>'
				.'</tr>';
			while ($data = mysql_fetch_array($hasil))
			{
				$hapus = '<a href="member.php?proses=hapus&username='.$data['username'].'">'
						.'Hapus</a>';
				echo '<tr>';
				// lakukan looping untuk menulis semua field
				for ($i=0; $i<7; $i++)
				{
					echo '<td>'.$data[$i].'</td>';
				}
				echo '<td>'.$hapus.'</td>'
					.'</tr>';
			}
			echo '</table>'
				.'<p><a href="index.php">Halaman Utama</a>';
		break;  // akhir dari proses view
		
		case 'hapus':
			// dapatkan username yang akan dihapus
			$user = $_GET['username'];
			
			// cegah Cross Site Scripting
			$user = filter_str($user);
			
			// hapus dari database
			$hasil = mysql_query("DELETE FROM member WHERE username='$user'");
			if (!$hasil)
				echo 'Error: gagal menghapus dari database. <a href="member.php">Lihat</a>';
			else
				echo 'Data berhasil dihapus dari database. <a href="member.php">Lihat</a>';
			
		break;
	} // akhir dari switch
}// akhir dari else

mysql_close(); // tutup koneksi
?>
		