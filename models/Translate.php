<?php
/**
 * Jobskee - open source job board 
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 * 
 * Translation class handles multi-lingual translation
 */

class Translate {

	public $lang;

	public function __construct() {
		$this->lang = (parse_ini_file("translations/". APP_LANG . ".ini", true)) ?: parse_ini_file("translations/en.ini", true);
	}

	public function t($var, $val=null) {
		$parts = explode('|', $var);
		if (!$val) {
			return $this->lang[$parts[0]][$parts[1]];
		}
		return str_replace("{{val}}", $val, $this->lang[$parts[0]][$parts[1]]);    
	}

}