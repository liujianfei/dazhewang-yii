<?php
class Weibo extends CWidget
{
    public function init()
    {
        $appKey = Yii::app()->params['weibo']['AppKey'];
        $appSecret = Yii::app()->params['weibo']['AppSecret'];
        $callback = Yii::app()->params['weibo']['callback'];
        $auth = new WeiboOAuth($appKey, $appSecret);
        $keys = $auth->getRequestToken();
        $aurl = $auth->getAuthorizeURL($keys['oauth_token'], false, $callback);
        Yii::app()->session->add('WeiboOAuthKeys', $keys);
    }

    public function run()
    {
    }
}
?>