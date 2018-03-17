<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2018/3/17
 * Time: 16:15
 */

namespace Admin\Controller;


use Think\Controller;

class CategoryController extends Controller
{
    public function add()
    {
        $this->assign(array(
            'list_name' =>  '分类列表',
            'add_name'  =>  '添加新分类',
            'title_name'=>  '添加分类'
        ));
        $model=D('Category');
        $list=$model->select();
        $cats=$model->getCategory($list);
        $this->assign('cats',$cats);
        if(IS_POST){
            if($model->create(I('post.'),1)) {    //1是添加，2是修改

                if ($model->add()) {
                    $this->success('添加成功', 'list');
                    exit();
                }
            }
            $error=$model->getError();
            $this->error($error,'');
        }
        $this->display();
    }
    public function list()
    {
        $model=D('Category');
        $list=$model->select();
        $cats=$model->getCategory($list);
        $this->assign(array(
            'list_name' =>  '分类列表',
            'add_name'  =>  '添加新分类',
            'title_name'=>  '分类列表'
        ));
        $this->assign('cats',$cats);
        $this->display();
    }
    public function edit()
    {
        $model=D('Category');
        if(IS_GET){
            $cat_id=I('get.cat_id');
            $data=$model->find($cat_id);
            $list=$model->select();
            $cats=$model->getCategory($list);
            $this->assign(array(
                'list_name' =>  '分类列表',
                'add_name'  =>  '添加新分类',
                'title_name'=>  '修改列表'
            ));
            $this->assign('data',$data);
            $this->assign('cats',$cats) ;
        }
        if(IS_POST){
            if(FALSE!==$model->save(I('post.'))){
                $this->success('修改成功',U('list'));
                exit();
            }else{
                $this->error($model->getError(),U('list'));
            }
        }

        $this->display();
    }
    public function delete()
    {
        if(IS_GET){
            $cat_id=I('get.cat_id');
            $model=D('Category');
            if($model->delete($cat_id)){
                $this->success('删除成功',U('list'));
            }else{
                $this->error($model->getError(),U('list'));
            }
        }
    }
}