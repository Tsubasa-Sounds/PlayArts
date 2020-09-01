"use strict";

$(function(){
// はじめの１つだけ表示
$("#mainMain li:first").addClass("active").show();
$("#synopsis li:first").addClass("active").show();
$("#mainTitle ul li:first").addClass("active");

// 時間の指定
var $interval = 3000; // 切り替わりの間隔（ミリ秒）
var $fade_speed = 500; // フェード処理の早さ（ミリ秒）
var $fade_speed2 = 0;
var $switchImg;

var aaa = function(){
//  画像の切り替え
var $activeImg = $("#mainMain li.active");
var $nextImg = $activeImg.next("li").length?$activeImg.next("li"):$("#mainMain li:first");
$activeImg.fadeOut($fade_speed).removeClass("active");
$nextImg.fadeIn($fade_speed).addClass("active");

// 中央の文章の切り替え
var $activeText = $("#synopsis li.active");
var $nextText = $activeText.next("li").length?$activeText.next("li"):$("#synopsis li:first");
$activeText.fadeOut($fade_speed).removeClass("active");
$nextText.fadeIn($fade_speed).addClass("active");

// 左のナビの切り替え
var $activeNavi = $("#mainTitle ul li.active");
var $nextNavi = $activeNavi.next("li").length?$activeNavi.next("li"):$("#mainTitle ul li:first");
$activeNavi.removeClass("active");
$nextNavi.addClass("active");

};

$switchImg = setInterval(aaa,$interval);

$("#mainTitle ul li").mouseover(function(){
// setIntervalのリセット
	clearInterval($switchImg);
	$switchImg = setInterval(aaa,$interval);

// clickされたら、ナビの色を変える
	var liNavi =$("#mainTitle ul li");
	var clickLiNavi; // 何番目のliがclickされたかを保持させる

//	console.log(liNavi);
	for(var i=0;i<liNavi.length;i++){
		$(liNavi[i]).removeClass("active");
	}
	$(this).addClass("active");

	for(var j=0;j<liNavi.length;j++){
		if($(liNavi[j]).hasClass("active")){
			clickLiNavi = j;
		}
	}

//	console.log(clickLiNavi);
	
// clickされたら、ナビに対応する画像を表示
	var liMain =$("#mainMain ul li");
	for(var o=0;o<liMain.length;o++){
		$(liMain[o]).fadeOut($fade_speed2).removeClass("active");
	}
	$(liMain[clickLiNavi]).fadeIn($fade_speed2).addClass("active");

// clickされたら、ナビに対応するあらすじを表示
	var liSynopsis =$("#synopsis ul li");
	for(var p=0;p<liSynopsis.length;p++){
		$(liSynopsis[p]).fadeOut($fade_speed2).removeClass("active");
	}
	$(liSynopsis[clickLiNavi]).fadeIn($fade_speed2).addClass("active");
});
	
});