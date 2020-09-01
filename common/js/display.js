"use strict";
	
	var oya = document.getElementById('ticketyoyaku');
	var first = document.getElementById('firstBox');
	var second = document.getElementById('secondBox');
	var radio = document.getElementsByName('home') ;
	
	function entryChange(){
	if(radio[0].checked) {
	// 自宅にお届けにチェックが入ったら
	oya.appendChild(first);
	oya.removeChild(second);
	}else if(radio[1].checked) {
	//劇場でお受取りにチェックが入ったら
	oya.removeChild(first);
	oya.appendChild(second);
	}
	}
	
	//オンロードさせ、リロード時に選択を保持
	window.onload = entry;
	
	function entry(){
	oya.appendChild(first);
	oya.removeChild(second);
	}