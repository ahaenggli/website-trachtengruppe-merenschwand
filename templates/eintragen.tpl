<a href="./gb.html"><b>Alle Eintr&auml;ge</b></a> | <b>Neuer Eintrag</b>
<br>
<br>
<br>
<h2>$error</h2>
$vorschau
<form name="Formular" action="$file" Method="post">
  <table width="100%"  border="0" cellspacing="2" cellpadding="0">
    <tr>
      <td width="34%" valign="top">
        <div align="right"> Name:
        </div></td>
      <td width="66%">
        <input name="name" type="text"value="$name"></td>
    </tr>
    <tr>
      <td valign="top">
        <div align="right"> Homepage:
        </div></td>
      <td>
        <input name="website" type="text" value="$website">
        (ohne http://) </td>
    </tr>
    <tr>
      <td valign="top">
        <div align="right"> E-Mail:
        </div></td>
      <td>
        <input name="email" type="text" value="$email"></td>
    </tr>
    <tr>
      <td valign="top">
        <div align="right"> Smilies:
        </div></td>
      <td>
        <a href="javascript:SmilieEinfuegen(':(D:')">
          <img border="0" src="./images/smilies/D.gif" alt="Smilie"></a>
        <a href="javascript:SmilieEinfuegen(':):')">
          <img border="0" src="./images/smilies/C.gif" alt="Smilie"></a>
        <a href="javascript:SmilieEinfuegen(':-):')">
          <img border="0" src="./images/smilies/CC.gif" alt="Smilie"></a>
        <a href="javascript:SmilieEinfuegen(':-:')">
          <img border="0" src="./images/smilies/m.gif" alt="Smilie"></a>
        <a href="javascript:SmilieEinfuegen(':xD:')">
          <img border="0" src="./images/smilies/xD.gif" alt="Smilie"></a>
        <a href="javascript:SmilieEinfuegen(':winki:')">
          <img border="0" src="./images/smilies/winki.gif" alt="Smilie"></a></td>
    </tr>
    <td valign="top">
      <div align="right">
        <p> Eintrag:
        </p>
        <p> &nbsp;
        </p>
      </div></td>
    <td valign="top">
<textarea style="background-color:FFFFFF;font-family:Arial;" name="inhalt" cols="40" rows="6">$inhalt</textarea>
      <br></td>
    </tr> 
    
    <tr>
      <td valign="top">       
       <div align="right">
       <p> Spamschutz:</p>
                <p> &nbsp;
        </p>
        </div></td>

      <td valign="top">
                Wieviel ist $Zahl_1 plus $Zahl_2 ?<input name="number" type="hidden" value="$zahl">
        <input name="arithmetic" type="text" id="arithmetic" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px" onfocus="if(this.value=='Das Ergebnis bitte hier hinein...')this.value=''" onblur="if(this.value=='')this.value='Das Ergebnis bitte hier hinein...'" value="Das Ergebnis bitte hier hinein...">

           <br><br>
            <input type="submit" name="submit" value="Eintragen">
            <input type="reset" value="Zurücksetzen">
            <input type="submit" name="vorschau" value="Vorschau"><br></td>
</tr>
</form>
</table>

<div align="center">
Mit folgenden Elementen k&ouml;nnen Sie den Eintrag etwas gestalten:<br>
<table>
<tr>
<td>[i]Text /i]</td>
<td>wird zu</td>
<td><i>Text</i></td>

</tr>

<tr>
<td>[u]Text[/u]</td>
<td>wird zu</td>
<td><u>Text</u></td>

</tr>
<tr>
<td>[b]Text[/b]</td>
<td>wird zu </td>
<td><b>Text</b></td>

</tr>

<tr>
<td>[color:green]Text[/color]</td>
<td>wird zu</td>
<td><span style="color:green">Text</span></td>
</tr>

<tr>
<td>[color:red]Text[/color]</td>
<td>wird zu</td>
<td><span style="color:red">Text</span></td>
</tr>

<tr>
<td>[color:blue]Text[/color]</td>
<td>wird zu</td>
<td><span style="color:blue">Text</span></td>
</tr>
</table>
</div>