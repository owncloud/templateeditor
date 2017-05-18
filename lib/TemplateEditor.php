<?php
/**
 * @author Philipp Schaffrath <github@philipp.schaffrath.email>
 *
 * @copyright Copyright (c) 2017, ownCloud GmbH
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */
namespace OCA\TemplateEditor;

use OCP\App;
use OCP\Theme\IThemeService;

class TemplateEditor {

	/**
	 * @var IThemeService
	 */
	private $themeService;

	/**
	 * TemplateEditor constructor.
	 *
	 * @param IThemeService $themeService
	 */
	public function __construct(IThemeService $themeService) {
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