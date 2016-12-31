var GB_ROOT_DIR = "http://www.trachtengruppe-merenschwand.ch/images/galerie_js/";
  
function SmilieEinfuegen(Smilie)
{
document.Formular.inhalt.value += Smilie+" ";
document.Formular.inhalt.focus();
} 

  
  $(function () {
        $( 'nav ul li ul li:has(ul)' ).attr('aria-haspopup','true').doubleTapToGo();  
        $( 'nav ul li:has(ul)' ).attr('aria-haspopup','true').doubleTapToGo();
     
  });
  
