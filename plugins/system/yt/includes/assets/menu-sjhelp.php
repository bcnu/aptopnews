<?php 
$span_tip = JHTML::tooltip('- You can remove SJ Help in Yt Plugin<br/>- Thank for using!', '', '', 'SJ Help');
$html .= "
<script type='text/javascript'>
	window.addEvent('domready', function(){
		if($('module-menu')!=null){
			var li = new Element('li', {'id':'li-sjhelp'}).injectBottom($('menu'));
			var help = new Element('a', {
								'style':'color:red; background: url(../plugins/system/yt/includes/images/yt.png) no-repeat 5px center; padding-left:25px',
								'href':'javascript:void(0)',
								'html':'".$span_tip."'
							}).inject(li);
			var ul = new Element('ul', {'id':'ul-sjhelp'}).injectBottom($('li-sjhelp'));
			var li_report = new Element('li').inject($('ul-sjhelp'));
			var li_template = new Element('li').inject($('ul-sjhelp'));
			var li_framework = new Element('li').inject($('ul-sjhelp'));
			
			var report = new Element('a', {
								'href':'http://www.smartaddons.com/forum/index/7-joomla-templates',
								'target':'_blank',
								'html':'Report bugs'
							}).inject(li_report);
			var template = new Element('a', {
								'href':'http://www.smartaddons.com/joomla/templates/template-user-guides',
								'target':'_blank',
								'html':'Template Tutorial'
							}).inject(li_template);
			var framework = new Element('a', {
								'href':'http://www.smartaddons.com/joomla/templates/yt-framework',
								'target':'_blank',
								'html':'Framework Tutorials'
							}).inject(li_framework);
		}
		
		var JTooltips = new Tips($$('.hasTip'), { maxTitleChars: 50, fixed: false}); 
	});
</script>
<style type='text/css'>
	.tip-wrap{z-index:9999;}
</style>
";

?>