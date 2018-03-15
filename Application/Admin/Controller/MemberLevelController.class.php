<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2018/3/15
 * Time: 10:13
 */

namespace Admin\Controller;

use Think\Controller;

class MemberLevelController extends Controller
{
    public function add()
    {
        if(IS_POST){
            $model=D('MemberLevel');
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
            'list_name' =>  '会员等级列表',
            'add_name'  =>  '添加新会员等级',
            'title_name'=>  '添加会员等级'
        ));
        $this->display();
    }
    public function list()
    {
        $model=D('MemberLevel');
        $data=$model->showPage();
        $this->assign('show',$data['show']);
        $this->assign('data',$data['list']);
        $this->assign(array(
            'list_name' =>  '会员等级列表',
            'add_name'  =>  '添加新会员等级',
            'title_name'=>  '会员等级列表'
        ));
        $this->display();
    }
    public function edit()
    {
        $model=D('MemberLevel');
        if(IS_GET){
            $level_id=I('get.level_id');
            $data=$model->find($level_id);
            $this->assign('data',$data);
        }
        if(IS_POST){
            if($model->save(I('post.'))){
                $this->success('修改成功',U('list'));
            }else{
                $this->error($model->getError(),U('list'));
            }
        }
        $this->assign(array(
            'list_name' =>  '会员等级列表',
            'add_name'  =>  '添加新会员等级',
            'title_name'=>  '修改会员等级'
        ));
        $this->display();
    }
    public function delete()
    {
        $id=I('get.level_id');
        $model=D('MemberLevel');
        if($model->delete($id)){
            $this->success('删除成功',U('list'));
        }else{
            $error=$model->getError();
            $this->error($error,U('list'));
        }
    }
}