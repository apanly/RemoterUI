<?php
class defaultController extends Controller
{
    public function defaultAction()
    {
        $type=trim($_GET['type']);
        if(!in_array($type,array("tv","air"))){
            $type="tv";
        }
        $uitarget=new infrared();
        $tvconfig=$uitarget->getConfig($type);
        $this->data=$this->formatLine($tvconfig);
        return $this->render("default");
    }
    public function customAction(){
        return $this->render("default");
    }
    public function zmqAction(){
        $code=1;
        $message="连接ZMQ错误";
        $dns="tcp://localhost:5555";
        $cmd=trim($_GET['cmd']);
        try{
            /*如果设置$persistent_id，在测试过程中发现如果三次连接不上，就会报
            Uncaught exception 'ZMQSocketException' with message 'Failed to send message: Operation cannot be accomplished in current state
            */
            //$queue = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ, "MySock1");
            $queue = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ);
            $queue->setSockOpt(ZMQ::SOCKOPT_SNDTIMEO,1000);
            $queue->setSockOpt(ZMQ::SOCKOPT_RCVTIMEO,1000);
            $queue->connect($dns);
            $queue->send($cmd);
            $message=$queue->recv();
            $code=0;
        }catch (Exception $e){
            $message=$e->getMessage();
        }
        $queue->disconnect($dns);
        return json_encode(array("code"=>$code,"message"=>$message));
    }

    private function formatLine($data,$onelimit=3){
      $returnVal=array();
      $len=ceil(count($data)/$onelimit);
      for($i=0;$i<$len;$i++){
          $returnVal[]=array_slice($data,$i*$onelimit,$onelimit,true);
      }
      return $returnVal;
    }

    public function getcmdtipsAction(){
        $uitarget=new infrared();
        return json_encode($uitarget->getAllCofing());
    }
}
