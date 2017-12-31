<form method="post" action="$file">

<input type="hidden" name="id" Value="$row->id"><br>
<input type="hidden" name="ip"  Value="$row->ip"><br>
Name: <input name="name" Value="$row->name"><br>
E-Mail: <input name="email" Value="$row->email"><br>
Website: <input name="website" Value="$row->website"><br>
Aktiv: <input name="aktiv" Value="$row->aktiv"> 1=JA wird Angezeigt, 0=Nein wird nicht Angezeigt.<br>
Eintrag:<br>
<textarea style="background-color:FFFFFF;font-family:Arial;" name="inhalt" cols="30" rows="10">$row->inhalt</textarea>
<br>
Kommentar:<br>

<textarea style="background-color:FFFFFF;font-family:Arial;" name="kommentar" cols="30" rows="10">$row->kommentar</textarea><hr><br><br>
<input type="submit" name="save" Value="Speichern">