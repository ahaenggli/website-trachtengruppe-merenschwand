<h2>Kontaktangaben</h2>

<div class="design design-text">
<h2>Briefanschrift</h2>
Trachtengruppe Merenschwand <br>
5634 Merenschwand
</div>

<form name="form" method="post" action="$file" class="design design-text">
<h2>Kontaktformular</h2>
  <table style="width:400px;">
    <tr>
      <td>Ihr Name:</td> 
      <td> 
        <input name="name" type="text" value="$_POST[name]" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px"></td>
  
    </tr>
    <tr> 
      <td>Ihre E-Mail Adresse:</td> 
      <td> 
        <input name="email" type="text" value="$_POST[email]" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px"></td>
    </tr>
    <tr> 
      <td>Ihre Mitteilung:</td> 
      <td> 
<textarea name="message" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px; height:100px" rows="4" cols="15">
$_POST[message]
</textarea></td>
    </tr>
    <tr> 
      <td> Wie viel ist $Zahl_1 plus $Zahl_2 ?</td> 
          
      <td> 
        <input name="number" type="hidden" value="$zahl" > 
        <input name="arithmetic" type="text" style="font-size:12px; font-family:Geneva, Arial, Helvetica, sans-serif; border : 1px solid #000000; width:186px" onfocus="if(this.value=='Das Ergebnis bitte hier hinein...')this.value=''" onblur="if(this.value=='')this.value='Das Ergebnis bitte hier hinein...'" value="Das Ergebnis bitte hier hinein..."></td>
    </tr>
    <tr> <td>M&ouml;gliche Aktionen</td> <td>

        <input name="submit" type="submit" value="Senden" $disabled> 
      </td>
    </tr>
  </table>
</form>
$error