<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>正在播放</title>
    <link href="{{ URL::asset('css/mdui.min.css') }}" rel="stylesheet" type="text/css">
    <link href="http://vjs.zencdn.net/6.2.7/video-js.css" rel="stylesheet">
    <script src="http://vjs.zencdn.net/6.2.7/video.js"></script>
    <!-- If you'd like to support IE8 -->
    <script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>



    <script src="https://cdn.bootcss.com/jquery/2.2.2/jquery.min.js"></script>
</head>

<body class="mdui-theme-primary-green mdui-theme-accent-pink">
<div class="mdui-appbar mdui-appbar-fixed">
    <div class="mdui-toolbar mdui-color-teal mdui-text-color-white-text">
        <a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></a>
        <a href="javascript:;" class="mdui-typo-headline">嗖嗖</a>
        <div class="mdui-toolbar-spacer"></div>
    </div>
</div>
<div class="mdui-container" style="margin-top: 100px;">
    <div class="mdui-row">
        <div class="mdui-col-xs-1 mdui-col-md-3"></div>
        <div class="" style="margin-top: 50px">
    <video id="my-video" class="video-js mdui-shadow-10 mdui-col-xs-10  mdui-col-md-6 " controls preload="auto"  height="350"
           poster="" data-setup="{}">
        <!-- 如果上面的rtmp流无法播放，就播放hls流 -->
        <source src="{{$video_url}}" type='video/mp4'>
    </video>
            </div>
    </div>
</div>
</body>
<script src="{{ URL::asset('js/mdui.min.js') }}">

</script>
</html>