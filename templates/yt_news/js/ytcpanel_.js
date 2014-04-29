//JS script

window.addEvent("load", function(){
	var fx_wrapper = new Fx.Morph($('cpanel_wrapper'), {duration:200, wait:false, transition: Fx.Transitions.linear});
	var fx_button  = new Fx.Morph($('cpanel_btn'), {duration:200, wait:false, transition: Fx.Transitions.linear});
	var i = 0;
	$('cpanel_btn').addEvent('click', function(e){
		if(i%2==0) {
			fx_wrapper.start({'right' : 0});
			fx_button.start({'right' : '254px'});
			$('cpanel_btn').addClass('cpanel-actived');
			$('cpanel_btn').removeClass('cpanel-normal');
		} else {
			fx_wrapper.start({'right' : '-260px'});
			fx_button.start({'right' : '-6px'});
			$('cpanel_btn').addClass('cpanel-normal');
			$('cpanel_btn').removeClass('cpanel-actived');
		}
		i++;
	});
	// delete cookie temp: ytvartemp_ ...
	var matches = document.cookie.match('(?:^|;)\\s*ytvartemp_([^=]*)=([^;]*)', 'g');
	if (matches){
		for (i=0;i<matches.length;i++) { //alert(matches[i]);
			var ck = matches[i].match('(?:^|;)\\s*ytvartemp_([^=]*)=([^;]*)');
			if (ck) {
				createCookie ('ytvartemp_'+ck[1], '', -1);
			}
		}
	}
	
});

function onResetDefault(tmpl_name){
	//alert(tmpl_name.escapeRegExp());
	var matches = document.cookie.match('(?:^|;)\\s*' + tmpl_name.escapeRegExp() + '_([^=]*)=([^;]*)', 'g');
	if (!matches) return;
	for (i=0;i<matches.length;i++) { //alert(matches[i]);
		var ck = matches[i].match('(?:^|;)\\s*' + tmpl_name.escapeRegExp() + '_([^=]*)=([^;]*)');
		if (ck) {
			createCookie (tmpl_name+'_'+ck[1], '', -1);
		}
	}
	
	if (window.location.href.indexOf ('?')>-1) window.location.href = window.location.href.substr(0,window.location.href.indexOf ('?'));
	else window.location.reload();
}

function onApply (tmpl_name) {
	var elems = document.getElementById('cpanel_wrapper').getElementsByTagName ('*');
	
	var usersetting = {};
	for (i=0;i<elems.length;i++) {
		var el = elems[i]; 
	    if (el.name && (match=el.name.match(/^ytcpanel_(.*)$/))) {
	        var name = match[1];	        
	        var value = '';
	        if (el.tagName.toLowerCase() == 'input' && (el.type.toLowerCase()=='radio' || el.type.toLowerCase()=='checkbox')) {
	        	if (el.checked) value = el.value;
	        } else {
	        	value = el.value;
	        }
	        if (usersetting[name]) {
	        	if (value) usersetting[name] = value + ',' + usersetting[name];
	        } else {
	        	usersetting[name] = value;
	        }
	    }
	}
	
	for (var k in usersetting) {
		name = tmpl_name + '_' + k; //alert(name);
		value = usersetting[k];
		createCookie(name, value, 365);
	}
	
	if (window.location.href.indexOf ('?')>-1) window.location.href = window.location.href.substr(0,window.location.href.indexOf ('?'));
	else window.location.reload();
}
function onChangelayout(obj, idSuffix, element, tmpl_name, layout_value, wtype) {
	// set value of suffixlayout
	var suffix = document.getElementById(idSuffix);
	suffix.value = obj; 
	// create cookie temp for layout
	createCookie('ytvartemp_'+tmpl_name+'_default_main_layout', layout_value, 365);
	// load cpanel_twidth
	wtype = getCookie('ytvartemp_'+tmpl_name+'_widthType', wtype);
	url = 'templates/'+tmpl_name+'/includes/cpanel-twidth.php?clayout='+layout_value+'&wtype='+wtype;
	$('yt_button_cpanel').setStyle('visibility', 'hidden');
	var c_ajax = new Request({url: url, method:'get', 
		onSuccess: function(result){
				$(element).set('html', result); //alert('dungnv');
				$('yt_button_cpanel').setStyle('visibility', 'visible');
		},
		onFailure: function(){
			$(element).set('text', 'Cpanel is not loading!');
		}
	});
	c_ajax.send();
}
function onChangeWidthType(element, tmpl_name, wtype_value, clayout) {
	// create cookie temp for widthtype
	createCookie('ytvartemp_'+tmpl_name+'_widthType', wtype_value, 365);
	// load cpanel_twidth
	clayout = getCookie('ytvartemp_'+tmpl_name+'_default_main_layout', clayout);
	url = 'templates/'+tmpl_name+'/includes/cpanel-twidth.php?clayout='+clayout+'&wtype='+wtype_value;
	$('yt_button_cpanel').setStyle('visibility', 'hidden');
	var c_ajax = new Request({url: url, method:'get', 
		onSuccess: function(result){
				$(element).set('html', result); //alert('dungnv');
				$('yt_button_cpanel').setStyle('visibility', 'visible');
		},
		onFailure: function(){
			$(element).set('text', 'Cpanel is not loading!');
		}
	});
	c_ajax.send();
}