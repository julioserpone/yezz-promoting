<?php

namespace App\Facades\Components;

class DefaultInputValue
{
    private $name;
    private $field;

    /**
     * Create a new defValue manager instance.
     *
     * @return void
     */
    public function __construct(){ }

    private function iniFieldAndName($data)
    {
        if (is_array($data)){
            $this->field=$data[1];
            $this->name=$data[0];
        }else{
            $this->name=$this->field=$data;
        }
    }

    private function getObjValue($obj,$fiel)
    {
        if (!$obj){
            return false;
        }
        $obj=is_array($obj)?$obj:$obj->toArray();
        return isset($obj[$fiel])?$obj[$fiel]:false;
    }

    public function text($old,$obj,$name)
    {
        $this->iniFieldAndName($name);
        $value=isset($old[$this->name])?$old[$this->name]:$this->getObjValue($obj,$this->field);
        return $value===false?'':$value;
    }

    public function select($old,$obj,$name,$val)
    {
        $this->iniFieldAndName($name);
        $value=isset($old[$this->name])?$old[$this->name]:$this->getObjValue($obj,$this->field);
        return $value===false?'':($value==$val?'selected="selected"':'');        
    }


}