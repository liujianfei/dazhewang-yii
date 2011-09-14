<?php
class CouponController extends Controller
{
    public function actionIndex($shop_name = '', $numPerPage = null, $pageNum = null)
    {
        $coupons = new ShopCoupon;
        $criteria = new CDbCriteria;
        if (!empty($shop_name))
            $criteria->addCondition("Shop.name like '%{$shop_name}%'");

        $count = $coupons->count();
        $pages = new CPagination($count);
        $pages->currentPage = empty($pageNum) ? 0 : $pageNum - 1;
        $pages->pageSize = empty($numPerPage) ? 20 : $numPerPage;
        $pages->applyLimit($criteria);

        $criteria->order = '';
        $coupons = $coupons->cache()->with('Shop')->findAll($criteria);
        $this->render('index', array('coupons'=>$coupons, 'pages'=>$pages, 'shop_name'=>$shop_name));
    }

    public function actionEdit($id = null, $shop_id = null)
    {
        $coupon = new ShopCoupon;
        $shop = null;
        if (!empty($id))
            $coupon = $coupon->cache()->findByPk($id);
        else if (!empty($shop_id))
            $coupon = $coupon->cache()->findByAttributes(array('shop_id'=>$shop_id));
        if ($coupon === null)
        {
            $coupon = new ShopCoupon;
            $shop = Shop::model()->cache()->findByPk($shop_id, array('select'=>'name'));
        }
        if (isset($_POST['Form']))
        {
            if (!empty($_POST['Form']['id']))
            {
                $message = '修改成功';
                $coupon = $coupon->cache()->findByPk($_POST['Form']['id']);
            }
            else
            {
                $message = '添加成功';
            }

            $coupon->attributes = $_POST['Form'];
            $upload = CUploadedFile::getInstanceByName('cover_img');
            if (!$coupon->isNewRecord && $upload !== null)
                $coupon->cover_img = $upload;
            $coupon->begin_time = strtotime($coupon->begin_time);
            $coupon->end_time = strtotime($coupon->end_time);
            $coupon->update_time = Yii::app()->params['timestamp'];
            if ($coupon->save())
            {
                $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>'coupon-index');
            }
            else
            {
                $error = array_shift($coupon->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }
            echo json_encode($result);
            Yii::app()->end();
        }
        $this->render('edit', array('coupon'=>$coupon, 'shop'=>$shop));
    }

    public function actionDel(array $id = array())
    {
        if (empty($id))
            $this->errror("参数传递错误");
        if (count($id) > 1)
            $this->errror("暂不支持批量删除");
        $id = $id[0];
        $coupon = ShopCoupon::model();
        if ($coupon->deleteByPk($id) > 0)
            $this->success('删除成功', 'coupon-index');
        else
        {
            $error = array_shift($coupon->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }
        echo json_encode($result);
        Yii::app()->end();
    }

    public function actionChangeDownCount($id = null, $count = null)
    {
        if (empty($id) || empty($count))
            $this->errror("参数传递错误");
        $coupon = ShopCoupon::model()->cache()->findByPk($id);
        $coupon->down_count = (int)$count;
        if ($coupon->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'coupon-index');
        else
        {
            $error = array_shift($coupon->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }
        echo json_encode($result);
        Yii::app()->end();
    }

    public function actionDownRecord()
    {
    }
}
?>