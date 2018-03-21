{"changed":true,"filter":false,"title":"2018_03_20_021459_create_purchase_table.php","tooltip":"/database/migrations/2018_03_20_021459_create_purchase_table.php","value":"<?php\n\nuse Illuminate\\Support\\Facades\\Schema;\nuse Illuminate\\Database\\Schema\\Blueprint;\nuse Illuminate\\Database\\Migrations\\Migration;\n\nclass CreatePurchaseTable extends Migration\n{\n    /**\n     * Run the migrations.\n     *\n     * @return void\n     */\n    public function up()\n    {\n        Schema::create('purchase', function (Blueprint $table) {\n            //primary key\n            $table->increments('num');\n            //foreign key\n            $table->integer('user_id')->unsigned();\n            $table  ->foreign('user_id')\n                    ->references('id')->on('users')\n                    ->onDelete('cascade');\n            $table->string('seller');\n            $table->Integer('board_num');\n            $table->timestamps();\n        });\n    }\n\n    /**\n     * Reverse the migrations.\n     *\n     * @return void\n     */\n    public function down()\n    {\n        Schema::dropIfExists('purchase');\n    }\n}\n","undoManager":{"mark":-2,"position":56,"stack":[[{"start":{"row":20,"column":43},"end":{"row":20,"column":44},"action":"insert","lines":[";"],"id":100}],[{"start":{"row":20,"column":43},"end":{"row":20,"column":44},"action":"remove","lines":[";"],"id":101}],[{"start":{"row":19,"column":50},"end":{"row":19,"column":51},"action":"remove","lines":[";"],"id":102}],[{"start":{"row":18,"column":25},"end":{"row":19,"column":0},"action":"insert","lines":["",""],"id":103},{"start":{"row":19,"column":0},"end":{"row":19,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":19,"column":12},"end":{"row":21,"column":28},"action":"insert","lines":["$table->foreign('user_id')","      ->references('id')->on('users')","      ->onDelete('cascade');"],"id":104}],[{"start":{"row":20,"column":6},"end":{"row":20,"column":8},"action":"insert","lines":["  "],"id":105}],[{"start":{"row":20,"column":8},"end":{"row":20,"column":12},"action":"insert","lines":["    "],"id":106}],[{"start":{"row":20,"column":12},"end":{"row":20,"column":16},"action":"insert","lines":["    "],"id":107}],[{"start":{"row":20,"column":16},"end":{"row":20,"column":20},"action":"insert","lines":["    "],"id":108}],[{"start":{"row":19,"column":18},"end":{"row":19,"column":20},"action":"insert","lines":["  "],"id":109}],[{"start":{"row":21,"column":6},"end":{"row":21,"column":8},"action":"insert","lines":["  "],"id":110}],[{"start":{"row":21,"column":8},"end":{"row":21,"column":12},"action":"insert","lines":["    "],"id":111}],[{"start":{"row":21,"column":12},"end":{"row":21,"column":16},"action":"insert","lines":["    "],"id":112}],[{"start":{"row":21,"column":16},"end":{"row":21,"column":20},"action":"insert","lines":["    "],"id":113}],[{"start":{"row":21,"column":20},"end":{"row":21,"column":24},"action":"insert","lines":["    "],"id":114}],[{"start":{"row":21,"column":20},"end":{"row":21,"column":24},"action":"remove","lines":["    "],"id":115}],[{"start":{"row":22,"column":12},"end":{"row":25,"column":12},"action":"remove","lines":["$table->integer('user_id')->unsigned()","            ->references('id')->on('users')","            ->onDelete('cascade');","            "],"id":116}],[{"start":{"row":18,"column":25},"end":{"row":19,"column":0},"action":"insert","lines":["",""],"id":117},{"start":{"row":19,"column":0},"end":{"row":19,"column":12},"action":"insert","lines":["            "]}],[{"start":{"row":19,"column":12},"end":{"row":19,"column":51},"action":"insert","lines":["$table->integer('user_id')->unsigned();"],"id":118}],[{"start":{"row":15,"column":24},"end":{"row":15,"column":32},"action":"remove","lines":["historys"],"id":119},{"start":{"row":15,"column":24},"end":{"row":15,"column":25},"action":"insert","lines":["P"]}],[{"start":{"row":15,"column":25},"end":{"row":15,"column":26},"action":"insert","lines":["u"],"id":120}],[{"start":{"row":15,"column":26},"end":{"row":15,"column":27},"action":"insert","lines":["r"],"id":121}],[{"start":{"row":15,"column":26},"end":{"row":15,"column":27},"action":"remove","lines":["r"],"id":122}],[{"start":{"row":15,"column":25},"end":{"row":15,"column":26},"action":"remove","lines":["u"],"id":123}],[{"start":{"row":15,"column":24},"end":{"row":15,"column":25},"action":"remove","lines":["P"],"id":124}],[{"start":{"row":15,"column":24},"end":{"row":15,"column":25},"action":"insert","lines":["p"],"id":125}],[{"start":{"row":15,"column":25},"end":{"row":15,"column":26},"action":"insert","lines":["u"],"id":126}],[{"start":{"row":15,"column":26},"end":{"row":15,"column":27},"action":"insert","lines":["r"],"id":127}],[{"start":{"row":15,"column":27},"end":{"row":15,"column":28},"action":"insert","lines":["c"],"id":128}],[{"start":{"row":15,"column":28},"end":{"row":15,"column":29},"action":"insert","lines":["h"],"id":129}],[{"start":{"row":15,"column":29},"end":{"row":15,"column":30},"action":"insert","lines":["a"],"id":130}],[{"start":{"row":15,"column":30},"end":{"row":15,"column":31},"action":"insert","lines":["s"],"id":131}],[{"start":{"row":15,"column":31},"end":{"row":15,"column":32},"action":"insert","lines":["e"],"id":132}],[{"start":{"row":6,"column":19},"end":{"row":6,"column":20},"action":"remove","lines":["s"],"id":133}],[{"start":{"row":6,"column":18},"end":{"row":6,"column":19},"action":"remove","lines":["y"],"id":134}],[{"start":{"row":6,"column":17},"end":{"row":6,"column":18},"action":"remove","lines":["r"],"id":135}],[{"start":{"row":6,"column":16},"end":{"row":6,"column":17},"action":"remove","lines":["o"],"id":136}],[{"start":{"row":6,"column":15},"end":{"row":6,"column":16},"action":"remove","lines":["t"],"id":137}],[{"start":{"row":6,"column":14},"end":{"row":6,"column":15},"action":"remove","lines":["s"],"id":138}],[{"start":{"row":6,"column":13},"end":{"row":6,"column":14},"action":"remove","lines":["i"],"id":142}],[{"start":{"row":6,"column":12},"end":{"row":6,"column":13},"action":"remove","lines":["H"],"id":143}],[{"start":{"row":6,"column":12},"end":{"row":6,"column":13},"action":"insert","lines":["P"],"id":144}],[{"start":{"row":6,"column":13},"end":{"row":6,"column":14},"action":"insert","lines":["u"],"id":145}],[{"start":{"row":6,"column":14},"end":{"row":6,"column":15},"action":"insert","lines":["r"],"id":146}],[{"start":{"row":6,"column":15},"end":{"row":6,"column":16},"action":"insert","lines":["c"],"id":147}],[{"start":{"row":6,"column":16},"end":{"row":6,"column":17},"action":"insert","lines":["h"],"id":148}],[{"start":{"row":6,"column":17},"end":{"row":6,"column":18},"action":"insert","lines":["a"],"id":149}],[{"start":{"row":6,"column":18},"end":{"row":6,"column":19},"action":"insert","lines":["s"],"id":150}],[{"start":{"row":6,"column":19},"end":{"row":6,"column":20},"action":"insert","lines":["e"],"id":151}],[{"start":{"row":36,"column":30},"end":{"row":36,"column":38},"action":"remove","lines":["historys"],"id":152},{"start":{"row":36,"column":30},"end":{"row":36,"column":31},"action":"insert","lines":["p"]}],[{"start":{"row":36,"column":31},"end":{"row":36,"column":32},"action":"insert","lines":["u"],"id":153}],[{"start":{"row":36,"column":32},"end":{"row":36,"column":33},"action":"insert","lines":["r"],"id":154}],[{"start":{"row":36,"column":33},"end":{"row":36,"column":34},"action":"insert","lines":["c"],"id":155}],[{"start":{"row":36,"column":34},"end":{"row":36,"column":35},"action":"insert","lines":["h"],"id":156}],[{"start":{"row":36,"column":35},"end":{"row":36,"column":36},"action":"insert","lines":["a"],"id":157}],[{"start":{"row":36,"column":36},"end":{"row":36,"column":37},"action":"insert","lines":["s"],"id":158}],[{"start":{"row":36,"column":37},"end":{"row":36,"column":38},"action":"insert","lines":["e"],"id":159}]]},"ace":{"folds":[],"scrolltop":840,"scrollleft":0,"selection":{"start":{"row":36,"column":38},"end":{"row":36,"column":38},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":21,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1521596541559}