// JavaScript Document
/***2011-09-16-ljf**/

<!--
/*第一种形式 第二种形式 更换显示样式*/
function setTab(m,n){
var tli=document.getElementById("menu"+m).getElementsByTagName("a");
var mli=document.getElementById("main"+m).getElementsByTagName("ul");
for(i=0;i<tli.length;i++){
   tli[i].className=i==n?"active":"";
   mli[i].style.display=i==n?"block":"none";
}
}
//-->