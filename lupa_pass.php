<?php

	include('template/template.php');
	include('template/index_var.php');
	
@ $id = $_GET['id'];
if ($id == '')
	$id = 'form';
// cegah Cross Site Scripting
$id = filter_str($id);

switch ($id)
{
	case 'form': // titik dua bukan titik koma
		$page_lupa = '<p>Masukkan email anda yang ada pada member area '
					.'www.smkn4batam.sch.id</p>'
					.'<form action="lupa_pass.php?id=kirim" method="post">'
					.'<table border="0" cellpadding="4">'
					.'<tr><td>Email: </td>'
						.'<td><input type="text" name="email" maxlenght="30"> '
						.'</td></tr>'
					.'<tr><td><input type="submit" value="KIRIM"> </td></tr>'
					.'</table></form>';
	break; // akhir dari proses form
	
	case 'kirim':
		$email = $_POST['email'];
		// cek email
		if (!cek_email($email))
			$page_lupa = 'Error: email tidak valid<br>'.$kembali;
		else
		{
			// lakukan query untuk mengecek email apa ada di database
			konek_db(); // koneksikan ke MySQL Server
			$hasil = mysql_query("SELECT * FROM member WHERE email='$email'");
			mysql_close(); // tutup koneksi
			if (mysql_num_rows($hasil) == 0)
				$page_lupa  = 'Error: email '.$email.' tidak ada di database.<br>'.$kembali;
			else
			{
				$data = mysql_fetch_array($hasil);
				// buat variabel untuk digunakan pada fungsi mail()
				$to = $email;
				$subject = 'Password Anda di Website http://smkn4batam.sch.id/';
				$isi_email = "Berikut ini adalah username dan Password anda: \n"
							."=============================================\n\n"
							."Username: ".$data['username']."\n"
							."Password: ".$data['password']."\n\n"
							."Harap ingat baik-baik password anda tersebut. Jika diperlukan catatlah password tersebut.\n\n"
							."www.smkn4batam.sch.id";
				$from = 'From: yogi@smkn4batam.sch.id';
				
				// jika anda tidak memilki mail server atau anda belum di server sebernarnya
				// beri komentar pada fungsi mail berikut
				// mail($to, $subject, $isi_email, $from);
				$page_lupa = 'Password berhasil dikirim. Silahkan cek email anda';
			} // akhir dari else ke dua
		} // akhir dari else pertama
	break; // akhir dari proses kirim
} // akhir dari switch

$skin = new skin;
$skin->ganti_skin('template/smk4_skin.php');
$skin->ganti_tag('/{JUDUL}/', $judul);
$skin->ganti_tag('/{MENU}/', $menu);
$skin->ganti_tag('/{UTAMA}/', $page_lupa);
$skin->ganti_tag('/{NEWS}/', $side_news);
$skin->ganti_tampilan();

?>