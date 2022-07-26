<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="script/jquery.blueberry.js"></script>
<link rel="stylesheet" href="blueberry.css" />
<link rel="stylesheet" href="flexslider.css" type="text/css" media="screen" />
<script defer src="script/jquery.flexslider.js"></script>

<!-- Syntax Highlighter -->
  <script type="text/javascript" src="js/shCore.js"></script>
  <script type="text/javascript" src="js/shBrushXml.js"></script>
  <script type="text/javascript" src="js/shBrushJScript.js"></script>

  <!-- Optional FlexSlider Additions -->
  <script src="js/jquery.easing.js"></script>
  <script src="js/jquery.mousewheel.js"></script>
  <script defer src="js/demo.js"></script>

<script>
$(window).load(function() {
	$('.blueberry').blueberry();
});
</script>
<script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>

<div id="wrapper">
	<div id="middle">
		<div id="content_index">
				<div class="blueberry">
				  <ul class="slides">
					<li><img src="image/carousel_image/slider1.jpg" /></li>
					<li><img src="image/carousel_image/slider2.jpg" /></li>
					<li><img src="image/carousel_image/slider3.jpg" /></li>
				  </ul>
				</div>
			
				<br>
			
				<div id="informative_block">
					<ul>
						<a href="cakes.php"><li><div id="informative_block1"><p>Вкусные торты</p></div></li></a>
						<a href="pies.php"><li><div id="informative_block2"><p>Пирожные</p></div></li></a>
						<a href="biscuit.php"><li><div id="informative_block3"><p>Печенья</p></div></li></a>
						<a href="wafers.php"><li><div id="informative_block4"><p>Вафли</p></div></li></a>
					</ul>
				</div>
				<div class="clear"></div>
				<br>
			
				<section class="slider">
					<div class="flexslider">
					  <ul class="slides">
									<li data-thumb="image/thumbnail_carousel/CwUBgfAuorI.jpg">
									  <img src="image/thumbnail_carousel/CwUBgfAuorI.jpg" />
									</li>
									<li data-thumb="image/thumbnail_carousel/FEak8b9mKiQ.jpg">
									  <img src="image/thumbnail_carousel/FEak8b9mKiQ.jpg" />
									</li>
									<li data-thumb="image/thumbnail_carousel/U0QxlMQo5oU.jpg">
									  <img src="image/thumbnail_carousel/U0QxlMQo5oU.jpg" />
									</li>
									<li data-thumb="image/thumbnail_carousel/uD5nkosmqC8.jpg">
									  <img src="image/thumbnail_carousel/uD5nkosmqC8.jpg" />
									</li>
								  </ul>
					</div>
			  	</section>
			
				<div id="content_text">
					<p>Торт по Вашему эскизу или наши авторские десерты - все будет исполнено идеально и точно в срок. <br><br>Нежнейшие эклеры, воздушные чизкейки, пирожные для детей и удивительные торты. <br><br>Станьте нашим покупателем, и Вы вернетесь к нам снова.</p>
					<p><br>Мы работаем ежедневно с 9:00 до 18:00. Ждем Вас по адресу: ул. Фрунзе, 92/5.</p>
					<p>Приходите в свой День Рождения и получите скидку 15% на весь ассортимент!</p>
				</div>					
		</div><!-- Конец контент -->		
	</div><!-- Конец мидл -->
</div><!-- Конец врапер -->
<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Adef49a7525c373a33fd1fba624c7ec2446f61c517f11a5e8fd3718a6b690e5ee&amp;width=100%25&amp;height=432&amp;lang=ru_RU&amp;scroll=true"></script>