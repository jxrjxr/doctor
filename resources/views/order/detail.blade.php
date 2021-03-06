﻿@extends('default')
@section('body')
<article class="page-container">
	<form class="form form-horizontal" id="form-city-add" method="post" action="{{ URL::route('order.update') }}">
	<input name="id" value="{{$order->id}}" type="hidden">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>from：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$order->from_type}}" placeholder="" name="name">
			<input type="text" class="input-text" value="{{$order->from_user}}" placeholder="" name="name">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">标签类型：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
		<select class="select" size="1" name="type">
			<option value="hospital" @if($tag->type == 'hospital') selected @endif>医院标签</option>
			<option value="subject" @if($tag->type == 'subject') selected @endif>科目标签</option>
		</select>
		</span> </div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>标签名：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="{{$tag->name}}" placeholder="" name="name">
		</div>
	</div>
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
			<button onClick="layer_close();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>			</div>
	</div>
	</form>
</article>
@endsection
@section('js')
<script type="text/javascript" src="http://lib.h-ui.net/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="http://lib.h-ui.net/jquery.validation/1.14.0/messages_zh.min.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-city-add").validate({
		rules:{
			name:{
				required:true,
				minlength:2,
				maxlength:8
			},
			type:{
				required:true
			}
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});
</script> 
@endsection