<?php
class CView {
    static function getViewItemList ($model) {
	$html = "";
	foreach ($model as $item) {
	    if($item->slogan != "") {
                $about = "";
                $str = explode(' ', $item->slogan);
                for($i = 0; (($i < 10) && ($i < count($str))); $i++) {$about .= $str[$i]." ";}
            } else {
                $about = "Подробнее";
            }
	    $image = CSite::getImages($item->id, 1);
	    $intro_link = Yii::app()->createUrl('items/details', array('id' => $item->id));
	    $distr = @Districts::model()->findByAttributes(array('id' => $item->district))->name;
	    $street = @Streets::model()->findByAttributes(array('id' => $item->street))->name;
	    $typePrice = ($item->type_price == 1) ? "м²" : "все";
	    $m_user = Users::model()->findByPk($item->owner_id);
	    $publDate = Yii::app()->dateFormatter->format('dd.MM.yy', $item->created);
	    $html .= '<li class="search-object-item">
		<div class="main-info">
		    <div class="image"><img src="/images/upload/resize/'.  CImage::getCashImg($image, 186).'" alt=""  class="object-img"/></div>
		    <div class="object-details">
			<p class="intro"><a href="'.$intro_link.'"><span>'.$about.'...</span><i class="icon-43"></i></a></p>	
			<div class="cols">
			    <div>
				<b>'.$distr.'</b>
				<b>'.$street.'</b>
				<b>Цена: '.(int)$item->price.' руб.</b>
				<span>Общая площадь: '.(int)$item->area.' м<sup>2</sup></span>
				<span class="stars" style="display:none;">
				    <span class="full"></span>
				    <span class="full"></span>
				    <span class="full"></span>
				    <span class="full"></span>
				    <span class="full"></span>
				</span><!-- end stars -->
			    </div>
			    <div>
				<span class="commission">Комиссия '.$item->komprice.'%</span>
				<span>Цена за '.$typePrice.': '.$item->price.' руб.</span>
				<!-- span>Комнат: 1</span>
				<span>Этаж: 3 | Этажность: 18</span -->
			    </div>
			</div>
		    </div>
		    <ul class="action-list">
			<li><a href="#"><i class="icon-13"></i></a></li>
			<li><a href="#"><i class="icon-14"></i></a></li>
			<li><a href="#"><i class="icon-15"></i></a></li>
			<li><a href="#" class="show-extra"><i class="icon-24"></i><i class="icon-9"></i></a></li>
		    </ul>
		</div><!-- end main-info -->
		<div class="extra-info">
		    <div class="right-block">
			<a href="#" class="button show-hide-link">Поделиться</a>
			<ul class="social-share hidden-block">
			    <li><a href="#"><i class="icon-17"></i></a></li>
			    <li><a href="#"><i class="icon-18"></i></a></li>
			    <li><a href="#"><i class="icon-19"></i></a></li>
			    <li><a href="#"><i class="icon-20"></i></a></li>
			</ul>
		    </div>
		    <div class="left-block">
			<div class="account-card">
			    <img src="'.$m_user->photo.'" alt="" />
			    <div class="details">
				<p class="account-name">
				    <span class="first-name">'.$m_user->name.'</span>
				    <span class="last-name">'.$m_user->so_name.'</span>
				</p>
				<table class="objects-rating">
				    <tr><td>Объектов</td><td>'.CSite::getCountObjUser($item->owner_id).'</td></tr>
				    <tr><td>Рейтинг</td><td>+0</td></tr>
				</table>
			    </div>
			</div><!-- end account-card -->
			<div class="info">
			    <span>Объявление: № '.$item->id.'</span>
			    <span>Смотрели: '.$item->hits.'</span>
			    <span>Фотографий: '.count(CSite::getImages($item->id)).'</span>
			    <span>Размещено: '.$publDate.'</span>
			    <span>Активно до: </span>
			</div>
		    </div>
		    <div class="clear"></div>
		    <div class="complain advanced-icon hidden-wrap">
			<a href="#"><i class="icon-16"></i></a>
			<ul class="advanced-list hidden">
			    <li><a href="#">Скрытые комиссии</a></li>
			    <li><a href="#">Неактуальный объект</a></li>
			    <li><a href="#">Неадекватное поведение</a></li>
			    <li><a href="#">Ложная информация</a></li>
			    <li><a href="#">Нарушение закона или правил</a></li>
			    <li><a href="#">Не оставлять жалобу</a></li>
			</ul>
		    </div>
		</div><!-- end extra-info -->
	    </li>';
	}
	return $html;
    }
}