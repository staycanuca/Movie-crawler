<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
    <title>剧集列表</title>
    <link href="{{ URL::asset('css/mdui.min.css') }}" rel="stylesheet" type="text/css">
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

    <div class="mdui-row mdui-grid-list">

        <div class="mdui-col-xs-6 mdui-col-sm-3 mdui-col-md-2 ">
            <img class="mdui-img-fluid" src="{{ $img }}" />
        </div>
        <div class=" mdui-col-sm-2 mdui-col-md-4">
            {{--<h3>{{$detail}}</h3>--}}
       </div>

    </div>
    <div class="mdui-row mdui-typo">
        <h4 class="doc-chapter-title mdui-text-color-teal"><u>资源列表</u></h4>
    </div>

    <div class="mdui-row">
        <div class="mdui-panel" mdui-panel="">
            <div class="mdui-panel-item">
                <div class="mdui-panel-item-header">
                    <div class="mdui-panel-item-title">剧集列表</div>
                    <div class="mdui-panel-item-summary"></div>
                    <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
                </div>
                <div class="mdui-panel-item-body mdui-text-center " style="">
                    @forelse($play_list as $play_lists)
                    <p><a class="mdui-text-color-pink" href="../play/{{$play_lists['episodeSid']}}">第{{$play_lists['episode']}}集</a></p>
                        @empty暂无剧集
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ URL::asset('js/mdui.min.js') }}">

</script>
</html>