<?php
class ShopController extends Controller
{
    /**
     * 商户管理
     * @param string $name
     * @param integer $category
     * @param integer $numPerPage
     * @param integer $pageNum
     */
    public function actionIndex($name = '', $category = null, $numPerPage = null, $pageNum = null)
    {
        $shops = new Shop;
        $criteria = new CDbCriteria;
        if (!empty($name))
            $criteria->addCondition("t.name like '%{$name}%'");
        if (!empty($category))
        {
            $criteria->addCondition('t.category_id = '.(int)$category.' OR Category.parent_id = '.(int)$category);
            $criteria->with = 'Category';
        }

        $count = $shops->count($criteria);
        $pages = new CPagination($count);
        $pages->currentPage = empty($pageNum) ? 0 : $pageNum - 1;
        $pages->pageSize = empty($numPerPage) ? 10 : $numPerPage;
        $pages->applyLimit($criteria);

        $criteria->order = "t.sort, t.click_count desc";
        $shops = $shops->cache()->findAll($criteria);
        $this->render('index', array('shops'=>$shops, 'pages'=>$pages, 'name'=>$name));
    }

    /**
     * 编辑商户
     * @param integer $id
     */
    public function actionEdit($id = null)
    {
        $shop = new Shop();
        if ($id !== null)
            $shop = $shop->cache()->findByPk($id);

        if (isset($_POST['Form']))
        {
            if (!empty($_POST['Form']['id']))
            {
                $shop = $shop->cache()->findByPk($_POST['Form']['id']);
                $message = '修改成功';
            }
            else
                $message = '添加成功';

            $shop->attributes = $_POST['Form'];
            $shop->update_time = Yii::app()->params['timestamp'];
            if ($shop->save())
                $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>'shop-index');
            else
            {
                $error = array_shift($shop->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }
            echo json_encode($result);
            Yii::app()->end();
        }
        $category_parent = ShopCategory::model()->cache()->findAll('parent_id = 0 AND status = 1');
        $category_childrens = null;
        if ($id !== null)
            $category_childrens = ShopCategory::model()->cache()->findAll('parent_id = '.$shop->Category->parent_id.' AND status = 1');
        $areas = ShopArea::model()->cache()->findAll('level = 2');
        $this->render('edit', array('shop'=>$shop, 'category_parent'=>$category_parent, 'category_childrens'=>$category_childrens, 'areas'=>$areas));
    }

    /**
     * 商户图片管理
     * @param integer $shop_id
     */
    public function actionPicture($shop_id = null)
    {
        if (empty($shop_id))
            $this->error('参数传递错误！');
        else
            $pictures = ShopPicture::model()->cache()->findByAttributes(array('shop_id'=>$shop_id));

        $this->render('picture', array('shop_id'=>$shop_id, 'pictures'=>$pictures));
    }

    /**
     * 商户图片修改
     * @param integer $id
     */
    public function actionUploadMultiple($shop_id = null)
    {
        if (empty($shop_id))
            $this->error('参数传递错误！');

        if (isset($_FILES['Filedata']))
        {
            $picture = new ShopPicture;
            $picture->src = CUploadedFile::getInstanceByName('Filedata');
            $picture->shop_id = $shop_id;
            $picture->create_time = Yii::app()->params['timestamp'];
            $picture->update_time = Yii::app()->params['timestamp'];
            $picture->sort = 0;
            if ($picture->save())
            {
                $result = array('statusCode'=>200, 'message'=>'上传成功', 'filePath'=>$picture->src);
            }
            else
            {
                $error = array_shift($shop->getErrors());
                $result = array('statusCode'=>300, 'message'=>'上传失败，错误：'.$error[0], 'filePath'=>$picture->src);
            }
            echo json_encode($result);
            Yii::app()->end();
        }

        $this->render('picture_edit', array('shop_id'=>$shop_id, 'multiple'=>true));
    }

    public function actionPictureReupload($id = null)
    {
        $this->render('picture_edit', array('multiple'=>false));
    }

    /**
     * 商户图片排序
     * @param integer $id
     * @param integer $sort
     */
    public function actionPictureChangeSort($id = null, $sort = null)
    {
    }

    /**
     * 删除商户图片
     * @param integer $id
     * @param integet $shop_id
     * @param boolean $delFile
     */
    public function actionPictureDel($id = null, $shop_id = null, $delFile = true)
    {
        if (empty($id) && empty($shop_id))
            $this->error('参数传递错误！');
        else if (empty($id))
        {
            $filePath = array();
            $pictures = ShopPicture::model()->findAll(array('select'=>'src', 'shop_id'=>$shop_id));
            foreach ($pictures as $picture)
            {
                $filePath[] = $picture['src'];
                $picture->delete();
            }
        }
        else
        {
            $picture = ShopPicture::model()->findByPk($id, array('select'=>'src'));
            $filePath = $picture['src'];
            $picture->delete();
        }

        // 如果需要删除文件
        if ($delFile && !empty($filePath))
        {
            if (is_array($filePath))
            {
                foreach ($filePath as $path)
                {
                    $path = Yii::getPathOfAlias('webroot') . $path;
                    @unlink($path);
                }
            }
            else
            {
                $filePath = Yii::getPathOfAlias('webroot') . $filePath;
                @unlink($filePath);
            }
        }

        $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'shop-picture');
        echo json_encode($result);
        Yii::app()->exit();
    }

    public function getCategory()
    {
        $categories = ShopCategory::model()->cache()->findAll('parent_id <> 0 AND status = 1');
        $result = array();
        foreach ($categories as $category)
        {
            $result[] = array('id'=>$category->id, 'name'=>$category->name, 'parent'=>$category->parent_id);
        }
        echo json_encode($result);
    }

    /**
     * 删除商户
     * @param integer $id
     */
    public function actionDel(array $id = array())
    {
        if (empty($id))
            $this->error('参数传递错误！');
        if (count($id) > 1)
            $this->error('暂不支持批量删除');
        else
        {
            $id = $id[0];
            ShopCoupon::model()->deleteAllByAttributes(array('shop_id'=>$id));
            $shop = Shop::model();
            if ($shop->deleteByPk($id) > 0)
                $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'shop-index');
            else
            {
                $error = array_shift($shop->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }
        }
        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 修改点击量
     * @param integer $id
     * @param integer $count
     */
    public function actionChangeClickCount($id = null, $count = null)
    {
        if (empty($id) || empty($count))
            $this->error('参数传递错误');

        $shop = Shop::model()->cache()->findByPk($id);
        $shop->click_count = (int)$count;
        $shop->update_time = Yii::app()->params['timestamp'];
        if ($shop->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'shop-index');
        else
        {
            $error = array_shift($shop->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 修改状态
     * @param integer $id
     * @param integer $sort
     */
    public function actionChangeSort($id = null, $sort = null)
    {
        if (empty($id) || empty($sort))
            $this->error('参数传递错误');

        $shop = Shop::model()->cache()->findByPk($id);
        $shop->sort = (int)$sort;
        $shop->update_time = Yii::app()->params['timestamp'];
        if ($shop->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'shop-index');
        else
        {
            $error = array_shift($shop->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 切换状态
     * @param integer $id
     * @param boolean $status
     */
    public function actionToggleStatus($id = null, $status = null)
    {
        if (empty($id) || $status === null)
            $this->error('参数传递错误');

        $shop = Shop::model()->cache()->findByPk($id);
        $shop->status = (int)$status;
        $shop->update_time = Yii::app()->params['timestamp'];
        if ($shop->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'shop-index');
        else
        {
            $error = array_shift($shop->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 商户分类
     */
    public function actionCategory($numPerPage = null, $pageNum = null)
    {
        $categories = new ShopCategory;
        $criteria = new CDbCriteria;

        $count = $categories->count();

        $pages = new CPagination($count);
        $pages->currentPage = empty($pageNum) ? 0 : $pageNum - 1;
        $pages->pageSize = empty($numPerPage) ? 10 : $numPerPage;
        $pages->applyLimit($criteria);

        $criteria->order = 't.parent_id, t.id';
        $categories = $categories->cache()->findAll($criteria);
        $this->render('category', array('categories'=>$categories, 'pages'=>$pages));
    }

    /**
     * 编辑商户分类
     * @param integer $id
     */
    public function actionEditCategory($id = null)
    {
        $category = new ShopCategory;
        if (!empty($id))
            $category = $category->cache()->findByPk($id);

        if (isset($_POST['Form']))
        {
            if (isset($_POST['Form']['id']))
            {
                $message = '修改成功';
                $category = $category->cache()->findByPk($_POST['Form']['id']);
            }
            else
                $message = '添加成功';

            $category->attributes = $_POST['Form'];
            if ($category->save())
                $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>'shop-category');
            else
            {
                $error = array_shift($category->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }
            echo json_encode($result);
            Yii::app()->end();
        }
        $categories = ShopCategory::model()->cache()->findAll();
        $this->render('category_edit', array('category'=>$category, 'categories'=>$categories));
    }

    /**
     * 删除商户分类
     * @param integer $id
     */
    public function actionDelCategory(array $id = array())
    {
        if (empty($id))
            $this->error('参数传递错误');
        if (count($id) > 1)
            $this->error('暂不支持批量删除');
        $id = $id[0];
        $count = ShopCategory::model()->deleteByPk($id);
        if ($count > 0)
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'shop-category');
        else
            $result = array('statusCode'=>300, 'message'=>'删除失败，请联系管理员');
        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 切换商户分类状态
     * @param integer $id
     * @param boolean $status
     */
    public function actionToggleCategoryStatus($id = null, $status = null)
    {
        if (empty($id) || $status === null)
            $this->error('参数传递错误');

        $category = ShopCategory::model()->cache()->findByPk($id);
        $category->status = (int)$status;
        if ($category->save())
            $result = array('statusCode'=>200, 'message'=>'修改成功', 'navTabId'=>'shop-category');
        else
        {
            $error = array_shift($category->getErrors());
            $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
        }

        echo json_encode($result);
        Yii::app()->end();
    }

    /**
     * 商户地区
     */
    public function actionArea()
    {
        $areas = new ShopArea;
        $criteria = new CDbCriteria;

        $count = $areas->count();
        $pages = new CPagination($count);
        $pages->currentPage = empty($pageNum) ? 0 : $pageNum - 1;
        $pages->pageSize = empty($numPerPage) ? 10 : $numPerPage;
        $pages->applyLimit($criteria);

        $areas = $areas->cache()->findAll($criteria);
        $this->render('area', array('areas'=>$areas, 'pages'=>$pages));
    }

    /**
     * 编辑商户地区
     * @param integer $id
     */
    public function actionEditArea($id = null)
    {
        $area = new ShopArea;
        if (!empty($id))
            $area = $area->cache()->findByPk($id);

        if (isset($_POST['Form']))
        {
            $id = $_POST['Form']['id'];
            if (empty($id))
                $message = '添加成功';
            else
            {
                $message = '修改成功';
                $area = $area->cache()->findByPk($id);
            }
            $area->attributes = $_POST['Form'];
            if ($area->save())
                $result = array('statusCode'=>200, 'message'=>$message, 'navTabId'=>'shop-area');
            else
            {
                $error = array_shift($area->getErrors());
                $result = array('statusCode'=>300, 'message'=>'错误：'.$error[0]);
            }
            echo json_encode($result);
            Yii::app()->end();
        }
        $areas = $area->cache()->findAll();
        $this->render('area_edit', array('area'=>$area, 'areas'=>$areas));
    }

    /**
     * 删除商户地区
     * @param array $id
     */
    public function actionDelArea(array $id = array())
    {
        if (empty($id))
            $this->error('参数传递错误');
        if (count($id) > 1)
            $this->error('暂不支持批量删除');
        $id = $id[0];
        $count = ShopArea::model()->deleteByPk($id);
        if ($count > 0)
            $result = array('statusCode'=>200, 'message'=>'删除成功', 'navTabId'=>'shop-area');
        else
            $result = array('statusCode'=>300, 'message'=>'错误');
        echo json_encode($result);
        Yii::app()->end();
    }
}
?>