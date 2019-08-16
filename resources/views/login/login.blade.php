<body>
<input type="text" placeholder="用户名" id="name">
<input type="password" placeholder="密码" id="password">
<input type="button" value="登录" onclick="dl()">
</body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    function dl() {
        var name=$('#name').val()
        var password=$('#password').val()
        $.ajax({
     //       type: "post",
            url:"<?= url('/login/login_action');?>",
            dataType: 'json',
            data:{
                name:name,
                password:password,
            },
            success: function (res) {
                console.log(res)
                if(res.status=="ok"){
                    alert(res.data)
                    location.href="<?= url('/user/login');?>"
                }else{
                    alert(res.data)
                }
            }
        })
    }
</script>