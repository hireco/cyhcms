function $Nav(){
	if(window.navigator.userAgent.indexOf("MSIE")>=1) return 'IE';
  else if(window.navigator.userAgent.indexOf("Firefox")>=1) return 'FF';
  else return "OT";
}

function editArc(aid){
	var qstrs,qstr;
	if(aid==0)  qstr = getOneItem();
	else qstr=aid;
	
	if(qstr=="") alert("你没选中任何文档！");
	else
	{
		qstrs = qstr.split(" ");
		location.href="archive_edit.php?infor_class="+qstrs[0]+"&class_id="+qstrs[1]+"&article_id="+qstrs[2]+"&article_title="+qstrs[3];
	}
}

function viewArc(aid){
	var qstrs,qstr;
	if(aid==0)  qstr = getOneItem();
	else qstr=aid;
	
	if(qstr=="") alert("你没选中任何文档！");
	else
	{
		qstrs = qstr.split(" ");
		window.open("../archive_view.php?infor_class="+qstrs[0]+"&id="+qstrs[2]);
	}
}

function updateArc(action,aid){
	var qstr;
	if(aid==0) qstr=getCheckboxItem();	
	else { qstr=aid;
	  qstrs = qstr.split(" ");
	  qstr="infor_class="+qstrs[0]+"&class_id="+qstrs[1]+"&article_id="+qstrs[2]+"&article_title="+qstrs[3];
	}
	
	if(qstr=="") alert("你没选中任何文档！");
	else { 
	  url_go="archive_update.php?action="+action+"&"+qstr;
	  var posLeft = 500; var posTop = 300; 
	  window.open(url_go, "popUpWin", "scrollbars=yes,resizable=yes,statebar=no,width=600,height=300,left="+posLeft+", top="+posTop);
    }
}

function changeArc(action,action_detail,aid){
	var qstr;
	if(aid==0) qstr=getCheckboxItem();	
	else { qstr=aid;
	  qstrs = qstr.split(" ");
	  qstr="infor_class="+qstrs[0]+"&class_id="+qstrs[1]+"&article_id="+qstrs[2]+"&article_title="+qstrs[3];
	}
	if(qstr=="") alert("你没选中任何文档！"); 
	else {
	url_go="archive_update.php?action="+action+"&action_detail="+action_detail+"&"+qstr;
	window.open(url_go,'hide_frame','width=10,height=10');
	}	
}

//获得选中文件的文件名
function getCheckboxItem()
{
	var allSel="";
	if(document.form1.arc_id.value) {
		allSel=document.form1.arc_id.value;
		str_val=allSel.split(" ");
		return  "infor_class="+str_val[0]+"&class_id="+str_val[1]+"&article_id="+str_val[2];
	 }
	for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(document.form1.arc_id[i].checked)
		{
			if(allSel==""){
				allSel=document.form1.arc_id[i].value;
			    str_val=allSel.split(" ");
				allSel="infor_class="+str_val[0]+"&class_id="+str_val[1]+"&article_id="+str_val[2];
			   }
			else{
				addSel=document.form1.arc_id[i].value;
				str_val=addSel.split(" ");
				allSel=allSel+","+str_val[2];
			   }
		}
	}
	return allSel;	
}

//获得选中其中一个的id
function getOneItem()
{
	var allSel="";
	if(document.form1.arc_id.value) return document.form1.arc_id.value;
	for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(document.form1.arc_id[i].checked)
		{
				allSel = document.form1.arc_id[i].value;
				break;
		}
	}
	return allSel;	
}

function sel_arc()
{
	var sel_arc = document.getElementById('sel_arc');
	if(sel_arc.value=="全选"){
	for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(!document.form1.arc_id[i].checked)
		{
			document.form1.arc_id[i].checked=true;
		}
	}
	 sel_arc.value="取消";
	 }
    else {
	for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(document.form1.arc_id[i].checked)
		{
			document.form1.arc_id[i].checked=false;
		}
	}
	 sel_arc.value="全选";
   }
}

//上下文菜单

function TotalMenu(obj,aid,atitle)
{
  var eobj,popupoptions
  popupoptions = [
    new ContextItem("浏览文档",function(){ viewArc(aid); }),
    new ContextItem("编辑文档",function(){ editArc(aid); }),
    new ContextSeperator(),
    new ContextItem("置顶文档",function(){ updateArc('top',aid); }),
    new ContextItem("置新文档",function(){ updateArc('new_or_not',aid); }),
    new ContextItem("推荐文档",function(){ updateArc('recommend',aid); }),
	new ContextItem("加粗标题",function(){ updateArc('title_bold',aid); }),
	new ContextSeperator(),
    new ContextItem("隐藏文档",function(){ updateArc('hide_type',aid); }),
    new ContextItem("锁定文档",function(){ updateArc('locked',aid); }),
    new ContextItem("审核文档",function(){ updateArc('checked',aid); }),
    new ContextSeperator(),
    new ContextItem("删除文档",function(){ updateArc('delete',aid); }),
	new ContextItem("移动文档",function(){ updateArc('move',aid); }),
    new ContextSeperator(),
    new ContextItem("全部选择",function(){ sel_arc(); }),
    new ContextItem("取消选择",function(){ sel_arc(); })
     ]
  ContextMenu.display(popupoptions)
}

function TopMenu(obj,aid,atitle)  { } 