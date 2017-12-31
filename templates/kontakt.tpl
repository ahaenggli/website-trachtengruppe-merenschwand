<form name="form" method="post" action="$file">
  <table width="400" cellpadding="2" cellspacing="2">
    <tr>
      <td>Ihr Name:</td> 
      <td> 
        <input name="name" type="text" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px"></td>
  
    </tr>
    <tr> 
      <td>Ihre E-Mail Adresse:</td> 
      <td> 
        <input name="email" type="text" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px"></td>
    </tr>
    <tr> 
      <td>Ihre Mitteilung:</td> 
      <td> 
<textarea name="message" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px; height:100px" rows="4" cols="15"></textarea></td>
    </tr>
    <tr> 
      <td> Wie viel ist $Zahl_1 plus $Zahl_2 ?</td> 
          
      <td> 
        <input name="number" type="hidden" value="$zahl" > 
        <input name="arithmetic" type="text" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px" onfocus="if(this.value=='Das Ergebnis bitte hier hinein...')this.value=''" onblur="if(this.value=='')this.value='Das Ergebnis bitte hier hinein...'" value="Das Ergebnis bitte hier hinein..."></td>
    </tr>
    <tr> <td>M&ouml;gliche Aktionen</td> <td>

        <input name="submit" type="submit" value="Senden" $disabled> 
        <input name="reset" type="reset" value="Zur&uuml;cksetzen">
      </td>
    </tr>
  </table>
</form>
$error