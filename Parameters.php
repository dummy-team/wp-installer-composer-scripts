<?php
namespace DummyTeam\WpInstallerComposerScripts;

use Composer\Script\Event;

class Parameters extends Script
{
    public static function getExtras(Event $event)
    {
        $extras = parent::getExtras($event);
        if (!isset($extras['dummyteam-parameters']['parameter-file'])) {
            throw new \InvalidArgumentException('You must set wordpress config file path in  extra.dummyteam-parameters settings.parameter-file');
        }
        if(!file_exists($extras['dummyteam-parameters']['parameter-file'])) {
            throw new \InvalidArgumentException('File "'.$extras['dummyteam-parameters']['parameter-file'].'" set in extra.dummyteam-parameters.parameter-file doesn\'t exist');
        }
        if (!isset($extras['dummyteam-parameters']['destination-folder'])) {
            $extras['dummyteam-parameters']['destination-folder'] = $extras['webroot-dir'] .'/../';
        }
        return $extras;
    }

    public static function build(Event $event)
    {
        // manage package configuration
        $globalConfig = self::getExtras($event);
        $config = $globalConfig['dummyteam-parameters'];

        // prepare output
        $io = $event->getIO();

        // copy source file to destination
        $distFile = $config['destination-folder'].'wp-config.php.dist';
        if(!file_exists($distFile)) {
            $io->write(sprintf('<info>Create "%s" file</info>', $distFile));
            copy($config['parameter-file'], $distFile);
        }
        $targetFile = $config['destination-folder'].'wp-config.php';
        if(!file_exists($targetFile)) {
            $io->write(sprintf('<info>Create "%s" file</info>', $targetFile));
            copy($config['parameter-file'], $targetFile);
        }
    }

}