<?php

class HtmlElement
{
   private $TagName;
   private $IsAutoClose;
   private $Attributes;
   private $Children;
   public $InnerText;
   public $Id;
   private $Classes;
   
   public function __construct($tagname, $autoclose = false, $innertext = null)
   {
      $this->IsAutoClose = $autoclose;
      $this->TagName = $tagname;
      $this->Attributes = array();
      $this->Children = array();
      $this->InnerText = $innertext;
      $this->Id = null;
      $this->Classes = array();
   }
   
   public function SetAttribute($name, $value)
   {
      $name = strtolower($name);
      if($name == "id")
      {
         $this->Id = $value;
         return;
      }
      
      if($name == "class")
      {
         $this->AddClass($value);
         return;
      }
      
      //if($this->AttributeExists($name))
      //   throw new Exception(__CLASS__ . '::' . __METHOD__ . 'The attribute already exists');
      $this->Attributes[$name] = $value;
   }
   
   public function GetAttribute($name)
   {
      $name = strtolower($name);
      if($name == "id")
         return $this->Id;
         
      if($this->AttributeExists($name))
         return $this->Attributes[$name];
         
      throw new Exception(__CLASS__ . '::' . __METHOD__ . " The attribute doesn's exist");
   }
   
   private function AttributeExists($name)
   {
      if(isset($this->Attributes[$name]))
         return true;
         
      return false;
   }
   
   public function AppendChild(HtmlElement $element)
   {
      $this->Children[] = $element;
   }
   
   public function AppendChildren($children)
   {
      if(!is_array($children))
         throw new Exception(__CLASS__ . "::" . __METHOD__ . "The argument is not an array");
         
      foreach($children as $child)
         $this->AppendChild($child);
   }
   
   public function AddClass($class)
   {
      if(!in_array($class, $this->Classes))
         $this->Classes[] = $class;
   }
   
   public function __toString()
   {
      $str = '<' . $this->TagName;
      if($this->Id != null)
         $str .= ' id="' . $this->Id . '"';
      if(count($this->Classes) > 0)
      {
         $str .= ' class="';
         foreach($this->Classes as $class)
            $str .= $class . ' ';
         $str = substr($str, 0, strlen($str) - 1);
         $str .= '"';
      }
         
      foreach($this->Attributes as $att => $val)
         $str .= ' ' . $att . '="' . $val . '"';
         
      if($this->IsAutoClose)
         $str .= ' />';
         
      else
      {
         $str .= '>';
         foreach($this->Children as $child)
            $str .= $child->__toString();
            
         if($this->InnerText != null)
            $str .= $this->InnerText;
            
         $str .= '</' . $this->TagName . '>';
      }
      
      //Activated only in debugging process
      //echo htmlentities($str);
      return $str;
   }
}