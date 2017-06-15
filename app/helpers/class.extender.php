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

	/**
	 * @name __construct Create the function that requires
	 * all the classes called by the main class
	 *
	 * @returns void
	 */
	function __construct()
	{
		
		/** Sets this to our custom var that is use to call
		 * these methods/func from the othr class */
		$_this = $this;
		
	}

	/**
	 * @name add A function the a bridge between the the
	 * class we are calling and the main oe so we can call
	 * the methods/func with ease
	 *
	 * @returns void
	 */
	public function add($object)
	{
		
		/** Sets this to our custom var that is use to hold
		 * the extended objects for later use. */
		$this->_exts[] = $object;
		
	}
	
	/**
	 * @name __get A magic method that is going to get any protected/-
	 * public vars from the other classes and returns it to the 
	 * main class
	 *
	 * @returns The var from the adjacent classes
	 */
	public function __get($varname)
	{
		
		/** Check to see if it exists with all the objects
		 * registered to the extension bridge */
		foreach($this->_exts as $ext)
		{
			
			/** Check to see if the var exists in the
			 * current class we are checking */
			if (property_exists($ext, $varname))
			{
				
				/** Return the var if it exists */
				return $ext->$varname;
			
			}
			
		}
		
	}
    
	/**
	 * @name __call A magic method that calls any function
	 * called thru the main class
	 *
	 * @returns The method from the fuction so it runs
	 * in the main class
	 */
	public function __call($method, $args)
	{
		
		/** Check to see if it exists with all the objects
		 * registered to the extension bridge */
		foreach($this->_exts as $ext)
		{
			
			/** Check to see if the var exists in the
			 * current class we are checking */
			if (method_exists($ext, $method))
			{
				
				
				return call_user_method_array($method, $ext, $args);
			
			}
			
		}
		
		/** Initiate a new runtime error and
		 * throw a new runtime exception */
		throw new \RuntimeException("This method {$method} doesn't exists");
		
	}

}
