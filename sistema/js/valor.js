function FormataValor(id,tammax,teclapres) {
    
        if(window.event) { // Internet Explorer
         var tecla = teclapres.keyCode; }
        else if(teclapres.which) { // Nestcape / firefox
         var tecla = teclapres.which;
        }
    

vr = document.getElementById(id).value;
vr = vr.toString().replace( "/", "" );
vr = vr.toString().replace( "/", "" );
vr = vr.toString().replace( ",", "" );
vr = vr.toString().replace( ".", "" );
vr = vr.toString().replace( ".", "" );
vr = vr.toString().replace( ".", "" );
vr = vr.toString().replace( ".", "" );
tam = vr.length;

if (tam < tammax && tecla != 8){ tam = vr.length + 1; }

if (tecla == 8 ){ tam = tam - 1; }

if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 ){
if ( tam <= 2 ){
document.getElementById(id).value = vr; }
if ( (tam > 2) && (tam <= 5) ){
document.getElementById(id).value = vr.substr( 0, tam - 2 ) + '.' + vr.substr( tam - 2, tam ); }
if ( (tam >= 6) && (tam <= 8) ){
document.getElementById(id).value = vr.substr( 0, tam - 2 ) + '.' + vr.substr( tam - 2, tam ); }
if ( (tam >= 9) && (tam <= 11) ){
document.getElementById(id).value = vr.substr( 0, tam - 2 ) + '.' + vr.substr( tam - 2, tam ); }
if ( (tam >= 12) && (tam <= 14) ){
document.getElementById(id).value = vr.substr( 0, tam - 2 ) + '.' + vr.substr( tam - 2, tam ); }
if ( (tam >= 15) && (tam <= 17) ){
document.getElementById(id).value = vr.substr( 0, tam - 2 ) + '.' + vr.substr( tam - 2, tam ); }
}
}
