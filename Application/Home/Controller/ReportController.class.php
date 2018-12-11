<?php
namespace Home\Controller;
use Think\Controller;
class ReportController extends Controller{
	//导出榜单列表为excel，执行此接口，直接进行下载。
	public function exporttable1(){
		
			// $xlsName  = "主播类型与粉丝数关联挖掘结果";
		$xlsName  = "";
			$xlsCell  = array(
				array('id','序号'),
				array('rule','规则内容'),
				array('trust_ratio','可信度'),
				array('support_ratio','置信度'),				
				);
			
			$result=M('temp1')->field('id,rule,trust_ratio,support_ratio')->select();
			A("Home/Excel")->exportExcel1($xlsName,$xlsCell,$result);
	}
	//导出榜单列表为excel，执行此接口，直接进行下载。
	public function exporttable2(){
		
			$xlsName  = "";
			$xlsCell  = array(
				array('id','序号'),
				array('rule','规则内容'),
				array('trust_ratio','可信度'),
				array('support_ratio','置信度'),				
				);
			$result=M('temp2')->field('id,rule,trust_ratio,support_ratio')->select();
			A("Home/Excel")->exportExcel2($xlsName,$xlsCell,$result);
	}
}