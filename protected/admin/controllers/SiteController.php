<?php
/*
 * 后台管理控制器
 */
class SiteController extends Controller
{
    public $layout = '//layouts/admin';
    public $headMenus;

    public function actions()
    {
        return array(
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor' => 0xffffff,
                'width'=>50,
                'height'=>25,
                'minLength'=>4,
                'maxLength'=>4,
                'padding'=>0,
            ),
        );
    }

    public function actionIndex()
    {
        $this->headMenus = AdminMenu::model()->with('Children')->cache()->findAll("t.parent_id = 0 AND t.status = 1 AND Children.status = 1");
        $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = '';
        if (!Yii::app()->user->isGuest) $this->redirect(Yii::app()->homeUrl);
        $model = new LoginForm;
        if (isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];
            if ($model->validate() && $model->login())
            {
                $this->redirect(Yii::app()->homeUrl, false);
                exit;
            }
        }
        $this->render('login', array('model' => $model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect($this->createUrl("site/login"));
    }

    /**
     *
     * 错误跳转页
     * @param string $message 错误消息
     * @param boolean $isAjax 是否为AJAX提交默认为是
     * @param string $tabid 需要关闭的tabID默认不关闭
     * @param mixed $jumpUrl 自动跳转页面
     * @param int $delay 自动跳转延时默认为5秒
     */
    public function actionError($message, $isAjax = true, $tabid = "", $jumpUrl = array('site/index'), $delay = 5)
    {
        if ($isAjax)
        {
            $output = "<script type=\"text/javascript\">";
            $output .= "alertMsg.error('{$message}');";
            if (!empty($tabid)) $output .= "navTab.closeTab('{$tabid}');";
            $output .= "</script>";
            echo $output;
            Yii::app()->end();
        }
        else
        {

        }
    }

    public function actionMenu($id = null)
    {
        //$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;
        if ($id === null) $this->error('参数传递错误');
        $this->layout = '';
        $menu = AdminMenu::model()->cache()->findByPk($id, "status = 1");
        $this->render('menu', array('menu'=>$menu));
    }
}

?>