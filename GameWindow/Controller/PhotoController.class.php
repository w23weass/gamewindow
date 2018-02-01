<?php
namespace TxdqWeb\Controller;
use Think\Controller;
class PhotoController extends BaseController{

	public function index(){
		
		$news_db=M('News');
		//游戏背景
		$gamebackgroup_rows=$news_db->where('type_id = 5 and game_id ="20" ')->limit('6')->order('num desc,addtime desc')->select();
		//新手入门
		$accidence_rows=$news_db->where('type_id = 6 and game_id ="20" ')->limit('6')->order('num desc,addtime desc')->select();
		$accidence2_rows=$news_db->where('type_id = 10 and game_id ="20" ')->limit('6')->order('num desc,addtime desc')->select();
		//基础信息
		$base_rows=$news_db->where('type_id = 7 and game_id ="20" ')->limit('6')->order('num desc,addtime desc')->select();
		//玩法活动
		$activity_rows=$news_db->where('type_id = 8 and game_id ="20" ')->limit('6')->order('num desc,addtime desc')->select();
		//系统
		$system_rows=$news_db->where('type_id = 9 and game_id ="20" ')->limit('6')->order('num desc,addtime desc')->select();		
		$assign=compact('gamebackgroup_rows','activity_rows','accidence_rows','base_rows','system_rows','accidence2_rows');
		$this->assign('assign',$assign);
		$this->display();
    }

}
