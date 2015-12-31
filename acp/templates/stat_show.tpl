   <br>
<center>  
<!--  <form class="sp" method="post" action="$file">      
    <input class="sp" type="submit" value="Start">  
  </form> --> 
  <form  class="sp"method="post" action="$file">      
    <input type="hidden" name="ipl" style="" value="$ip">      
    <input class="sp" type="submit" value="Mich selber aus der Statistik l&ouml;schen">  
  </form>
      <form  class="sp" method="post" action="$file">      
    <input type="hidden" name="log" style="" value="$logs">      
    <input class="sp" type="submit" value="Diese Logs l&ouml;schen ($logs)">  
  </form>
  
</center> 
<br>
<table style="color:black;">
  <tr style="color:lightgreen;">
  <td>Nr.</td>
  <td>IP</td>
  <td>Letzter Besuch</td>
  <td>Land</td>
  <td>Browser</td>
  <td>PC</td>
  <td>Referer</td>  
  <td>Seite</td>

  </tr>

$users
   
</table>