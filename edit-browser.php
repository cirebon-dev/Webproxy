<?php
/*******************************************************************
* Glype is copyright and trademark 2007-2016 UpsideOut, Inc. d/b/a Glype
* and/or its licensors, successors and assigners. All rights reserved.
*
* Use of Glype is subject to the terms of the Software License Agreement.
* http://www.glype.com/license.php
*******************************************************************
* This page allows the user to change settings for their "virtual
* browser" - includes disabling/enabling referrers, choosing a user
* agent string
******************************************************************/


/*****************************************************************
* Initialize glype
******************************************************************/

require 'includes/init.php';

# Stop caching
sendNoCache();

# Start buffering
ob_start();


/*****************************************************************
* Create content
******************************************************************/

# Return without saving button
$return		 = empty($_GET['return']) ? '' : '<input type="button" value="Cancel" onclick="window.location=\'' . remove_html($_GET['return']) . '\'">';
$returnField = empty($_GET['return']) ? '' : '<input type="hidden" value="' . remove_html($_GET['return']) . '" name="return">';
$agent		 = empty($_SERVER['HTTP_USER_AGENT']) ? '' : htmlentities($_SERVER['HTTP_USER_AGENT']);

# Quote strings
function escape_single_quotes($value) {
	return str_replace("'", "\'", $value);
}
function remove_html($x) {
	$x = preg_replace('#"#', '', $x);
	$x = preg_replace("#'#", '', $x);
	$x = preg_replace('#<#', '', $x);
	$x = preg_replace('#>#', '', $x);
	$x = preg_replace('#\\\\#', '', $x);
	return $x;
}

# Get existing values
$browser		  = $_SESSION['custom_browser'];

$currentUA		  = escape_single_quotes($browser['user_agent']);
$realReferrer	  = $browser['referrer'] == 'real' ? 'true' : 'false';
$customReferrer  = $browser['referrer'] == 'real' ? ''	  : escape_single_quotes($browser['referrer']);

echo <<<OUT
	<script type="text/javascript">
		// Update custom ua field with value of currently selected preset
		function updateCustomUA(select) {

			// Get value
			var newValue = select.value;

			// Custom field
			var customField = document.getElementById('user-agent');

			// Special cases
			switch ( newValue ) {
				case 'none':
					newValue = '';
					break;
				case 'custom':
					customField.focus();
					return;
			}

			// Set new value
			customField.value = newValue;
		}

		// Set select box to "custom" field when the custom text field is edited
		function setCustomUA() {
			var setTo = document.getElementById('user-agent').value ? 'custom' : '';
			setSelect(document.getElementById('user-agent-presets'), setTo);
		}

		// Set a select field by value
		function setSelect(select, value) {
			for ( var i=0; i < select.length; ++i ) {
				if ( select[i].value == value ) {
					select.selectedIndex = i;
					return true;
				}
			}
			return false
		}

		// Clear custom-referrer text field if real-referrer is checked
		function clearCustomReferrer(checkbox) {
			if ( checkbox.checked ) {
				document.getElementById('custom-referrer').value = '';
			}
		}

		// Clear real-referrer checkbox if custom-referrer text field is edited
		function clearRealReferrer() {
			document.getElementById('real-referrer').checked = '';
		}

		// Add domready function to set form to current values
		window.addDomReadyFunc(function() {
			document.getElementById('user-agent').value			= '{$currentUA}';
			if ( setSelect(document.getElementById('user-agent-presets'), '{$currentUA}') == false ) {
				setCustomUA();
			}
			document.getElementById('real-referrer').checked	= {$realReferrer};
			document.getElementById('custom-referrer').value	= '{$customReferrer}';
		});
	</script>

	<h2 class="first">Edit Browser</h2>
	<p>You can adjust the settings for your "virtual browser" below. These options affect the information the proxy sends to the target server.</p>
	<form action="includes/process.php?action=edit-browser" method="post">

		<table cellpadding="2" cellspacing="0" align="center" class="large-table">
			<tr>
				<th colspan="2">User Agent (<a style="cursor:help;" onmouseover="tooltip('Your user agent is sent to the server and identifies the software you are using to access the internet.')" onmouseout="exit()">?</a>)</th>
			</tr>
			<tr>
				<td width="150">Choose from presets:</td>
				<td>
					<select id="user-agent-presets" onchange="updateCustomUA(this)">
						<option value="Mozilla/5.0 (Macintosh; Intel Mac OS X 13_5_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36 Edg/116.0.1938.69">PC (Mac OS)</option>
					<option value="Mozilla/5.0 (Linux; Android 12; Pixel 5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Mobile Safari/537.36">Mobile (Android)</option>
					
					<option value="Mozilla/5.0 (iPhone; CPU iPhone OS 14_0_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/14.0 Mobile/15E148 Safari/604.1">Mobile (Ios)</option>
						<option value="Zen X38/MAUI WAP Browser">WAP Browser</option>
						<<option value="{$agent}"> - Current/Real</option>
						<option value=""> - None</option>
						<option value="custom"> - Custom...</option>			  
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="text" id="user-agent" name="user-agent" class="full-width" onchange="setCustomUA();">
				</td>
			</tr>
			<tr>
				<td colspan="2" class="small-note"><b>Note:</b> some websites may adjust content based on your user agent.</td>
			</tr>
		</table>

		<table cellpadding="2" cellspacing="0" align="center" class="large-table">
			<tr>
				<th colspan="2">Referrer (<a style="cursor:help;" onmouseover="tooltip('The URL of the referring page is normally sent to the server. You can override this to a custom value or set to send no referrer for extra privacy.')" onmouseout="exit()">?</a>)</th>
			</tr>
			<tr>
				<td width="150">Send real referrer:</td>
				<td><input type="checkbox" name="real-referrer" id="real-referrer" onclick="clearCustomReferrer(this)"></td>
			</tr>
			<tr>
				<td>Custom referrer:</td>
				<td><input type="text" name="custom-referrer" id="custom-referrer" class="full-width" onchange="clearRealReferrer()"></td>
			</tr>
			<tr>
				<td colspan="2" class="small-note"><b>Note:</b> some websites may validate your referrer and deny access if set to an unexpected value</td>
			</tr>
		</table>

		<br>

		<div style="text-align: center;"><input type="submit" value="Save"> {$return}</div>

		{$returnField}

	</form>
OUT;


/*****************************************************************
* Send content wrapped in our theme
******************************************************************/

# Get buffer
$content = ob_get_contents();

# Clear buffer
ob_end_clean();

# Print content wrapped in theme
echo replaceContent($content);
