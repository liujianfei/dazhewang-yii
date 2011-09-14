<?php

class SiteController extends Controller
{
    public $pageTitle = '';

    public function init()
    {
        $this->cssFiles[] = 'index.css';
        parent::init();
    }

	public function actionIndex()
	{

	    $this->pageTitle = '首页';
		$this->render('index');
	}

	public function actionError()
	{
	    if(($error=Yii::app()->errorHandler->error))
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

}