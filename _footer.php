	<?php if(!$amp) { ?>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		<br>
		<footer class="page-footer font-small blue-grey lighten-5">
			<div class="footer-copyright text-center text-black-50 py-3">iAPK.org © 2019-2020 Copyright<br>
				<a class="dark-grey-text">We are not responsible for the content.</a>
				<br>
				<?php
				$endtime = microtime(true);
				printf("Page loaded in %f seconds", $endtime - $starttime );
				?>
			</div>
		</footer>
		<script type="text/javascript">$("img.lazyload").lazyload();var options={base:{container:"",items:3,slideBy:"page",mouseDrag:!0}},mobile="false",classIn="jello",classOut="rollOut",speed=400,doc=document,win=window,initFns={},sliders=new Object;for(var i in options){var item=options[i];item.container="#"+i,item.swipeAngle=!1,item.speed||(item.speed=speed),doc.querySelector(item.container)&&(sliders[i]=tns(options[i]))}</script>
		<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P3479QL" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<?php } else { ?>
		<amp-analytics config="https://www.googletagmanager.com/amp.json?id=GTM-MP9XDL5&gtm.url=SOURCE_URL" data-credentials="include"></amp-analytics>
	<?php } ?>
	</body>
</html>
