<?php

class PluginTopicview_ModuleTopic extends PluginTopicview_Inherit_ModuleTopic
{
    /**
     * Увеличивает у топика число просмотров
     *
     * @param unknown_type $sTopicId
     * @return unknown
     */
    public function increaseTopicCountRead($sTopicId)
    {

        return $this->oMapperTopic->increaseTopicCountRead($sTopicId);
    }

    public function getCountTopicRead($id)
    {

        return $this->oMapperTopic->getCountTopicRead($id);
    }


    public function getIdAllTopics()
    {

        return $this->oMapperTopic->getIdAllTopics();
    }

    public function updateCountTopic($id, $count)
    {

        return $this->oMapperTopic->updateCountTopic($id, $count);
    }
}
