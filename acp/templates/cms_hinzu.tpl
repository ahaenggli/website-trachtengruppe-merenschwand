<form action="$file" method="post">
<input type="hidden" name="cms_id" value="$id">
<table>
  <tr><td><i>&Uuml;berschrift: </i><br><input type="text" name="cms_header" size="50" value="$header"></td></tr>
  
  <tr><td><i>Text: </i><br><textarea type="text" name="cms_message" id="cms_message" style="width:800px;height:300px;">$message</textarea></td></tr>
  <tr><td><i>Sichtbarkeit: </i><br><input type="text" name="cms_aktiv" size="2" value="$aktiv"> (0=nicht anzeigen; 1=anzeigen) <span style="padding-left:100px;"><input type="submit" name="cms_save" value="Speichern"></span></td></tr>
</table> 
</form>

<script src='//cdn.tinymce.com/4/tinymce.min.js'></script>
<script>
  tinymce.init({
    selector: '#cms_message',
    language_url : 'http://www.trachtengruppe-merenschwand.ch/acp/langs/de.js',      
      width : 900,
      height : 500,
        element_format : 'html',
        statusbar: false,
        menubar: false,
    toolbar: 'undo redo styleselect bold italic underline alignleft aligncenter alignright bullist numlist outdent indent removeformat image link unlink code',
  plugins: 'code image link'
  });
  </script>

<!--
<script type="text/javascript" src="./nicEdit.js"></script> <script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() { new nicEditor({buttonList : ['fontSize','bold','italic','underline','strikeThrough','subscript','superscript','removeformat','image','link','unlink','xhtml']}).panelInstance('cms_message',{hasPanel : true}); });
  //]]>
</script>
   -->