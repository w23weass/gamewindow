<?php
namespace TxdqWeb\Controller;
use Think\Controller;
class NewsController extends BaseController{

	public function index(){
		$news_type = I('type'); //获取新闻类型
		$page = I('page','1',''); //当前页面
		$limit = 15; //每页显示多少
		$order = "num desc,addtime desc";
		$where='game_id = "20" and ';
		switch($news_type){
			case 'activity':
				$where .= 'status = 1 and type_id= 3';		
				break;
			case 'notice':
				$where .= 'status = 1 and type_id= 2';		
				break;
			case 'policy':
				$where .= 'status = 1 and type_id= 4';		
				break;
			case 'news':
				$where .= 'status = 1 and type_id= 1';		
				break;
			default :
				$where .= 'status = 1 and type_id in (1,2,3,4) ';
				break;
		}
		$news_db = M('News');
		$count = count($news_db->where($where)->select());
		$paging = $this->pageing($count,$limit,$page);
		if( $count >0 ) {
			$total_pages = ceil($count/$limit);
		}else{
			$total_pages = 1;
		}
		if ($page > $total_pages) $page = $total_pages;
		$start = $limit * $page - $limit;
		$limit = "{$start},{$limit}";
		$new_list =$news_db->where($where)->order($order)->limit($limit)->select();
		$assign=compact('news_type','new_list','paging');
		$this->assign('assign',$assign);
		$this->display();
    }

	public function details(){
		$status = I('status');
		$id = I('id');
		$news_db = M('News');
		$news_rows=$news_db->where('id="'.$id.'" and game_id = "20" ')->find();
		$assign=compact('news_rows','status');
		$this->assign('assign',$assign);
		$this->display();
	}

	public function tourl($action,$param){
		parse_str($_SERVER['QUERY_STRING'].'&'.$action.'='.$param,$url);
		$url['type'] = isset($url['type'])?$url['type']:'';
		if(CONTROLLER_NAME == 'News'){
			$urls="/news_".ACTION_NAME.".html?type=".$url['type'].'&page='.$url['page'];
		}
		return $urls;
	}

	public function pageing($recordcount,$pagesize,$page=1){
		$style_parma = array("pagenext" => "下一页"
		,"pagepre" =>"上一页"
		,"pagefirst" => "首页"
		,"pageend" => "尾页");
		if(!$recordcount)return false;
		if(!$pagesize)$pagesize = 20;//默认30?
		$pagecount = ceil($recordcount/$pagesize);
		$echo =  '<div class="pager" >';
		$echo .= '<a href="'.self::tourl('page',1).'" style="margin-right:10px;">'.$style_parma["pagefirst"].'</a>';
		$echo .= $page>1 ? '<a href="'.self::tourl('page',$page-1).'" style="margin-right:10px;">'.$style_parma['pagepre'].'</a>' : '<a style="margin-right:10px;">'.$style_parma['pagepre'].'</a>';
		for($i = ($page>20 ? $page-10 : 1);($i<=$page+20 && $i<=$pagecount);$i++)
		{
			$echo .= $i==$page ? '<a class="active" style="margin-right:10px;">'.$i.'</a>' : '<a href="'.self::tourl('page',$i).'" style="margin-right:10px;">'.$i.'</a>';
		}
		$echo .= $page<$pagecount ? '<a href="'.self::tourl('page',$page+1).'" style="margin-right:10px;">'.$style_parma['pagenext'].'</a>' : '<a style="margin-right:10px;">'.$style_parma['pagenext'].'</a>';
		$echo .= '<a href="'.self::tourl('page',$pagecount).'" style="margin-right:10px;">'.$style_parma['pageend'].'</a>';
		$echo .= '</div>';
		return $echo;
	}

}
