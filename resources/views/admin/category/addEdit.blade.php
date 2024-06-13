@extends('layouts.default')

@section('title',$category->cat_id>0?'编辑目录':'添加目录')

@section("body")
    <div class="row-fluid index-list">
        <div class="span12 add-edit">

            <form action="/{{$cfAdminPath}}/addEditCategoryAction/{{$category->cat_id}}" method="post">
                <p>
                    <label for="">目录名称:</label>
                    <input name="cat_name" type="text" @if($category->cat_id>0) disabled @endif
                    value="{{$category->cat_name}}"/>
                </p>
                <p>
                    <label for="">SEO关键字:</label>
                    <input name="keyword" type="text"
                           value="{{$category->keyword}}"/>
                </p>
                <p>
                    <label for="">SEO介绍:</label>
                    <textarea
                        name="description">{{$category->description}} </textarea>
                </p>

                <p>
                <div class="btn-group" role="group" aria-label="">
                    <label for="">类型:</label>
                    <input type="radio" class="btn-check" name="is_page" id="btnradiop1" autocomplete="off" value="0"
                           value="0" @if($category->is_page == 0) checked @endif />
                    <label class="btn btn-mini" for="btnradiop1">普通目录</label>

                    <input type="radio" class="btn-check" name="is_page" id="btnradiop2" autocomplete="off" value="1"
                           value="1" @if($category->is_page == 1) checked @endif />
                    <label class="btn btn-mini" for="btnradiop2">单页面</label>
                </div>

                </p>
                <p>
                <div class="btn-group" role="group" aria-label="">
                    <label for="">状态:</label>
                    <input type="radio" class="btn-check" name="status" id="btnradio1" autocomplete="off" value="-1"
                           value="0" @if($category->status ==-1) checked @endif />
                    <label class="btn btn-mini btn-danger" for="btnradio1">删除</label>

                    <input type="radio" class="btn-check" name="status" id="btnradio2" autocomplete="off" value="1"
                           value="1" @if($category->status ==1) checked @endif />
                    <label class="btn btn-mini" for="btnradio2">草稿</label>

                    <input type="radio" class="btn-check" name="status" id="btnradio3" autocomplete="off" value="99"
                           @if($category->status ==99) checked @endif />
                    <label class="btn btn-mini btn-success" for="btnradio3">通过</label>
                </div>

                </p>

                <p>
                    <label for="">内容:</label>
                    <textarea name="cat_content" class="category-textarea">{{$category->cat_content}}</textarea>
                </p>

                <p>
                    <input type="hidden" name="cat_id" value="{{$category->cat_id}}">
                    <button type="button" class="btn">取消</button>
                    <button type="submit" class="btn btn-success" name="doSubmit">提交</button>
                    @csrf
                </p>

                </ul>
            </form>
        </div>
    </div>

    <hr/>
@endsection

@section("javascript")
    <script type="text/javascript">
        if ($('input[name="status"]:checked').size() === 0)
            $('input[name="status"]:eq(2)').prop('checked', true)
    </script>
@endsection

