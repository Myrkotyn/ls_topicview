<?php
class PluginTopicview_ModuleTopic_MapperTopic extends PluginTopicview_Inherit_ModuleTopic_MapperTopic
{

    public function increaseTopicCountRead($sTopicId)
    {
        $sql = "UPDATE ".Config::Get('db.table.topic')."
			SET
				topic_count_read=topic_count_read+1
			WHERE
				topic_id = ?
		";
        if ($this->oDb->query($sql,$sTopicId)) {

            return true;
        }

        return false;
    }

    public function getCountTopicRead($sTopicId)
    {

        $sql = "SELECT topic_count_read FROM ".Config::Get('db.table.topic')." WHERE topic_id = ?";

        if ($res = $this->oDb->query($sql,$sTopicId)) {

            return $res[0]['topic_count_read'];
        }

        return false;
    }

    public function getIdAllTopics()
    {
        $sql = "SELECT topic_id FROM ".Config::Get('db.table.topic')." ";

        if ($res = $this->oDb->query($sql)) {

            return $res;
        }

        return false;
    }

    public function updateCountTopic($id, $count)
    {
        $sql = "UPDATE ".Config::Get('db.table.topic')." SET topic_count_read=".$count."	WHERE topic_id = ".$id."";

        return $this->oDb->query($sql);
    }
}
