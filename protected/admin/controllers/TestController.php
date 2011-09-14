<?php
class TestController extends Controller
{
    public function actionTest()
    {
        echo Yii::getPathOfAlias('webroot') ;
    }
}
?>