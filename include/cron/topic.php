#!/usr/bin/env php
<?php
$sDirRoot = dirname(realpath((dirname(__FILE__)) . "/../../../"));
set_include_path(get_include_path() . PATH_SEPARATOR . $sDirRoot);
chdir($sDirRoot);

require_once($sDirRoot . "/config/loader.php");
require_once($sDirRoot . "/engine/classes/Cron.class.php");


class TopicCountCacheClean extends Cron
{
    /**
     * Запись кешированных данных в БД и удаление их
     */
    public function Client()
    {
        $array = $this->Topic_getIdAllTopics();

        foreach($array as $id)
        {

//            $s = $this->oEngine->Cache_Set('asdas', "count_topic_{$id['topic_id']}");
            $count = $this->oEngine->Cache_Get("count_topic_{$id['topic_id']}");
//            $count = $this->Cache_Get("count_topic_{$id['topic_id']}");

//            echo $count;
            if(!$count)
            {
                break;
            }
            $this->Topic_updateCountTopic($id['topic_id'], $count);
            $this->Cache_Delete("count_topic_{$id['topic_id']}");
//            echo $id['topic_id']."\n";
        }
    }
}


/**
 * Создаем объект крон-процесса
 */
$app=new TopicCountCacheClean();
print $app->Exec();
