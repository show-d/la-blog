@extends('layouts.default')

@section('title',$content->content_id>0?'编辑文章':'发表博文')

@section("body")
    @if($errors->any())
        <div class="error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row-fluid index-list">
        <div class="span12 add-edit">

            <form action="/{{$cfAdminPath}}/addEditAction/{{$content->content_id}}" method="post">
                <p>
                    <label for="">标题:</label> <input name="title" type="text" value="{{ $content->title}}"/><span
                        class="red">*</span>
                </p>
                <p>
                    <label for="">目录:</label>
                    <select name="cat_id" id="">
                        @foreach( $catList as $v)
                            <option value="{{$v->cat_id}}">{{$v->cat_name}}</option>
                        @endforeach
                    </select>
                    <span class="red">*</span>
                </p>
                <p>
                    <label for="">标签:</label> <input name="keyword" type="text" value="{{$content->keyword}}"/><span
                        class="red">*</span>
                </p>
                <p>
                    <label for="">介绍:</label> <textarea name="description">{{ $content->description}}</textarea>
                </p>
                <p>
                    <label for="">页面路由(用于自定义文章url):</label> <input name="html_name" type="text"
                                                                              value="{{ $content->html_name}}"/><span
                        class="red">*</span>
                </p>
                <p>
                    <label for="">发布时间:</label>
                    <input name="PublishTime" type="hidden" value="{{$content->publish_time}}"/>
                    <input name="txtPublishTime" type="text" data-value="{{$content->publish_time}}" value=""/>
                </p>

                <p>
                <div class="btn-group" role="group" aria-label="">
                    <label for="">状态:</label>

                    @if($content->content_id>0)
                        <input type="radio" class="btn-check" name="status" id="btnradio1" autocomplete="off" value="-1"
                               value="0" @if($content->status == -1)  checked @endif />
                        <label class="btn btn-mini btn-danger" for="btnradio1">删除</label>
                    @endif

                    <input type="radio" class="btn-check" name="status" id="btnradio2" autocomplete="off" value="1"
                           value="1" @if($content->status == 1)  checked @endif />
                    <label class="btn btn-mini" for="btnradio2">草稿</label>

                    <input type="radio" class="btn-check" name="status" id="btnradio3" autocomplete="off" value="99"
                           @if($content->status == 99 || $content->content_id<=0)  checked @endif />
                    <label class="btn btn-mini btn-success" for="btnradio3">通过</label>
                </div>
                </p>

                <p>
                    <label for="">内容:</label>


                    <!-- 编辑器 DOM -->
                <div style="border: 1px solid #ccc;">
                    <div id="editor-toolbar" style="border-bottom: 1px solid #ccc;"></div>
                    <div id="editor-text-area" style="height: 500px"></div>
                </div>


                </p>

                <p>
                    <button type="button" class="btn" id="btnCancel">取消</button>
                    <button type="submit" class="btn btn-success" name="doSubmit">提交</button>
                    <input type="hidden" name="hidcat_id" value="{{$content->cat_id}}">
                    <input type="hidden" name="content_id" value="{{$content->content_id}}">
                    <input type="hidden" name="content" id="hidContent" value="">
                    @csrf
                </p>

                </ul>
            </form>

        </div>
    </div>

    <hr>
@endsection

@section("javascript")
    <link rel="stylesheet" href="{{ asset('js/highlight/styles/github.min.css')}}">
    <link href="{{ asset('js/editor/wangEditor.css')}}" rel="stylesheet"/>
    <link href="{{ asset('js/highlight/highlightjs-line-numbers.css')}}" rel="stylesheet"/>
    <script src="{{ asset('js/editor/wangEditor.min.js')}}"></script>
    <script src="{{ asset('js/highlight/highlight.min.js')}}"></script>
    <script src="{{ asset('js/highlight/highlightjs-line-numbers.min.js')}}"></script>
    <style type="text/css">
        .w-e-text-container [data-slate-editor] pre > code {
            margin: 0 !important;
        }
    </style>
    <script>
        const E = window.wangEditor

        // 切换语言
        const LANG = location.href.indexOf('lang=en') > 0 ? 'en' : 'zh-CN'
        E.i18nChangeLanguage(LANG)
        window.editor = E.createEditor({
            selector: '#editor-text-area',
            html: `{!! $content->content !!}`,
            config: {
                placeholder: 'Type here...',
                MENU_CONF: {
                    uploadImage: {
                        fieldName: 'file',
                        server: '/{{$cfAdminPath}}/uploadFileAction'
                    }
                },
                onChange(editor) {
                    console.log(editor.getHtml())
                    $('[name="content"]').val(editor.getHtml())
                },
                onblur(editor) {
                    hljs.highlightAll();
                    hljs.initLineNumbersOnLoad();
                }

            }
        })

        window.toolbar = E.createToolbar({
            editor,
            selector: '#editor-toolbar',
            config: {}
        })

        function containsChinese(str) {
            const pattern = /[\u4E00-\u9FA5]+/;
            return pattern.test(str);
        }

        $('[name="title"]').blur(function () {
            var str = $(this).val();

            if (containsChinese(str)) {
                /*                $.post('/convertToPinyin', {"_token": _token, "text": str}, function (d) {
                                    str = join(' ', d.data);
                                })*/

                $.ajax({
                    type: 'POST',
                    url: '/convertToPinyin',
                    data: {"_token": _token, "text": str},
                    async: false,
                    success: function (d) {
                        str = d.data.join(' ');

                        console.log(str)
                    },
                    error: function (xhr, status, error) {
                        // 处理错误响应
                        console.error(error);
                    }
                });
            }

            var url = $.trim(str.toLowerCase()).replace(/[^a-zA-Z0-9]/g, '-')
            url = url.replace(/--/g, '-')
            var urlLen = url.length
            var lastCharacter = url.substring(urlLen - 1, urlLen)
            if (lastCharacter === '-')
                url = url.substring(0, urlLen - 1)
            $('[name="html_name"]').val(url)
        })

        $('[name="doSubmit"]').click(function () {
            if (!checkEmptyTxt('title')) {
                return false
            }
            if (!checkEmptyTxt('keyword')) {
                return false
            }
            if (!checkEmptyTxt('html_name')) {
                return false
            }

            setPublishTime()
        })

        function setPublishTime() {
            var $publishTime = $('[name="PublishTime"]')
            var $txtPublishTime = $('[name="txtPublishTime"]')
            var publishTime = $.trim($publishTime.val())
            if (publishTime === '0' || publishTime === '') {
                publishTime = Math.floor(new Date().getTime() / 1000)
            }
            $txtPublishTime.val(timeConverter(publishTime, 'yyyyMMddHHmmss'))
            var publishTime = Math.floor(new Date($txtPublishTime.val()).getTime() / 1000)
            $publishTime.val(publishTime)
        }

        setPublishTime()

        if ($('input[name="status"]:checked').size() === 0)
            $('input[name="status"]:eq(2)').prop('checked', true)

        var catId = parseInt($('input[name="hidcat_id"]').val())
        if (!isNaN(catId)) {
            $('select option[value="' + catId + '"]').prop('selected', true)
        }

    </script>
@endsection
