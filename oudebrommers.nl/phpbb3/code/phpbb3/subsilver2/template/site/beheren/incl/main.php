<?
$sql = 'SELECT * FROM admusers WHERE id = "'.$_SESSION['obuserid'].'"';
$sqlquery = mysql_query($sql);
while ($show = mysql_fetch_assoc($sqlquery)) {
	$rechten = $show['rechten'];
	$username = $show['gebruikersnaam'];
}
if ($_GET['edit'] == "start") {
	if ($rechten == "1") {
	echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
	echo '<tr>';
	echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Start</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td bgcolor="#ececec" class="menu2">';
		if ($_POST['Wijzigen']) {
			$startbericht = htmlspecialchars($_POST['startbericht']);
			$sql = 'UPDATE site_start SET text = "'.$startbericht.'"';
			mysql_query($sql);
			echo 'Bericht opgeslagen';
		}
		else
		{
			$sql = 'SELECT * FROM site_start';
			$sqlquery = mysql_query($sql);
			while ($show = mysql_fetch_assoc($sqlquery)) {
				echo '<br><form method="post" action="" name="addtextform"><textarea name="startbericht" class="post" rows="10" cols="100">'.$show['text'].'</textarea>';
			}
			echo "<br><a href=\"javascript:addtext('startbericht','[b] [/b]')\">Vet</a> / ";
			echo "<a href=\"javascript:addtext('startbericht','[i] [/i]')\">Cursief</a> / ";
			echo "<a href=\"javascript:addtext('startbericht','[u] [/u]')\">Onderstrepen</a>";
			echo '<br><input type="submit" value="Opslaan" name="Wijzigen" class="post"></form>';
		}
	echo '</td>';
	echo '</tr>';
	echo '</table>';
	}
}
elseif ($_GET['edit'] == "spotlights") {
	if ($rechten == "1") {
		if ($_POST['toevoegen']) {
			$sql = 'DELETE FROM site_spotlights';
			mysql_query($sql);
			$sql = 'INSERT INTO site_spotlights (text, f, t) VALUES ("'.$_POST['startpagina'].'", "'.$_POST['f'].'", "'.$_POST['t'].'")';
			mysql_query($sql);
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
			echo '<tr>';
			echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Evenement in de spotlights</b></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td bgcolor="#ececec" class="menu2">';
			echo 'Startpagina gewijzigd.';
			echo '</td>';
			echo '</tr>';
			echo '</table>';
		}
		else
		{
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
			echo '<tr>';
			echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Evenement in de spotlights</b></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td bgcolor="#ececec" class="menu2">';
			echo '<br><form method="post" action="">';
			echo 'f: <input type="text" name="f" class="post"><br>';
			echo 't: <input type="text" name="t" class="post"><br><br>';
			echo 'Startpagina bericht:<br>';
			echo '<textarea name="startpagina" class="post" rows="10" cols="100"></textarea><br><br>';
			echo '<input type="submit" name="toevoegen" value="Toevoegen" class="post">';
			echo '</form>';
			echo '</td>';
			echo '</tr>';
			echo '</table>';
		}
	}
}
elseif ($_GET['edit'] == "nieuws") {
	if ($rechten == "1") {
		if ($_GET['optie'] == "toevoegen") {
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
			echo '<tr>';
			echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Nieuws</b></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td bgcolor="#ececec" class="menu2">';
			if ($_POST['ntoevoegen']) {
				$titel = $_POST['titel'];
				$bericht = $_POST['bericht'];
				$datum = date("d-m-Y");
				$sortdatum = date("Y-m-d");
				$sql = 'INSERT INTO site_nieuws (titel, bericht, datum, sortdatum, door)
					VALUES ("'.$titel.'", "'.$bericht.'", "'.$datum.'", "'.$sortdatum.'", "'.$username.'")';
				mysql_query($sql);
				echo 'Bericht opgeslagen';
			}
			else
			{
				echo '<br><form method="post" action="">Titel:<br><input type="text" name="titel" class="post">';
				echo '<br>Bericht:<br><textarea name="bericht" class="post" rows="10" cols="100"></textarea>';
				echo '<br><br><input type="submit" name="ntoevoegen" value="Opslaan" class="post"></form>';
			}
			echo '</td>';
			echo '</tr>';
			echo '</table>';
		}
		elseif ($_GET['optie'] == "bewerken") {
			if ($_GET['keuze'] == "bewerken") {
				if ($_POST['nbewerken']) {
					$sql = 'UPDATE site_nieuws SET titel = "'.$_POST['titel'].'", bericht = "'.$_POST['bericht'].'" WHERE id = "'.$_GET['id'].'"';
					mysql_query($sql);
					echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
					echo '<tr>';
					echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Nieuws</b></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td bgcolor="#ececec" class="menu2">';
					echo 'Nieuwsbericht bewerkt';
					echo '</td>';
					echo '</tr>';
					echo '</table>';				
				}
				else
				{
					$sql = 'SELECT * FROM site_nieuws WHERE id = "'.$_GET['id'].'"';
					$sqlquery = mysql_query($sql);
					while ($show = mysql_fetch_assoc($sqlquery)) {
						$titel = $show['titel'];
						$bericht = $show['bericht'];
					}
					echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
					echo '<tr>';
					echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Nieuws</b></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td bgcolor="#ececec" class="menu2">';
					echo '<br><form method="post" action="">Titel:<br><input type="text" name="titel" class="post" value="'.$titel.'">';
					echo '<br>Bericht:<br><textarea name="bericht" class="post" rows="10" cols="100">'.$bericht.'</textarea>';
					echo '<br><br><input type="submit" name="nbewerken" value="Opslaan" class="post"></form>';
					echo '</td>';
					echo '</tr>';
					echo '</table>';
				}
			}
			elseif ($_GET['keuze'] == "verwijderen") {
				$sql = 'DELETE FROM site_nieuws WHERE id = "'.$_GET['id'].'"';
				mysql_query($sql);
				echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
				echo '<tr>';
				echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Nieuws</b></td>';
				echo '</tr>';
				echo '<tr>';
				echo '<td bgcolor="#ececec" class="menu2">';
				echo 'Nieuwsbericht verwijderd';
				echo '</td>';
				echo '</tr>';
				echo '</table>';
			}
			else
			{
				$sql = 'SELECT * FROM site_nieuws ORDER BY sortdatum DESC, id DESC LIMIT 4';
				$sqlquery = mysql_query($sql);
				while ($show = mysql_fetch_assoc($sqlquery)) {
					echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
					echo '<tr>';
					echo '<td height="25" background="cellpic1.gif" class="menu1"><b>'.$show['titel'].'</b> <font size="1">(<a href="?edit=nieuws&optie=bewerken&keuze=bewerken&id='.$show['id'].'">Bewerken</a> / <a href="?edit=nieuws&optie=bewerken&keuze=verwijderen&id='.$show['id'].'">Verwijderen</a>)</font></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td bgcolor="#ececec" class="menu2">';
					$bericht = nl2br($show['bericht']);
					echo $bericht;
					echo '</td>';
					echo '</tr>';
					echo '</table>';
					echo '<div id="doline"></div>';
				}
			}
		}
	}
}
elseif ($_GET['edit'] == "evenementen") {
	if ($rechten == "1") {
		if ($_GET['optie'] == "toevoegen") {
			echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
			echo '<tr>';
			echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Evenementen</b></td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td bgcolor="#ececec" class="menu2">';
			if ($_POST['etoevoegen']) {
				$titel = $_POST['titel'];
				$plaats = $_POST['plaats'];
				$wat = $_POST['wat'];
				$waar = $_POST['waar'];
				$dag = $_POST['dag'];
				$maand = $_POST['maand'];
				$jaar = $_POST['jaar'];
				$datum = "$dag-$maand-$jaar";
				$datumsort = "$jaar-$maand-$dag";
				$van = $_POST['van'];
				$tot = $_POST['tot'];	
				$organisatie = $_POST['organisatie'];
				$website = $_POST['website'];
				$telefoon = $_POST['telefoon'];
				$email = $_POST['email'];
				$sql = 'INSERT INTO site_evenementen (titel, plaats, wat, waar, datum, datumsort, van, tot, organisatie, website, telefoon, email)
					VALUES ("'.$titel.'", "'.$plaats.'", "'.$wat.'", "'.$waar.'", "'.$datum.'", "'.$datumsort.'", "'.$van.'", "'.$tot.'", "'.$organisatie.'", "'.$website.'", "'.$telefoon.'", "'.$email.'")';
				mysql_query($sql);
				echo 'Bericht opgeslagen';
			}
			else
			{
				echo '<br><form method="post" action="">Titel: <input type="text" name="titel" class="post"><br>';
				echo 'Plaats: <input type="text" name="plaats" class="post"><br><br>';
				echo 'Wat: <input type="text" name="wat" class="post"><br>';
				echo 'Waar: <input type="text" name="waar" class="post"><br><br>';
				echo 'Datum: <select name="dag" class="post">';
				$i = 01;
				while ($i <= 31) {
					echo '<option value="'.$i.'">'.$i.'</option>';
					$i++;
				}
				echo '</select>';
				echo '<select name="maand" class="post">';
				$i = 1;
				while ($i <= 12) {
					echo '<option value="'.$i.'">'.$i.'</option>';
					$i++;
				}
				echo '</select>';
				echo '<select name="jaar" class="post">';
				echo '<option value="2008">2008</option><option value="2009">2009</option></select><br>';
				echo 'Van: <input type="text" name="van" class="post"><br>';
				echo 'Tot: <input type="text" name="tot" class="post"><br><br>';
				echo 'Organisatie: <input type="text" name="organisatie" class="post"><br>';
				echo 'Website: <input type="text" name="website" class="post"><br>';
				echo 'Telefoon: <input type="text" name="telefoon" class="post"><br>';
				echo 'E-mail: <input type="text" name="email" class="post"><br>';
				echo '<br><input type="submit" name="etoevoegen" value="Opslaan" class="post"></form>';
			}
			echo '</td>';
			echo '</tr>';
			echo '</table>';
		}
		elseif ($_GET['optie'] == "bewerken") {
				if ($_GET['keuze'] == "bewerken") {
					if ($_POST['ewijzigen']) {
						$sql = 'UPDATE site_evenementen SET
							titel = "'.$_POST['titel'].'", 
							plaats = "'.$_POST['plaats'].'", 
							wat = "'.$_POST['wat'].'", 
							waar = "'.$_POST['waar'].'", 
							van = "'.$_POST['van'].'", 
							tot = "'.$_POST['tot'].'", 
							organisatie = "'.$_POST['organisatie'].'", 
							website = "'.$_POST['website'].'", 
							telefoon = "'.$_POST['telefoon'].'", 
							email = "'.$_POST['email'].'" WHERE id = "'.$_GET['id'].'"';
						mysql_query($sql);
						echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
						echo '<tr>';
						echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Evenementen</b></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td bgcolor="#ececec" class="menu2">';
						echo 'Evenement bewerkt';
						echo '</td>';
						echo '</tr>';
						echo '</table>';	
					}
					else
					{
						echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
						echo '<tr>';
						echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Evenementen</b></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td bgcolor="#ececec" class="menu2">';
						$sql = 'SELECT * FROM site_evenementen WHERE id = "'.$_GET['id'].'"';
						$sqlquery = mysql_query($sql);
						while ($show = mysql_fetch_assoc($sqlquery)) {
							echo '<br><form method="post" action="">Titel: <input type="text" name="titel" class="post" value="'.$show['titel'].'"><br>';
							echo 'Plaats: <input type="text" name="plaats" class="post" value="'.$show['plaats'].'"><br><br>';
							echo 'Wat: <input type="text" name="wat" class="post" value="'.$show['wat'].'"><br>';
							echo 'Waar: <input type="text" name="waar" class="post" value="'.$show['waar'].'"><br><br>';
							echo 'Van: <input type="text" name="van" class="post" value="'.$show['van'].'"><br>';
							echo 'Tot: <input type="text" name="tot" class="post" value="'.$show['tot'].'"><br><br>';
							echo 'Organisatie: <input type="text" name="organisatie" class="post" value="'.$show['organisatie'].'"><br>';
							echo 'Website: <input type="text" name="website" class="post" value="'.$show['website'].'"><br>';
							echo 'Telefoon: <input type="text" name="telefoon" class="post" value="'.$show['telefoon'].'"><br>';
							echo 'E-mail: <input type="text" name="email" class="post" value="'.$show['email'].'"><br>';
							echo '<br><input type="submit" name="ewijzigen" value="Opslaan" class="post"></form>';
						}
						echo '</td>';
						echo '</tr>';
						echo '</table>';
					}
				}
				elseif ($_GET['keuze'] == "verwijderen") {
					$sql = 'DELETE FROM site_evenementen WHERE id = "'.$_GET['id'].'"';
					mysql_query($sql);
					echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
					echo '<tr>';
					echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Evenementen</b></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td bgcolor="#ececec" class="menu2">';
					echo 'Evenement verwijderd';
					echo '</td>';
					echo '</tr>';
					echo '</table>';
				}
				else
				{
				$sql = 'SELECT * FROM site_evenementen ORDER BY datumsort ASC, id DESC';
				$sqlquery = mysql_query($sql);
				$sqlnum = mysql_num_rows($sqlquery);
				if ($sqlnum == "0") {
					echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
					echo '<tr>';
					echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Evenementen</b></td>';
					echo '</tr>';
					echo '<tr>';
					echo '<td bgcolor="#ececec" class="menu2">';
					echo 'Geen evenementen momenteel';
					echo '</td>';
					echo '</tr>';
					echo '</table>';					
				}
				else
				{
					while ($show = mysql_fetch_assoc($sqlquery)) {
						echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
						echo '<tr>';
						echo '<td height="25" background="cellpic1.gif" class="menu1"><b>'.$show['titel'].' / '.$show['plaats'].'</b> ('.$show['datum'].') <font size="1">(<a href="?edit=evenementen&optie=bewerken&keuze=bewerken&id='.$show['id'].'">Bewerken</a> / <a href="?edit=evenementen&optie=bewerken&keuze=verwijderen&id='.$show['id'].'">Verwijderen</a>)</font></td>';
						echo '</tr>';
						echo '<tr>';
						echo '<td bgcolor="#ececec" class="menu2">';
						echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">';
						echo '<tr><td width="100"><b>Wat:</b></td><td><font size="1"> '.$show['wat'].'</td></tr>';
						echo '<tr><td><b>Waar:</b></td><td><font size="1"> '.$show['waar'].'</td></tr>';
						echo '<tr><td><b>Van:</b></td><td><font size="1"> '.$show['van'].'</td></tr>';
						echo '<tr><td><b>Tot:</b></td><td><font size="1"> '.$show['tot'].'</td></tr>';
						echo '<tr><td><b>Organisatie:</b></td><td><font size="1"> '.$show['organisatie'].'</td></tr>';
						echo '<tr><td><b>Website:</b></td><td><font size="1"> '.$show['website'].'</td></tr>';
						echo '<tr><td><b>Telefoon:</b></td><td><font size="1"> '.$show['telefoon'].'</td></tr>';
						echo '<tr><td><b>E-mail:</b></td><td><font size="1"> '.$show['email'].'</td></tr>';
						echo '</table>';
						echo '</td>';
						echo '</tr>';
						echo '</table>';
						echo '<div id="doline"></div>';
					}
				}
			}
		}
	}
}
else
{
	echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">';
	echo '<tr>';
	echo '<td height="25" background="cellpic1.gif" class="menu1"><b>Welkom</b></td>';
	echo '</tr>';
	echo '<tr>';
	echo '<td bgcolor="#ececec" class="menu2">';
	echo 'Welkom! Maak een keuze in het menu.';
	echo '</td>';
	echo '</tr>';
	echo '</table>';
}
?>