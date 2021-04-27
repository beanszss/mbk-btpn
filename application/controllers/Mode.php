<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mode extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
    }

    public function maintenance()
    {
        echo '
		<html>
		<head>
			<title>Situs Sedang Dalam Perbaikan</title>
			<link rel="icon" type="image/png" sizes="96x96" href="https://img.icons8.com/metro/1600/maintenance.png">
		</head>
			<body>
				<p style="text-align: center; padding-top: 15%; font-size:30px;" style="text-align:center"><strong>Situs Sedang Dalam Perbaikan</strong></p>
				<p style="text-align:center">Mohon Maaf, saat ini kami sedang melakukan upgrade sistem, silahkan mengunjungi kembali halaman ini beberapa saat lagi, terima kasih</p>		
				<p style="text-align:center">info: <a href="mailto:admin@mbk-btpn">hexa8bit@firasmpratama.com</a></p>
			</body>
		</html>
		';
    }
}
