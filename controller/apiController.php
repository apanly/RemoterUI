<?php
/**
 * 所有树莓派用到的phpapi都放在这里
 */
class apiController extends Controller
{
    private $lb=array('台风','暴雨','暴雪','寒潮','大风','沙尘暴','高温','干旱','雷电','冰雹','霜冻','大雾','霾','道路结冰');
    private $jb=array('蓝色','黄色','橙色','红色','白色');
    /**
     * 天气api
     * 默认上海天气
     */
   public function onedayweatherAction(){
    $cid=$_GET['cityid']?$_GET['cityid']:101020100;
    $wuri="http://m.weather.com.cn/data/{$cid}.html";
    $httptarget=new Httplib();
    $data=$httptarget->get($wuri);
    if($data['response']['code']==200){
           $weatherarray=json_decode($data['body'],true);
           $weather=$weatherarray['weatherinfo'];
           $todayinfo=array();
           $todayinfo['city']=$weather['city'];
           $todayinfo['temp']=$weather['temp1'];
           $tmp=explode("~",$todayinfo['temp']);
           $todayinfo['htemp']=$tmp[0];
           $todayinfo['ltemp']=$tmp[1];
           $todayinfo['weather']=$weather['weather1'];
           $content="今天{$todayinfo['city']}的最高气温{$todayinfo['htemp']},最低气温{$todayinfo['ltemp']},{$todayinfo['weather']}";
           $this->sendmail($content);
    }
  }

   public function liveweatherAction(){
       $cid=$_GET['cityid']?$_GET['cityid']:101020100;
       $wuri="http://www.weather.com.cn/data/sk/{$cid}.html";
       $httptarget=new Httplib();
       $data=$httptarget->get($wuri);
       if($data['response']['code']==200){
           $weatherarray=json_decode($data['body'],true);
           $weather=$weatherarray['weatherinfo'];
           $liveinfo=array();
           $liveinfo['city']=$weather['city'];
           $liveinfo['temp']=$weather['temp'];
           $liveinfo['wd']=$weather['WD'];
           $liveinfo['ws']=$weather['WS'];
           $content="目前{$liveinfo['city']}的温度是{$liveinfo['temp']},{$liveinfo['wd']}{$liveinfo['ws']}";
           $this->sendmail($content);
       }
   }

    public function weatherwarnAction(){
        $alerturi="http://product.weather.com.cn/alarm/grepalarm.php?areaid=[\d]{5,7}&type=[\d]{2}&level=[\d]{2}";
        $httptarget=new Httplib();
        $data=$httptarget->get($alerturi);
        if($data['response']['code']==200){
           $alert=$data['body'];
           $alert=substr($alert,strlen("var alarminfo="));
           $alert=substr($alert,0,-1);
           $alertcontent=json_decode($alert,true);
           if($alertcontent['count']>0){
               foreach($alertcontent['data'] as $item){
                   $tmp=explode("-",$item[1]);
                   $lbindex=((int)substr($tmp[2],0,2))-1;
                   $jbindex=((int)substr($tmp[2],2,2))-1;
                   echo $item[0]."--".$this->lb[$lbindex].$this->jb[$jbindex]."<br/>";
               }
           }
        }
    }

   private function sendmail($body){
       $mailTarget=new mail();
       $mailTarget->addAddress('13774355074@139.com', 'Vincentguo139');
       $mailTarget->sendMail("天气预报",$body);
   }
}
