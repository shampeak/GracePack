<?php

namespace Grace\Mmcfile;
/**
 * Class Mmcfile
 * @package Grace\Mmcfile
 * 接口
 *
 * app('mmcfile')->set("a",[1,2,3,4]);
 * app('mmcfile')->get("a");
 *
 * app('mmcfile')->set([1,2,3,4]);      //默认default
 * app('mmcfile')->get();               //默认default
 *
 *
 *
 */

class Mmcfile{ // class start

    private $_root      = '';
    private $_config    = array();                       // default expire
    private $_jsonFile  = array();
    private $_nr      = array();

    public function __construct($config = array()){
        $this->_config      = $config;
        $this->_root        = $config['root'];
    }

    public function get($key = 'default')
    {
        $this->read($key);
        return $this->_nr[$key];
    }

    public function set($key = 'default',$value = array())
    {

        $count = func_num_args();
        if($count == 1){
            $value  = $key;
            $key    = 'default';
        }

        $this->nr[$key] = $value;
        $this->save($key);
    }

    //===========================================

    private function read($key)
    {
        $_jsonFile = $this->_root.$key.'.json';
        if(empty($this->_nr[$key])) {
            if (file_exists($_jsonFile)) {
                $_ar = @file_get_contents($_jsonFile);
                $ar = json_decode($_ar,true);
            } else {
                $ar = array();
            }
            $this->_nr[$key] = $ar;
        }
        return $this;
    }

    private function save($key)
    {
        if(!is_dir($this->_root)){            //路径不存在
            die("mmcfile 存储路径不存在");
        }
        $_jsonFile = $this->_root.$key.'.json';
        @file_put_contents($_jsonFile,json_encode($this->nr[$key]));
    }

}
