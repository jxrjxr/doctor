@extends('default')
@section('body')
    <article class="page-container">
        <form action="{{URL::Route('user.store')}}" method="post" class="form form-horizontal" id="form-member-add">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>用户名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="name" name="name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>性别：</label>
                <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                    <div class="radio-box">
                        <input name="sex" type="radio" id="sex-1" checked value="1">
                        <label for="sex-1">男</label>
                    </div>
                    <div class="radio-box">
                        <input type="radio" id="sex-2" name="sex" value="2">
                        <label for="sex-2">女</label>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="" placeholder="" id="mobile" name="mobile">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" placeholder="@" name="email" id="email">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>签名：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" placeholder="" name="sign" id="sign">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">头像：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div class="uploader-thum-container">
                        <div id="fileList" class="uploader-list">
                            <input name="headimgurl" value="" type="hidden" id="headimgurl">
                            <img src="" id="img">
                        </div>
                        <div id="filePicker">选择图片</div>
                        <button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">医院标签：</label>
                <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select class="select" size="1" name="tag_hospital">
                    <option value="">请选择医院</option>
                    @foreach($tag_hospital as $key=>$value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
				</span> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">擅长科目：</label>
                <div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select class="select" size="1" name="tag_subject">
                    <option value="">请选择科目</option>
                    @foreach($tag_subject as $key=>$value)
                        <option value="{{$value->id}}">{{$value->name}}</option>
                    @endforeach
                </select>
				</span> </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">描述：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea name="introduction" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" onKeyUp="textarealength(this,100)"></textarea>
                    <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
                </div>
            </div>
            <div class="row cl">
                <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                    <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
                </div>
            </div>
        </form>
    </article>
@endsection
@section('js')
    <script type="text/javascript" src="/lib/webuploader/0.1.5/webuploader.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.skin-minimal input').iCheck({
                checkboxClass: 'icheckbox-blue',
                radioClass: 'iradio-blue',
                increaseArea: '20%'
            });

            $("#form-member-add").validate({
                rules:{
                    name:{
                        required:true,
                        minlength:2,
                        maxlength:16
                    },
                    sex:{
                        required:true
                    },
                    mobile:{
                        required:true,
                        isMobile:true
                    },
                    email:{
                        required:true,
                        email:true
                    },
                    uploadfile:{
                        required:true
                    }
                },
                onkeyup:false,
                focusCleanup:true,
                success:"valid",
                submitHandler:function(form){
                    $(form).ajaxSubmit();
                    var index = parent.layer.getFrameIndex(window.name);
                    //parent.$('.btn-refresh').click();
                    parent.layer.close(index);
                }
            });

            $list = $("#fileList");
                    $btn = $("#btn-star");
                    state = "pending";

            var uploader = WebUploader.create({
                auto: true,
                swf: '/lib/webuploader/0.1.5/Uploader.swf',

                // 文件接收服务端。
                server: '{{ URL::route("common.upload") }}',

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: '#filePicker',

                // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
                resize: false,
                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });
            uploader.on( 'fileQueued', function( file ) {
                var $li = $(
                                '<div id="' + file.id + '" class="item">' +
                                '<div class="pic-box"><img></div>'+
                                '<div class="info">' + file.name + '</div>' +
                                '<p class="state">等待上传...</p>'+
                                '</div>'
                        ),
                        $img = $li.find('img');
                $list.append( $li );

                // 创建缩略图
                // 如果为非图片文件，可以不用调用此方法。
                // thumbnailWidth x thumbnailHeight 为 100 x 100
                uploader.makeThumb( file, function( error, src ) {
                    if ( error ) {
                        $img.replaceWith('<span>不能预览</span>');
                        return;
                    }
                    $img.attr( 'src', src );
                }, 400, 270 );
            });
            // 文件上传过程中创建进度条实时显示。
            uploader.on( 'uploadProgress', function( file, percentage ) {
                var $li = $( '#'+file.id ),
                        $percent = $li.find('.progress-box .sr-only');

                // 避免重复创建
                if ( !$percent.length ) {
                    $percent = $('<div class="progress-box"><span class="progress-bar radius"><span class="sr-only" style="width:0%"></span></span></div>').appendTo( $li ).find('.sr-only');
                }
                $li.find(".state").text("上传中");
                $percent.css( 'width', percentage * 100 + '%' );
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on( 'uploadSuccess', function( file ,response ) {
                $('#thumbnail').val(response._raw);
                $( '#'+file.id ).addClass('upload-state-success').find(".state").text("已上传");
            });

            // 文件上传失败，显示上传出错。
            uploader.on( 'uploadError', function( file ) {
                $( '#'+file.id ).addClass('upload-state-error').find(".state").text("上传出错");
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on( 'uploadComplete', function( file ) {
                $( '#'+file.id ).find('.progress-box').fadeOut();
            });
            uploader.on('all', function (type) {
                if (type === 'startUpload') {
                    state = 'uploading';
                } else if (type === 'stopUpload') {
                    state = 'paused';
                } else if (type === 'uploadFinished') {
                    state = 'done';
                }

                if (state === 'uploading') {
                    $btn.text('暂停上传');
                } else {
                    $btn.text('开始上传');
                }
            });

            $btn.on('click', function () {
                if (state === 'uploading') {
                    uploader.stop();
                } else {
                    uploader.upload();
                }
            });

        });
        function add_pic(title,url,w,h){
            layer_show(title,url,w,h);
        }
    </script>
@endsection