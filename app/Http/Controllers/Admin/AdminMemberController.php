<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class AdminMemberController extends Controller
{
    public function signIn()
    {
        return view('admin.signin');
    }

    public function signInAction(Request $request): View
    {
        $userCaptcha = $request->input('captchaCode');
        $generatedCaptcha = session()->get('captcha');
        if ($userCaptcha !== $generatedCaptcha) {
            return $this->showMessagePage("验证码不正确！");
        }

        $username = trim($request->input('username'));
        $password = trim($request->input('password'));

        $member = Member::where('user_name', $username)->first();
        if ($member) {
            //if (Hash::check($password, $user->password)) {
            if (Hash::check($password, trim($member->password))) {
                session()->put('member', $member);
                if ($member->group_id == 99) {
                    session()->put('isAdmin', true);
                }

                return $this->showMessagePage("登录成功！",url:'/');
            }
            return $this->showMessagePage("用户名或密码不正确.");
        }
        return $this->showMessagePage("用户名或密码不正确！");
    }

    public function signOutAction()
    {
        // 清除所有会话数据
        Session::flush();

        return $this->showMessagePage("登出成功！",url:'/');
    }
}
