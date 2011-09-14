<?php

class Controller extends CController
{
	public $layout = '';
	public $compareExclude = array('login', 'logout', 'error', 'captcha', 'test');

    // 对action的权限验证
	protected function beforeAction($action)
	{
	    //Yii::app()->cache->flush();
	    if (in_array($action->id, $this->compareExclude)) return true;
	    $isAjax = isset($this->actionParams['isAjax']) ? $this->actionParams['isAjax'] : false;
	    $tabid = isset($this->actionParams['tabid']) ? $this->actionParams['tabid'] : "";

	    $user = Yii::app()->user;
	    // login required
        if ($user->isGuest)
        {
            if (Yii::app()->request->urlReferrer == null || Yii::app()->request->urlReferrer === Yii::app()->homeUrl)
                $this->redirect(array('site/login'), false);
            else
                $this->error('登陆超时，请重新登陆！', '', true, 301);
            return false;
        }

        // check access
	    $authName = $this->id.'/'.$action->id;
        if ($user->checkAccess($authName))
            return true;
        else
            $this->error('您没有权限执行本操作', $isAjax, $tabid);
        return false;
	}

	public function createUrl($route = '', $params = array(), $ampersand = '&')
	{
	    if (strpos($route, 'http://') !== false) return $route;
	    return parent::createUrl($route, $params, $ampersand);
	}

	public function error($message, $tabid = '', $isForm = false, $errorCode = 300)
	{
	    if ($isForm)
	    {
	        $result = array('statusCode'=>$errorCode, 'message'=>$message, 'navTabId'=>$tabid);
    	    echo json_encode($result);
    	    Yii::app()->end();
	    }
	    else
	        $this->redirect($this->createUrl('site/error',
	            array('message'=>$message, 'tabid'=>$tabid)));
	}

	public function success($message, $tabid = '', $isForm = true)
	{
	    if ($isForm)
	    {
	        $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>$tabid);
    	    echo json_encode($result);
	    }
	    else
	    {
	        $output = "<script type=\"text/javascript\">";
            $output .= "alertMsg.success('{$message}');";
            if (!empty($tabid)) $output .= "navTab.closeTab('{$tabid}');";
            $output .= "</script>";
            echo $output;
	    }
        Yii::app()->end();
	}

	public function getActionParams()
	{
	    return $_GET + $_POST;
	}
}