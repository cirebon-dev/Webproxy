<?php
# declare(strict_types=1);

/*******************************************************************
* WARNING!! this Glype fork version by guangrei or cirebon-dev.
* 
******************************************************************/
/*******************************************************************
* Glype is copyright and trademark 2007-2016 UpsideOut, Inc. d/b/a Glype
* and/or its licensors, successors and assigners. All rights reserved.
*
* Use of Glype is subject to the terms of the Software License Agreement.
* http://www.glype.com/license.php
******************************************************************/

$options['stripJS'] = true;
$options['allowCookies'] = true;

function preRequest() {
	global $URL;
	if ($URL['host'] != 'm.facebook.com') {
		$URL['host'] = preg_replace('/((www\.)?facebook\.com)/', 'm.facebook.com', $URL['host']);
		$URL['href'] = preg_replace('/\/\/((www\.)?facebook\.com)/', '//m.facebook.com', $URL['href']);
	}
}
