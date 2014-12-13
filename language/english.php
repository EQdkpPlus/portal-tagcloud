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

$lang = array(
	'weather'					=> 'Weather',
	'weather_desc'				=> 'Shows the weather',
	'weather_name'				=> 'Weather',
	'pk_weather_no_data'		=> 'No Country or ZIP set in your user profile. Weather will only show information if you\'ve set up your Profile information.',
	'pk_weather_tempformat'		=> 'Temperature Format (default: Celcius)',
	'pk_weather_geolocation'	=> 'Use Geolocation-Option of the browser if no location data is setin the user profile?',
	'pk_weather_fulllink'		=> 'Full forecast',
);
?>