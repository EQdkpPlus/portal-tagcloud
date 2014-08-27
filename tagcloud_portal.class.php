<?php
 /*
 * Project:		EQdkp-Plus
 * License:		Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:		2008
 * Date:		$Date: 2012-12-17 13:13:57 +0100 (Mo, 17. Dez 2012) $
 * -----------------------------------------------------------------------
 * @author		$Author: godmod $
 * @copyright	2006-2011 EQdkp-Plus Developer Team
 * @link		http://eqdkp-plus.com
 * @package		eqdkp-plus
 * @version		$Rev: 12604 $
 * 
 * $Id: weather_portal.class.php 12604 2012-12-17 12:13:57Z godmod $
 */

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}

class tagcloud_portal extends portal_generic {
	
	public static $shortcuts = array('puf'	=> 'urlfetcher');
	protected static $path		= 'tagcloud';
	protected static $data		= array(
		'name'			=> 'TagCloud',
		'version'		=> '0.1.0',
		'author'		=> 'GodMod',
		'icon'			=> 'fa-tags',
		'contact'		=> EQDKP_PROJECT_URL,
		'description'	=> 'Shows a Tagcloud for your articles',
	);
	protected static $positions = array('left', 'left', 'right', 'middle', 'bottom');
	
	protected static $apiLevel = 20;

	public function output() {
		$this->tpl->js_file($this->server_path.'portal/tagcloud/js/jqcloud-1.0.4.min.js');
		
		$this->tpl->add_css("
			div.jqcloud a {
			  font-size: inherit;
			  text-decoration: none;
			}
			
			div.jqcloud span.w10 { font-size: 550%; }
			div.jqcloud span.w9 { font-size: 500%; }
			div.jqcloud span.w8 { font-size: 450%; }
			div.jqcloud span.w7 { font-size: 400%; }
			div.jqcloud span.w6 { font-size: 350%; }
			div.jqcloud span.w5 { font-size: 300%; }
			div.jqcloud span.w4 { font-size: 250%; }
			div.jqcloud span.w3 { font-size: 200%; }
			div.jqcloud span.w2 { font-size: 150%; }
			div.jqcloud span.w1 { font-size: 100%; }
			
			/* colors */
			
			div.jqcloud { color: #09f; }
			div.jqcloud a { color: inherit; }
			div.jqcloud a:hover { color: #0df; }
			div.jqcloud a:hover { color: #0cf; }
			div.jqcloud span.w10 { color: #0cf; }
			div.jqcloud span.w9 { color: #0cf; }
			div.jqcloud span.w8 { color: #0cf; }
			div.jqcloud span.w7 { color: #39d; }
			div.jqcloud span.w6 { color: #90c5f0; }
			div.jqcloud span.w5 { color: #90a0dd; }
			div.jqcloud span.w4 { color: #90c5f0; }
			div.jqcloud span.w3 { color: #a0ddff; }
			div.jqcloud span.w2 { color: #99ccee; }
			div.jqcloud span.w1 { color: #aab5f0; }
			
			/* layout */
			
			div.jqcloud {
			  overflow: hidden;
			  position: relative;
			}
			
			div.jqcloud span { padding: 0; }
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