<?php

include('template/template.php');
include('template/index_var.php');

/* variabel-variabel untuk halaman kontaqk kami */
/***********************************************/
konek_db();
@ $kontak = $_GET['kontak_id'];
if ($kontak == '')
	$kontak = 'form';
//cegah Cross Site Scripting
$kontak = filter_str($kontak);

switch ($kontak)
{
	case 'form':
		$page_kontak = '<p>Jika anda mempunyai pertanyaan, kritik, saran atau apapun itu seputar SMK Negeri 4 Batam, silahkan kirimkan melalui form kontak dibawah ini. Kami akan merespon pertanyaan anda secepat mungkin.</p>'
					  .'<form action="kontak.php?kontak_id=proses_form" method="post">'
					  .'<table border="0" cellpadding="4">'
					  .'<tr><td>Nama: </td>'
					  	.'<td><input type="text" name="nama"></td></tr>'
					  .'<tr><td>Email: </td>'
					  	.'<td><input type="text" name="email"><td></tr>'
					  .'<tr><td>Subject: </td>'
					  	.'<td><input type="text" name="subject" size="50"> </td></tr>'
					  .'<tr><td>Pertanyaan: </td>'
					  	.'<td><textarea name="isi" rows="8" cols="50">'
						.'</textarea></td></tr>'
					  .'</table>'
					  .'<center><input type="submit" value="Kirim">'.' '.'<input type="reset" value="Batal"> </form>';
	break; // akhir dari proses form
	
	case 'proses_form':
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$isi = $_POST['isi'];
		
		$pesan_error = '';
		if (!cek_field($_POST))
			$pesan_error = 'Error: masih ada field yang kosong<br>';
		// cek email
		if (!cek_field($_POST))
			$pesan_error .= 'Error: email tidak valid<br>';
			
		if ($pesan_error != '')
			$page_kontak = $pesan_error.$kembali;
		else
		{
			$to = 'yogi@smkn4batam.sch.id'; // email anda
			$from = 'From: '.$email; //email si pengirim
			// jika anda tidak memiliki mail server atau anda belum di server
			// sebenarnya beri komentar pada fungsi mail berikut
			// mail($to, $subject, $pertanyaan, $from);
			
			// masukkan ke dalam database kita,, wokeh! ;)
			$query = "INSERT INTO kontak (nama, email, subject, isi) VALUES ('$nama', '$email', '$subject', '$isi')";
			$hasil = mysql_query($query);
			mysql_close(); // tutup koneksi
			
		if (!$hasil)
			$page_kontak = 'Error: gagal memasukkan data ke database. Mohon coba lagi nanti!<br>'.$kembali;
		else
		{
			$page_kontak = 'Pesan anda telah terkirim. Terima Kasih.';
		} // akhir dari else pertama
		
		} // akhir dari else kedua
	break; // akhir dari proses proses_form
}
$judul = 'Contact';

	$skin = new skin;
	$skin->ganti_skin('template/smk4_skin.php');
	$skin->ganti_tag('/{JUDUL}/', $judul);
	$skin->ganti_tag('/{MENU}/', $menu);
	$skin->ganti_tag('/{UTAMA}/', $page_kontak);
	$skin->ganti_tag('/{NEWS}/', $side_news);
	$skin->ganti_tampilan();
?>