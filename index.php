<?php
/*
 * file to determine the layout of the homepage 'Home'
 */
 ?>
<?php
	
	// Dit is de titel die op de pagina en in de menubalk
	// zal verschijnen.
	$title = "The English Wikipedia database of writers and books";

	// Voer de inhoud van "top.inc.php" uit. Deze verzorgt de
	// algemene pagina lay-out en het menu.
	require("template/top.tpl.php");
?>

Today is 
<?php print date('Y-m-d');
?>
<br />
Group members: Ellen Anthonissen, Stijn Reynders, Kevin Thonon

