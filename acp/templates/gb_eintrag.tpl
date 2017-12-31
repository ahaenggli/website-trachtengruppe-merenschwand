<form action="$file" method="post">
<table align="center" border="1" cellspacing="0" cellpadding="5" width="75%">
  <tr><td>Eintrag von <b>$row[name]</b> &nbsp; <input type="submit" name="beab" Value="$button">
      $website
      $email
      <br>Am $datum 
      <br></td>
  </tr>
  <tr>   <td>   $inhalt 
      <br>   $kommentar   </td>
  </tr>
</table> 
<br>
<br>
<input type="hidden" name="id" value="$row[id]">

</form>
<hr><br><br>