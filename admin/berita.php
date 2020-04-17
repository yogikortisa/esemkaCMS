<?php

// mulai session
session_start();
include('fungsi.php');
konek_db(); // koneksikan ke MySQL Server

// ambil data dari URL
@ $proses = $_GET['proses'];
if ($proses == '')
	$proses = 'view';
	
// cegah Cross Site Scripting
$proses = filter_str($proses);

// cek apakah user sudah login atau belum
if (!cek_session('admin'))
	echo 'Anda belum login. Silahkan <a href="index.php">Login</a> dulu';
else
{
	switch ($proses)
	{
		case 'view':
			echo '<h1>Daftar Berita</h1><hr>';
			$hasil = mysql_query("SELECT * FROM news ORDER BY id_berita DESC");
			while ($data = mysql_fetch_array($hasil))
			{
				echo $data['jdl_berita'].' [ Tanggal: '.$data['tgl_berita'].' ] '
				.' [ <a href="berita.php?proses=edit&berita='.$data['id_berita'].'">EDIT'
				.'</a> ]'
				.' [ <a href="berita.php?proses=hapus&berita='.$data['id_berita'].'">HAPUS'
				.'</a> ]<br><br>';
			}
			echo '<a href="index.php">Halaman Utama</a> <a href="'
				.'berita.php?proses=tambah">Tambah Berita</a>';
		
		break; // akhir dari proses view
		
		case 'edit':
			// dapatkan id berita yang diedit
			$id = $_GET['berita'];
			// cegah Cross Site Scripting
			$id = filter_str($id);
			
			$hasil = mysql_query("SELECT * FROM news WHERE id_berita='$id'");
			$data = mysql_fetch_array($hasil);
			// tampilkan form edit
			echo '<h2>Edit Berita</h2><hr>'
				.'<form action="berita.php?proses=proses_edit" method="post">'
				.'Judul: <br>'
				.'<input type="text" name="judul" size="50" value="'.$data['jdl_berita'].'"><br><br>'
				.'Isi berita: <br>'
				.'<textarea name="isi" cols="70" rows="10">'
					.$data['isi_berita'].'</textarea><br><br>'
				.'Tanggal Berita: <br>'
				.'<input type="text" name="tgl" value="'.$data['tgl_berita'].'"><br><br>'
				.'<input type="hidden" name="id" value="'.$data['id_berita'].'">'
				.'<input type="submit" value="EDIT BERITA"><br>'
				.'</form>'
				.'<p><a href="index.php">Halaman Utama</a> <a href="berita.php">Tampilkan Berita</a></p>';
				
		break; // akhir dari proses edit
				
		case 'proses_edit':
			$id = $_POST['id'];
			$judul = $_POST['judul'];
			$isi = $_POST['isi'];
			$tgl = $_POST['tgl'];
			
			// lakukan update
			$query = "UPDATE news SET jdl_berita='$judul', isi_berita='$isi', 
					tgl_berita='$tgl' WHERE id_berita='$id'";
			$hasil = mysql_query($query);
			if (!$hasil)
				echo 'Error: Gagal mengupdate database';
			else
				echo 'Berita berhasil diupdate. <a href="berita.php">Tampilkan Berita</a>';
		
		break; // akhir dari proses edit
		
		case 'tambah':
			echo '<h2>Tambah Berita</h2><hr>'
				.'<form action="berita.php?proses=proses_tambah" method="post">'
				.'Judul: <br><input type="text" name="judul" size"50"><br><br>'
				.'Isi Berita: <br><textarea name="isi" cols="70" rows="10"></textarea><br><br>'
				.'Tanggal Berita: <br>'
				.'<input type="text" name="tgl"> Format DD-MM-YYYY <br><br>'
				.'<input type="submit" value="TAMBAH BERITA">'
				.'</form>'
				.'<p><a href="index.php">Halaman Utama</a> <a href="berita.php">Tampilkan Berita</a></p>';
				
		break; // akhir dari proses tambah
		
		case 'proses_tambah':
			$judul = $_POST['judul'];
			$isi = $_POST['isi'];
			$tgl = $_POST['tgl'];
			
			// cek semua field apa sudah terisi
			if (!cek_field($_POST))
				exit('Error: masih ada field yang kosong');
			
			// masukkan data ke database
			$query = "INSERT INTO news (jdl_berita, isi_berita, tgl_berita) VALUES ('$judul', '$isi', '$tgl')";
			$hasil = mysql_query($query);
			if (!$hasil)
				echo 'Error: Tidak dapat memasukkan berita ke database.';
			else
				echo 'Berita berhasil ditambah ke database. <a href="berita.php">Lihat</a>';
		
		break; // akhir dari proses proses_tambah
		
		case 'hapus':
			// dapatkan id dari berita yang akan dihapus
			$id = $_GET['berita'];
			// cegah dari Cross Site Scripting
			$id = filter_str($id);
			
			// lakukan query
			$hasil = mysql_query("DELETE FROM news WHERE id_berita='$id'");
			if (!$hasil)
				echo 'Error: Gagal menghapus berita.';
			else
				echo 'Berita berhasil dihapus. <a href="berita.php">Lihat</a>';
		
		break; // akhir dari proses hapus
	} // akhir dari switch
} // akhir dari else

mysql_close(); // tutup koneksi

?>
				