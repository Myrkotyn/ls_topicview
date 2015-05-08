<?php

if (!class_exists('Plugin')) {
    die('Hacking attemp!');
}

class PluginTopicview extends Plugin
{
    protected $aInherits = array(
        'module' => array('ModuleTopic'),
        'mapper' => array('ModuleTopic_MapperTopic'),
    );

    public function Init()
    {

    }

    public function Activate()
    {

        return true;
    }

    public function Deactivate()
    {

        return true;
    }
}
