//JS script for Joomla template

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


var boxes = [];
showBox = function (box,focusobj, caller) {
	box=$(box);
	if (!box) return;
	if ($(caller)) box._caller = $(caller);
	boxes.include (box);
	if (box.getStyle('display') == 'none') {
		box.setStyles({
			display: 'block',
			opacity: 0
		});
	}
	if (box.status == 'show') {
		//hide
		box.status = 'hide';
		var fx = new Fx.Style (box,'opacity');
		fx.stop();
		fx.start (box.getStyle('opacity'), 0);
		if (box._caller) box._caller.removeClass ('show');
	} else {
		boxes.each(function(box1){
			if (box1!=box && box1.status=='show') {
				box1.status = 'hide';
				var fx = new Fx.Style (box1,'opacity');
				fx.stop();
				fx.start (box1.getStyle('opacity'), 0);
				if (box1._caller) box1._caller.removeClass ('show');
			}
		},this);
		box.status = 'show';
		var fx = new Fx.Style (box,'opacity',{onComplete:function(){if($(focusobj))$(focusobj).focus();}});
		fx.stop();
		fx.start (box.getStyle('opacity'), 1);
		
		if (box._caller) box._caller.addClass ('show');
	}
}



