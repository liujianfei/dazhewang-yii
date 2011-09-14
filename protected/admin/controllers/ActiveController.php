<?php
class ActiveController extends Controller
{
    public function actionIndex()
    {
        $actives = Active::model()->cache()->findAll();
        $this->render('index', array('actives'=>$actives));
    }

    public function actionEdit($id = null)
    {
        $active = new Active;
        if ($id !== null)
            $active = $active->cache()->findByPk($id);

        if (isset($_POST['Form']))
        {
            $id = $_POST['Form']['id'];
            if (!empty($id))
            {
                $message = '修改成功';
                $active = $active->cache()->findByPk($id);
            }
            else
                $message = '添加成功';

            $active->attributes = $_POST['Form'];
            $upload = CUploadedFile::getInstanceByName('cover_img_small');
            if (!$active->isNewRecord && $upload !== null)
                $active->cover_img_small = $upload;
            $upload = CUploadedFile::getInstanceByName('cover_img_big');
            if (!$active->isNewRecord && $upload !== null)
                $active->cover_img_big = $upload;
            $active->begin_time = strtotime($active->begin_time);
            $active->end_time = strtotime($active->end_time);
            $active->update_time = Yii::app()->params['timestamp'];
            if ($active->save())
                $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>'active-index');
            else
            {
                $error = array_shift($active->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }
            echo json_encode($result);
            Yii::app()->end();
        }
        $categories = ActiveCategory::model()->cache()->findAll();
        $this->render('edit', array('active'=>$active, 'categories'=>$categories));
    }

    public function actionDel(array $id = array())
    {
        if (empty($id))
            $this->error('参数传递错误');
        if (count($id) > 1)
            $this->error('暂不支持批量删除');

        $id = $id[0];
        if (Active::model()->deleteByPk($id) > 0)
            $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'active-index');
        else
            $result = array('statusCode'=>300, 'message'=>'删除失败');
        echo json_encode($result);
        Yii::app()->end();
    }

    public function actionToggleStatus($id = null, $status = null)
    {
        if ($id == null || $status == null)
            $this->error('参数传递错误');

        $active = Active::model()->cache()->findByPk($id);
        $active->status = (int)$status;
        $active->update_time = Yii::app()->params['timestamp'];
        if ($active->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'active-index');
        else
        {
            $error = array_shift($active->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }
        echo json_encode($result);
        Yii::app()->end();
    }

    public function actionChengeSort($id = null, $sort = null)
    {
        if ($id == null || $sort == null)
            $this->error('参数传递错误');

        $active = Active::model()->cache()->findByPk($id);
        $active->sort = $sort;
        $active->update_time = Yii::app()->params['timestamp'];
        if ($active->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'active-index');
        else
        {
            $error = array_shift($active->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }
        echo json_encode($result);
        Yii::app()->end();
    }
}
?>