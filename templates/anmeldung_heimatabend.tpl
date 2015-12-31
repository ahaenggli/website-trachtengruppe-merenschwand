<h1>Platzreservation f&uuml;r den Heimatabend 2011:</h1> 

    <br>
<form action="anmeldung_heimatabend.html" method="post" autocomplete="off">
<table>
<tr>
<td>Ihr Name:</td>
<td><input type="text" name="name" value="$name"></td>
</tr>
<tr>
<td>Ihr Vorname:</td>
<td><input type="text" name="vorname" value="$vorname"></td>
</tr>
<tr>
<td>Strasse:</td>
<td><input type="text" name="strasse" value="$strasse"></td>
</tr>
<tr>
<td>PLZ/Ort:</td>
<td><input type="text" name="plz_ort" value="$plz"></td>
</tr>
<tr>
<td>Anzahl Personen:</td>
<td><input type="text" name="anzahl" value="$anzahl"></td>
</tr>
<tr>
<td>Welches Datum?</td>
<td><input type="radio" name="datum" value="1" id="A1"> <label for="A1">Samstag, 19. November 2011</label> <br>
<input type="radio" name="datum" value="2" id="A2"> <label for="A2"> Sonntag, 20. November 2011</label><br>
</td>
</tr>

<tr>
<td>Mit Essen?</td>
<td><input type="radio" name="essen" value="1" id="A3"> <label for="A3"> Ja </label><br>
<input type="radio" name="essen" value="0" id="A4"> <label for="A4"> Nein </label><br>
</td>
</tr>
<tr>
<td valign="top">Platzwunsch<br>(vorne, hinten, am Eingang, etc.)<br>und Bemerkungen :</td>
<td><textarea cols="40" rows="5" name="platzwunsch" >$nachricht</textarea></td>
</tr>

      <td> Wie viel ist $Zahl_1 plus $Zahl_2 ?</td> 
          
      <td> 
        <input name="number" type="hidden" value="$zahl" > 
        <input name="arithmetic" type="text" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px" onfocus="if(this.value=='Das Ergebnis bitte hier hinein...')this.value=''" onblur="if(this.value=='')this.value='Das Ergebnis bitte hier hinein...'" value="Das Ergebnis bitte hier hinein..."></td>
    </tr>
    
<tr>      <td></td>
<td>$error <input type="submit" name="submit" value="Reservieren"  $disabled></td>
</tr>
</table>
<div>

</div>
</form>