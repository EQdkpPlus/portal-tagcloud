<?php
/*	Project:	EQdkp-Plus
 *	Package:	Tag cloud Portal Module
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}

class tagcloud_portal extends portal_generic {
	
	public static $shortcuts = array('puf'	=> 'urlfetcher');
	protected static $path		= 'tagcloud';
	protected static $data		= array(
		'name'			=> 'TagCloud',
		'version'		=> '0.2.0',
		'author'		=> 'GodMod',
		'icon'			=> 'fa-tags',
		'contact'		=> EQDKP_PROJECT_URL,
		'description'	=> 'Shows a Tagcloud for your articles',
		'lang_prefix'           => 'tagcloud_',
	);
	protected static $positions = array('left', 'left', 'right', 'middle', 'bottom');
	protected $settings	= array(
		'style'	=> array(
			'type'		=> 'dropdown',
			'options'	=> ['Text', 'Bubbles'],
			'default'	=> 0,
		),
	);
	protected static $apiLevel = 20;

	public function output() {
		$this->tpl->js_file($this->server_path.'portal/tagcloud/js/jqcloud-1.0.4.min.js');
		
		$this->tpl->add_css("
			div.jqcloud { color: #09f; overflow: hidden; position: relative; }
			div.jqcloud a { color: #333; font-size: inherit; text-decoration: none; }
			div.jqcloud a:hover { color: #fff; }
			div.jqcloud span { padding: 0; }
			div.jqcloud span.w10 { font-size: 550%; color: #0cf; }
			div.jqcloud span.w9 { font-size: 500%; color: #0cf; }
			div.jqcloud span.w8 { font-size: 450%; color: #0cf; }
			div.jqcloud span.w7 { font-size: 400%; color: #39d; }
			div.jqcloud span.w6 { font-size: 350%; color: #90c5f0; }
			div.jqcloud span.w5 { font-size: 300%; color: #90a0dd; }
			div.jqcloud span.w4 { font-size: 250%; color: #90c5f0; }
			div.jqcloud span.w3 { font-size: 200%; color: #a0ddff; }
			div.jqcloud span.w2 { font-size: 150%; color: #99ccee; }
			div.jqcloud span.w1 { font-size: 100%; color: #aab5f0; }
		");
		if($this->config('style') == 1) $this->tpl->add_css("
			div.jqcloud span { border: 1px solid rgba(152, 152, 152, 0.75); border-radius: 100px / 50px; padding: 5px; box-shadow: 2px 2px 5px #000; }
			div.jqcloud span.w10 { background-color: rgba(0, 204, 255, 0.8); z-index: 10; }
			div.jqcloud span.w9 { background-color: rgba(0, 204, 255, 0.8); z-index: 9; }
			div.jqcloud span.w8 { background-color: rgba(0, 204, 255, 0.8); z-index: 8; }
			div.jqcloud span.w7 { background-color: rgba(51, 153, 221, 0.8); z-index: 7; }
			div.jqcloud span.w6 { background-color: rgba(59, 125, 179, 0.8); z-index: 6; }
			div.jqcloud span.w5 { background-color: rgba(90, 110, 188, 0.8); z-index: 5; }
			div.jqcloud span.w4 { background-color: rgba(71, 137, 191, 0.8); z-index: 4; }
			div.jqcloud span.w3 { background-color: rgba(84, 194, 255, 0.8); z-index: 3; }
			div.jqcloud span.w2 { background-color: rgba(75, 132, 170, 0.8); z-index: 2; }
			div.jqcloud span.w1 { background-color: rgba(106, 122, 209, 0.8); z-index: 1; }
		");
		
		$arrTags = $this->pdh->get('articles', 'tags_array');
		$arrOutTags = array();
		foreach($arrTags as $strTag => $arrArticleIDs){
			$arrOutTags[] = array('text' => $strTag, 'link' => $this->routing->build('tag', $strTag, false), 'weight' => count($arrArticleIDs));
		}
		
		$this->tpl->add_js('
			
		var word_list = '.json_encode($arrOutTags).';
      $(function() {
        $("#portal-jqcloud").jQCloud(word_list);
      });
				', 'docready');
		
		return '<div id="portal-jqcloud" style="height: 150px;"></div>';
	}

}
?>
