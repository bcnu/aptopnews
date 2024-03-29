<?php
/**
 * @package YTools
 * @version $Id$
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2009-2011 YouTech Company. All Rights Reserved.
 * @author YouTech Company
 *
 */

defined('_YTOOLS') or die('include yloader.php instead of');

abstract class YTools {
	/**
	 * YTools_Image class instance
	 * Use for image processing.
	 * @var object
	 */
	private static $image	= null;
	
	/**
	 * Current module
	 * @var object
	 */
	private static $module	= null;
	
	/**
	 * Set current module to work with
	 * @param object $module
	 */
	public static function setModule($module=null){
		self::$module = $module;
	}
	
	/**
	 * Return current module
	 * @return $module
	 */
	public static function getModule(){
		if ( self::$module === null ){
			$module = new stdClass();
			$module->module = 'ytools';
			self::$module = $module;
		}
		return self::$module;
	}
	
	/**
	 * Get Ytools_Image object and set source image before.
	 * @param string $image_file
	 */
	public static function getImage($image_file){
		return self::_getImage()->reset()->load($image_file);
	}
	
	/**
	 * Resize an image to $width x $height.
	 * @param string $image - Is real path or url of image file.
	 * @param int $width
	 * @param int $height
	 * @param array $config
	 * @return image url from image cache.
	 */
	public static function resize($image, $width, $height=null, $config=array()){
		if (self::isUrl($image)){
			$get_url_cache = self::getRemoteFile($image);
			if (is_array($get_url_cache)){
				$image = array_pop($get_url_cache);
			} else {
				return $image;
			}
		}
		
		//self::_getImage()->applyConfig($config);
		self::_getImage()->load($image)->resize($width, $height);
		$abs_image_path = (string)self::_getImage()->save();
		return str_replace(array(JPATH_SITE, DS), array(JURI::base(true), '/'), $abs_image_path);
	}
	
	/**
	 * Cache folder for current module
	 * 
	 */
	public static function getModuleCache(){
		$cache = JPATH_CACHE . DS . self::getModule()->module;
		if(!file_exists($cache)){
			@mkdir($cache, 0755, true);
		}
		return $cache;
	}
	
	/**
	 * Include javascript files
	 * @param string $filename
	 */
	public static function script($filename){
		$js_files = self::_getRelativePaths($filename, true, 'js');
		//self::dump($js_files);
		
		$document = &JFactory::getDocument();
		foreach ($js_files as $include) {
			$document->addScript($include);
		}
	}
	
	/**
	 * Include stylesheet files
	 * @param string $filename
	 * @param string $type
	 * @param string $media
	 * @param Array $attribs
	 */
	public static function stylesheet($filename, $type = 'text/css', $media = null, $attribs = array()){
		$css_files = self::_getRelativePaths($filename, true, 'css');
		//self::dump($css_files);
		
		$document = &JFactory::getDocument();
		foreach ($css_files as $include) {
			$document->addStylesheet($include, $type, $media, $attribs);
		}
	}
	
	/**
	 * Find layout files.
	 * @param string $layout_name
	 */
	public static function layout($layout_name=null){
		if (is_null($layout_name)){
			$layout_name = 'default.php';
		} else if (false===strpos($layout_name, '.')){
			$layout_name .= '.php';
		}
		$layout_files = self::_getRelativePaths($layout_name, true, 'tmpl');
		return $layout_files;
	}
	
	private static function _getRelativePaths($filename, $detect_browser=true, $folder){
		if (self::isUrl($filename)){
			$includes = array($filename);
		} else {
			if ($detect_browser){
				$navigator	= JBrowser::getInstance();
				$browser	= $navigator->getBrowser();
				$major		= $navigator->getMajor();
				$minor		= $navigator->getMinor();
				$ext		= JFile::getExt($filename);
				$strip		= JFile::stripExt($filename);
				
				// Try to include files named filename.ext, filename_browser.ext, filename_browser_major.ext, filename_browser_major_minor.ext
				// where major and minor are the browser version names
				$potential = array($filename, $strip.'_'.$browser.'.'.$ext,  $strip.'_'.$browser.'_'.$major.'.'.$ext, $strip.'_'.$browser.'_'.$major.'_'.$minor.'.'.$ext);
			} else {
				$potential = array($filename);
			}
			
			$app = JFactory::getApplication();
			$template = $app->getTemplate();

			// Prepare array of files
			$includes = array();
			if ($folder==='tmpl'){
				$includes_PATH = array(
					'templates' . DS . $template . DS . 'html' . DS . self::getModule()->module . DS,
					'modules' . DS . self::getModule()->module . DS . $folder . DS				
				);
			} else {
				$includes_PATH = array(
					'templates' . DS . $template . DS . 'html' . DS . self::getModule()->module . DS . 'assets' . DS . $folder . DS,
					'templates' . DS . $template . DS . 'html' . DS . self::getModule()->module . DS . 'assets' . DS,
					'templates' . DS . $template . DS . 'html' . DS . self::getModule()->module . DS . $folder  . DS,
					'templates' . DS . $template . DS . 'html' . DS . self::getModule()->module . DS,

					'modules' . DS . self::getModule()->module . DS . 'assets' . DS . $folder . DS,
					'modules' . DS . self::getModule()->module . DS . 'assets' . DS,
					'modules' . DS . self::getModule()->module . DS . $folder  . DS,				
					'modules' . DS . self::getModule()->module . DS
				);
			}
			
			foreach ($potential as $file){
				foreach ($includes_PATH as $path){
					//echo "<br>Check file: " . $path . $file;
					if (file_exists($path . $file)){
						$file_url = str_replace(DS, '/', $path . $file);
						array_push($includes, $file_url);
						break;
					}
				}
			}
		}
		return $includes;
	}
	
	/**
	 * Human readable date format
	 * @param int $timestamp
	 * @param int $granularity
	 * @param string $format
	 */
	public static function timeAgo($timestamp, $granularity=2, $format='Y-m-d H:i:s'){
		$difference = time() - $timestamp;
		if($difference < 0){
			return '0 seconds ago';
		} elseif ($difference < 864000){
			$periods = array('week' => 604800,'day' => 86400,'hr' => 3600,'min' => 60,'sec' => 1);
			$output = '';
			foreach($periods as $key => $value){
				if($difference >= $value){
					$time = round($difference / $value);
					$difference %= $value;
					$output .= ($output ? ' ' : '').$time.' ';
					$output .= (($time > 1 && $key == 'day') ? $key.'s' : $key);
					$granularity--;
				}
				if($granularity == 0) break;
			}
			return ($output ? $output : '0 seconds').' ago';
		}
		return date($format, $timestamp);
	}
	
	/**
	 * Validate an url
	 * @param string $url
	 */
	public static function isUrl($url){
		if(preg_match('/^(https?)\:\/\/[a-z0-9+\$_-]+(\.[a-z0-9+\$_-]+)*/', $url)){
			return true;
		}
		return false;
	}
	
	/**
	 * Validate an email
	 * @param string $email
	 * @return boolean
	 */
	public static function isEmail($email){
		if(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $email)){
			return true;
		}
		return false;
	}
	
	/**
	 * Parse and build target attribute for links.
	 * @param string $value (_self, _blank, _windowopen, _modal)
	 */
	public static function parseTarget($value='_self'){
		$target = '';
		switch($value){
			default:
			case '0':
			case '_self':
				break;
			case '1':
			case '_blank':
				$target = "target=\"_blank\"";
				break;
			case '2':
			case '_windowopen':
				$target = "onclick=\"window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,false');return false;\"";
				break;
			case '3':
			case '_modal':
				$target = "";
				break;
		}
		return $target;
	}
	
	/**
	 * Truncate string by $length
	 * @param string $string
	 * @param int $length
	 * @param string $etc
	 * @return string
	 */
	public static function truncate($string, $length, $etc='...'){
		if ($length==0){
			return '';
		}
		return defined('MB_OVERLOAD_STRING')
		? self::_mb_truncate($string, $length, $etc)
		: self::_truncate($string, $length, $etc);
	}
	
	/**
	 * Truncate string if it's size over $length
	 * @param string $string
	 * @param int $length
	 * @param string $etc
	 * @return string
	 */
	private static function _truncate($string, $length, $etc='...'){
		if ($length>=0 && $length<strlen($string)){
			$buffer = '';
			$buffer_length = 0;
			$parts = preg_split('/(<[^>]*>)/', $string, -1, PREG_SPLIT_DELIM_CAPTURE);
			$self_closing_tag = split(',', 'area,base,basefont,br,col,frame,hr,img,input,isindex,link,meta,param,embed');
				
			foreach($parts as $i => $s){
				if( false===strpos($s, '<') ){
					$s_length = strlen($s);
					if ($buffer_length + $s_length < $length){
						$buffer .= $s;
						$buffer_length += $s_length;
					} else if ($buffer_length + $s_length == $length) {
						if ( !empty($etc) ){
							$buffer .= ($s[$s_length - 1]==' ') ? $etc : " $etc";
						}
						break;
					} else {
						$words = preg_split('/([^\s]*)/', $s, - 1, PREG_SPLIT_DELIM_CAPTURE);
						$space_end = false;
						foreach ($words as $w){
							if ($w_length = strlen($w)){
								if ($buffer_length + $w_length < $length){
									$buffer .= $w;
									$buffer_length += $w_length;
									$space_end = (trim($w) == '');
								} else {
									if ( !empty($etc) ){
										$more = $space_end ? $etc : " $etc";
										$buffer .= $more;
										$buffer_length += strlen($more);
									}
									break;
								}
							}
						}
						break;
					}
				} else {
					preg_match('/^<([\/]?\s?)([a-zA-Z0-9]+)\s?[^>]*>$/', $s, $m);
					//$tagclose = isset($m[1]) && trim($m[1])=='/';
					if (empty($m[1]) && isset($m[2]) && !in_array($m[2], $self_closing_tag)){
						array_push($open, $m[2]);
					} else if (trim($m[1])=='/') {
						$tag = array_pop($open);
						if ($tag != $m[2]){
							// uncomment to to check invalid html string.
							// die('invalid close tag: '. $s);
						}
					}
					$buffer .= $s;
				}
			}
			// close tag openned.
			while(count($open)>0){
				$tag = array_pop($open);
				$buffer .= "</$tag>";
			}
			return $buffer;
		}
		return $string;
	}
	
	/**
	 * Truncate mutibyte string if it's size over $length
	 * @param string $string
	 * @param int $length
	 * @param string $etc
	 * @return string
	 */
	private static function _mb_truncate($string, $length, $etc='...'){
		$encoding = mb_detect_encoding($string);
		if ($length>=0 && $length<mb_strlen($string, $encoding)){
			$buffer = '';
			$buffer_length = 0;
			$parts = preg_split('/(<[^>]*>)/', $string, -1, PREG_SPLIT_DELIM_CAPTURE);
			$self_closing_tag = explode(',', 'area,base,basefont,br,col,frame,hr,img,input,isindex,link,meta,param,embed');
			$open = array();
				
			foreach($parts as $i => $s){
				if (false === mb_strpos($s, '<')){
					$s_length = mb_strlen($s, $encoding);
					if ($buffer_length + $s_length < $length){
						$buffer .= $s;
						$buffer_length += $s_length;
					} else if ($buffer_length + $s_length == $length) {
						if ( !empty($etc) ){
							$buffer .= ($s[$s_length - 1]==' ') ? $etc : " $etc";
						}
						break;
					} else {
						$words = preg_split('/([^\s]*)/', $s, -1, PREG_SPLIT_DELIM_CAPTURE);
						$space_end = false;
						foreach ($words as $w){
							if ($w_length = mb_strlen($w, $encoding)){
								if ($buffer_length + $w_length < $length){
									$buffer .= $w;
									$buffer_length += $w_length;
									$space_end = (trim($w) == '');
								} else {
									if ( !empty($etc) ){
										$more = $space_end ? $etc : " $etc";
										$buffer .= $more;
										$buffer_length += mb_strlen($more);
									}
									break;
								}
							}
						}
						break;
					}
				} else {
					preg_match('/^<([\/]?\s?)([a-zA-Z0-9]+)\s?[^>]*>$/', $s, $m);
					//$tagclose = isset($m[1]) && trim($m[1])=='/';
					if (empty($m[1]) && isset($m[2]) && !in_array($m[2], $self_closing_tag)){
						array_push($open, $m[2]);
					} else if (trim($m[1])=='/') {
						$tag = array_pop($open);
						if ($tag != $m[2]){
							// uncomment to to check invalid html string.
							// die('invalid close tag: '. $s);
						}
					}
					$buffer .= $s;
				}
			}
			// close tag openned.
			while(count($open)>0){
				$tag = array_pop($open);
				$buffer .= "</$tag>";
			}
			return $buffer;
		}
		return $string;
	}
	
	/**
	 * Extract images tag from $text
	 * @param string $text
	 * @return array src of images:
	 */
	public static function extractImages(&$text){
		$searchTags = array(
			'img' 		=> '/<img[^>]+>/i',
			'input' 	=> '/<input[^>]+type\s?=\s?"image"[^>]+>/i'
		);
		$searchSrc = '/src\s?=\s?"([^"]*)"/i';
		$images	 = array();
		foreach ($searchTags as $tag => $regex){
			preg_match_all($regex, $text, $m);
			if (count($m)){
				foreach ($m[0] as $htmltag){
					preg_match_all($searchSrc, $htmltag, $msrc);
					if (count($msrc) && isset($msrc[1])){
						foreach ($msrc[1] as $src){
							array_push($images, $src);
						}
					}
					$text = str_replace($htmltag, '', $text);
				}
			}
		}
		return $images;
	}
	
	/**
	 * Get content of remote file and save it to cache.
	 * @param string $url
	 */
	public static function getRemoteFile($url){
		if (self::isUrl($url)){
			$infourl = self::parseUrl($url);
			if (isset($infourl['path'])){
				preg_match("/^\/[^\.]+\.([^\/]+)$/", $infourl['path'], $ext);
				if (isset($ext[1])){
					$ext = $ext[1];
				} else {
					$ext = 'cache';
				}
			}
			$filename = JPATH_CACHE . DS . md5($url) . ".$ext";
			if (file_exists($filename)){
				// cache exists
				return array($filename);
			}
			$content = '';
			if ( function_exists('curl_init') ){
				// initialize a new curl resource
				$ch = curl_init();
		
				// set the url to fetch
				curl_setopt($ch, CURLOPT_URL, $url);
		
				// don't give me the headers just the content
				curl_setopt($ch, CURLOPT_HEADER, 0);
		
				// return the value instead of printing the response to browser
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
				// use a user agent to mimic a browser
				curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; rv:8.0.1) Gecko/20100101 Firefox/8.0.1');
		
				$content = curl_exec($ch);
		
				// remember to always close the session and free all resources
				curl_close($ch);
				if (!$content){
					return "<br>Cannot get content of file.";
				}
			} else if ( ini_get('allow_url_fopen')==1 ){
				$content = file_get_contents($url);
				if (!$content){
					return "Cannot get content of file.";
				}
			} else {
				$host = $infourl['host'];
				$path = isset($infourl['path']) ? $infourl['path'] : '/';
				if (isset($infourl['query'])){
					$path .= '?' . $infourl['query'];
				}
				$port = isset($infourl['port']) ? $infourl['port'] : 80;
				$timeout = 10;
		
				$fp = @fsockopen($host, $port, $errno, $errstr, $timeout);
		
				if (!$fp){
					return "Cannot retrieve $url";
				} else {
					fputs($fp,	"GET $path HTTP/1.0\r\n" .
								"Host: $host\r\n" .
								"User-Agent: Mozilla/5.0 (Windows NT 6.1; rv:8.0.1) Gecko/20100101 Firefox/8.0.1\r\n" .
								"Accept: */*\r\n" .
								"Accept-Language: en-us,en;q=0.5\r\n" .
								"Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\n" .
								"Keep-Alive: 300\r\n" .
								"Connection: keep-alive\r\n" .
								"Referer: http://$host\r\n\r\n");
								
					while ( $line = fread($fp, 4096) ){
						$content .= $line;
					}
					fclose($fp);
		
					// strip the headers
					$pos		= strpos($content, "\r\n\r\n");
					$content	= substr($content, $pos + 4);
				}
			}
			if ($content){
				// file_put_contents($filename, $content);
				// return array($filename);
				return self::writeToFile($filename, $content);
			}
		} else {
			return "Invalid Url.";
		}
	}
	
	/**
	 * Write $content to file. Check and create folder if it is not exists.
	 * @param string $filename
	 * @param string $content
	 * @param boolean $override
	 */
	public static function writeToFile($filename, $content, $overwrite=true){
		$file_exists = file_exists($filename);
		if (!$overwrite && $file_exists){
			return "File exists!";
		} else if (!$file_exists){
			// create folder if need.
			$pathname = dirname($filename);
			if (!file_exists($pathname)){
				mkdir($pathname, 0755, true);
			}
		}
		$fh = fopen($filename, 'w') or die("YTools::writeToFile - Can't open file: $filename");
		fwrite($fh, $content);
		fclose($fh);
		return array($filename);
	}

	/**
	 * Joomla! JString::parse url
	 * @param string $url
	 */
	public static function parseUrl($url){
		$result = array();
		// Build arrays of values we need to decode before parsing
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "$", ",", "/", "?", "%", "#", "[", "]");
		// Create encoded URL with special URL characters decoded so it can be parsed
		// All other charcters will be encoded
		$encodedURL = str_replace($entities, $replacements, urlencode($url));
		// Parse the encoded URL
		$encodedParts = parse_url($encodedURL);
		// Now, decode each value of the resulting array
		foreach ($encodedParts as $key => $value) {
			$result[$key] = urldecode($value);
		}
		return $result;
	}

	/**
	 * debug variable
	 * @param unknown_type $var
	 * @param string $label
	 * @param boolean $echo
	 * @return string
	 */
	public static function dump($var, $label=null, $echo=true){
		// format the label
		$label = ($label===null) ? '' : rtrim($label) . ' ';

		// var_dump the variable into a buffer and keep the output
		ob_start();
		var_dump($var);
		$output = ob_get_clean();

		// neaten the newlines and indents
		$output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);

		if(!extension_loaded('xdebug')) {
			$output = htmlspecialchars($output, ENT_QUOTES);
		}

		$output = '<pre>' . $label . $output . '</pre>';

		if ($echo) {
			echo($output);
		}
		return $output;
	}

	/**
	 * Include class file use YTools is namespace.
	 * @param string $object - suffix class name.
	 * eg. image -> import YTools_Image class.
	 */
	private static function _import($object){
		$filename = _YTOOLS_BASE . DS . 'ytools_' . strtolower($object) . '.php';
		if(file_exists($filename)){
			include_once  $filename;
		} else {
			die('YTools::_import - File: ' . $filename . ' is not exists!');
		}
	}

	/**
	 * Get instance of YTools_Image
	 *
	 */
	private static function _getImage(){
		if( self::$image === null ){
			self::_import('image');
			self::$image = &YTools_Image::getInstance();
		}
		return self::$image;
	}

	/**
	 * @deprecated
	 * Set config for Image class in self::resize is recommended.
	 * @param Array $conf
	 */
	public static function getImageResizerHelper($conf=array()){
		isset($conf['background']) && self::_getImage()->setBackground($conf['background']);
		isset($conf['thumbnail_mode']) && self::_getImage()->setFunction('resize_'.$conf['thumbnail_mode']);
	}

	/**
	 * @deprecated
	 * Use self::getModuleCache instead of
	 * @return cahce path for current module
	 */
	public static function getCache(){
		return self::getModuleCache();
	}

	/**
	 * @deprecated
	 * Use self::timeAgo instead of
	 * @param $date
	 * @param $granularity
	 */
	public static function getDateAgo($date, $granularity=2) {
		return self::timeAgo($timestamp, $granularity);
	}

	/**
	 * @deprecated
	 * Use self::parseTarget instead of
	 * @param string $type
	 */
	public static function getTargetAttr($type='_self'){
		return self::parseTarget($type);
	}

	/**
	 * @deprecated
	 * Use self::truncate instead of
	 * @param string $string
	 * @param int $limit_chars
	 */
	public static function shorten($string, $limit_chars=-1){
		return self::truncate($string, $limit_chars);
	}

	/**
	 * @deprecated
	 * Use self::truncate instead of
	 * @param string $str
	 * @param int $limit
	 */
	public static function cut_string($str, $limit=-1){
		return self::_truncate($str, $limit);
	}

	/**
	 * @deprecated
	 * Use self::truncate instead of
	 * @param string $str
	 * @param int $limit
	 */
	public static function mb_shorten($str, $limit=-1){
		return self::_mb_truncate($str, $limit, '...');
	}
}

if (!class_exists('YtUtils')){
	/**
	 * @deprecated
	 * Use YTools is recommended.
	 */
	class YtUtils extends YTools {

		/**
		 * Resize image
		 * @param string $image - Image true path
		 * @param int $width - resize to this width
		 * @param int $height = resize to this height. If null, fit image by 'width'.
		 * @param string $mode - Resize mode
		 * @param int $image_type - IMAGETYPE_PNG, IMAGETYPE_GIF, ...
		 */
		static function resize($image, $width, $height, $mode='stretch', $image_type=null){
			$config = array();
			if (isset($mode)){
				$config['function'] = 'resize_'.$mode;
			}
			if (isset($image_type)){
				$config['output_image_type'] = $image_type;
			}
			parent::resize($image, $width, $height, $config);
		}
	}
}