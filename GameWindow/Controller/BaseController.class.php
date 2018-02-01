<?php
namespace GameWindow\Controller;
use Think\Controller;
class BaseController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->assign('host',C('TXDQ_DOMAIN'));//获取网站域名
		/*$this->assign('siteinfo',$this->getSiteInfo()); //获取站点信息
		$this->assign('headgames',$this->getHeadGame()); //获取友情链接
		$this->assign('links',$this->getLinks()); //获取友情链接
		$this->assign('fcolumns',$this->getFcolumns()); //获取底部栏目
		$this->assign('model',CONTROLLER_NAME); //获取底部栏目*/
	}

	private function getLinks(){
		//友情链接
		$where ='status = 1 and type = 0';
		$order = 'num desc,id desc';
		$limit = '15';
		$links_db = M('Links');
		$links_rows = $links_db->where($where)->order($order)->limit($limit)->select();
		return $links_rows;
	}
	private function getFcolumns(){
		//底部栏目
		$where = 'status = 1';
		$order = 'num desc,id desc';
		$limit = '8';
		$fcolumns_db = M('Fcolumns');
		$fcolumns_rows = $fcolumns_db->where($where)->order($order)->limit($limit)->select();
		return $fcolumns_rows;
	}
	public function getSiteInfo(){
		//站点信息
		$site_info_db = M('SiteInfo');
		$site_info_row = $site_info_db->find(1);
		return $site_info_row;
	}
	private function getHeadGame(){
		//获取游戏id对应字段，以及游戏类型对应字段

		$game = D('Base')->getIdToName('Game', 'id', 'name', 'status = 1', 'array', 'cms_', 'DB_WWW');
		$gameidcode = D('Base')->getIdToName('Game', 'id', 'code', 'status = 1', 'array', 'cms_', 'DB_WWW');

		//热门游戏
		$where = 'status = 1';
		$order = 'num desc,id desc';
		$limit = '12';
		$game_hots_db = M('GameHots');
		$head_game['hots'] = $game_hots_db->where($where)->order($order)->limit($limit)->select();
		foreach($head_game['hots'] as $k=>$v){
			$head_game['hots'][$k]['name'] = $game[$v['gameid']];
			$head_game['hots'][$k]['code'] = $gameidcode[$v['gameid']];
		}
		//最新游戏
		$where = 'status = 1 and isshow = 1';
		$order = 'num desc,id desc';
		$limit = '24';
		$game_db = M('Game');
		$head_game['news'] = $game_db->where($where)->order($order)->limit($limit)->select();
		return $head_game;

	}
	public function getUserRow(){
		if($_SESSION['user']['loginname']){
			$loginname=$_SESSION['user']['loginname'];
			$user_db = M('User');
			$where['loginname'] = $loginname;
			$user_row = $user_db->where($where)->find();
			if($user_row['birthday']){
					$birthday=explode('-',$user_row['birthday']);
					$user_row['year']=$birthday[0];
					$user_row['mon']=$birthday[1];
					$user_row['day']=$birthday[2];
			}
			return $user_row;
		}
	}
	public function getCardTypeRows(){
		//热门礼包
				$game = D('Base')->getIdToName('Game', 'id', 'name', 'status = 1', 'array', 'cms_', 'DB_WWW');
				$gamepicture=D('Base')->getIdToName('GamePicture', 'gameid', 'icon-144x144', 'status = 1', 'array', 'cms_', 'DB_WWW');//获取133*133的icon
				$card_type_db = M('CardType');
				$limit='3';
				$where = 'status = 1';
				$order = 'num desc,id desc';
				$card_type_rows = $card_type_db->where($where)->order($order)->limit($limit)->select();
				foreach($card_type_rows as $k=>$v){
					$card_type_rows[$k]['game_name'] = $game[$v['gameid']];		
					$card_type_rows[$k]['game_picture'] = $gamepicture[$v['gameid']];	
				}
				return $card_type_rows;
	}
}
