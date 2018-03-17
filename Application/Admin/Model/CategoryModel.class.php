<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2018/3/17
 * Time: 16:16
 */

namespace Admin\Model;


use Think\Model;

class CategoryModel extends Model
{
    protected $insertField=array('parent_id','cat_name');
    protected $updateField=array('parent_id','cat_name');
    protected $_validate=array(
        array('cat_name','require','分类名称必须填写',1)
    );

    protected function _before_update(&$data,$option)
    {
    }
    protected function _before_delete(&$option)
    {
        $model=D('Category');
        $list=$model->select();
        $cat_id=$option['where']['cat_id'];
        $cats=$this->getCategory($list,0,$cat_id,true);
        $ca[]=$cat_id;
        foreach ($cats as $v){
            $ca[]=$v['cat_id'];
        }
        $ca=implode(',',$ca);
        $option['where']['cat_id']=array('IN',$ca);
    }



    //******第一个参数分类数据
    //******第二个参数分类等级
    //******第三个参数父类ID
    //******第四个参数
    public function getCategory($list,$level=0,$parent_id=0,$isclear=false)

    {
        static $cats=array();
        static $i=0;
        if($isclear){
            $cats=array();
            $i=0;
        }
        foreach ($list as $k=>$v)
        {
            if($v['parent_id']==$parent_id){
                $cats[$i]['cat_id']=$v['cat_id'];
                $cats[$i]['cat_name']=$v['cat_name'];
                $cats[$i]['level']=$level;
                $i++;
                $this->getCategory($list,$level+1,$v['cat_id']);
            }
        }
        return $cats;
    }

}