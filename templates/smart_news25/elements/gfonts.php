<?php
defined('_JEXEC') or die( 'Restricted access' );
jimport('joomla.html.html');
jimport('joomla.form.formfield');
class JFormFieldGFonts extends JFormField
{

	protected $type = 'fonts';

	protected function getInput() {	
		// Initialize variables.
        $session = JFactory::getSession();
        $options = array();
		$attr = '';
        // Initialize some field attributes.
        $attr .= $this->element['class'] ? ' class="'.(string) $this->element['class'].'"' : '';
        // To avoid user's confusion, readonly="true" should imply disabled="true".
        if ( (string) $this->element['readonly'] == 'true' || (string) $this->element['disabled'] == 'true') { 
            $attr .= ' disabled="disabled"';
        }
        $attr .= $this->element['size'] ? ' size="'.(int) $this->element['size'].'"' : '';
        $attr .= $this->multiple ? ' multiple="multiple"' : '';
        // Initialize JavaScript field attributes.
        $attr .= $this->element['onchange'] ? ' onchange="'.(string) $this->element['onchange'].'"' : '';
		
		$gfont_group = array (
						'latin'=>array(
								'Droid Sans','Droid Serif','Lobster','Yanone Kaffeesatz','Nobile','Reenie Beanie',
								'Tangerine','Neucha','Josefin Slab','OFL Sorts Mill Goudy TT','Molengo','PT Sans',
								'Vollkorn','Just Me Again Down Here','Ubuntu','Cantarell','Inconsolata','Crimson Text',
								'Cardo','Cuprum','Droid Sans Mono','Neuton','Arvo','Philosopher','Old Standard TT','Josefin Sans',
								'Covered By Your Grace','Arimo','IM Fell','Geo','Copse','Raleway','Allerta','Just Another Hand',
								'Tinos','Puritan','Mountains of Christmas','Cabin','Sniglet','Allan','Lato','Orbitron','Vibur',
								'Gruppo','Allerta Stencil','Cousine','Syncopate','Merriweather','Kristi','Anonymous Pro','Coda',
								'Corben','Buda','Bentham','Lekton','UnifrakturMaguntia','UnifrakturCook','Kenia','Rock Salt',
								'Calligraffitti','Cherry Cream Soda','Chewy','Coming Soon','Crafty Girls','Crushed','Fontdiner Swanky',
								'Homemade Apple','Irish Growler','Kranky','Luckiest Guy','Permanent Marker','Schoolbell','Slackey',
								'Sunshiney','Unkempt','Walter Turncoat'
							),
						'Cyrillic'=>array('Anonymous Pro','Cuprum','Neucha','PT Sans','Philosopher','Ubuntu'),
						'Greek'=>array('GFS Didot','GFS Neohellenic','Ubuntu','Anonymous Pro'),
						'Khmer'=>array('Hanuman')
						);
		
		$lists = "";
		$option[] = JHTML::_('select.option', ' ', '-------- None select --------');
		foreach ($gfont_group as $group=>$gfonts) {
			$option[] = JHTML::_('select.optgroup', $group);
			foreach ($gfonts as $gfont) {
				$option[] = JHTML::_('select.option', $gfont, $gfont);
			}
		}
	
		$lists .= JHTML::_('select.genericlist', $option, $this->name, trim($attr), 'value', 'text', $this->value, $this->id );
		//return JHTML::_( 'select.genericlist', $mitems, $this->name,trim($attr), 'value', 'text', $this->value, $this->id ); 
		return $lists;
	}
} 
?>