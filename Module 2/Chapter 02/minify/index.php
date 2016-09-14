<?php 
	
	include('libs/Converter.php');
	include('libs/Minify.php');
	include('libs/CSS.php');
	include('libs/JS.php');
	include('libs/Exception.php');


	use MatthiasMullie\Minify;
	
	/* Minify CSS*/

	$cssSourcePath = 'css/styles.css';
	$cssOutputPath = 'css/styles.min.merged.css';	

	$cssMinifier = new MatthiasMullie\Minify\CSS($cssSourcePath);
	$cssMinifier->add('css/style.css');
	$cssMinifier->add('css/forms.css');
	$cssMinifier->minify($cssOutputPath);

	/* Minify JS */

	$jsSourcePath = 'js/app.js';
	$jsOutputPath = 'js/app.min.merged.js';

	$jsMinifier = new Minify\JS($jsSourcePath);
	$jsMinifier->add('js/checkout.js');
	$jsMinifier->minify($jsOutputPath);
	


	echo "Done";
?>