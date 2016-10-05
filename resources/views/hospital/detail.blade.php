@extends('default')
@section('body')
    <article class="page-container">
        <form action="{{URL::Route('hospital.update')}}" method="post" class="form form-horizontal" id="form-member-update">
            <input type="hidden" name="id" value="{{$hospital->id}}">
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>医院名称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$hospital->name}}" placeholder="" id="name" name="name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>医院简称：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$hospital->short_name}}" placeholder="" id="short_name" name="short_name">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>城市：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" placeholder="" value="{{$hospital->city}}" name="city" id="city">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>地址：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" placeholder="" value="{{$hospital->address}}" name="address" id="address">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$hospital->mobile}}" placeholder="" id="mobile" name="mobile">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">400电话：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$hospital->phone}}" placeholder="" id="phone" name="phone">
                </div>
            </div>

            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">微博URL：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$hospital->weibourl}}" placeholder="" id="" name="weibourl">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">微信QR：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$hospital->wechatqr}}" placeholder="" id="" name="wechatqr">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">好大夫URL：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$hospital->doctorurl}}" placeholder="" id="" name="doctorurl">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">百度百科URL：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$hospital->baikeurl}}" placeholder="" id="" name="baikeurl">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">百度经度：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$hospital->longitude}}" placeholder="" id="" name="longitude">
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">百度纬度：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <input type="text" class="input-text" value="{{$hospital->latitude}}" placeholder="" id="" name="latitude">
                </div>
            </div>


            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">封面：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <div class="uploader-thum-container">
                        <div id="fileList" class="uploader-list">
                            <input type="hidden" name="photo" id="photo" value="{{$hospital->photo}}">
                            @if ($hospital->photo)
                                <img src="http://oss-cn-beijing.aliyuncs.com/feidaoimg/{{$hospital->photo}}"  id="img" style="width: 400px;height: 225px;margin: 10px 0;">
                            @else
                                <img src=""  id="img">
                            @endif
                        </div>
                        <div id="filePicker">选择图片</div>
                        <button id="btn-star" class="btn btn-default btn-uploadstar radius ml-10">开始上传</button>
                    </div>
                </div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-4 col-sm-3">介绍：</label>
                <div class="formControls col-xs-8 col-sm-9">
                    <textarea name="description" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" onKeyUp="textarealength(this,100)">{{$hospital->description}}</textarea>
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
                $('#photo').val(JSON.parse(response._raw)[0]);
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