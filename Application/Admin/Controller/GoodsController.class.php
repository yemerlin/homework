<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2018/3/12
 * Time: 22:32
 */
namespace Admin\Controller;



use Think\Controller;

class GoodsController extends Controller
{
    public function add(){
        if(IS_POST){
            $model=D('Goods');
            if($model->create(I('post.'),1)) {    //1是添加，2是修改

                if ($model->add()) {
                    $this->success('添加成功', '');
                    exit();
                }
            }
            $error=$model->getError();
            $this->error($error,'');
        }
        $this->display();
    }
}