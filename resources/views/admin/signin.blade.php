@extends('layouts.default')
@section("title",'登录')

@section("body")

    <div class="row-fluid index-list">
        <div class="span12">

            <form action="/{{$cfAdminPath}}/signInAction" method="post">
                <p>
                    <label for="">用户名:</label> <input name="username" type="text" autocomplete="off"/>
                    <span class="red">*</span>
                </p>
                <p>
                    <label for="">密码:</label> <input name="password" type="password" autocomplete="off"/>
                    <span class="red">*</span>
                </p>

                <p><label for="">验证码:</label>
                    <input name="captchaCode" type="text" maxlength="5" autocomplete="off" />
                    <span class="red">*</span>
                </p>
                <p>
                    <img id="captchaImg" src="" alt="captcha" title="Click to get a new captcha."/>
                    <input type="hidden" id="captchaId" name="captchaId" value=""/>

                </p>
                <p>
                    <label for=""></label>
                    <input type="submit" name="doSubmit" value="提交" class="btn btn-primary">
                    @csrf
                </p>
            </form>

        </div>
    </div>

@endsection

@section("javascript")
    <script type="text/javascript">
        $('[name="doSubmit"]').click(function () {
            if (!checkEmptyTxt('username')) {
                return false
            }
            if (!checkEmptyTxt('password')) {
                return false
            }
            if (!checkEmptyTxt('captchaCode')) {
                return false
            }
        })

       handleCaptcha()
    </script>
@endsection
