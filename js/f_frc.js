


function x(){ document.getElementById('error').innerHTML=""; }
function aZ(control) {     if (/[a-z]/.test(control.value)) {control.value = control.value.toUpperCase();} }

function getcopia(quecopia) {
	var aux = document.createElement("input");
	aux.setAttribute("value",quecopia);
	document.body.appendChild(aux);
	aux.select();
	document.execCommand("copy");
	document.body.removeChild(aux);
	}
	
function enter(nextfield) {
if(window.event.keyCode == 13) {
  nextfield.focus();
  return false; }
else
  return true; }

//   Para Validar Campos Númericos y Letras
//			onKeydown="return keyRestrict(event,'1234567890.')"
//          onKeyPress="return keyRestrict(event,'abcdefghijklmnopqrstuvwxyz '+String.fromCharCode(241))" 
 function getKeyCode(e)
{
 if (window.event)
    return window.event.keyCode;
 else if (e)
    return e.which;
 else
    return null;
}

function keychar(e, validchars) {
 var key='', keychar='';
 key = getKeyCode(e);
//window.alert(key);
 if (key == null) return true;
 keychar = String.fromCharCode(key);
 keychar = keychar.toLowerCase();
 validchars = validchars.toLowerCase();
 if (validchars.indexOf(keychar) != -1)
  return true;
 if ( key==null || key==0 || key==8 || key==9 || key==13 || key==27 )
  return true;
 return false;
} 

function keynum(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105) ) {
        return false;
    }
    return true;
}


function keynumdec(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57) && (charCode < 96 || charCode > 105)) {
		if (charCode == 190){ return true;}else{return false;}
        
    }
    return true;
}
    


function taCount1(visCnt) { 
	var taObj=event.srcElement;
	if (taObj.value.length>taObj.maxLength*1) taObj.value=taObj.value.substring(0,taObj.maxLength*1);
	if (visCnt) visCnt.innerText=taObj.maxLength-taObj.value.length;
}

function taCount2(visCnt) { 
	var taObj=event.srcElement;
	if (taObj.value.length>taObj.maxLength*1) taObj.value=taObj.value.substring(0,taObj.maxLength*1);
	if (visCnt) visCnt.innerText=taObj.maxLength-taObj.value.length;
}



function obtennumerosencadena(string) {
	var tmp = string.split("");
  var map = tmp.map(function(current) {
	  if (!isNaN(parseInt(current))) {
	  return current;
	  }
  });

  var numbers = map.filter(function(value) {
	  return value != undefined;
  });

  return numbers.join("");
}




