<?php

include('template/template.php');
include('template/index_var.php');

$judul = '<a href="index.php?id=1">Kepala Sekolah SMK Negeri 4 Batam</a>';

$utama = '
Nama Lengkap: Baharudding Sitepu, S.Pd<br><br>
NIP: 197202251999031006<br><br>
Pangkat/Gol.: Guru Pembina/IVa<br><br>
Alamat: Putra Moro II, Blok L/15 Sei.Langkai, Kec. Sagulung Batam<br><br>
No. Hp: 081270763832<br><br>
Email: sitepu_b@yahoo.com<br><br>
Status: Menikah<br><br>
Anank: 4 (empat)
';


	$skin = new skin;
	$skin->ganti_skin('template/smk4_skin.php');
	$skin->ganti_tag('/{JUDUL}/', $judul);
	$skin->ganti_tag('/{MENU}/', $menu);
	$skin->ganti_tag('/{UTAMA}/', $utama);
	$skin->ganti_tag('/{NEWS}/', $side_news);
	$skin->ganti_tampilan();
	
?>