function $Nav(){
	if(window.navigator.userAgent.indexOf("MSIE")>=1) return 'IE';
  else if(window.navigator.userAgent.indexOf("Firefox")>=1) return 'FF';
  else return "OT";
}

function editArc(aid){
	var qstrs,qstr;
	if(aid==0)  qstr = getOneItem();
	else qstr=aid;
	
	if(qstr=="") alert("��ûѡ���κ��ĵ���");
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
	
	if(qstr=="") alert("��ûѡ���κ��ĵ���");
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
	
	if(qstr=="") alert("��ûѡ���κ��ĵ���");
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
	if(qstr=="") alert("��ûѡ���κ��ĵ���"); 
	else {
	url_go="archive_update.php?action="+action+"&action_detail="+action_detail+"&"+qstr;
	window.open(url_go,'hide_frame','width=10,height=10');
	}	
}

//���ѡ���ļ����ļ���
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

//���ѡ������һ����id
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
	if(sel_arc.value=="ȫѡ"){
	for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(!document.form1.arc_id[i].checked)
		{
			document.form1.arc_id[i].checked=true;
		}
	}
	 sel_arc.value="ȡ��";
	 }
    else {
	for(i=0;i<document.form1.arc_id.length;i++)
	{
		if(document.form1.arc_id[i].checked)
		{
			document.form1.arc_id[i].checked=false;
		}
	}
	 sel_arc.value="ȫѡ";
   }
}

//�����Ĳ˵�

function TotalMenu(obj,aid,atitle)
{
  var eobj,popupoptions
  popupoptions = [
    new ContextItem("����ĵ�",function(){ viewArc(aid); }),
    new ContextItem("�༭�ĵ�",function(){ editArc(aid); }),
    new ContextSeperator(),
    new ContextItem("�ö��ĵ�",function(){ updateArc('top',aid); }),
    new ContextItem("�����ĵ�",function(){ updateArc('new_or_not',aid); }),
    new ContextItem("�Ƽ��ĵ�",function(){ updateArc('recommend',aid); }),
	new ContextItem("�Ӵֱ���",function(){ updateArc('title_bold',aid); }),
	new ContextSeperator(),
    new ContextItem("�����ĵ�",function(){ updateArc('hide_type',aid); }),
    new ContextItem("�����ĵ�",function(){ updateArc('locked',aid); }),
    new ContextItem("����ĵ�",function(){ updateArc('checked',aid); }),
    new ContextSeperator(),
    new ContextItem("ɾ���ĵ�",function(){ updateArc('delete',aid); }),
	new ContextItem("�ƶ��ĵ�",function(){ updateArc('move',aid); }),
    new ContextSeperator(),
    new ContextItem("ȫ��ѡ��",function(){ sel_arc(); }),
    new ContextItem("ȡ��ѡ��",function(){ sel_arc(); })
     ]
  ContextMenu.display(popupoptions)
}

function TopMenu(obj,aid,atitle)  { } 