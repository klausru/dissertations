{**
 * plugins/generic/dissertations/dissertationsEdit.tpl
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Edit dissertations 
 *
 *}
{fbvFormArea id="dissertations"}
	{fbvFormSection list="true"}
		{fbvElement type="checkbox" id="isdissertations" label="plugins.generic.dissertations.label" checked=$isdissertations|compare:true}
	{/fbvFormSection}
{/fbvFormArea}