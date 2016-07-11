<?php

namespace Grace\Simulation;

use Grace\Base\Base;

class Simulation extends Base
{

    public function location($modelname = ''){
        $rec['model']    = $modelname;

        //=======================================
        //对调用时间进行记录
        //用这个来判断生产环境下是否有调用
        //=======================================

        $tree = debug_backtrace();
        array_shift($tree);

        $rec['file']    = current($tree)['file'];
        $rec['line']    = current($tree)['line'];
        $rec['_function']= current($tree)['function'];       //根据本类方法判断一些数据类型
        array_shift($tree);
        $rec['function'] = current($tree)['function'];
        $rec['class']    = current($tree)['class'];
        //OK,获得调用数据

        //存储到mmcfile里面
        $lib = app('mmcfile')->get('Simulation.index');
        $lib = empty($lib)?array():$lib;

        $type = $lib[$modelname]['type'];
        $info = $lib[$modelname]['info'];

        //检查是否已经被记录
        $record = true;

        $lib[$model]['info'] = $rec;

        $record = true;         //根据检查结果重置标记

        if($record){
            //记录
        }else{
            //不用记录
        }

    }

    public function test($modelname = ''){
        $this->location($modelname);
    }

    /**
     *     //控制台
     * 必要的参数包括
    */
    public function console(){
        //录用就用console
        //独立的控制台
    }

    /**
     * 页面小部件,可以嵌入到页面上
     * request需要传入二级路由
     */
    public function widget($get = ''){
        //录用就用console
        //返回相应页面内容
    }

}
