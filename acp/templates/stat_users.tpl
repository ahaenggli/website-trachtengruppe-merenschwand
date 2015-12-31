  <tr style="background-color:$background">    
   <td>$i</td>
   <td>      <form  class="sp" method="post" action="$file">      
    <input type="hidden" name="log" style="" value="$row[ip]"">      
    <input class="sp" type="submit" value="$row[ip]">  
  </form></td> 
   <td>$besuch</td>  
   <td>$row[cc]</td>  
   <td>$row[browser]</td>  
   <td>$row[pc]</td>    
    
    <td align="center">    
      <form method="post" action="$file">        
        <input type="hidden" name="show" value="$row[ip]">             
        <input class="sp" type="submit" value="Zeige Details">    
      </form>
    </td>
  </tr>