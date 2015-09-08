window.onload = inAll;
function inAll() {
	slides('slides');
	pulldownMenu('nav');
	inputBoxBG();
	inspectionUrl();
	qq_kefu('qq-kefu',505,198);
}
//判断留言版url格式
function inspectionUrl() {
	if (!document.getElementById('url')) return false;
	var url = document.getElementById('url');
	var submit = document.getElementById('submit');
	submit.onclick = function() {
		if(url.value) {
			if(url.value.indexOf('http://') ) alert('别偷懒，网址前还没填" http:// "呢~！');
		}
	}
}
//输入框悬停
function inputBoxBG() {
	if (document.forms.length == 0) return false;
	for (var i=0; i<document.forms.length; i++) {
		var thisform = document.forms[i];
		for (var j=0; j<thisform.elements.length; j++) {
			var element = thisform.elements[j];
			if (element.type == 'text' || element.name == 'comment' || element.type == 'password' || element.type == 'email' || element.type == 'search' || element.type == 'url') {
				element.onmouseover = function() {
					this.style.background = '#effcf5';
				}
				element.onmouseout = function() {
					this.style.background = '#ffffff';
				}
			}
		}
	}
}
//下拉菜单
function pulldownMenu(MenuID) {
	if (!document.getElementById(MenuID)) return false;
	var nav = document.getElementById(MenuID);
	if (!nav.getElementsByTagName('ul')) return false;
	var childs = nav.getElementsByTagName('ul');
	for (var i=0; i<childs.length; i++) {
		var child = childs[i];
		if (child.parentNode.className == 'menu-item-home') child.style.display = 'block';
		if (child.className == 'children' || child.className == 'sub-menu') {
			child.parentNode.onmouseover = function() {
				for (var j=0; j<childs.length; j++) {
					var child_t = childs[j];
					if (child_t.className == 'children' || child_t.className == 'sub-menu') child_t.style.display = 'none';
				}
				var this_child = this.getElementsByTagName('ul');
				this_child[0].style.display = 'block';
			}
			child.parentNode.onmouseout = function() {
				var this_child = this.getElementsByTagName('ul');
				this_child[0].style.display = 'none';
				for (var k=0; k<childs.length; k++) {
					var child_h = childs[k];
					if (child_h.parentNode.className == 'menu-item-home') child_h.style.display = 'block';
				}
			}
		}
	}
}
//幻灯片
function slides(elem) {
	if(!document.getElementById(elem)) return false;
	var oPlay=document.getElementById(elem);
	var oOl=oPlay.getElementsByTagName('ol')[0];
	var aLi1=oOl.getElementsByTagName('li');
	var oUl=oPlay.getElementsByTagName('ul')[0];
	var aLi2=oUl.getElementsByTagName('li');
	var i=iNum=direction=0;
	var times=null;
	var play=null;
	for(i=0;i<aLi1.length;i++) {
		aLi1[i].index=i;
		aLi1[i].onmouseover=function(){
			iNum=this.index;
			show();
		}
		aLi1[i].onclick=function(){
			return false;
		}
	}
	//按钮点击后调用的函数
	function show() {
		for(i=0;i<aLi1.length;i++) {
			aLi1[i].className='';
		}
		aLi1[iNum].className='active';
		startMove(-(iNum*230));
	}
	//自动播放转向
	function autoPlay() {
		if(iNum>=aLi1.length-1) {
			direction=1;
		} else if(iNum<=0) {
			direction=0;
		}
		if(direction==0) {
			iNum++;
		}
		else if(direction==1) {
			iNum--;
		}
		show();
	}
	//自动播放
	play=setInterval(autoPlay,3000);
	
	//鼠标移入展示区停止自动播放
	oPlay.onmouseover=function() {
		clearInterval(play);
	}
	//鼠标移出展示区开启自动播放
	oPlay.onmouseout=function() {
		play=setInterval(autoPlay,3000);
	}
	
	function startMove(iTarget) {
		clearInterval(times);
		times=setInterval(function(){
			doMove(iTarget);
		},30);
	}
	function doMove(iTarget) {	
		var iSpeed=(iTarget-oUl.offsetTop)/10;
		iSpeed=iSpeed>0?Math.ceil(iSpeed):Math.floor(iSpeed);
		if(oUl.offsetTop==iTarget){
			clearInterval(times);
		} else {
			oUl.style.top=oUl.offsetTop+iSpeed+'px';
		}	
	}
}
//客服中心
function qq_kefu(elem,offsetX,offsetY) {
	if(!document.getElementById(elem)) return false;
	var elem = document.getElementById(elem);
	var browser_w = document.documentElement.clientWidth;
	if(browser_w < 1280) {
		var left = browser_w-145;
	} else {
		var left = browser_w/2+475+25;
	}
	elem.style.position = 'absolute';
	elem.style.left = left+'px';
	var n = offsetY;
	window.onscroll = function(){ elem.style.top = (document.body.scrollTop || document.documentElement.scrollTop)+n+'px'; }
	window.onresize = function(){ elem.style.top = (document.body.scrollTop || document.documentElement.scrollTop)+n+'px'; }
}