<?php
class AdController extends Controller
{
    public function actionIndex($type = null, $numPerPage = null, $pageNum = null)
    {
        $criteria = new CDbCriteria;
        if ($type !== null)
            $criteria->condition = "type = {$type}";

        $ads = Ad::model()->cache()->findAll($criteria);
        $types = $this->actionGetType();
        $this->render('index', array('ads'=>$ads, 'types'=>$types));
    }

    public function actionEdit($id = null)
    {
        $ad = new Ad;
        if ($id !== null)
            $ad = $ad->findByPk($id);
        else
        {
            if (count($this->actionGetType()) == 0)
            {
                echo json_encode(array('statusCode'=>300, 'message'=>'请先添加广告位', 'callback'=>'$.pdialog.closeCurrent();'));
                Yii::app()->end();
            }
        }
        $types = $this->actionGetType();

        if (isset($_POST['Form']))
        {
            if (!empty($_POST['Form']['id']))
            {
                $ad = $ad->findByPk($_POST['Form']['id']);
                $message = '修改成功';
            }
            else
                $message = '新增成功';

            if (isset($types[$_POST['Form']['type']]))
            {
                $type = $types[$_POST['Form']['type']];
                foreach ($type['dom'] as $dom)
                {
                    foreach ($dom['child'] as $dom)
                    {
                        if (strtolower(trim($dom['type'])) == 'file')
                        {
                            $ad->param = CUploadedFile::getInstanceByName($dom['attr']['name']);
                            if (!$ad->validate('param'))
                            {
                                var_dump($ad->param);
                                $error = array_shift($ad->getErrors());
                                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
                                echo '<script type="text/javascript">var response = ' . json_encode($result) . ';if(window.parent.dialogAjaxDone) window.parent.dialogAjaxDone(response);</script>';
                                Yii::app()->end();
                            }
                            else
                            {
                                $_POST['Form']['param'][$dom['attr']['name']] = $ad->param;
                            }
                        }
                    }
                }
                if (empty($_POST['Form']['param']['href']) || trim($_POST['Form']['param']['href']) == '')
                {
                    $result = array('statusCode'=>300, 'message'=>'错误：链接地址不能为空');
                    echo json_encode($result);
                    Yii::app()->end();
                }
                $_POST['Form']['param'] = serialize($_POST['Form']['param']);
            }
            else
            {
                $result = array('statusCode'=>300, 'message'=>'错误：请选择广告类型');
                echo json_encode($result);
                Yii::app()->end();
            }
            $ad->attributes = $_POST['Form'];
            $ad->start_time = strtotime($ad->start_time);
            $ad->end_time = strtotime($ad->end_time);
            $ad->update_time = Yii::app()->params['timestamp'];

            if ($ad->save())
                $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>'ad-index');
            else
            {
                $error = array_shift($ad->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }

            echo json_encode($result);
            Yii::app()->end();
        }
        $this->render('edit', array('ad'=>$ad, 'types'=>$types));
    }

    public function actionDel(array $id = array())
    {
        if (empty($id))
            $this->error('参数传递错误');
        if (count($id) > 1)
            $this->error('暂不能批量删除');
        else
            $id = $id[0];

        $ad = Ad::model();
        $count = $ad->deleteByPk($id);
        if ($count > 0)
            $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'ad-index');
        else
        {
            $error = array_shift($ad->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    public function actionToggleStatus($id = null, $status = null)
    {
        if ($id === null || $status === null)
            $this->error('参数传递错误');

        $ad = Ad::model()->cache()->findByPk($id);
        $ad->status = (int)$status;
        if ($ad->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'ad-index');
        else
        {
            $error = array_shift($ad->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    public function actionChangeSort($id = null, $sort = null)
    {
        if ($id === null || $sort === null)
            $this->error('参数传递错误');

        $ad = Ad::model()->cache()->findByPk($id);
        $ad->sort = (int)$sort;
        if ($ad->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'ad-index');
        else
        {
            $error = array_shift($ad->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 获取广告分类
     * @param string $name
     */
    public function actionGetType($name = null)
    {
        $result = include(Yii::app()->basePath.'/config/AdType.php');
        if (empty($name))
            return $result;
        else
            return $result[$name];
    }

    public function actionGetTypeHtml($type = null, $param = null)
    {
        if ($type === null)
            $this->error('广告类型不能为空');
        $param = unserialize($param);
        $type = $this->actionGetType($type);
        $html = '';
        foreach ($type['dom'] as $dom)
        {
            $html .= "<" . $dom['type'];
            if (!empty($dom['attr']))
            {
                foreach ($dom['attr'] as $attr=>$val)
                {
                    $html .= " {$attr}=\"{$val}\"";
                }
            }

            $html .= ">\r\n";

            if (!empty($dom['child']))
            {
                foreach ($dom['child'] as $child)
                {
                    if (!empty($child['label']))
                        $html .= "<label>{$child['label']}</label>\r\n";

                    if (strtolower(trim($child['type'])) == 'file')
                        if (!empty($param) && !empty($param['src']))
                        {
                            $html .= "<span style=\"line-height: 21px;\">\r\n".
                            "<a href=\"{$param['src']}\" target=\"_blank\">查看</a> \r\n".
                            "<a name=\"cover_img\" class=\"reUpload\" href=\"#\">重新上传</a> \r\n".
                            "</span>";
                            break;
                        }
                        else
                            $html .= "<input type=\"file\"";
                    else if (strtolower(trim($child['type'])) == 'split')
                        $html .= "<span";
                    else
                        $html .= "<input type=\"text\"";

                    if (!empty($child['attr']))
                    {
                        foreach ($child['attr'] as $attr=>$val)
                        {
                            $html .= " {$attr}=\"{$val}\"";
                        }
                        if (!empty($param))
                        {
                            foreach ($param as $attr=>$val)
                            {
                                if ($child['attr']['name'] == "Form[param][".$attr."]")
                                {
                                    $html .= " value=\"$val\"";
                                }
                            }
                        }
                    }

                    if (!empty($child['css']))
                    {
                        $html .= " style=\"";
                        foreach ($child['css'] as $attr=>$val)
                        {
                            $html .= "{$attr}:{$val}; ";
                        }
                        $html .= "\"";
                    }

                    if (strtolower(trim($child['type'])) == 'split')
                        $html .= ">{$child['text']}</span>\r\n";
                    else
                        $html .= " />\r\n";
                }
            }

            $html .= "</{$dom['type']}>\r\n";
        }
        echo $html;
    }
}
?>