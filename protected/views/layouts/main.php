<?php 
$contr = Yii::app()->getController()->getId();
$act = Yii::app()->getController()->getAction()->getId();
$id = Yii::app()->request->getParam('id');

$wrap = "";
if(($contr == 'items') && ($act == 'details')) $wrap = 'card-object';
if(($contr == 'items') && ($act == 'addnew')) $wrap = 'with-sidebar-icon';
if(($contr == 'site') && (($act == 'index') && !isset(Yii::app()->request->cookies['user_views_id']) || ($act == 'about'))) $wrap = 'landing';
//var_dump(array($contr, $act, $id));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />

	<title></title>

	<!-- Данное значение часто используют поисковые системы, заполняем ответственно -->
	<meta name="description" content="" />

	<!-- Адаптируем страницу для мобильных устройств -->
	<meta name="viewport" content="width=1024, maximum-scale=2.0" />

	<!-- Традиционная иконка сайта, размер 16x16, прозрачность поддерживается. Рекомендуемый формат: .ico -->
	<link rel="shortcut icon" href="favicon.ico" />

	<!-- Иконка сайта для устройств от Apple, рекомендуемый размер 114x114, прозрачность не поддерживается -->
	<link rel="apple-touch-icon" href="apple-touch-icon.png" />

	<!-- Подключаем файлы стилей -->
	<link rel="stylesheet" type="text/css" href="/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="/css/style.css" />
        
        <!-- DmitryWP -->
        <link rel="stylesheet" type="text/css" href="/css/profile.css" />

	<!-- Скрипты -->
	<script type="text/javascript" src="/js/modernizr.custom.js"></script> <!-- Определение возможностей браузера -->
	<script type="text/javascript" src="/js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="/js/ajaxupload.js"></script>
        <script type="text/javascript" src="/js/jquery.autocomplete.js"></script>
        <script type="text/javascript" src="/js/jquery.arcticmodal-0.3.min.js"></script>
	<script type="text/javascript" src="/js/scripts.js"></script>
        <script type='text/javascript' src="/js/profile.js"></script>
        <script type='text/javascript' src="/js/string.js"></script>
	<script type="text/javascript" src="/js/search.js"></script>
	<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>
</head>

<body>

	<?php echo $this->renderPartial('/layouts/_regionSearch'); ?>
	
	<div class="wrapper <?php echo $wrap; ?>">
		<?php echo $content; ?>
		<div class="clear"></div>
		<div class="right-sidebar">
			<div class="right-sidebar-links">
				<a href="#" class="to-top"><i class="icon-9"></i>Вверх</a>
				<a href="#" class="operator-link">Задать вопрос</a>
				<a href="#" class="information-link"><i class="icon-8"></i></a>
			</div>
		</div><!-- end right-sidebar -->
	</div> <!-- end wrapper -->
	
	<section id="shadow"></section>
	
	<section class="popup add-popup">
		<?php echo $this->renderPartial('/items/_hate'); ?>
	</section><!-- end popup -->
        <script type="text/javascript">
            $(document).on('click', ".vk", function() {
                var newWin = window.open("https://oauth.vk.com/authorize?<?php echo CSite::skrepka('vk'); ?>", 'example', 'width=656,height=329,left=' + (screen.availWidth - 656)/2 + ',top=' + (screen.availHeight - 328)/2);
                newWin.focus();
            });
        </script>
</body>
</html>