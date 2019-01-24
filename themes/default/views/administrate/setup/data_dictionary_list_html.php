<?php
/* ----------------------------------------------------------------------
 * manage/data_dictionary_List_html.php :
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2019 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This source code is free and modifiable under the terms of
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
	$entries 		= $this->getVar('entries');

	$new_menu = '<div class="sf-small-menu form-header-button rounded">'.
		'<div class="caNavHeaderIcon">'.
		'<a href="#" onclick="_navigateToNewForm(jQuery(\'#tableList\').val());">'.caNavIcon(__CA_NAV_ICON_ADD__, 2).'</a>'.
		'</div>'.
		'<form action="#">'._t('New metadata alert rule for ').' '.caHTMLSelect('table_num', caGetPrimaryTablesForHTMLSelect(true), array('id' => 'tableList')).'</form>'.
		'</div>';
?>
<script language="JavaScript" type="text/javascript">
/* <![CDATA[ */
	jQuery(document).ready(function(){
		jQuery('#caMetadataAlertList').caFormatListTable();
	});

	function _navigateToNewForm(table_num) {
		document.location = '<?php print caNavUrl($this->request, 'manage/metadata_alert_rules', 'MetadataAlertRuleEditor', 'Edit', array('entry_id' => 0)); ?>' + '/table_num/' + table_num;
	}
/* ]]> */
</script>
<div class="sectionBox">
	<?php 
		print caFormControlBox(
			'<div class="list-filter">'._t('Filter').': <input type="text" name="filter" value="" onkeyup="$(\'#caMetadataAlertList\').caFilterTable(this.value); return false;" size="20"/></div>',
			'', 
			$new_menu
		);
	?>
	
	<table id="caMetadataAlertList" class="listtable">
		<thead>
			<tr>
				<th class="list-header-unsorted">
					<?php print _t('Name'); ?>
				</th>
				<th class="list-header-unsorted">
					<?php print _t('Entry type'); ?>
				</th>
				<th class="list-header-unsorted">
					<?php print _t('Bundle'); ?>
				</th>
				<th class="list-header-unsorted">
					<?php print _t('Rules'); ?>
				</th>
				<th class="{sorter: false} list-header-nosort listtableEditDelete"> </th>
			</tr>
		</thead>
		<tbody>
<?php
	if (sizeof($entries)) {
		foreach($entries as $entry) {
?>
			<tr>
				<td>
					<div class="caMetadataAlertListName"><?php print $entry['label']; ?></div>
				</td>
				<td>
					<div class="caMetadataAlertListName"><?php print Datamodel::getTableProperty($entry['table_num'], 'NAME_PLURAL'); ?></div>
				</td>
				<td>
					<div class="caMetadataAlertListName"><?php print $entry['bundle_label']." (".$entry['bundle_name'].")"; ?></div>
				</td>
				<td>
					<div><?php print (int)$entry['numRules']; ?></div>
				</td>
				<td class="listtableEditDelete">
					<?php print caNavButton($this->request, __CA_NAV_ICON_EDIT__, _t("Edit"), '', 'administrate/setup/data_dictionary_entries', 'DataDictionaryEntryEditor', 'Edit', array('entry_id' => $entry['entry_id']), array(), array('icon_position' => __CA_NAV_ICON_ICON_POS_LEFT__, 'use_class' => 'list-button', 'no_background' => true, 'dont_show_content' => true, 'rightMargin' => "0px")); ?>
					<?php print caNavButton($this->request, __CA_NAV_ICON_DELETE__, _t("Delete"), '', 'administrate/setup/data_dictionary_entries', 'DataDictionaryEntryEditor', 'Delete', array('entry_id' => $entry['entry_id']), array(), array('icon_position' => __CA_NAV_ICON_ICON_POS_LEFT__, 'use_class' => 'list-button', 'no_background' => true, 'dont_show_content' => true, 'rightMargin' => "0px")); ?>
				</td>
			</tr>
<?php
		}
	} else {
?>
		<tr>
			<td colspan='8'>
				<div align="center">
					<?php print _t('No entries have been created'); ?>
				</div>
			</td>
		</tr>
<?php
	}
	TooltipManager::add('.deleteIcon', _t("Delete"));
	TooltipManager::add('.editIcon', _t("Edit"));
?>
		</tbody>
	</table>
</div>

<div class="editorBottomPadding"><!-- empty --></div>
