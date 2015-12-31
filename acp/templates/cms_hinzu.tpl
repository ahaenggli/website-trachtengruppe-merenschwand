<form action="$file" method="post">
<table>
  <tr><td><input type="text" name="header" size="50" value="$header"></td></tr>
  
  <tr><td><textarea rows="20" cols="90" type="text" name="message" style="background-color:FFFFFF;font-family:Arial;">$message</textarea></td></tr>
  <tr><td><input type="text" name="aktiv" size="2" value="$aktiv"> (0=nicht anzeigen; 1=anzeigen)</td></tr>
</table> 
<input type="hidden" name="id" value="$id">
<input type="submit" name="$name" value="$button">
</form>