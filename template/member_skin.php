<html>
<title>.::SMK Negeri 4 Batam::.</title>
<!-- panggil file CSS nya! -->
<link rel="stylesheet" href="../css/websekolah.css" type="text/css" />
<link rel="stylesheet" href="../css/dropdownmenu.css" type="text/css" />
<!-- panggil javascript buat slider! :D -->
<script type="text/javascript" src="../js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.cycle.all.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#slideshow').cycle({
        fx:     'fade',
        speed:  'slow',
        timeout: 3000,
        pager:  '#slider_nav',
        pagerAnchorBuilder: function(idx, slide) {
            // return sel string for existing anchor
            return '#slider_nav li:eq(' + (idx) + ') a';
        }
    });
});
</script>
<!-- selesai memanggil! :p -->
</head>
<body>
<div id="utama"> <!-- Layout Utama-->

{MENU}
            
<!-- Berita Terbaru -->
    <div class="berita">
        <p><strong>Berita Terbaru:</strong> <blink>SMK Langsung Kerja? | 18 Sep 2012</blink></p>
    </div>
<!-- Menu Kiri -->
	<div id="menukiri">
        <div id="bg_menu"> Menu Utama </div>
    	<div id="content_menu">
    	<a href="../index.php">&raquo; Home </a> <br />
        <a href="profil.php">&raquo; Profil </a> <br />
        <a href="../bukutamu.php">&raquo; Buku Tamu </a> <br />
        <a href="../kontak.php">&raquo; Contact </a> <br />
    	</div>

    	<div id="bg_menu"> Informasi Terkini </div>
    	<div id="content_menu">
      		{NEWS}
		</div>  
	</div>
<!-- Layout BLOG! -->
	<div id="judul_blog">{JUDUL}</div>
	<div id="blog">
    	<div class="post">
            	<div class="post-text2">
                	{UTAMA}
                </div>
		</div>                
	</div>
<!-- Bagian Footer -->
	<div class="bersih"></div>
    <div id="kaki"><img src="../gambar/footer.jpg" /></div>
    
</div> <!-- Penutup Layout Utama -->
</body>
</html>