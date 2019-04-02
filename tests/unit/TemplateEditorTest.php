<?php

namespace OCA\TemplateEditor\Tests\Unit;

use OC\Helper\EnvironmentHelper;
use OCA\TemplateEditor\TemplateEditor;
use OCP\App\IAppManager;
use OCP\IL10N;
use OCP\Theme\IThemeService;
use Test\TestCase;

class TemplateEditorTest extends TestCase {

	/**
	 * @var IThemeService | \PHPUnit\Framework\MockObject\MockObject
	 */
	private $themeService;

	/**
	 * @var IAppManager | \PHPUnit\Framework\MockObject\MockObject
	 */
	private $appManager;

	/**
	 * @var EnvironmentHelper | \PHPUnit\Framework\MockObject\MockObject
	 */
	private $environmentHelper;

	/**
	 * @var IL10N | \PHPUnit\Framework\MockObject\MockObject
	 */
	private $l10n;

	protected function setUp() {
		parent::setUp();
		$this->themeService = $this->getMockBuilder(IThemeService::class)
			->disableOriginalConstructor()
			->getMock();

		$this->appManager = $this->getMockBuilder(IAppManager::class)
			->disableOriginalConstructor()
			->getMock();

		$this->environmentHelper = $this->getMockBuilder(EnvironmentHelper::class)
			->disableOriginalConstructor()
			->getMock();

		$this->l10n = $this->getMockBuilder(IL10N::class)
			->disableOriginalConstructor()
			->getMock();
	}

	public function testBaseTemplates() {
		$templateEditor = new TemplateEditor(
			$this->themeService,
			$this->appManager,
			$this->environmentHelper,
			$this->l10n
		);

		$templates = $templateEditor->getEditableTemplates();
		$this->assertEquals(7, \count($templates));
	}

	public function testBaseAndFooterTemplates() {
		$serverRoot = '/var/www';
		$templateEditor = $this->getMockBuilder(TemplateEditor::class)
			->setConstructorArgs(
				[
					$this->themeService,
					$this->appManager,
					$this->environmentHelper,
					$this->l10n
				]
			)
			->setMethods(['fileExists'])
			->getMock();

		$this->environmentHelper->expects($this->any())
			->method('getServerRoot')
			->willReturn($serverRoot);

		$templateEditor->expects($this->any())
			->method('fileExists')
			->willReturnCallback(
				function ($path) use ($serverRoot) {
					return \in_array(
						$path,
						[
							$serverRoot . '/core/templates/html.mail.footer.php',
							$serverRoot . '/core/templates/plain.mail.footer.php'
						]
					);
				}
			);

		$templates = $templateEditor->getEditableTemplates();
		$this->assertEquals(9, \count($templates));
	}
}
