<html>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
		<title>Chat Room</title>
		<link href="{{URL::asset('css/mdui.min.css')}}" rel="stylesheet" type="text/css">
	</head>

	<body class="mdui-theme-primary-green ">
		<div class="mdui-appbar mdui-appbar-fixed">
			<div class="mdui-toolbar mdui-color-teal mdui-text-color-white-text">
				<a href="javascript:;" class="mdui-btn mdui-btn-icon"><i class="mdui-icon material-icons">menu</i></a>
				<a href="javascript:;" class="mdui-typo-headline">影搜</a>

				<div class="mdui-toolbar-spacer"></div>

			</div>
		</div>
		<div class="mdui-container" style="margin-top: 100px;">

			<div class="mdui-row mdui-grid-list mdui-text-center">
				<h3>{{ $title }}</h3>
			</div>
            <div class="mdui-row mdui-grid-list mdui-text-center mdui-text-color-grey">
                <h3>{{ $s_title }}</h3>
            </div>
			<div class="mdui-row mdui-typo">
		<h2 class="doc-chapter-title mdui-text-color-teal "><u>资源列表</u></h2>

	     </div>

			<div class="mdui-row">
				<div class="mdui-panel" mdui-panel="">
                    @foreach($mov_down as $mov_downs)
          <div class="mdui-panel-item">
            <div class="mdui-panel-item-header">
              <div class="mdui-panel-item-title">{{$mov_downs['season']}}</div>
              <i class="mdui-panel-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
            </div>
            <div class="mdui-panel-item-body mdui-text-center" style="">
              <p>
                  @if(isset($mov_downs['online_mov']))
                      <form method="post" action="magnet">
                          {{ csrf_field() }}
                          <input type="hidden" name="url" value="{{$mov_downs['online_mov']}}">
                      <button class="mdui-btn mdui-ripple mdui-color-teal" type="submit">在线播放磁力链（beta）</button>
                      </form>
                      @else
                      无在线播放资源
                  @endif
              </p>
              <div class="mdui-panel-item-actions">
                  @foreach($mov_downs['data'] as $down_list)
                      <div class="mdui-chip mdui-color-teal">
                          <a class=" mdui-text-color-white" href="{{$down_list['url']}}"> <span class="mdui-chip-title">{{$down_list['text']}}</span></a>
                      </div>
                @endforeach
              </div>
            </div>
          </div>
         @endforeach
        </div>
			</div>
		</div>
	</body>
  <script src="{{URL::asset('js/mdui.min.js')}}">

  </script>
</html>