<?php
class TestController extends Controller
{
    public function actionIndex()
    {
        Yii::app()->session->add('test', 'Test Session');

    }

    public function actionTest()
    {
        $session = Yii::app()->getSession();
        Dumper::dump($session['test']);
    }

    public function actionWeibo()
    {
        $appKey = Yii::app()->params['weibo']['AppKey'];
        $appSecret = Yii::app()->params['weibo']['AppSecret'];
        $callback = Yii::app()->params['weibo']['callback'];
        $auth = new WeiboOAuth($appKey, $appSecret);
    }
}
?>