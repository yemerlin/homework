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
//            dump($_POST);
//            DIE();
            $model=D('Goods');
            if($model->create(I('post.'),1)) {    //1是添加，2是修改

                if ($model->add()) {
                    $this->success('添加成功', 'list');
                    exit();
                }
            }
            $error=$model->getError();
            $this->error($error,'');
        }
        $m_l_model=D('MemberLevel');
        $level=$m_l_model->field('level_id,level_name')->select();
        $b_model=D('Brands');
        $data=$b_model->field('brand_id,brand_name')->select();
        $this->assign(array(
            'list_name' =>  '商品列表',
            'add_name'  =>  '添加新商品',
            'title_name'=>  '添加商品',
            'data'      =>  $data,
            'level'     =>  $level
        ));
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
        $this->assign(array(
            'list_name' =>  '商品列表',
            'add_name'  =>  '添加新商品',
            'title_name'=>  '商品列表'
        ));
        $this->display();
    }
    public function edit()
    {
        $model=D('goods');
        if(IS_GET) {
            $id = I('get.id');
            $data=$model->find($id);
            $b_model=D('Brands');
            $ml_model=D('MemberLevel');
            $mp_model=D('MemberPrice');
            $list=$b_model->field('brand_id,brand_name')->select();
            $ml_list=$ml_model->field('level_id,level_name')->select();
            $mp_list=$mp_model->where("goods_id=$id")->select();
            foreach ($mp_list as $k=>$v){
                $mp_data[$v['level_id']]=$v['member_price'];
            }
//            dump($data);
//            dump($mp_list);
//            dump($mp_data);
//            die();
            $this->assign(
                array(
                    'data'=>$data,
                    'list'=>$list,
                    'm_list'=>$ml_list,
                    'mp_data'=>$mp_data
                ));
        }
        if(IS_POST){

                if(false!==$model->save(I('post.'))){
                    $this->success('修改成功',U('list'));
                    exit();
                }else{
                    $this->error('失败',U('list'));
                }
        }

        $this->assign(array(
            'list_name' =>  '商品列表',
            'add_name'  =>  '添加新商品',
            'title_name'=>  '修改商品'
        ));
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