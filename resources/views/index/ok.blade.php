<div id="div" style="position: absolute;left: 50%; top:30%;display: none">
    <input id="ip3" type="hidden">
    用户名<input id="ip1" type="text">
    <br><br>
    密码<input id="ip2" type="text">
    <br><br>
    <input type="button" value="修改" onclick="up1()" style="cursor: pointer">
    <input type="button" value="关闭" onclick="guanbi()" style="cursor: pointer">
</div>

<input placeholder="用户名" id="name">
<input placeholder="密码" type="password" id="password">
<input type="button" value="添加" onclick="add()" style="cursor: pointer">
<input type="button" value="退出" onclick="logout()" style="cursor: pointer">
<table border="1" cellspacing="1"><thead><tr><th>id</th><th>用户名</th><th>密码</th><th>删除</th><th>修改</th></tr></thead><tbody></tbody></table>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    function show() {
        $.ajax({
            url: "<?= url('user/show');?>",
            dataType: 'json',
            success: function (res) {
                console.log(res.data1)
                var res = res.data
                var tr = ''
                for (var i = 0; i < res.length; i++) {
                    tr = tr + '<tr class="text-c"><td>' + res[i].id + '</td><td>' + res[i].name + '</td><td>' + res[i].password + '</td><td><input style="cursor: pointer" type="button" value="删除" onclick="del(' + res[i].id + ')"></td><td><input  style="cursor: pointer" type="button" value="修改" onclick="up(' + res[i].id + ',\'' + res[i].name + '\',\'' + res[i].password + '\')"></td> </tr>'
                    }
                $("table tbody").html(tr)
            }
        })
    }
    show()

    function del(id) {
        $.ajax({
            url: "<?= url('user/del');?>",
            data:{
              id:id,
            },
            success: function (res) {
                show()
            }
        })
    }
    function add() {
        var name=$('#name').val()
        var password=$('#password').val()
        $.ajax({
            url: "<?= url('user/add');?>",
            data:{
                name:name,
                password:password,
            },
            success: function (res) {
                show()
            }
        })
    }
    function up(id,name,password) {
        document.getElementById("div").style.display="block";
        $('#ip3').val(id)
        $('#ip1').val(name)
        $('#ip2').val(password)
    }
    function guanbi() {
        document.getElementById("div").style.display="none";
    }

    function up1() {
        var name=$('#ip1').val()
        var password=$('#ip2').val()
        var id=$('#ip3').val()
        $.ajax({
            url: "<?= url('user/up');?>",
            data:{
                name:name,
                password:password,
                id:id,
            },
            success: function (res) {
                document.getElementById("div").style.display="none";
                show()
            }
        })
    }

    function logout() {
        $.ajax({
            url: "<?= url('user/logout');?>",
            success: function (res) {
             //   console.log(res)
                location.href="<?= url('/login/index');?>"
            }
        })
    }
</script>