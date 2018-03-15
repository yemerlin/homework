<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2018/3/15
 * Time: 10:14
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class MemberLevelModel extends Model
{
    protected $insertFields=array('level_name','jifen_bottom','jifen_top');
    protected $updateFields=array('level_name','jifen_bottom','jifen_top');
    protected $validate=array(
        array('level_name','require','等级名称必须填',1),
        array('jifen_bottom','require','积分下限必须填',1),
        array('jifen_top','require','积分下限必须填',1),
    );
    public function showPage()
    {
        $count=$this->count();
        $page=new Page($count,5);
        $data['show']=$page->show();
        $data['list']=$this->limit($page->firstRow,$page->listRows)->select();
        return $data;
    }

}