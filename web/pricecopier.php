<?php
/*
Nice page that gets embedded to show content.
*/

#INCLUDE THE FOLLOWING TO MAKE THE REST WORK#
include_once 'config.php';
include_once 'vars.php';

##########CONNECTION INFO FOR DATABASE###########
$con = new mysqli($ip,$user,$pw,$db);

if(isset($_GET['assettag'])){
	$id = $_GET['assettag'];
	
	$search = mysqli_escape_string($con, $id);
	$query = mysqli_query($con, "SELECT * FROM asset_information WHERE tagno='$id'");
	
	//Needed for the magic happening below.
	
	//Opens the marapets file for the item. We load this through our domain tho.
	$html = file_get_html('' . $_GET["id"] . '&marasite=1');
	//Save the picture as variable.
	foreach($html->find('img[border="0"]') as $picture);
	//Save the item name text as variable. 
	foreach($html->find('font["size+1"] b') as $name);
	//Save the shop text as a variable. 
	foreach($html->find('i') as $shop);
	//Save the rarity number as a variable. Gets rid of the R.
	foreach($html->find('font[color="#C53F55"]') as $rarity); 
	$rarityno = preg_replace("/[^0-9.]/" . $rarity->plaintext);
	//Save the wanted number as a variable. Gets rid of the text associated.
	foreach($html->find('font[color="#0000FF"]') as $want); 
	$wantno = preg_replace("/[^0-9.]/" . $want->plaintext);
	//Get the text and details for player shops.
	foreach($html->find('a font[color="#5F148D"]') as $playershop); 
	/* Finally, echo it all into HTML. Not worrying about formatting as
	it is handled by the page it is inserted into. */
	echo '<table align="center" width="510">';
	echo '<tr><td width="85"><img src="' . $picture->src . '"></td></tr>';
	echo '<tr><td width="250"><b style="line-height:1.15; font-size:14pt">' . $name . '</b></br>';
	echo '<b style="color: darkorange;">Rarity ' . $rarityno . ' </b>';
	
	//Display wanted text, with link to the wanted page.
	echo '<b style="color: darkblue;"><a href="wanted.php?do=browse&id=', $_GET["id"] .
		 '" style="font-size:100%;">' . $wantno . ' Wanted' . '</a></b></br>' . $shop . '</i></br>'; 
		 
	//Display shop text with a link to the shop search page for the item.
	echo '<a target="_blank" href="https://marapets.com/shopsearch.php?do=' . $name->plaintext .
		 '&ref=maralook" style="font-size:100%;">' . $playershop . '</a></br>';
	echo '</td></tr>';
	echo '</table>';
}
//If for some reason ID is not set, handle it here.
else{
	echo "ERROR DISPLAYING ITEM CONTENT";
}
?> 