<?php

namespace Grace\Simulation;

use Grace\Base\Base;

class Simulation extends Base
{
    private $_config    = array();
    private $_root      = '';

    public function __construct($config = array()){
        $this->_config      = $config;
        $this->_root        = $config['defaultRoot'];
    }

    /**
     * @param $value
     * 保存对象和对象信息
     */
    public function save($rec)
    {
        $mmcname = 'Simulation.index';
        //=================================================
        $lib = app('mmcfile')->get($mmcname);             //存储到mmcfile里面
        $lib = empty($lib)?array():$lib;
        //判断是否重复
        $record = true;
        if(!empty($lib)){
            foreach($lib as $k=>$v){
                $hash = md5(serialize([
                    'model'     => $rec['model'],
                    'file'      => $v['file'],
                    'line'      => $v['line'],
                    '_function' => $v['_function'],
                    'function'  => $v['function'],
                    'class'     => $v['class']
                ]));
                if($hash == $v['hash']) $record = false;        //发现数据,不要记录
            }
        }
        //重复性判断结束
        //=================================================
        if($record){
            $lib[] = $rec;
            app('mmcfile')->set($mmcname,$lib);//记录
        }

    }

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
        $rec['hash']    = md5(serialize($rec));             //对自身进行hash
        $this->save($rec);      //保存
    }


    /**
     * @param int    $no
     * @param string $modelname
     *
     * @return array
     */
    public function no($no = 0,$modelname = '')
    {
    }

    /**
     * @param int    $int
     * @param string $modelname
     *
     * @return int
     */
    public function int($modelname = ''){
        $this->location($modelname);
        return
    }

    /**
     * @param string $arr
     * @param string $modelname
     *
     * @return string
     */
    public function str($arr = '',$modelname = '')
    {
        $this->location($modelname);
        return 'str';
    }

    /**
     * @param array  $arr
     * @param string $modelname
     *
     * @return array
     */
    public function arr($arr = array(),$modelname = '')
    {
        $this->location($modelname);
        return array();
    }


    //===============================================
    //===============================================
    //===============================================

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
