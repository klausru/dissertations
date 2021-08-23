<?php

/**
 * @file plugins/generic/dissertations/pages/dissertationsHandler.inc.php
 *
 * Copyright (c) 2014-2020 Simon Fraser University
 * Copyright (c) 2003-2020 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @class dissertationsHandler
 * @ingroup plugins_generic_dissertations
 *
 * @brief Handle reader-facing router requests
 */

import('classes.handler.Handler');

class dissertationsHandler extends Handler {

	/**
	 * @copydoc PKPHandler::authorize()
	 */
	function authorize($request, &$args, $roleAssignments) {
		import('lib.pkp.classes.security.authorization.ContextRequiredPolicy');
		$this->addPolicy(new ContextRequiredPolicy($request));

		import('classes.security.authorization.OjsJournalMustPublishPolicy');
		$this->addPolicy(new OjsJournalMustPublishPolicy($request));

		return parent::authorize($request, $args, $roleAssignments);
	}

	/**
	 * View dissertations
	 */
	public function index($args, $request) {
		$this->setupTemplate($request);
		$templateMgr = TemplateManager::getManager($request);
		$context = $request->getContext();
		$plugin = PluginRegistry::getPlugin('generic', 'dissertationsplugin');

		$params = array(
			'contextId' => $context->getId(),
			'orderBy' => 'seq',
			'orderDirection' => 'ASC',
			/** 'count' => $count,
			* 'offset' => $offset, */
			'isPublished' => true,
		);
		$issues = iterator_to_array(Services::get('issue')->getMany($params));

		$dissertations = [];
		foreach ($issues as $issue) {
			if ($issue->getData('isdissertations')){
				$dissertations[] = $issue;
			}
		}

		$templateMgr->assign(array(
			'issues' => $dissertations,
		));

		return $templateMgr->display($plugin->getTemplateResource('dissertations.tpl'));
	}
}
