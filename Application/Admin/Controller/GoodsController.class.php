<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2018/3/12
 * Time: 22:32
 */
namespace Admin\Controller;



use Think\Controller;
use Think\Upload;

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
    public function list(){
        $model=D('Goods');
        $keyword=I('get.keyword')==''? '':I('get.keyword');
        $p_low=I('get.p_low')==''? '':I('get.p_low');
        $p_high=I('get.p_high')==''? '':I('get.p_high');
        $list=$model->showPage($keyword,$p_low,$p_high);
        $this->assign('list',$list['data']);
        $this->assign('showPage',$list['show']);
        $this->display();
    }
    public function edit()
    {
        $model=D('goods');
        if(IS_GET) {
            $id = I('get.id');
            $data=$model->find($id);
            $this->assign('data',$data);
        }
        if(IS_POST){
                if($model->save(I('post.'))){
                    $this->success('修改成功',U('list'));
                }else{
                    $this->error($model->getError(),U('list'));
                }
        }
        $this->display();
    }
    public function delete()
    {
        if($id=I('get.id')){
            $model=D('goods');
            if($model->delete($id)){
                $this->success('删除成功',U('list'));
            }else{
                $this->error($model->getError(),U('list'));
            }
        }
    }
}