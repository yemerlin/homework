<?php
/**
 * Created by PhpStorm.
 * User: Merlin
 * Date: 2018/3/12
 * Time: 22:38
 */

namespace Admin\Controller;


use Think\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $this->display();
    }
    public function main(){
        $this->display();
    }
    public function menu(){
        $this->display();
    }
    public function top(){
        $this->display();
    }

}