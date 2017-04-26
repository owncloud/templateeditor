<?php

namespace OCA\TemplateEditor;

use OCP\Settings\ISettings;
use OCP\Template;

class AdminPanel implements ISettings {

	/**
	 * @var TemplateEditor
	 */
	private $templateEditor;

	/**
	 * @param TemplateEditor $templateEditor
	 */
	public function __construct(TemplateEditor $templateEditor) {
		$this->templateEditor = $templateEditor;
	}

	/**
	 * @return Template
	 */
	public function getPanel() {
		$template = new Template('templateeditor', 'settings-admin');
		$template->assign('themeNames', $this->templateEditor->getAllThemeNames());
		$template->assign('editableTemplates', $this->templateEditor->getEditableTemplates());
		return $template;
	}

	/**
	 * @return string
	 */
	public function getSectionID() {
		return 'general';
	}

	/**
	 * @return int
	 */
	public function getPriority() {
		return 5;
	}
}
