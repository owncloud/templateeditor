<?php

namespace OCA\TemplateEditor;

use OCP\Settings\ISettings;
use OCP\Template;

class AdminPanel implements ISettings {

	public function getSectionID() {
		return 'general';
	}

	public function getPanel() {
		$themes = \OCA\TemplateEditor\MailTemplate::getEditableThemes();
		$editableTemplates = \OCA\TemplateEditor\MailTemplate::getEditableTemplates();
		$tmpl = new Template('templateeditor', 'settings-admin');
		$tmpl->assign('themes', $themes);
		$tmpl->assign('editableTemplates', $editableTemplates);
		return $tmpl;
	}

	public function getPriority() {
		return 5;
	}


}