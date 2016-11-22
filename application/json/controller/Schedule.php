<?php
/**
 * Created by PhpStorm.
 * User: HC
 * Date: 2016/11/16
 * Time: 17:20
 */
namespace app\json\controller;
use app\json\table\Schedules;
class Schedule extends Base{
    /*
         * 添加日程信息
         * */
    public function scheduleAdd(){
        $data['carno']=input('param.carno');
        $data['timestart']=input('param.timestart');
        $data['timeend']=input('param.timeend');
        $validate=$this->validate($data,'Schedule');
        //var_dump($validate);exit;
        if(true!==$validate){
            $this->setDesc(" $validate ");
            $this->setResponseData([]);
            return 2;
        }
        $sc=new Schedules();
        $sc->setCarno($data['carno']);
        $sc->setTimestart($data['timestart']);
        $sc->setTimeend($data['timeend']);
        $re=$sc->add();
        if($re!=0){
            $this->setDesc('添加失败');
            $this->setResponseData([]);
            return 3;
        }
        $this->setDesc('添加日程成功');
        $this->setResponseData(['carno'=>$data['carno'],'timestart'=>$data['timestart'],'timeend'=>$data['timeend']]);
        return 0;
    }
    public function addSc(){
        $result=$this->scheduleAdd();
        $data=['retcode'=>$result,'desc'=>$this->getDesc(),$this->getResponseData()];
        return $this->response($data,'json',200);
    }

    /*
     * 删除
     * */


    
}