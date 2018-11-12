<?php

namespace App\Facades;

 use Illuminate\Support\Facades\Facade;

 class DefaultInputValue extends Facade
 {
 	
 	protected static function getFacadeAccessor() 
 	{ 
 		return 'defValue'; 
 	}
 }