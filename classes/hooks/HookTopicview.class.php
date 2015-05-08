<?php

class PluginTopicview_HookTopicview extends Hook
{
    /**
     * Регистрируем хуки
     */
    public function RegisterHook()
    {
        $this->AddHook('init_action', 'InitAction', __CLASS__);
        $this->AddHook('topic_show', 'TopicShow', __CLASS__);
        $this->AddHook('template_topic_show_info','topic_show_info', __CLASS__);
    }

    public function InitAction()
    {
        $this ->Viewer_AppendStyle (Plugin::GetTemplateWebPath (__CLASS__) . 'css/viewcount.css');
    }

    public function TopicShow($aParams)
    {
        $oTopic=$aParams['oTopic'];
        $oUser=$this->User_GetUserCurrent();
        $id = $oTopic->getId();

        if (Config::Get("plugin.topicview.NoRefreshTopic") == true) {
            if (isset($_COOKIE['topicview_cur_topic']) && $id == $_COOKIE['topicview_cur_topic']) {
                setcookie('topicview_cur_topic', $id);

                return false;
            }
            else
            {
                setcookie('topicview_cur_topic', $id);
            }
        }

        // Проверяем авторизован ли юзер
        $is_auth = $this->User_IsAuthorization();
        if ($is_auth) {
            $no_cur = $oUser->getId()!=$oTopic->getUserId();
        }
        else {
            $no_cur = true;
        }

        // Проверяем авторизован ли юзер и является ли автором топика
        if (Config::Get("plugin.topicview.OnlyAuthUser") && $is_auth && $no_cur) {

        }
        else if (!Config::Get("plugin.topicview.OnlyAuthUser") && $no_cur) {

        }
        else
            return;


        if(false === ($data = $this -> Cache_Get("count_topic_{$id}"))) {
            $data = $this->Topic_getCountTopicRead($id);
            $this->Cache_Set($data, "count_topic_{$id}", array("count_change_{$id}"), 60*60*2);
        }
        else {
            $this->Cache_Set($data+1, "count_topic_{$id}", array("count_change_{$id}"), 60*60*2);
        }
    }

    function topic_show_info($aParams)
    {
        $oTopic=$aParams['topic'];
        $id = $oTopic->getId();

        if(false === ($data = $this -> Cache_Get("count_topic_{$id}"))) {
            $data = $this->Topic_getCountTopicRead($id);
            $this->Cache_Set($data, "count_topic_{$id}", array("count_change"), 60*60*2);
        }
//        echo "count_topic_{$id}";
        $this->Viewer_Assign('data',$data);

        return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'inject_topic_show_info.tpl');
    }

}
