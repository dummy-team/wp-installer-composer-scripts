<?php
namespace DummyTeam\WpInstallerComposerScripts;

use Composer\Script\Event;

class Parameters extends Script
{
    public static function getExtras(Event $event)
    {
        $extras = parent::getExtras($event);
        if (!isset($extras['dummyteam-parameters']['parameter-file'])) {
            throw new \InvalidArgumentException('You have to specify settings parameter-file in  extra.dummyteam-parameters settings.');
        }
        if (!isset($extras['dummyteam-parameters']['parameter-target'])) {
            $extras['dummyteam-parameters']['parameter-target'] = $extras['webroot-dir'] .'/wp-config.php';
        }
        return $extras;
    }

    public static function build(Event $event)
    {
        $config = self::getExtras($event);

        print_r($config);
    }

}