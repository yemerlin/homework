<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2018/3/12
 * Time: 23:55
 */
namespace Admin\Model;
use Think\Image;
use Think\Model;
use Think\Page;
use Think\Upload;

class GoodsModel extends Model
{
    protected $_map=array(
        'g_name'        =>'goods_name',
        'gs_price'      =>'shop_price',
        'gm_price'      =>'market_price',
        'gis_on_sale'   =>'is_on_sale',
        'g_desc'        =>'goods_desc'
    );
    protected $insertFields=array('goods_name','shop_price','market_price','goods_desc','is_on_sale','brand_id','cat_id','e_cat_id');
    protected $updateFields=array('goods_name','shop_price','market_price','goods_desc','is_on_sale','brand_id','cat_id','e_cat_id');
    protected $_validate=array(
        array('goods_name','require','商品名称必须填',1),
        array('shop_price','currency','本店价格必须是货币',1),
        array('market_price','currency','市场价格必须是货币',1),
    );

    protected function _before_insert(&$data,$option)
    {

        if($_FILES['logo']['error']==0){
            $upload=new Upload();
            $upload->maxSize=0;  //10M
            $upload->exts=array('jpeg','gif','png','jpg');
            $upload->rootPath='./Public/Uploads/';
            $upload->savePath='Goods/';

            $info=$upload->upload();

            if(!$info){
                $this->error=$upload->getError();
                return false;
            }else{
                $logo=$info['logo']['savepath'].$info['logo']['savename'];
                $s_logo=$info['logo']['savepath'].'s_'.$info['logo']['savename'];
                $m_logo=$info['logo']['savepath'].'m_'.$info['logo']['savename'];
                $l_logo=$info['logo']['savepath'].'l_'.$info['logo']['savename'];
                $xl_logo=$info['logo']['savepath'].'xl_'.$info['logo']['savename'];

                $image=new Image();
                $image->open('./Public/Uploads/'.$logo);
                $image->thumb(700,700)->save('./Public/Uploads/'.$xl_logo);
                $image->thumb(350,350)->save('./Public/Uploads/'.$l_logo);
                $image->thumb(130,130)->save('./Public/Uploads/'.$m_logo);
                $image->thumb(50,50)->save('./Public/Uploads/'.$s_logo);

                $data['logo']=$logo;
                $data['s_logo']=$s_logo;
                $data['m_logo']=$m_logo;
                $data['l_logo']=$l_logo;
                $data['xl_logo']=$xl_logo;
            }
        }



        $data['addtime']=time();

    }
    protected function _after_insert($data,$option)
    {
        //处理扩展分类
        $e_cat_id=I('post.e_cat_id');
        $gc_model=D('GoodsCat');
        foreach ($e_cat_id as $v) {
            if($v!=0) {
                $gc_model->add(
                    array(
                        'goods_id' => $data['id'],
                        'cat_id' => $v
                    )
                );
            }
        }

        $mb=I('post.member_price');    //处理会员价格
        $model=D('MemberPrice');
        foreach ($mb as $k=>$v){
            if($v>0){
                $model->add(array(
                    'goods_id'      => $data['id'],
                    'level_id'      => $k,
                    'member_price'  => $v
                ));
            }
        }
        //处理商品相册
        if(isset($_FILES['pic'])){
            $p_model=D('GoodsPic');
            $pics=array();
            $i=0;
            foreach ($_FILES['pic']['name'] as $key=>$val) { //处理三维数组
                $pics[$i]['name']=$val;
                $pics[$i]['type']=$_FILES['pic']['type'][$key];
                $pics[$i]['tmp_name']=$_FILES['pic']['tmp_name'][$key];
                $pics[$i]['error']=$_FILES['pic']['error'][$key];
                $pics[$i]['size']=$_FILES['pic']['size'][$key];
                $i++;
            }
            foreach ($pics as $k=>$file){
                if($file['error']==0){
                    $upload=new Upload();
                    $upload->maxSize=0;  //10M
                    $upload->exts=array('jpeg','gif','png','jpg');
                    $upload->rootPath='./Public/Uploads/';
                    $upload->savePath='Goods/';
                    $info=$upload->uploadOne($file);
                    if(!$info){
                        $this->error=$upload->getError();
                        return false;
                    }else{
                        $pic=$info['savepath'].$info['savename'];
                        $s_pic=$info['savepath'].'s_'.$info['savename'];
                        $m_pic=$info['savepath'].'m_'.$info['savename'];
                        $l_pic=$info['savepath'].'l_'.$info['savename'];
                        $image=new Image();
                        $image->open('./Public/Uploads/'.$pic);
                        $image->thumb(650,650)->save('./Public/Uploads/'.$l_pic);
                        $image->thumb(350,350)->save('./Public/Uploads/'.$m_pic);
                        $image->thumb(50,50)->save('./Public/Uploads/'.$s_pic);
                        $p_model->add(
                            array(
                                "goods_id"  =>$data['id'],
                                "pic"       =>$pic,
                                "s_pic"     =>$s_pic,
                                "m_pic"     =>$m_pic,
                                "l_pic"     =>$l_pic
                            )
                        );
                    }
                }
            }
        }
    }
    protected function _before_update(&$data,$option)
    {


        if($_FILES['logo']['error']==0) {  //是否上传新图片
            $oldlogo=$this->field('logo,s_logo,m_logo,l_logo,xl_logo')->find($data['id']);
            unlink('./Public/Uploads/'.$oldlogo['logo']);                                //删除旧图
            unlink('./Public/Uploads/'.$oldlogo['s_logo']);                                //删除旧图
            unlink('./Public/Uploads/'.$oldlogo['m_logo']);                                //删除旧图
            unlink('./Public/Uploads/'.$oldlogo['l_logo']);                                //删除旧图
            unlink('./Public/Uploads/'.$oldlogo['xl_logo']);                                //删除旧图
            $upload = new Upload();
            $upload->rootPath = './Public/Uploads/';
            $upload->savePath = 'Goods/';
            $upload->exts = array('jpeg', 'png', 'jpg', 'gif');
            $info = $upload->upload();
            if(!$info){
                $this->error=$upload->getError();
                return false;
            }else{

                $data['logo']=$info['logo']['savepath'].$info['logo']['savename'];
                $data['s_logo']=$info['logo']['savepath'].'s_'.$info['logo']['savename'];
                $data['m_logo']=$info['logo']['savepath'].'m_'.$info['logo']['savename'];
                $data['l_logo']=$info['logo']['savepath'].'l_'.$info['logo']['savename'];
                $data['xl_logo']=$info['logo']['savepath'].'xl_'.$info['logo']['savename'];

                $image=new Image();
                $image->open('./Public/Uploads/'.$data['logo']);
                $image->thumb(50,50)->save('./Public/Uploads/'.$data['s_logo']);
                $image->thumb(130,130)->save('./Public/Uploads/'.$data['m_logo']);
                $image->thumb(350,350)->save('./Public/Uploads/'.$data['l_logo']);
                $image->thumb(700,700)->save('./Public/Uploads/'.$data['xl_logo']);
            }
        }
        $id=$option['where']['id'];
        $list=I('post.member_price');
        $model=D('MemberPrice');
        $model->where("goods_id=$id")->delete();
        foreach ($list as $k=>$v){
            if($v>0){
                $model->add(array(
                    'goods_id'      => $id,
                    'level_id'      => $k,
                    'member_price'  => $v
                ));
            }
        }
    }


    protected function _before_delete($option)
    {
        //删除扩展分类

        $id=$option['where']['id'];
        $gc_model=D('GoodsCat');
        $gc_model->where("goods_id=$id")->delete();

        $oldlogo=$this->field('logo,s_logo,m_logo,l_logo,xl_logo')->find($id);
        unlink('./Public/Uploads/'.$oldlogo['logo']);
        unlink('./Public/Uploads/'.$oldlogo['s_logo']);
        unlink('./Public/Uploads/'.$oldlogo['m_logo']);
        unlink('./Public/Uploads/'.$oldlogo['l_logo']);
        unlink('./Public/Uploads/'.$oldlogo['xl_logo']);

        $mp_model=D('MemberPrice');
        $mp_model->where("goods_id=$id")->delete();
        $gp_model=D('GoodsPic');
        $oldpic=$gp_model->where("goods_id=$id")->field('pic,s_pic,m_pic,l_pic')->select();
        foreach ($oldpic as $v) {
            unlink('./Public/Uploads/' . $v['pic']);
            unlink('./Public/Uploads/' . $v['s_pic']);
            unlink('./Public/Uploads/' . $v['m_pic']);
            unlink('./Public/Uploads/' . $v['l_pic']);
        }
        $gp_model->where("goods_id=$id")->delete();

    }
    protected function _after_update($data,$option)
    {
        //修改扩展分类
        $id=$data['id'];
        $gc_model=D('GoodsCat');
        $gc_model->where("goods_id=$id")->delete();
        $e_cat_id=I('post.e_cat_id');
        foreach ($e_cat_id as $v){
            if($v!=0){
                $gc_model->add(
                    array(
                        'goods_id'  => $id,
                        'cat_id'    =>$v
                    )
                );
            }
        }
        if($_FILES['pic']){
            $pics=array();
            $i=0;
            foreach ($_FILES['pic']['name'] as $k=>$v){
                $pics[$i]['name']=$v;
                $pics[$i]['type']=$_FILES['pic']['type'][$k];
                $pics[$i]['tmp_name']=$_FILES['pic']['tmp_name'][$k];
                $pics[$i]['error']=$_FILES['pic']['error'][$k];
                $pics[$i]['size']=$_FILES['pic']['size'][$k];
                $i++;
            }
            foreach ($pics as $k=>$file){
                if($file['error']==0){
                    $upload=new Upload();
                    $upload->maxSize=0;  //10M
                    $upload->exts=array('jpeg','gif','png','jpg');
                    $upload->rootPath='./Public/Uploads/';
                    $upload->savePath='Goods/';
                    $info=$upload->uploadOne($file);

                    if(!$info){
                        $this->error=$upload->getError();
                        return false;
                    }else{
                        $pic=$info['savepath'].$info['savename'];
                        $s_pic=$info['savepath'].'s_'.$info['savename'];
                        $m_pic=$info['savepath'].'m_'.$info['savename'];
                        $l_pic=$info['savepath'].'l_'.$info['savename'];
                        $image=new Image();
                        $image->open('./Public/Uploads/'.$pic);
                        $image->thumb(650,650)->save('./Public/Uploads/'.$l_pic);
                        $image->thumb(650,650)->save('./Public/Uploads/'.$m_pic);
                        $image->thumb(650,650)->save('./Public/Uploads/'.$s_pic);
                        $gp_model=D('GoodsPic');
                        $gp_model->add(
                            array(
                                "goods_id"  =>$data['id'],
                                "pic"       =>$pic,
                                "s_pic"     =>$s_pic,
                                "m_pic"     =>$m_pic,
                                "l_pic"     =>$l_pic
                            )
                        );

                    }
                }
            }
        }

    }

    public function showPage($keyword,$p_low,$p_high)
    {
        $list=array();
        $where=array();
        $count=$this->count();
        if($keyword!=''){
            $where['goods_name']=array('like',"%$keyword%");
            $count=$this->where($where)->count();
        }
        if($p_low && $p_high){
            $where['shop_price']=array('between',array($p_low,$p_high));
            $count=$this->where($where)->count();
        }elseif ($p_low){
            $where['shop_price']=array('egt',$p_low);
            $count=$this->where($where)->count();
        }elseif ($p_high){
            $where['shop_price']=array('elt',$p_high);
            $count=$this->where($where)->count();
        }


        $page=new Page($count,5);
        $list['show']=$page->show();
        $list['data']=$this->field('g.*,b.brand_name,c.cat_name,group_concat(ec.cat_name separator "  <br>") e_cat_name')->alias('g')->join('left join ye_brands b on g.brand_id=b.brand_id left join ye_category c on g.cat_id=c.cat_id left join ye_goods_cat gc on g.id=gc.goods_id left join ye_category ec on gc.cat_id=ec.cat_id')->where($where)->limit($page->firstRow,$page->listRows)->group('g.id')->select();
        return $list;
    }


}