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
        $cmd=trim($_GET['cmd']);
        $queue = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ, "MySock1");
        $queue->connect("tcp://127.0.0.1:5555");
        $queue->send($cmd);
        $recv=$queue->recv();
        return json_encode(array("code"=>0,"message"=>$recv));
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
