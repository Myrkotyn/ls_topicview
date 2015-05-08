<?php

/* -- Настройки счетчика посещений топика -- */
/* -- ----------------------------------- -- */

/*
true - считаются посещения всех зарегистрированных/авторизованных пользователей кроме автора;
false - считаются посещени всех пользователей, кроме автора)
*/
$config['OnlyAuthUser'] = false;

/*
true - посещение засчитывается только один раз при открытии топика,
    в дальнейшем при обновлении страницы (F5 в броузере) кол-во посещений не увеличивается;
false - посещение засчитывается каждый раз при обновлении страницы )
*/
$config['NoRefreshTopic'] = false;

return $config;
