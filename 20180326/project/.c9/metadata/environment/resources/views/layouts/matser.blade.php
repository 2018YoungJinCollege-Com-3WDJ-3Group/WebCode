{"filter":false,"title":"matser.blade.php","tooltip":"/resources/views/layouts/matser.blade.php","undoManager":{"mark":0,"position":0,"stack":[[{"start":{"row":0,"column":0},"end":{"row":36,"column":0},"action":"insert","lines":["<!doctype html>","<html lang=\"{{ app()->getLocale() }}\">","<head>","    <style>","        .content {","            text-align: center;","        }","        .user_icon{","            text-align: right;","        }","    </style>","</head>","<body>","<div class=\"content\" style=\"margin: auto;\">","    <div style=\"margin: auto;\">","        <h1>오르골</h1>","    </div>","    <div class=\"user_icon\">","        <a href=\"https://placeholder.com\"><img src=\"http://via.placeholder.com/50x50\"></a>","        <a href=\"https://placeholder.com\"><img src=\"http://via.placeholder.com/50x50\"></a>","        <a href=\"https://placeholder.com\"><img src=\"http://via.placeholder.com/50x50\"></a>","    </div>","    <div>","        <input type=\"text\"><input type=\"submit\" value=\"검색하기\">","    </div>","    <div class=\"menu_icon\">","        <a href=\"{{route('main.index')}}\"><img src=\"http://via.placeholder.com/100x100\"></a>","        <a href=\"{{route('scoreboard.index')}}\"><img src=\"http://via.placeholder.com/100x100\"></a>","        <a href=\"https://placeholder.com\"><img src=\"http://via.placeholder.com/100x100\"></a>","        <a href=\"https://placeholder.com\"><img src=\"http://via.placeholder.com/100x100\"></a>","        <a href=\"https://placeholder.com\"><img src=\"http://via.placeholder.com/100x100\"></a>","    </div>","    @yield('content')","</div>","</body>","</html>",""],"id":1}]]},"ace":{"folds":[],"scrolltop":0,"scrollleft":0,"selection":{"start":{"row":10,"column":12},"end":{"row":10,"column":12},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":0},"timestamp":1520671117997,"hash":"292c8d5abf0a2b2f30f2b3c96c797ec070639fcc"}