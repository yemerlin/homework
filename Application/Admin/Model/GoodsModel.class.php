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
    protected $insertFields=array('goods_name','shop_price','market_price','goods_desc','is_on_sale');
    protected $_validate=array(
        array('goods_name','require','商品名称必须填',1),
        array('shop_price','currency','本店价格必须是货币',1),
        array('market_price','currency','市场价格必须是货币',1)
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

}