<?php
class WeiboLogin extends CWidget
{
    public function run()
    {
        $appKey = Yii::app()->params['weibo']['AppKey'];
        $appSecret = Yii::app()->params['weibo']['AppSecret'];
        $callback = $this->controller->createUrl("user/login", array('from'=>'sinaWeibo'));
        $auth = new WeiboOAuth($appKey, $appSecret);
        $keys = $auth->getRequestToken();
        $aurl = $auth->getAuthorizeURL($keys['oauth_token'], false, $callback);
        Yii::app()->session->add('WeiboOAuthKeys', $keys);
        $this->render('WeiboLogin/login', array('aurl'=>$aurl));
    }
}
?>