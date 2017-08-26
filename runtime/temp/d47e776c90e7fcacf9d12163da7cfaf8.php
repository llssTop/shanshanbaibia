<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:83:"F:\wamp64\www\shanshanbaibia\public/../application/index\view\user\information.html";i:1503555864;s:73:"F:\wamp64\www\shanshanbaibia\public/../application/index\view\layout.html";i:1503736421;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>首页</title>
		<link href="__HCSS_PATH__bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="__HCSS_PATH__amazeui.css" rel="stylesheet" type="text/css" />
		<link href="__HCSS_PATH__admin.css" rel="stylesheet" type="text/css" />
		<link href="__HCSS_PATH__personal.css" rel="stylesheet" type="text/css">
		<link href="__HCSS_PATH__infstyle.css" rel="stylesheet" type="text/css">
		<link href="__HCSS_PATH__hmstyle.css" rel="stylesheet" type="text/css"/>
		<link href="__HCSS_PATH__skin.css" rel="stylesheet" type="text/css" />
		<link href="__HCSS_PATH__demo.css" rel="stylesheet" type="text/css" />
		<link href="__HCSS_PATH__cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="__HCSS_PATH__optstyle.css" rel="stylesheet" type="text/css" />
		<script src="__HJS_PATH__jQuery-1.11.3.js"></script>
		<script src="__HJS_PATH__amazeui.min.js"></script>
		
		<script src="__HJS_PATH__bootstrap.min.js"></script>
		<script type="text/javascript" src="__HJS_PATH__list.js"></script>
		<link href="__HCSS_PATH__orstyle.css" rel="stylesheet" type="text/css">
	</head>
<body>
		<header>
			<article>
				<div class="mt-logo">
					<!--顶部导航条 -->
					<div class="am-container header">
						<ul class="message-l">
							<div class="topMessage">
								<div class="menu-hd">
									<?php if(empty(session('username'))): ?>
									<a href="/index/user/login/" target="_top" class="h">亲，请登录</a>
									<a href="/index/user/register/" target="_top">免费注册</a>
									<?php else: ?> 
									<a href="<?php echo url('index/user/information'); ?>" target="_top">欢迎登录<?php echo session('username'); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</ul>
						<ul class="message-r">
							<div class="topMessage home">
								<div class="menu-hd"><a href="/index/index/index/" target="_top" class="h">商城首页</a></div>
							</div>
							<?php if(!empty(session('username'))): ?>
							<div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="/index/user/information/" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
							</div>
							<?php else: ?>
							 <div class="topMessage my-shangcheng">
								<div class="menu-hd MyShangcheng"><a href="/index/user/login/" target="_top"><i class="am-icon-user am-icon-fw"></i>未登录</a></div>
							</div>
							<?php endif; ?>

							<div class="topMessage mini-cart">
								<div class="menu-hd"><a id="mc-menu-hd" href="/index/order/shopcart/" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
							</div>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="/index/collection/collection/" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
							<?php if(!empty(session('username'))): ?>
							<div class="topMessage favorite">
								<div class="menu-hd"><a href="/index/user/loginout/" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>退出</span></a>
							</div>
							<?php endif; ?>
						</ul>
						</div>

						<!--悬浮搜索框-->

						<div class="nav white">
							<div class="logoBig">
								<li><img src="__HIMG_PATH__logobig.png" /></li>
							</div>

							<div class="search-bar pr">
								<a name="index_none_header_sysc" href="#"></a>
								<form>
									<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
									<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
								</form>
							</div>
						</div>

						<div class="clear"></div>
					</div>
					<div class=tip>
			<div id="sidebar">
				<div id="wrap">
					<div id="prof" class="item ">
						<a href="# ">
							<span class="setting "></span>
						</a>
						<div class="ibar_login_box status_login ">
							<div class="avatar_box ">
								<p class="avatar_imgbox "><img src="__HIMG_PATH__no-img_mid_.jpg " /></p>
								<ul class="user_info ">
									<li>用户名sl1903</li>
									<li>级&nbsp;别普通会员</li>
								</ul>
							</div>
							<div class="login_btnbox ">
								<a href="# " class="login_order ">我的订单</a>
								<a href="# " class="login_favorite ">我的收藏</a>
							</div>
							<i class="icon_arrow_white "></i>
						</div>

					</div>
					<div id="shopCart " class="item ">
						<a href="# ">
							<span class="message "></span>
						</a>
						<p>
							购物车
						</p>
						<p class="cart_num ">0</p>
					</div>
					<div id="asset " class="item ">
						<a href="# ">
							<span class="view "></span>
						</a>
						<div class="mp_tooltip ">
							我的资产
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="foot " class="item ">
						<a href="# ">
							<span class="zuji "></span>
						</a>
						<div class="mp_tooltip ">
							我的足迹
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="brand " class="item ">
						<a href="#">
							<span class="wdsc "><img src="__HIMG_PATH__wdsc.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我的收藏
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="broadcast " class="item ">
						<a href="# ">
							<span class="chongzhi "><img src="__HIMG_PATH__chongzhi.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我要充值
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div class="quick_toggle ">
						<li class="qtitem ">
							<a href="# "><span class="kfzx "></span></a>
							<div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
						</li>
						<!--二维码 -->
						<li class="qtitem ">
							<a href="#none "><span class="mpbtn_qrcode "></span></a>
							<div class="mp_qrcode " style="display:none; "><img src="__HIMG_PATH__weixin_code_145.png " /><i class="icon_arrow_white "></i></div>
						</li>
						<li class="qtitem ">
							<a href="#top " class="return_top "><span class="top "></span></a>
						</li>
					</div>

					<!--回到顶部 -->
					<div id="quick_links_pop " class="quick_links_pop hide "></div>

				</div>

			</div>
			<div id="prof-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					我
				</div>
			</div>
			<div id="shopCart-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					购物车
				</div>
			</div>
			<div id="asset-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					资产
				</div>

				<div class="ia-head-list ">
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">优惠券</div>
					</a>
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">红包</div>
					</a>
					<a href="# " target="_blank " class="pl money ">
						<div class="num ">￥0</div>
						<div class="text ">余额</div>
					</a>
				</div>

			</div>
			<div id="foot-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					足迹
				</div>
			</div>
			<div id="brand-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					收藏
				</div>
			</div>
			<div id="broadcast-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					充值
				</div>
			</div>
		</div>
		<script>
			window.jQuery || document.write('<script src="__HJS_PATH__jquery.min.js "><\/script>');
		</script>
		<script type="text/javascript " src="__HJS_PATH__quick_links.js "></script>

<script src="__HJS_PATH__jQuery-1.11.3.js"></script>
            <div class="nav-table">
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="#">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>
			</div>
			<b class="line"></b>
		<div class="center">
			<div class="col-main">
				<div class="main-wrap">
					
					<div class="user-info">
						<!--标题 -->
						<div class="am-cf am-padding">
							<div class="am-fl am-cf"><strong class="am-text-danger am-text-lg">个人资料</strong> / <small>Personal&nbsp;information</small></div>
						</div>
						<hr/>
						<!--头像 -->
                  
						<div class="user-infoPic">
							<div class="filePic">
								<div>
							<img class="am-circle am-img-thumbnail" src="__APIC_PATH__<?php  echo $data['avatar']?>" alt="" />
								</div>
							</div>
							<p class="am-form-help">头像</p>
							<div class="info-m">
								<div><b>用户名：<i><?php echo $data['uname']; ?></i></b></div>
								<div class="u-level">
									<span class="rank r2">
							             <s class="vip1"></s><a class="classes" href="#"><?php switch($data['vip']): case "0": ?>铜牌会员<?php break; case "1": ?>银牌会员<?php break; case "2": ?>金牌会员<?php break; default: ?>铜牌会员
											<?php endswitch; ?>
							         </a>
						            </span>
								</div>
								<div class="u-safety">
									<a href="safety.html">
									 账户安全
									<span class="u-profile"><i class="bc_ee0000" style="width: 60px;" width="0"><?php echo $data['grade']; ?></i></span>
									</a>
								</div>

							</div>
							<div style="margin:40px auto; width:40px;height:6opx;">
									<form action="<?php echo url('index/user/upload'); ?>" enctype="multipart/form-data" method="post">
										<input type="file" name="image" /> <br>
										<input type="submit" value="上传" />
									</form>
								</div>
						</div>
						<!--个人信息 -->
						<div class="info-main">
							<form class="am-form am-form-horizontal">
								<div class="am-form-group">
									<label for="user-name2" class="am-form-label">昵称</label>
									<div class="am-form-content">
										<input type="text" id="user-name2" placeholder="nickname">
									</div>
								</div>
								<div class="am-form-group">
									<label class="am-form-label">性别</label>
									<div class="am-form-content sex">
										<label class="am-radio-inline">
											<input type="radio" name="radio10" value="male" data-am-ucheck> 男
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="radio10" value="female" data-am-ucheck> 女
										</label>
										<label class="am-radio-inline">
											<input type="radio" name="radio10" value="secret" data-am-ucheck> 保密
										</label>
									</div>
								</div>
								<div class="am-form-group" >
									<label for="user-birth" class="am-form-label">生日</label>
									
										<div id="box" style="height:50px;height:60px; width:700px;float:left;" >
										      <select name="sel1" id="sel1"  style="float:left;width:200px;">
										        <option value="year">年</option>
										      </select> 
										      <select name="sel2" id="sel2" style="float:left;width:200px;" >
										        <option value="month">月</option>
										      </select> 
										      <select name="sel3" id="sel3" style="float:left;width:200px;" >
										        <option value="day">日</option>
										      </select>
										      <span id="result" style="clear:both;" name="birthday"></span>
									</div>
							
								</div>
								<div class="am-form-group">
									<label for="user-phone" class="am-form-label">电话</label>
									<div class="am-form-content">
										<input id="user-phone" placeholder="telephonenumber" type="tel">
									</div>
								</div>
								<div class="am-form-group">
									<label for="user-email" class="am-form-label">电子邮件</label>
									<div class="am-form-content">
										<input id="user-email" placeholder="Email" type="email">
									</div>
								</div>
								<div class="am-form-group address">
									<label for="user-address" class="am-form-label">收货地址</label>
									<div class="am-form-content address">
										<a href="address.html">
											<p class="new-mu_l2cw">
												<span class="province">湖北</span>省
												<span class="city">武汉</span>市
												<span class="dist">洪山</span>区
												<span class="street">雄楚大道666号(中南财经政法大学)</span>
												<span class="am-icon-angle-right"></span>
											</p>
										</a>
									</div>
								</div>
								<div class="am-form-group safety">
									<label for="user-safety" class="am-form-label">账号安全</label>
									<div class="am-form-content safety">
										<a href="safety.html">
											<span class="am-icon-angle-right"></span>
										</a>
									</div>
								</div>
								<div class="info-btn">
									<div class="am-btn am-btn-danger" id ="change">保存修改</div>
								</div>
								<script type="text/javascript">
								     $("#change").click(function(){
								     	$.post("<?php echo url('index/user/upinfo'); ?>",
								     		{
								     			uname:$("#user-name2").val(),
									     		sex:$("input[type='radio']:checked").val(),
									     		result:$("#sel1").val() + '/' + $("#sel2").val() + '/' +$("#sel3").val(),
									     		phone:$("#user-phone").val(),
									     		email:$("#user-email").val()
								     	},function(data){
								     		//console.log(data);
												if(data['errcode']=='1'){
													 $this->success('成功',url('index/user/information'));
												}else{
													 $this->error('失败',url('index/user/information'));
												}
											},'json');
								     });
							</script>
							</form>
						</div>
					</div>
				</div>
				<!--底部-->
			</div>
			<div style="position:absolute; top:190px; left:65px;">
			<aside class="menu">
				<ul>
					<li class="person{"
						<a href="<?php echo url('index/user/information'); ?>">个人中心</a>
					</li>
					<li class="person">
						<a href="#">个人资料</a>
						<ul>
							<li class="active"> <a href="<?php echo url('index/user/information'); ?>">个人信息</a></li>
							<li> <a href="<?php echo url('index/user/safety'); ?>">安全设置</a></li>
							<li> <a href="<?php echo url('index/user/address'); ?>">收货地址</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的交易</a>
						<ul>
							<li><a href="<?php echo url('index/order/order'); ?>">订单管理</a></li>
							<li> <a href="<?php echo url('index/order/change'); ?>">退款售后</a></li>
						</ul>
					</li>
					<li class="person">
						<a href="#">我的资产</a>
						<ul>
							<li> <a href="<?php echo url('index/bonus/coupon'); ?>">优惠券 </a></li>
							<li> <a href="<?php echo url('index/bonus/bonus'); ?>">红包</a></li>
							<li> <a href="<?php echo url('index/bonus/bill'); ?>">账单明细</a></li>
						</ul>
					</li>

					<li class="person">
						<a href="#">我的小窝</a>
						<ul>
							<li> <a href="<?php echo url('index/collection/collection'); ?>">收藏</a></li>
							<li> <a href="<?php echo url('index/collection/foot'); ?>">足迹</a></li>
							<li> <a href="<?php echo url('index/collection/comment'); ?>">评价</a></li>
							<li> <a href="<?php echo url('index/collection/news'); ?>">消息</a></li>
						</ul>
					</li>

				</ul>
			</aside>
		</div>
		</div>
	</body>
</html>

<script>
   //生成日期
   function creatDate()
   {
     //生成1900年-2100年
     for(var i = 2016; i >= 1950; i--)
     {
       //创建select项
       var option = document.createElement('option');
       option.setAttribute('value',i);
       option.innerHTML = i;
       sel1.appendChild(option);
     }
     //生成1月-12月
     for(var i = 1; i <=12; i++){
       var option1 = document.createElement('option');
       option1.setAttribute('value',i);
       option1.innerHTML = i;
       sel2.appendChild(option1);
     }
     //生成1日—31日
     for(var i = 1; i <=31; i++){
       var option2 = document.createElement('option');
       option2.setAttribute('value',i);
       option2.innerHTML = i;
       sel3.appendChild(option2);
     }
   }
   creatDate();
   //保存某年某月的天数
   var days;
 
   //年份点击 绑定函数
   sel1.onclick = function()
   {
     //月份显示默认值
     sel2.options[0].selected = true;
     //天数显示默认值
     sel3.options[0].selected = true;
   }
   //月份点击 绑定函数
   sel2.onclick = function()
   {
     //天数显示默认值
     sel3.options[0].selected = true;
     //计算天数的显示范围
     //如果是2月
     if(sel2.value == 2)
     {
       //判断闰年
       if((sel1.value % 4 === 0 && sel1.value % 100 !== 0) || sel1.value % 400 === 0)
       {
         days = 29;
       }
       else
       {
         days = 28;
       }
       //判断小月
     }else if(sel2.value == 4 || sel2.value == 6 ||sel2.value == 9 ||sel2.value == 11){
       days = 30;
     }else{
       days = 31;
     }
 
     //增加或删除天数
     //如果是28天，则删除29、30、31天(即使他们不存在也不报错)
     if(days == 28){
       sel3.remove(31);
       sel3.remove(30);
       sel3.remove(29);
     }
     //如果是29天
     if(days == 29){
       sel3.remove(31);
       sel3.remove(30);
       //如果第29天不存在，则添加第29天
       if(!sel3.options[29]){
         sel3.add(new Option('29','29'),null)
       }
     }
     //如果是30天
     if(days == 30){
       sel3.remove(31);
       //如果第29天不存在，则添加第29天
       if(!sel3.options[29]){
         sel3.add(new Option('29','29'),null)
       }
       //如果第30天不存在，则添加第30天
       if(!sel3.options[30]){
         sel3.add(new Option('30','30'),null)
       }
     }
     //如果是31天
     if(days == 31){
       //如果第29天不存在，则添加第29天
       if(!sel3.options[29])
       {
         sel3.add(new Option('29','29'),null)
       }
       //如果第30天不存在，则添加第30天
       if(!sel3.options[30])
       {
         sel3.add(new Option('30','30'),null)
       }
       //如果第31天不存在，则添加第31天
       if(!sel3.options[31])
       {
         sel3.add(new Option('31','31'),null)
       }
     }
   }
 
   //结果显示 设置好日期时间后 弹窗通知
   box.onclick = function()
    {
    //当年、月、日都已经为设置值时
	    if(sel1.value !='year' && sel2.value != 'month' && sel3.value !='day')
	    {
	      var result = document.getElementById('result').innerText = sel1.value + '/' + sel2.value + '/' + sel3.value;
	      alert('日期已经设置完毕');
	    } 
    }
 </script>
		<div class="footer ">
			<div class="footer-hd ">
				<p>
					<a href="# ">恒望科技</a>
					<b>|</b>
					<a href="# ">商城首页</a>
					<b>|</b>
					<a href="# ">支付宝</a>
					<b>|</b>
					<a href="# ">物流</a>
				</p>
			</div>
			<div class="footer-bd ">
				<p>
					<a href="# ">关于恒望</a>
					<a href="# ">合作伙伴</a>
					<a href="# ">联系我们</a>
					<a href="# ">网站地图</a>
					
				</p>
			</div>
		</div>
	</div>
</body>
</html>
