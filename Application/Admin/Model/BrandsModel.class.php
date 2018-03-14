<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2018/3/14
 * Time: 21:00
 */

namespace Admin\Model;

use Think\Model;
use Think\Page;
use Think\Upload;

class BrandsModel extends Model
{
    protected $insertFields=array('brand_name','brand_desc','brand_url');
    protected $updateFields=array('brand_name','brand_desc','brand_url');
    protected $_validate=array(
        array('brand_name','require','品牌名称必须填',1)
);

    protected function _before_insert(&$data,$option)
    {

        if($_FILES['brand_logo']['error']==0){
            $upload=new Upload();
            $upload->exts=array('jpeg','jpg','png','gif');
            $upload->rootPath='./Public/Uploads/';
            $upload->savePath='Brands/';
            $info=$upload->upload();
            if(!$info){
                $this->error=$upload->geterror();
            }else{
                $data['brand_logo']=$info['brand_logo']['savepath'].$info['brand_logo']['savename'];
            }
        }
    }
    protected function _before_update(&$data,$option)
    {
        if($_FILES['brand_logo']['error']==0){
            $upload=new Upload();
            $upload->exts=array('jpeg','jpg','png','gif');
            $upload->rootPath='./Public/Uploads/';
            $upload->savePath='Brands/';
            $info=$upload->upload();
            if(!$info){
                $this->error=$upload->getError();
                return false;
            }else{
                $data['brand_logo']=$info['brand_logo']['savepath'].$info['brand_logo']['savename'];
                $oldlogo=$this->field('brand_logo')->find($data['brand_id']);
                unlink('./Public/Upload/'.$oldlogo['brand_logo']);
            }
        }
    }
    protected function _before_delete($option)
    {
        $id=$option['where']['brand_id'];
        $oldlogo=$this->field('brand_logo')->find($id);
        unlink('./Public/Uploads/'.$oldlogo['brand_logo']);
    }

    public function showPage()
    {
        $count=$this->count();
        $page=new Page($count,2);
        $data['show']=$page->show();
        $data['list']=$this->limit($page->firstRow,$page->listRows)->select();
        return $data;
    }
}