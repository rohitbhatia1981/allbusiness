<?php
/*
 * Title: FeedSync REAXML Pre-processor
 * Program URI: https://www.easypropertylistings.com.au/extensions/feedsync/
 * Description: Program created and written to process listing feeds from a wide range of systems in use around the globe. 
 * Supported formats are REAXML, BLM, Expert Agent, Jupix, EAC, Rockend Rest, Core Logic MLS/Rets. Once processed by FeedSync 
 * listings can be imported into your application like WordPress from the dynamic output feeds.
 * 
 * The program will process the input files and store them in a database on your server. The output is generated on the fly 
 * as requested by your import software.
 * Author: Merv Barrett
 * Author URI: http://realestateconnected.com.au/
 * Version: 3.0
 *
 * Copyright 2017 Merv Barrett
 *
 * FeedSync is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as
 * published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


/* Initialise FeedSync Do not edit this file*/

define('FEEDSYNC_HOME',true);
require_once('config.php');
require_once('core/functions.php');


$feedsync_hook->do_action('init');
home();
