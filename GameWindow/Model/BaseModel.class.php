<?php
namespace Home\Model;
use Think\Model;
class BaseModel extends Model {

    Protected $autoCheckFields = false;

    public function getModelObj($model,$tablePrefix='',$connection=''){
        $mobj = M($model,$tablePrefix,$connection);
        return $mobj;
    }

    public function getIdToName($model,$field='id',$name,$where,$type='array',$tablePrefix='',$connection=''){
        $modelobj = $this->getModelObj($model,$tablePrefix,$connection);
        $data = $modelobj->field("$field,$name")->where($where)->select();
        $resdata = array();
        foreach($data as $k=>$v){
            $resdata[$v[$field]] = $v[$name];
        }
        switch($type){
            case 'array' : break;
            case 'json' : $resdata = json_encode($resdata);
                break;
        }
        return $resdata;
    }
}