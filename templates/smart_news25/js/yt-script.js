// JavaScript Document
window.addEvent('domready',function(){new SmoothScroll({duration:1000},window);});

function switchFontSize (ckname,val){
	var bd = document.getElementsByTagName('body');
	if (!bd || !bd.length) return;
	bd = bd[0];
	var oldclass = 'fs'+CurrentFontSize;
	switch (val) {
		case 'inc':
			if (CurrentFontSize+1 < 7) {
				CurrentFontSize++;
			}		
		break;
		case 'dec':
			if (CurrentFontSize-1 > 0) {
				CurrentFontSize--;
			}		
		break;
		case 'reset':
		default:
			CurrentFontSize = DefaultFontSize;			
	}
	var newclass = 'fs'+CurrentFontSize;
	bd.className = bd.className.replace(new RegExp('fs.?', 'g'), '');
	bd.className = trim(bd.className);
	bd.className += (bd.className?' ':'') + newclass;
	createCookie(ckname, CurrentFontSize, 365);
}
function trim(str, chars) {
	chars = chars || "\\s";
	str =   str.replace(new RegExp("^[" + chars + "]+", "g"), "");
	str =  str.replace(new RegExp("^[" + chars + "]+", "g"), "");
	return str;
}

function switchTool (ckname, val) {
	createCookie(ckname, val, 365);
	window.location.reload();
}
function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime()+(days*24*60*60*1000));
    var expires = "; expires="+date.toGMTString();
  }
  else expires = "";
  document.cookie = name+"="+value+expires+"; path=/";
}