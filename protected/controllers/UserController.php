<?php
class UserController extends Controller
{
    public function actionReg()
    {
    }

    public function actinBind()
    {
    }

    public function actionLogin($from = null)
    {
        if (!empty($from))
        {
            switch (strtolower(trim($from)))
            {
                case 'sinaweibo':
                    break;
                default:
                    break;
            }
        }
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
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionIndex()
    {
    }

    /**
     * 修改个人信息
     * @param integer $id
     */
    public function actionEdit($id = null)
    {
    }

    /**
     * 修改姓名
     * @param integer $id
     * @param string $name
     */
    public function actionChangeName($id = null, $name = null)
    {
    }

    /**
     * 修改密码
     * @param integer $id
     * @param string $old
     * @param string $new
     */
    public function actionChangePwd($id = null, $old = null, $new = null)
    {
    }

    /**
     * 重置密码
     * @param integer $id
     * @param string $email
     */
    public function actionResetPwd($id = null, $email = null)
    {
    }
}
?>