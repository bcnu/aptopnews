// JavaScript Document
window.addEvent('load', function(){
	if($('module-status')!=null){
		var span = new Element('span', {'class':'yt-clearcache', 'style':'background: url(../plugins/system/yt/includes/images/clean-cache.png) no-repeat left bottom'}).injectTop($('module-status'));
		var clearcache = new Element('a', {
							'href':'javascript:void(0)',
							'events': {
								'click': function(){
									var linkurl = '../index.php?action=clearCache&type=plugin';
									new Request({url: linkurl, method:'post', 
										onSuccess: function(result){
											alert(result);
										},
										onFailure: function(){
											alert('Error ...');
										}
									}).send();
								}
							} 
						}).inject(span);
		clearcache.set('text', 'Clean cache: CSS, JS');
	}
});
