/********************************************************************************************************
 * D-ImageChange
 *----------------------------------------------------------------------------------------------------
 * @Desc 图片轮换插件
 *----------------------------------------------------------------------------------------------------
 * @Author D.夏亦知非
 * @Email DeclanZhang@gmail.com
 * @QQ 29540200
 * @Blog http://onblur.javaeye.com
 * @Date 2009-10-19
 * @Version V1.3@2010-03-16
 * @JQueryVersion 1.3.2+ (建议使用1.4以上版本)
 * 
 * @update v1.1 增加清空原始内容功能,以免页面加载完成之前显示大片空白
 * 		   v1.2 修正IE6每次从服务器读取背景图片的BUG
 *         v1.3 修正了宽度过大产生的BUG, 兼容JQ1.4.1, 建议使用JQ1.4+, 效率更高
 **/

/*
 *	袁晨思 2010-10-31日修改，增加按钮高度
 */

// 修正IE6每次从服务器读取背景图片的BUG
try {
	document.execCommand('BackgroundImageCache', false, true);
}catch(e){

}

(function($){

jQuery.fn.extend({
	
	d_imagechange:function(setting){
		
		var config = $.extend({
			bg:true,						// 是否背景色
			title:false,					// 是否有标题
			desc:false,						// 是否有描述
			btn:true,						// 是否显示按钮
			repeat:'no-repeat',				// 重复规则 'no-repeat' 'repeat-x' 'repeat-y' 'repeat'
			
			bgColor:'#290000',				// 背景色
			bgOpacity:1,					// 背景透明度
			bgHeight:20,					// 背景高
			
			titleSize:12,					// 标题文字大小
			titleFont:'Verdana,宋体',		// 标题文本字体
			titleColor:'#CCC',				// 标题文本颜色
			titleTop:4,						// 标题上边距
			titleLeft:4,					// 标题左边距
			
			descSize:12,					// 描述文字大小
			descFont:'Verdana,宋体',			// 描述文本字体
			descColor:'#FFF',				// 描述文本颜色
			descTop:2,						// 描述上边距
			descLeft:4,						// 描述左边距
			
			btnBgColor:'#290000',			// 默认按钮背景颜色
			btnActiveBgColor: '#d4abab',	// 激活按钮背景颜色
			btnFont:'Verdana',				// 按钮文本字体
			btnFontSize:12,					// 按钮文字大小(注意:Chrome有默认最小字号的限制)
			btnColor:'#FFF',				// 默认按钮文本颜色
			btnActiveColor: '#333',         // 激活按钮文本颜色
			btnText:true,					// 是否显示文本
			btnWidth:15,					// 按钮宽
			btnHeight:20,					// 按钮高
			btnTop:0,						// 按钮上边距
			btnPadding: "5px 10px",			// 按钮内边距
			
			playTime:2000,					// 轮换间隔时间,单位(毫秒)
			animateTime:500,				// 动画执行时间,单位(毫秒)
			animateStyle:'o',				// 动画效果:'o':渐显 'x':横向滚动 'y':纵向滚动 'show':原地收缩伸展 'show-x':横向收缩伸展 'show-y':纵向收缩伸展' none':无动画
			width:300,						// 宽, 不设定则从DOM读取
			height:200						// 高, 不设定则从DOM读取
			
		},setting);
		
		return $(this).each(function(){
			var _this = $(this);
			var _w = config.width || _this.width();			// 宽
			var _h = config.height || _this.height();		// 高
			var _n = config.data.length;					// 数目
			var _i = 0;										// 当前显示的item序号
			
			_this.empty()
				 .css('overflow','hidden')
				 .css('position', 'relative')
				 .width(_w)
				 .height(_h);
			
			// 半透明背景
			if(config.bg && config.data.length>0){
			$('<div />').appendTo(_this)
						.width(_w)
						.height(config.bgHeight)
						.css('line-height', config.bgHeight)
						//.css('background-color',config.bgColor)
						.css('opacity',config.bgOpacity)
						.css('position','absolute')
						.css('left', 0)
						.css('top',_h-config.bgHeight)
						.css('zIndex',1);
			}
			
			// 文字区
			var _textArea = 
			$('<div />').appendTo(_this)
						.width(_w)
						.height(config.bgHeight)
						.css('position','absolute')
						.css('marginTop',_h-config.bgHeight)
						.css('zIndex',2);
			// 按钮区
			var _btnArea = 
			$('<div />').appendTo(_this)
						//.width(config.data.length * (config.btnWidth + config.btnMargin))
						.height(config.bgHeight)
						.css('position','absolute')
						.css('top',_h-config.bgHeight)
						//.css('left',_w-(config.btnWidth+config.btnMargin)*_n-5)
						.css('zIndex',3)
						.css('display',config.btn?'block':'none');
			
			// 插入空div修正IE的绝对定位BUG
			$('<div />').appendTo(_this);
			
			// 图片区
			var _imgArea = 
			$('<div />').appendTo(_this)
						.width('x,show-x'.indexOf(config.animateStyle)!=-1?_w*_n:_w)
						.height('y,show-y'.indexOf(config.animateStyle)!=-1?_h*_n:_h);			
	
			// 初始化图片 文字 按钮
			$.each(config.data,function(i,n){
				
				$('<a />').appendTo(_imgArea)
						  .width(_w)
						  .height(_h)
						  .attr('href',n.href?n.href:'')
						  .attr('target',n.target?n.target:'')
						  .attr('title',n.title?n.title:'')
						  .css('display','block')
						  .css('position','absolute')
						  .css('left',0)
						  .css('right',0)
						  .css('float','x,show-x'.indexOf(config.animateStyle)!=-1?'left':'')
						  .append($('<img />')
                              .width(_w)
                              .height(_h)
                              .attr('alt', '')
                              .attr('src', n.src));
						  
				if(config.title){
				$('<b />').appendTo(_textArea)
						  .html(n.title?n.title:'')
						  .css('display',i==0?'block':'none')
						  .css('fontSize',config.titleSize)
						  .css('fontFamily',config.titleFont)
						  .css('color',config.titleColor);
						  //.css('marginTop',config.titleTop)
						  //.css('marginLeft',config.titleLeft);
				}
				
				if(config.desc){
				$('<p />').appendTo(_textArea)
						  .html(n.desc?n.desc:'')
						  .css('display',i==0?'block':'none')
						  .css('fontSize',config.descSize)
						  .css('fontFamily',config.descFont)
						  .css('color',config.descColor)
						  .css('marginTop',config.descTop)
						  .css('marginLeft',config.descLeft);
				}
				  
			    if (config.data.length == 1) return true;
				$('<a />').appendTo(_btnArea)
						  .width(config.btnWidth)
						  .height(config.btnHeight)
						  .html(n.title?n.title:'')
						  .css('fontSize',config.btnFontSize)
						  .css('fontFamily',config.btnFont)
						  .css('textAlign','center')
						  .css('display','block')
						  .css('float','left')
						  .css('width', i + 1 == config.data.length ? '106px' : '105px')
						  .css('overflow','hidden')
						  .css('marginTop',config.btnTop)
						  .css('margin-right', i + 1 == config.data.length ? 0 : 1)
						  .css('background-color',i == 0 ? config.btnActiveBgColor : config.btnBgColor)
						  .css('color',i == 0 ? config.btnActiveColor : config.btnColor)
						  .css('cursor','pointer')

			});
			
			// 保存所有元素集合的引用,方便在事件中使用
			var _bs = _btnArea.children('a');
			var _ts = _textArea.children('b');
			var _ds = _textArea.children('p');
			var _is = _imgArea.children('a');

			// 针对不同的动画效果的附加设置, 主要是block的问题, 若在初始化时设置block:none会造成之后无block效果
			if('o,show,none'.indexOf(config.animateStyle)!=-1){
				_is.not(':first').hide();
				_is.css('position','absolute');
			}
			
			// 添加按钮事件
			_bs.click(function(){
				var ii = _bs.index(this);
				if(ii==_i){return;}
				
				_ts.eq(_i).css('display','none');
				_ts.eq(ii).css('display','block');
				_ds.eq(_i).css('display','none');
				_ds.eq(ii).css('display','block');
				_bs.eq(_i).css('background-color',config.btnBgColor).css('color', config.btnColor);
				_bs.eq(ii).css('background-color',config.btnActiveBgColor).css('color', config.btnActiveColor);
				
				switch(config.animateStyle){
				case 'o' :
					_is.eq(_i).fadeOut(config.animateTime);
					_is.eq(ii).fadeIn(config.animateTime);
					break;
				case 'x' :
					_imgArea.animate({marginLeft:-ii*_w},config.animateTime);
					break;
				case 'y' :
					_imgArea.animate({marginTop:-ii*_h},config.animateTime);
					break;
				case 'show' :
				case 'show-x' :
				case 'show-y' :
					_is.eq(_i).hide(config.animateTime);
					_is.eq(ii).show(config.animateTime);
					break;				
				case 'none' :
					_is.eq(_i).hide();
					_is.eq(ii).show();
					break;				
				}
				_i = ii;
			});

			// 添加轮换任务
			var _play = setInterval(play,config.playTime);
			
			function play(){
				_bs.eq((_i+1)%_n).click()
			}		
			// 鼠标进入事件
			_this.mouseover(function(){
				clearInterval(_play);
			});
						
			// 鼠标离开事件
			_this.mouseout(function(){
				_play = setInterval(play,config.playTime);
			});
		});
	}
});

})(jQuery);