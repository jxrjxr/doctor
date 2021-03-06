@extends('default')
@section('body')
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 用户中心 <span class="c-gray en">&gt;</span> 用户管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
    <div class="page-container">
        <div class="text-c"> 日期范围：
            <input type="text" name="" onfocus="WdatePicker({maxDate:'#F{$dp.$D(\'datemax\')||\'%y-%M-%d\'}'})" id="datemin" class="input-text Wdate" style="width:120px;">
            -
            <input type="text" onfocus="WdatePicker({minDate:'#F{$dp.$D(\'datemin\')}',maxDate:'%y-%M-%d'})" id="datemax" class="input-text Wdate" style="width:120px;">
            <input type="text" class="input-text" style="width:250px" placeholder="输入会员名称、电话、邮箱" id="" name="">
            <button type="submit" class="btn btn-success radius" id="" name="name"><i class="Hui-iconfont">&#xe665;</i> 搜用户</button>
        </div>
        <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a> <a href="javascript:;" onclick="member_add('添加用户','{{URL::Route('user.add')}}','','510')" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe600;</i> 添加用户</a></span> <span class="r">共有数据：<strong>{{count($users)}}</strong> 条</span> </div>
        <div class="mt-20">
            <table class="table table-border table-bordered table-hover table-bg table-sort">
                <thead>
                <tr class="text-c">
                    <th width="25"><input type="checkbox" name="" value=""></th>
                    <th width="80">ID</th>
                    <th width="100">用户名</th>
                    <th width="40">性别</th>
                    <th width="90">手机</th>
                    <th width="150">邮箱</th>
                    <th width="130">加入时间</th>
                    <th width="70">状态</th>
                    <th width="100">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $value)
                <tr class="text-c">
                    <td><input type="checkbox" value="1" name=""></td>
                    <td>{{$value->id}}</td>
                    <td><u style="cursor:pointer" class="text-primary" onclick="member_show('张三','member-show.html','10001','360','400')">{{$value->name}}</u></td>
                    <td>
                        @if($value->sex == 1)
                            男
                        @else
                            女
                        @endif
                    </td>
                    <td>{{$value->mobile}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->created_at}}</td>
                    <td class="td-status">
                        @if($value->status == 1)
                            <span class="label label-defaunt radius">未审核</span>
                        @elseif($value->status == 2)
                            <span class="label label-success radius">已审核</span>
                        @endif
                    </td>
                    <td class="td-manage">
                        @if($value->status == 1)
                            <a style="text-decoration:none" onClick="member_start(this,'{{$value->id}}')" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>
                        @elseif($value->status == 2)
                            <a style="text-decoration:none" onClick="member_stop(this,'{{$value->id}}')" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>
                        @endif

                        <a title="编辑" href="javascript:;" onclick="member_edit('编辑','{{URL::Route('user.detail',['id'=>$value->id])}}','{{$value->id}}','','510')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
                        {{--<a style="text-decoration:none" class="ml-5" onClick="change_password('修改密码','{{URL::Route('user.detail',['id'=>$value->id])}}','{{$value->id}}','600','270')" href="javascript:;" title="修改密码"><i class="Hui-iconfont">&#xe63f;</i></a>--}}
                        <a title="删除" href="javascript:;" onclick="member_del(this,'{{$value->id}}')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript" src="/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.table-sort').dataTable({
                "aaSorting": [[ 1, "desc" ]],//默认第几个排序
                "bStateSave": true,//状态保存
                "aoColumnDefs": [
                    //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                    {"orderable":false,"aTargets":[1,7]}// 制定列不参与排序
                ]
            });
            $('.table-sort tbody').on( 'click', 'tr', function () {
                if ( $(this).hasClass('selected') ) {
                    $(this).removeClass('selected');
                }
                else {
                    table.$('tr.selected').removeClass('selected');
                    $(this).addClass('selected');
                }
            });
        });
        /*用户-添加*/
        function member_add(title,url,w,h){
            layer_show(title,url,w,h);
        }
        /*用户-查看*/
        function member_show(title,url,id,w,h){
            layer_show(title,url,w,h);
        }
        /*用户-停用*/
        function member_stop(obj,id){
            layer.confirm('确认要停用吗？',function(index){
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_start(this,id)" href="javascript:;" title="启用"><i class="Hui-iconfont">&#xe6e1;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
                $(obj).remove();
                shiftStatus(id,1);
                layer.msg('已停用!',{icon: 5,time:1000});
            });
        }

        /*用户-启用*/
        function member_start(obj,id){
            layer.confirm('确认要启用吗？',function(index){
                $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="Hui-iconfont">&#xe631;</i></a>');
                $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已启用</span>');
                $(obj).remove();
                shiftStatus(id,2);
                layer.msg('已启用!',{icon: 6,time:1000});
            });
        }
        /*用户-编辑*/
        function member_edit(title,url,id,w,h){
            layer_show(title,url,w,h);
        }
        /*密码-修改*/
        function change_password(title,url,id,w,h){
            layer_show(title,url,w,h);
        }
        /*用户-删除*/
        function member_del(obj,id){
            layer.confirm('确认要删除吗？',function(index){
                $(obj).parents("tr").remove();
                doDelete(id);
                layer.msg('已删除!',{icon:1,time:1000});
            });
        }

        function shiftStatus(id,status){
            $.ajax({
                type: "GET",
                url: "{{ URL::route('user.auth') }}",
                data: {
                    id: id,
                    status: status
                },
                dataType: "json",
                success: function(data){
                }
            });
            return true;
        }

        function doDelete(ids){
            $.ajax({
                type: "POST",
                url: "{{ URL::route('user.delete') }}",
                data: {
                    ids: ids,
                },
                dataType: "json",
                success: function(data){
                }
            });
            return true;
        }
    </script>
@endsection