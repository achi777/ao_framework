<?php

/**

 * Created by PhpStorm.

 * User: archil

 * Date: 25.11.2015

 * Time: 10:29

 */

session_start();

ob_start();

/*TimeZone*/
date_default_timezone_set("Asia/Tbilisi");

/*PATH*/
include("domain_config.php");

/*DB*/
include("db_config.php");

/********************Pagination***********************/

define('paginationStartTag',"<ul class=\"pagination\">");
define('paginationEndTag',"</ul>");
define('paginationInsideStartTag',"<li>");
define('paginationInsideEndTag',"</li>");
define('paginationCurrentStartTag',"<li class=\"active\">");
define('paginationCurrentEndTag',"</li>");
define('paginationStartPage',"&lt;&lt;");
define('paginationFirstPage',"&lt;");
define('paginationNextPage',"&gt;");
define('paginationEndPage',"&gt;&gt;");