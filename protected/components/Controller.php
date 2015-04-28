<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    public $layout = '//layouts/column1';
    public $menu = array();
    public $breadcrumbs = array();
    public $user_views_id = "";
    public $city_name;
    public $count_list = 0;

    public function init() {
	if (isset(Yii::app()->session['cityName'])) {
	    $this->city_name = Yii::app()->session['cityName'];
	} else {
	    if (isset(Yii::app()->request->cookies['cityName'])) {
		$this->city_name = Yii::app()->session['cityName'] = Yii::app()->request->cookies['cityName'];
	    } else {
		$this->city_name = Yii::app()->session['cityName'] = 'Москва';
	    }
	}
	$cookie = new CHttpCookie('cityName', $this->city_name);
	$cookie->expire = time() + 31104000;
	Yii::app()->request->cookies['cityName'] = $cookie;
	parent::init();
    }

    public function setUserViewId() {
	if (isset(Yii::app()->request->cookies['user_views_id'])) {
	    $this->user_views_id = Yii::app()->request->cookies['user_views_id']->value;
	} else {
	    $this->user_views_id = md5(time()) . "_" . time();
	    $cookie = new CHttpCookie('user_views_id', $this->user_views_id);
	    $cookie->expire = time() + 31104000;
	    Yii::app()->request->cookies['user_views_id'] = $cookie;
	}
    }

}
