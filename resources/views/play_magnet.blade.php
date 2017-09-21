<html>
<head>
    <meta charset="UTF-8">
    <title>在线播放</title>
    <link href="{{ URL::asset('css/mdui.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        #output video {
            width: 100%;
        }
        #progressBar {
            height: 5px;
            width: 0%;
            background-color: #35b44f;
            transition: width .4s ease-in-out;
        }

        .show-seed {
            display: none;
        }
        #status code {
            font-size: 90%;
            font-weight: 700;
            margin-left: 3px;
            margin-right: 3px;
            border-bottom: 1px dashed rgba(255,255,255,0.3);
        }

        .is-seed #hero {
            background-color: #154820;
            transition: .5s .5s background-color ease-in-out;
        }
        #hero {
            background-color: #2a3749;
        }
        #status {
            color: #fff;
            font-size: 17px;
            padding: 5px;
        }

    </style>
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
    <div id="hero">
        <div id="output">
            <div id="progressBar"></div>
            <!-- The video player will be added here -->
        </div>
        <!-- Statistics -->
        <div id="status">
            <div>
                <span class="show-leech">Downloading </span>
                <span class="show-seed">Seeding </span>
                <span class="show-leech"> from </span>
                <span class="show-seed"> to </span>
                <code id="numPeers">0 peers</code>.
            </div>
            <div>
                <code id="downloaded"></code>
                of <code id="total"></code>
                — <span id="remaining"></span><br/>
                &#x2198;<code id="downloadSpeed">0 b/s</code>
                / &#x2197;<code id="uploadSpeed">0 b/s</code>
            </div>
        </div>

    </div>
    <div class="mdui-row">
        <p>该功能播放不稳定，长时间加载不出来请选择其他影片。</p>
    </div>
</div>

<script src="{{ URL::asset('js/mdui.min.js') }}" ></script>

<script src="https://cdn.jsdelivr.net/webtorrent/latest/webtorrent.min.js"></script>

<!-- Moment is used to show a human-readable remaining time -->
<script src="http://momentjs.com/downloads/moment.min.js"></script>

<script>
    var torrentId = '{{$url}}';

    var client = new WebTorrent()

    // HTML elements
    var $body = document.body
    var $progressBar = document.querySelector('#progressBar')
    var $numPeers = document.querySelector('#numPeers')
    var $downloaded = document.querySelector('#downloaded')
    var $total = document.querySelector('#total')
    var $remaining = document.querySelector('#remaining')
    var $uploadSpeed = document.querySelector('#uploadSpeed')
    var $downloadSpeed = document.querySelector('#downloadSpeed')

    // Download the torrent
    client.add(torrentId, function (torrent) {

        // Torrents can contain many files. Let's use the .mp4 file
        var file = torrent.files.find(function (file) {
            return file.name.endsWith('.mp4')
        })

        // Stream the file in the browser
        file.appendTo('#output')

        // Trigger statistics refresh
        torrent.on('done', onDone)
        setInterval(onProgress, 500)
        onProgress()

        // Statistics
        function onProgress () {
            // Peers
            $numPeers.innerHTML = torrent.numPeers + (torrent.numPeers === 1 ? ' peer' : ' peers')

            // Progress
            var percent = Math.round(torrent.progress * 100 * 100) / 100
            $progressBar.style.width = percent + '%'
            $downloaded.innerHTML = prettyBytes(torrent.downloaded)
            $total.innerHTML = prettyBytes(torrent.length)

            // Remaining time
            var remaining
            if (torrent.done) {
                remaining = 'Done.'
            } else {
                remaining = moment.duration(torrent.timeRemaining / 1000, 'seconds').humanize()
                remaining = remaining[0].toUpperCase() + remaining.substring(1) + ' remaining.'
            }
            $remaining.innerHTML = remaining

            // Speed rates
            $downloadSpeed.innerHTML = prettyBytes(torrent.downloadSpeed) + '/s'
            $uploadSpeed.innerHTML = prettyBytes(torrent.uploadSpeed) + '/s'
        }
        function onDone () {
            $body.className += ' is-seed'
            onProgress()
        }
    })

    // Human readable bytes util
    function prettyBytes(num) {
        var exponent, unit, neg = num < 0, units = ['B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
        if (neg) num = -num
        if (num < 1) return (neg ? '-' : '') + num + ' B'
        exponent = Math.min(Math.floor(Math.log(num) / Math.log(1000)), units.length - 1)
        num = Number((num / Math.pow(1000, exponent)).toFixed(2))
        unit = units[exponent]
        return (neg ? '-' : '') + num + ' ' + unit
    }
</script>
</body>
</html>
        
        