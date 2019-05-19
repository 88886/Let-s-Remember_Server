<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\User;
use app\common\model\Friend;

class IndexController extends Controller
{
    public function index()
    {
        return '';
    }

    public function login()
    {
    	$param = Request::instance()->param();
		if (!isset($param['username']) ||!isset($param['password']))
			return ;
		$username = $param['username'];
		$password = $param['password'];

		if (User::Login($username, $password))
		{
			$user = User::get(session('user_id'));

			echo('<result>1</result>');
			echo('<user_id>' . $user->getData('user_id') . '</user_id>');
			echo('<nickname>' . $user->getData('nickname') . '</nickname>');
			echo('<mobile>' . $user->getData('mobile') . '</mobile>');
			echo('<email>' . $user->getData('email') . '</email>');
			echo('<integral>' . $user->getData('integral') . '</integral>');
			echo('<recite_short>' . $user->getData('recite_short') . '</recite_short>');
			echo('<recite_middle>' . $user->getData('recite_middle') . '</recite_middle>');
			echo('<recite_long>' . $user->getData('recite_long') . '</recite_long>');
		}
		else
		{
			echo "<result>用户名或密码错误</result>";
		}
    }

    public function register()
	{
		echo "ndienfiuewnfb";
		$param = Request::instance()->param();
		if (!isset($param['username']) ||!isset($param['password']) || !isset($param['nickname']))
			return '<result>数据出错</result>';
		$username = $param['username'];
		$password = $param['password'];
		$nickname = $param['nickname'];

		if (User::get(['username' => $username]) != null) {
			return '<result>用户名已存在</result>';
		}
		$user = new User;
		$user->username = $username;
		$user->password = $password;
		if (!$user->save()) {
			return '<result>' . $user->error() . '</result>';
		}
		echo "<result>1</result>";
		echo '<user_id>' . $user->user_id . '</result>';
	}

	public function logout()
	{
		// 这里不需要在后台退出
	}

	public function updateUserInfo()
	{
		$param = Request::instance()->param();
		$user_id = $param['user_id'];
		if ($user_id == "") return "<result>无法获取用户ID</result>";
		$user = User::get($user_id);
		if (is_null($user))	return "<result>无法获取用户</result>";

		if (isset($param['nickname']))
			$user->nickname = $param['nickname'];

		if (isset($param['username']))
			$user->username = $param['username'];

		if (isset($param['password']))
			$user->password = $param['password'];

		if (isset($param['mobile']))
			$user->mobile = $param['mobile'];

		if (isset($param['email']))
			$user->email = $param['email'];

		if (isset($param['integral']))
			$user->integral = $param['integral'];

		// 其实这个应该比大小的（怕点太快网络时延）
		// 但是一来点太快不算入记住
		// 二来会被后面的补回来
		if (isset($param['recite_short']))
			$user->recite_short = $param['recite_short'];

		if (isset($param['recite_middle']))
			$user->recite_middle = $param['recite_middle'];

		if (isset($param['recite_long']))
			$user->recite_long = $param['recite_long'];

		if ($user->isUpdate(true)->save())
			return "<result>1</result>";
		else
			return "</result>". $this->error() . "</result>";
	}

	/**
	 * 所有用户的世界排行榜
	 * @return [type] [description]
	 */
	public function getRank()
	{
		$User = new User;
		$users = $User->order('integral desc')->select();
		// echo sizeof($users);
		// var_dump($users);
		foreach ($users as $user) {
			echo "<USER>";
			echo '<USER_ID>' . $user->getData('user_id') . '</USER_ID>';
			echo '<USERNAME>' . $user->getData('username') . '</USERNAME>';
			echo '<NICKNAME>' . $user->getData('nickname') . '</NICKNAME>';
			echo '<INTEGRAL>' . $user->getData('integral') . '</INTEGRAL>';
			$recite = $user->getData('recite_short') + $user->getData('recite_middle') + $user->getData('recite_long');
			echo '<RECITE>' . $recite . '</RECITE>';
			echo '<TRPEIN>' . $user->getData('typein') . '</TRPEIN>';
			echo "</USER>";
		}
	}

	public function addFriend()
	{
		$param = Request::instance()->param();
		$user_id1 = $param['user_id'];
		$user_id2 = $param['user_id2'];

		if ($user_id1 == $user_id2)
			return '<result>这是你自己哦</result>';

		$Friend = new Friend;
		$map = ['user_id1' => $user_id1,
				'user_id2' => $user_id2];
		if ($Friend->where($map)->select())
			return '<result>你们已经是好友了</result>';


		$Friend->user_id1 = $user_id1;
		$Friend->user_id2 = $user_id2;
		$Friend->save();

		$Friend = new Friend;
		$Friend->user_id1 = $user_id2;
		$Friend->user_id2 = $user_id1;
		$Friend->save();

		echo '<result>添加好友成功</result>';
	}
}
