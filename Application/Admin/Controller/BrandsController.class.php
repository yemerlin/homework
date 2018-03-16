<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2018/3/14
 * Time: 20:57
 */

namespace Admin\Controller;


use Think\Controller;

class BrandsController extends Controller
{
    public function add()
    {
        if(IS_POST){
            $model=D('brands');
            if($model->create(I('post.'),1)){
                if($model->add()){
                    $this->success('添加成功',U('list'));
                    exit();
                }
            }
            $error=$model->getError();
            $this->error($error,U('list'));
        }
        $this->assign(array(
            'list_name' =>  '品牌列表',
            'add_name'  =>  '添加新品牌',
            'title_name'=>  '添加品牌'
        ));
        $this->display();
    }
    public function list()
    {
        $model=D('brands');
        $data=$model->showPage();
        $this->assign('show',$data['show']);
        $this->assign('data',$data['list']);
        $this->assign(array(
            'list_name' =>  '品牌列表',
            'add_name'  =>  '添加新品牌',
            'title_name'=>  '品牌列表'
        ));
        $this->display();
    }
    public function edit()
    {
        $model=D('Brands');
        if(IS_GET){
            $brand_id=I('get.brand_id');
            $data=$model->find($brand_id);
            $this->assign('data',$data);
        }
        if(IS_POST){
            if(false!==$model->save(I('post.'))){
                $this->success('修改成功',U('list'));
            }else{
                $this->error($model->getError(),U('list'));
            }
        }
        $this->assign(array(
            'list_name' =>  '品牌列表',
            'add_name'  =>  '添加新品牌',
            'title_name'=>  '修改品牌'
        ));
        $this->display();
    }
    public function delete()
    {
        $id=I('get.brand_id');
        $model=D('Brands');
        if($model->delete($id)){
            $this->success('删除成功',U('list'));
        }else{
            $error=$model->getError();
            $this->error($error,U('list'));
        }
    }

}