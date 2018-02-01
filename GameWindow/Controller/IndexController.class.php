<?php
namespace GameWindow\Controller;
use Think\Controller;
class IndexController extends BaseController{

	public function index(){
		$focus_middle_pic=M('Focus')->where('focustype = 1 and gameid="20"')->order('num desc,addtime desc')->select();
		$focus_middle1_pic=M('Focus')->where('focustype = 2 and gameid="20"')->order('num desc,addtime desc')->select();
		$focus_footer_pic=M('Focus')->where('focustype = 3 and gameid="20"')->order('num desc,addtime desc')->select();
		//新闻攻略
		$news_db=M('News');
		$policy_rows=$news_db->where('type_id = 4 and game_id="20"')->limit('6')->order('num desc,addtime desc')->select();
		//新闻活动
		$activity_rows=$news_db->where('type_id = 3 and game_id="20"')->limit('6')->order('num desc,addtime desc')->select();
		//新闻公告
		$notice_rows=$news_db->where('type_id = 2 and game_id="20"')->limit('6')->order('num desc,addtime desc')->select();
		//新闻
		$news_rows=$news_db->where('type_id = 1 and game_id="20"')->limit('6')->order('num desc,addtime desc')->select();
		//新闻综合
		$group_rows=$news_db->where('type_id in(1,2,3,4) and game_id="20"' )->limit('6')->order('num desc,addtime desc')->select();		
		$assign=compact('focus_middle_pic','policy_rows','activity_rows','notice_rows','news_rows','group_rows','focus_footer_pic','focus_middle1_pic');
		$this->assign('assign',$assign);
		$this->display();
		
    }

}
