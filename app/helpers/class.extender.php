<?php
/**
 * @project Trinity Framework
 * @copyright Copyright (c) 2017-2017 nephp. (https://github.com/nephp)
 */
 
namespace App\r7r1n17y\Framework;

/**
 * @name ExtensionBridge
 */
abstract class ExtensionBridge {
  
    /**
     * @var _exts Container for each object
     * @type private
     */
    private $_exts = array();

    /**
     * @var _this Used to call custom methods/func
     * @type public
     */
    public $_this;
        
    function __construct(){$_this = $this;}
    
    public function addExt($object)
    {
        $this->_exts[]=$object;
    }
    
    public function __get($varname)
    {
        foreach($this->_exts as $ext)
        {
            if(property_exists($ext,$varname))
            return $ext->$varname;
        }
    }
    
    public function __call($method,$args)
    {
        foreach($this->_exts as $ext)
        {
            if(method_exists($ext,$method))
            return call_user_method_array($method,$ext,$args);
        }
        throw new Exception("This Method {$method} doesn't exists");
    }
    
    
}
