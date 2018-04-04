<?php
// +----------------------------------------------------------------------
// | Description: 组织架构
// +----------------------------------------------------------------------
// | Author: linchuangbin <linchuangbin@honraytech.com>
// +----------------------------------------------------------------------

namespace app\admin\controller;

use app\admin\model\Access;
use app\common\controller\ApiCommon;

class Workbenches extends ApiCommon
{
	//工作台任务列表
	public function index()
	{
		$workbench_model = model('Workbench');
		$uid = $this->uid;
		$group_id = Access::get($uid)->group_id;
		$param = $this->param;
		$keywords = !empty($param['keywords']) ? json_decode($param['keywords'], true) : '';
		$page = !empty($param['page']) ? $param['page'] : '';
		$limit = !empty($param['limit']) ? $param['limit'] : '';
		$data = $workbench_model->getTaskList($keywords, $page, $limit, $uid, $group_id);
		return resultArray(['data' => $data]);
	}

	//工作台 - 任务标准列表
	public function index_list()
	{
		$workbench_model = model('Workbench');
		$uid = $this->uid;
		$group_id = Access::get($uid)->group_id;
		$param = $this->param;
		$keywords = !empty($param['keywords']) ? json_decode($param['keywords'],true) : '';
		$page = !empty($param['page']) ? $param['page'] : '';
		$limit = !empty($param['limit']) ? $param['limit'] : '';
		$data = $workbench_model->getList($keywords,$page,$limit,$uid,$group_id);
		return resultArray(['data'=>$data]);
	}

	//工作台 - 等待上游 资产列表
	public function wait_upper_assets(){
		$workbench_model = model('Workbench');
		$uid = $this->uid;
		$group_id = Access::get($uid)->group_id;
		$param = $this->param;
		$keywords = !empty($param['keywords']) ? json_decode($param['keywords'],true) : '';
		$page = !empty($param['page']) ? $param['page'] : '';
		$limit = !empty($param['limit']) ? $param['limit'] : '';
		$data = $workbench_model->getUpperAssets($keywords,$page,$limit,$uid,$group_id);
		return resultArray(['data'=>$data]);
	}

	//工作台 - 等待上游 镜头列表
	public function wait_upper_shots(){
		$workbench_model = model('Workbench');
		$uid = $this->uid;
		$param = $this->param;
		$keywords = !empty($param['keywords']) ? json_decode($param['keywords'],true) : '';
		$page = !empty($param['page']) ? $param['page'] : '';
		$limit = !empty($param['limit']) ? $param['limit'] : '';
		$data = $workbench_model->getUpperShots($keywords,$page,$limit,$uid);
		return resultArray(['data'=>$data]);
	}

	//工作台 - 完成
	public function finish_list(){
		$workbench_model = model('Workbench');
		$uid = $this->uid;
		$param = $this->param;
		$keywords = !empty($param['keywords']) ? json_decode($param['keywords'],true) : '';
		$page = !empty($param['page']) ? $param['page'] : '';
		$limit = !empty($param['limit']) ? $param['limit'] : '';
		$data = $workbench_model->getFinishTask($keywords,$page,$limit,$uid);
		return resultArray(['data'=>$data]);
	}

	//工作台列表
	public function workbenches_list(){

	}

	//详情
	public function read()
	{
		$workbench_model = model('Workbench');
		$param = $this->param;
		$data = $workbench_model->getData_ById($param['id']);
		if (!$data) {
			return resultArray(['error' => $workbench_model->getError()]);
		}
		return resultArray(['data' => $data]);
	}

	public function save()
	{
		$workbench_model = model('Workbench');
		$param = $this->param;
		$data = $workbench_model->addData($param);
		if (!$data) {
			return resultArray(['error' => $workbench_model->getError()]);
		}
		return resultArray(['data' => '添加成功']);
	}

	public function update()
	{
		$workbench_model = model('Workbench');
		$param = $this->param;
		$task_id = !empty($param['id']) ? $param['id'] : '';
		$data = $workbench_model->updateData_ById($param, $task_id);
		if (!$data) {
			return resultArray(['error' => $workbench_model->getError()]);
		}
		return resultArray(['data' => '编辑成功']);
	}

	//改变任务状态
	public function change_status()
	{
		$workbench_model = model('Workbench');
		$param = $this->param;
		$uid = $this->uid;
		$group_id = Access::get($uid)->group_id;
		$task_id = !empty($param['id']) ? $param['id'] : '';
		$data = $workbench_model->change_task_status($task_id, $param['status'], $uid,$group_id);
		if (!$data) {
			return resultArray(['error' => $workbench_model->getError()]);
		}
		return resultArray(['data' => '操作成功']);
	}

	//删除一条数据
	public function delete()
	{
		$workbench_model = model('Workbench');
		$param = $this->param;
		$data = $workbench_model->delDataById($param['id'], true);
		if (!$data) {
			return resultArray(['error' => $workbench_model->getError()]);
		}
		return resultArray(['data' => '删除成功']);
	}

	//批量删除
	public function deletes()
	{
		$workbench_model = model('Workbench');
		$param = $this->param;
		$data = $workbench_model->delDatas($param['ids'], true);
		if (!$data) {
			return resultArray(['error' => $workbench_model->getError()]);
		}
		return resultArray(['data' => '删除成功']);
	}

	//批量改变状态
	public function enables()
	{
		$workbench_model = model('Workbench');
		$param = $this->param;
		$data = $workbench_model->enableDatas($param['ids'], $param['status'], true);
		if (!$data) {
			return resultArray(['error' => $workbench_model->getError()]);
		}
		return resultArray(['data' => '操作成功']);
	}


}
