<?php
class infrared
{
     private $config=array();
     public function __construct(){
           $this->initTV();
           $this->initAir();
     }
     private function initTV(){
         $config=array();
         $config['1']='28';
         $config['2']='18';
         $config['3']='08';
         $config['4']='22';
         $config['5']='12';
         $config['6']='02';
         $config['7']='29';
         $config['8']='19';
         $config['9']='09';
         $config['0']='11';
         $config['声音+']='0c';
         $config['返回']='21';
         $config['频道+']='1b';
         $config['静音']='1c';
         $config['频道-']='07';
         $config['开/关']='20';
         $config['声音-']='04';
         $config['A/T']='01';
         $this->config['tv']=$config;
     }

     private function initAir(){
         $config=array();
         $config['开/关']='2a';
         $config['温度']='15';
         $this->config['air']=$config;
     }


      public function getConfig($type){
          if(isset($this->config[$type])){
              return $this->config[$type];
          }
          return array();
      }

      public function getAllCofing(){
          $retval=array();
          $config=$this->config;
          foreach($config as $key=>$item){
              foreach($item as $subkey=>$subitem){
                  $retval[]=array("label"=>"{$key}-{$subkey}","value"=>$subitem);
              }
          }
          return $retval;
      }
}
