<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>嗖嗖电影</title>
    <link href="css/mdui.min.css" rel="stylesheet" type="text/css">
</head>
<body class="mdui-theme-primary-green ">
<div class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-teal mdui-text-color-white-text">
        <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></a>
        <a href="javascript:;" class="mdui-typo-headline">嗖嗖</a>

        <div class="mdui-toolbar-spacer"></div>

    </div>
</div>
<div class="mdui-container">
    <div class="mdui-row">
        <div class="mdui-text-center" style="margin-top: 130px">
            <h2>嗖嗖</h2>
        </div>
    </div>
    <div class="mdui-row">
        <div class="mdui-col-xs-1 mdui-col-md-3"></div>
        <div class="mdui-col-xs-10  mdui-col-md-6" style="margin-top: 50px">
            <form action="search" method="post" id="form1">
                {{ csrf_field() }}
                <div class="mdui-textfield mdui-textfield-floating-label">
                    <label class="mdui-textfield-label">输入影片名字</label>
                    <input class="mdui-textfield-input" type="text" id="mov_name" name="mov_name">
                </div>
            </form>
        </div>
    </div>
    <div class="mdui-row">
        <div class="mdui-text-center" style="margin-top: 10px">
            <button class="mdui-btn mdui-btn-raised mdui-ripple mdui-color-teal" id="start">开始</button>
        </div>
    </div>
</div>

<script src="js/mdui.min.js"></script>
<script src="https://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>

<script>
    var $$ = mdui.JQ;
    $$("#start").on('click',function(){
        var pic_path= document.getElementById("mov_name").value;
        if(pic_path==""){
            mdui.alert('请输入影片名字!','错误');
            return false;
        }
        document.getElementById("form1").submit();
    })

</script>
</body>
</html>