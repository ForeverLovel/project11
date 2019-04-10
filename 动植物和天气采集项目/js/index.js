
// 三基点温度显示
(function(){

	let dataDisplayDiagramTable=document.getElementsByClassName("data-display-diagram-table");

	

	let arrow=document.getElementsByClassName('arrow')[0];
	console.log(arrow);

	let index=0;

	for(var i=0;i<dataDisplayDiagramTable.length;i++)
	{
		dataDisplayDiagramTable[i].id=i;
	}


	arrow.onclick=function()

	{
		index++;

		if(index>=dataDisplayDiagramTable.length)

		{

			index=0;

		}

		for(var d=0;d<dataDisplayDiagramTable.length;d++)
		{

			dataDisplayDiagramTable[d].style.display="none";


		}

			dataDisplayDiagramTable[index].style.display="block";

	}
})();


// banner轮播
(function(){


	window.onload=function()
{

	function byid(id)
	{
		return typeof(id)==="string"?document.getElementById(id):id;
	}
	let index=0,
		timer,
		bannerItem=byid("banner-item").getElementsByClassName("banner-items"),
		dots=byid("banner-items-dots").getElementsByTagName("span"),
		len=bannerItem.length;
		prev=byid("prev"),
		next=byid("next");
	console.log(len);

	slideImg();
	function slideImg()
	{
		var banner=byid("banner");
		//轮播图时滑过清除定时器，离开时继续
		banner.onmousemove=function()
		{//滑过定时器
			if(timer)
			{
				clearInterval(timer);
			}
		}
		//离开定时器
		banner.onmouseout=function()//这个是绑定一个事件
		{
			timer=setInterval(function()
				{
					index++;
					if(index>=len)
					{
						index=0;
					}
					changeImg();
				},3000);
			
		}
		banner.onmouseout();//这是一个方法

	}

		for(var d=0;d<len;d++)
		{
			dots[d].id=d;
			dots[d].onclick=function()
			{
				index=this.id;
				this.className="banner-items-dots-active";
				changeImg();
			}
		}
		next.onclick=function()
		{
			index++;
			if(index>=len)
			{
				index=0;
			}
			changeImg();
		}
		prev.onclick=function()
		{
			index--;
			if(index<0)
			{
				index=len-1;
			}
			changeImg();
		} 

		//图片进行滚动
		function changeImg()
		{
			
			for(var i=0;i<len;i++)
			{
				bannerItem[i].style.display="none";
				dots[i].className="";
			}
			bannerItem[index].style.display="block";
			dots[index].className="banner-items-dots-active";
		}

	}
})();