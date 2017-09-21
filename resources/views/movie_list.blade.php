<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>视频列表</title>
    <link href="css/mdui.min.css" rel="stylesheet" type="text/css">
</head>
<body class="mdui-theme-primary-green mdui-theme-accent-teal">
<div class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-teal mdui-text-color-white-text">
        <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></a>
        <a href="javascript:;" class="mdui-typo-headline">嗖嗖</a>
        <div class="mdui-toolbar-spacer"></div>
    </div>
</div>
<div class="mdui-container" style="margin-top: 100px;">
    <div class="mdui-row mdui-typo">
        <h2 class="doc-chapter-title">搜索结果</h2>
    </div>
    <div class="mdui-row">
       <h3  class="doc-chapter-title mdui-text-color-teal">磁力链下载，在线播放磁力链（Beta）</h3>
    </div>
    <div class="mdui-row mdui-typo ">
        @forelse($move_list as $move_lists)
        <div class="mdui-col-xs-6 mdui-col-sm-3 mdui-col-md-2 mdui-shadow-2" style="margin-top: 10px">
            <a href=".{{ $move_lists['href'] }}">
            <div class="mdui-card">
                <div class="mdui-card-media">
                    <img  class="mdui-img-fluid" src="{{ $move_lists['img_src'] }}">
                    <div class="mdui-card-media-covered">
                        <div class="mdui-card-primary">
                            <div class="mdui-card-primary-title"><small>{{ $move_lists['mov_name'] }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
            </a>
        </div>
        @empty
            无资源
        @endforelse

    </div>

<div class="mdui-row">
    <div class="mdui-divider-dark">

    </div>
</div>
    <div class="mdui-row">
        <h3  class="doc-chapter-title mdui-text-color-teal">在线播放</h3>
    </div>
    <div class="mdui-row mdui-typo ">
        @forelse($kmj_list as $kmj_lists)
            <div class="mdui-col-xs-6 mdui-col-sm-3 mdui-col-md-2 mdui-shadow-2" style="margin-top: 10px">
                <a href="online/{{ $kmj_lists['id'] }}">
                    <div class="mdui-card">
                        <div class="mdui-card-media">
                            <img  class="mdui-img-fluid" src="{{ $kmj_lists['cover'] }}">
                            <div class="mdui-card-media-covered">
                                <div class="mdui-card-primary">
                                    <div class="mdui-card-primary-title"><small>{{ $kmj_lists['title'] }}</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            无资源
        @endforelse
    </div>
    <div class="mdui-row"  style="margin-top: 20px;">
        <div class="mdui-text-center" style="border-top:1px solid #cccccc">
            <p>2017©.<a href="http://movie.o11o.cc" class="mdui-text-color-pink">嗖嗖</a></p>
        </div>
    </div>

</div>
<button id="gotop" class="mdui-fab mdui-fab-fixed mdui-ripple mdui-color-teal"><i class="mdui-icon material-icons">&#xe55d;</i></button>



<script src="https://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $("#gotop").click(function() {
            $("html,body").animate({scrollTop:0}, 500);
        });
    })
</script>
</body>
</html>