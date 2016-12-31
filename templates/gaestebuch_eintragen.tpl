<a href="./gaestebuch.html"><b>Alle Eintr&auml;ge</b></a> | <b>Neuer Eintrag</b>
<br>
$vorschau

<div style="float:left;">
<form name="Formular" action="$file" Method="post">
  <table>
    <tr>
      <td>
        <div class="right"> Name:
        </div></td>
      <td>
        <input name="name" type="text" value="$name"></td>
    </tr>
    <tr>
      <td>
        <div align="right"> Homepage:
        </div></td>
      <td>
        <input name="website" type="text" value="$website">
        (ohne http://) </td>
    </tr>
    <tr>
      <td>
        <div align="right"> E-Mail:
        </div></td>
      <td>
        <input name="email" type="text" value="$email"></td>
    </tr>
    <tr>
      <td>
        <div align="right"> Smilies:
        </div></td>
      <td>
        <a href="javascript:SmilieEinfuegen(':(D:')">
          <img src="./images/smilies/D.gif" alt="Smilie"></a>
        <a href="javascript:SmilieEinfuegen(':):')">
          <img src="./images/smilies/C.gif" alt="Smilie"></a>
        <a href="javascript:SmilieEinfuegen(':-):')">
          <img src="./images/smilies/CC.gif" alt="Smilie"></a>
        <a href="javascript:SmilieEinfuegen(':-:')">
          <img src="./images/smilies/m.gif" alt="Smilie"></a>
        <a href="javascript:SmilieEinfuegen(':xD:')">
          <img src="./images/smilies/xD.gif" alt="Smilie"></a>
        <a href="javascript:SmilieEinfuegen(':winki:')">
          <img src="./images/smilies/winki.gif" alt="Smilie"></a></td>
    </tr>
    <tr>
    <td>
      <div class="right">
        <p> Eintrag:
        </p>
        <p> &nbsp;
        </p>
      </div></td>
    <td>
<textarea style="background-color:FFFFFF;font-family:Arial;" name="inhalt" cols="40" rows="6">$inhalt</textarea>
      <br></td>
    </tr> 
    
    <tr>
      <td>       
       <div class="right">
       <p> Spamschutz:</p>
                <p> &nbsp;</p>
        </div></td>

      <td>
                Wieviel ist <span style="display:none">1 plus </span><span>$Zahl_1</span> + <span>$Zahl_2</span><span style="display:none">+ 5</span> ?<input name="number" type="hidden" value="$zahl">
        <input name="arithmetic" type="text" id="arithmetic" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px" onfocus="if(this.value=='Das Ergebnis bitte hier hinein...')this.value=''" onblur="if(this.value=='')this.value='Das Ergebnis bitte hier hinein...'" value="Das Ergebnis bitte hier hinein...">

           <br><br>
            <input type="submit" name="submit" value="Eintragen">
            <input type="submit" name="vorschau" value="Vorschau"><br></td>
</tr>
</table>
</form>
</div>
<div class="design design-info" style="float:right;width:250px;">
<b>Mit folgenden Elementen kann
der Eintrag gestaltet werden:</b><br>
<table>
<tr>
<td>&#91;i]Text[/i&#93;</td>
<td>wird zu</td>
<td><i>Text</i></td>

</tr>

<tr>
<td>&#91;u&#93;Text&#91;/u&#93;</td>
<td>wird zu</td>
<td><u>Text</u></td>

</tr>
<tr>
<td>&#91;b&#93;Text&#91;/b&#93;</td>
<td>wird zu </td>
<td><b>Text</b></td>

</tr>

<tr>
<td>&#91;color:green&#93;Text&#91;/color&#93;</td>
<td>wird zu</td>
<td><span style="color:green">Text</span></td>
</tr>

<tr>
<td>&#91;color:red&#93;Text&#91;/color&#93;</td>
<td>wird zu</td>
<td><span style="color:red">Text</span></td>
</tr>

<tr>
<td>&#91;color:blue&#93;Text&#91;/color&#93;</td>
<td>wird zu</td>
<td><span style="color:blue">Text</span></td>
</tr>
</table>
</div>
<br class="clear">
<h2>$error &nbsp;</h2>
