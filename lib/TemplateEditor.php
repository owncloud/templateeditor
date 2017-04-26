<?php
/**
 * Created by PhpStorm.
 * User: philipp
 * Date: 19.04.17
 * Time: 16:36
 */

namespace OCA\TemplateEditor;


use OC\Theme\ThemeService;
use OCP\App;

class TemplateEditor {

	/**
	 * @var ThemeService
	 */
	private $themeService;

	/**
	 * TemplateEditor constructor.
	 *
	 * @param ThemeService $themeService
	 */
	public function __construct(ThemeService $themeService) {
		$this->themeService = $themeService;
	}

	/**
	 * @return string[]
	 */
	public function getAllThemeNames() {
		$themes = $this->themeService->getAllThemes();
		$themeNames = [];

		foreach ($themes as $theme) {
			$themeNames[] = $theme->getName();
		}
		return $themeNames;
	}

	/**
	 * @return array
	 */
	public function getEditableTemplates() {
		$l10n = \OC::$server->getL10NFactory()->get('templateeditor');
		$templates = [
			'core/templates/mail.php' => $l10n->t('Sharing email - public link shares (HTML)'),
			'core/templates/altmail.php' => $l10n->t('Sharing email - public link shares (plain text fallback)'),
			'core/templates/internalmail.php' => $l10n->t('Sharing email (HTML)'),
			'core/templates/internalaltmail.php' => $l10n->t('Sharing email (plain text fallback)'),
			'core/templates/lostpassword/email.php' => $l10n->t('Lost password mail'),
			'settings/templates/email.new_user.php' => $l10n->t('New user email (HTML)'),
			'settings/templates/email.new_user_plain_text.php' => $l10n->t('New user email (plain text fallback)'),
		];

		if (App::isEnabled('activity')) {
			$tmplPath = \OC_App::getAppPath('activity') . '/templates/email.notification.php';
			$path = substr($tmplPath, strlen(\OC::$SERVERROOT) + 1);
			$templates[$path] = $l10n->t('Activity notification mail');
		}

		return $templates;
	}

	/**
	 * @param string $themeName
	 * @param string $template
	 * @return MailTemplate
	 */
	public function getMailTemplate($themeName, $template) {
		return new MailTemplate(
			$this->themeService->findTheme($themeName),
			$template
		);
	}

}