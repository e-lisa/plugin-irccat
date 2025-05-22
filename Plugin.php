<?php

namespace Kanboard\Plugin\irccat;

use Kanboard\Core\Translator;
use Kanboard\Core\Plugin\Base;

/**
 * irccat Plugin
 *
 * @package  irccat
 * @author   Frederic Guillot
 */
class Plugin extends Base
{
    public function initialize()
    {
        $this->template->hook->attach('template:config:integrations', 'irccat:config/integration');
        $this->template->hook->attach('template:project:integrations', 'irccat:project/integration');
        $this->projectNotificationTypeModel->setType('irccat', t('irccat'), '\Kanboard\Plugin\irccat\Notification\irccat');
    }

    public function onStartup()
    {
        Translator::load($this->languageModel->getCurrentLanguage(), __DIR__.'/Locale');
    }

    public function getPluginDescription()
    {
        return 'Receive notifications on irccat';
    }

    public function getPluginAuthor()
    {
        return 'Lisa Marie';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/kanboard/plugin-irccat';
    }

    public function getCompatibleVersion()
    {
        return '>=1.0.37';
    }
}
