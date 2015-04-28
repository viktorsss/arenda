<?php

class ItemsController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
	return array(
	    'accessControl', // perform access control for CRUD operations
	);
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
	return array(
	    array('allow', // allow all users to perform 'index' and 'view' actions
		'actions' => array('index', 'view', 'details', 'list', 'addnew',
		    'selectrayon',
		    'selectstreet',
		    'getnumbworlds',
		    'upload',
		    'imagedelete',
		    'stateuser',
		    'viewnologinuser',
		    'getfunc',
		    'typeobj',
		    'setparam',
		    'preroom',
		    'getonestepfields',
		    'getthreestepfields',
		    'saveaddnew',
		    'searchfield',
		    'viewsearchlist',
		    'savesearchlist',
		    'withoutreg',
		),
		'users' => array('*'),
	    ),
	    array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions' => array('create', 'update',
		    'viewloginuser',
		    'updateitem',
		),
		'users' => array('@'),
	    ),
	    array('allow', // allow admin user to perform 'admin' and 'delete' actions
		'actions' => array('admin', 'delete'),
		'users' => array('admin'),
	    ),
	    array('deny', // deny all users
		'users' => array('*'),
	    ),
	);
    }

    public function actionWithoutReg() {
	$this->renderPartial('step4/_withoutreg');
    }

    public function actionViewSearchList() {
	$html = "";
	$cond = "";
	$post = Yii::app()->request->getPost('search');

	if (isset($post)) {
	    $cond = "functionality = " . $post['catid'] . " AND trans = " . $post['trans'] . " AND city = '$this->city_name'";

	    $cr = new CDbCriteria();
	    $cr->select = "*";

	    if (@$post['cost'] == 1) {
		
	    } elseif (@$post['cost'] == 2) {
		
	    }

	    if (isset($post['areaFrom']) && ($post['areaFrom'] != 0))
		$cond .= " AND area >= " . $post['areaFrom'];
	    if (isset($post['areaTo']) && ($post['areaTo']) != 0)
		$cond .= " AND area <= " . $post['areaTo'];

	    if (isset($post['costFrom']) && ($post['costFrom']) != 0)
		$cond .= " AND price >= " . $post['costFrom'];
	    if (isset($post['costTo']) && ($post['costTo']) != 0)
		$cond .= " AND price <= " . $post['costTo'];

	    if (isset($post['kom']))
		$cond .= " AND komprice = 0";
	    $cr->condition = $cond;
	    if (isset($post['distr'])) {
		foreach ($post['distr'] as $item) {
		    $arr[] = $item;
		}
		$cr->addInCondition('district', $arr);
	    }
	    $cr->order = "created DESC";
	    $items = Items::model()->findAll($cr);

	    foreach ($items as $item) {
		if ($item->about != "") {
		    $about = "";
		    $str = explode(' ', $item->about);
		    for ($i = 0; (($i < 10) && ($i < count($str))); $i++) {
			$about .= $str[$i] . " ";
		    }
		} else {
		    $about = "Подробнее";
		}
		$image = CSite::getImages($item->id, 1);
		$m_user = Users::model()->findByPk($item->owner_id);
		$distr = @Districts::model()->findByAttributes(array('id' => $item->district))->name;
		$street = @Streets::model()->findByAttributes(array('id' => $item->street))->name;
		$html .= '<li class="search-object-item">
			<div class="main-info">
			    <div class="image"><img src="/images/upload/resize/' . CImage::getCashImg($image, 186) . '" alt=""  class="object-img"/></div>
			    <div class="object-details">
				<p class="intro"><a href="' . $this->createUrl('items/details', array('id' => $item->id)) . '"><span>' . $about . '...</span><i class="icon-43"></i></a></p>	
				<div class="cols">
				    <div>
					<b>' . $distr . '</b>
					<b>' . $street . '</b>
					<b>Цена: ' . (int) $item->price . ' руб.</b>
					<span>Общая площадь: ' . (int) $item->area . ' м<sup>2</sup></span>
					<span class="stars">
					    <span class="full"></span>
					    <span class="full"></span>
					    <span class="full"></span>
					    <span class="full"></span>
					    <span class="full"></span>
					</span><!-- end stars -->
				    </div>
				    <div>
					<span class="commission">Комиссия ' . $item->komprice . '%</span>
					<span>Цена за ' . (($item->type_price == 1) ? "м²" : "все") . ': ' . $item->price . 'руб.</span>
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
				    <img src="' . $m_user->photo . '" alt="" />
				    <div class="details">
					<p class="account-name">
					    <span class="first-name">' . $m_user->name . '</span>
					    <span class="last-name">' . $m_user->so_name . '</span>
					</p>
					<table class="objects-rating">
					    <tr><td>Объектов</td><td>' . CSite::getCountObjUser($item->owner_id) . '</td></tr>
					    <tr><td>Рейтинг</td><td>+0</td></tr>
					</table>
				    </div>
				</div><!-- end account-card -->
				<div class="info">
				    <span>Объявление: № ' . $item->id . '</span>
				    <span>Смотрели: ' . $item->hits . '</span>
				    <span>Фотографий: ' . count(CSite::getImages($item->id)) . '</span>
				    <span>Размещено: ' . $item->created . '</span>
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
	}
	echo json_encode(array('mess' => "Good epta", 'data' => $html));
    }

    public function actionSearchField() {
	$sort = array();
	$cond = "";
	$count = 0;
	$post = Yii::app()->request->getPost('search');

	if (isset($post)) {
	    $cond = "status = 6 AND functionality = " . $post['catid'] . " AND trans = " . $post['trans'] . " AND city = '$this->city_name'";

	    $cr = new CDbCriteria();
	    $cr->select = "*";

	    if (isset($post['areaFrom']) && ($post['areaFrom'] != 0))
		$cond .= " AND area >= " . $post['areaFrom'];
	    if (isset($post['areaTo']) && ($post['areaTo']) != 0)
		$cond .= " AND area <= " . $post['areaTo'];

	    if (isset($post['costFrom']) && ($post['costFrom']) != 0)
		$cond .= " AND price >= " . $post['costFrom'];
	    if (isset($post['costTo']) && ($post['costTo']) != 0)
		$cond .= " AND price <= " . $post['costTo'];

	    if (isset($post['kom']))
		$cond .= " AND komprice = 0";

	    $cr->condition = $cond;
	    if (isset($post['distr'])) {
		foreach ($post['distr'] as $item) {
		    $arr[] = $item;
		}
		$cr->addInCondition('district', $arr);
	    }

	    if (isset($post['rooms-amount'])) {
		$cr->addInCondition('rooms', $post['rooms-amount']);
	    }
	    $count = Items::model()->count($cr);

	    $limit = isset($_POST['show']) ? $_POST['show'] : 7;
	    $sort[] = isset($post['sort']) ? $post['sort'] : 'created';
	    $sort[] = isset($post['orders']) ? $post['orders'] : 'DESC';

	    $cr->order = implode(' ', $sort);

	    $cr->limit = $limit;
	    $cr->offset = isset($post['upMore']) ? $limit * $post['upMore'] : 0;
	    $data = Items::model()->findAll($cr);
	}

	echo json_encode(array('mess' => "Good epta", 'count' => $count, 'data' => CView::getViewItemList($data)));
    }

    public function actionSaveSearchList() {
	$model = new Spros();
	$post = Yii::app()->request->getPost('search');

	if (isset($post)) {
	    $post['cost'] = Yii::app()->request->getParam('cost');
	    $model->attributes = array(
		'user_id' => Yii::app()->user->id,
		'catid' => $post['catid'],
		'trans' => $post['trans'],
		'city' => $this->city_name,
		'data' => json_encode($post),
	    );
	    if ($model->save()) {
		echo json_encode(array('mess' => 'Good Epta'));
	    }
	}
    }

    public function actionGetThreeStepFields($out = NULL, $item_id = NULL, $trans = NULL) {
	$res = array();

	$id = isset($out) ? $out : Yii::app()->request->getParam('id');

	if (isset($item_id)) {
	    $fields_val = CValue::getValField($item_id);
	    $t_id = $trans;
	} else {
	    $fields_val = array();
	    $session = Yii::app()->session['addProd'];
	    $t_id = @$session['trans'][0];
	}

	$html = "";

	$condition = "trans = :defid";
	$params[':defid'] = 0;
	if (isset($t_id)) {
	    $condition .= " OR trans = :inid";
	    $params[':inid'] = $t_id;
	}

	$model = FuncFields::model()->findAllByAttributes(array('func_id' => $id, 'type' => 'checkbox'), $condition, $params);

	foreach ($model as $item) {
	    $val = isset($fields_val[$item->id]) ? "checked" : "";
	    $res[$item->name_column][] = '<li><label class="checkbox grey ' . $val . '"><input type="checkbox" name="addnew[checkbox][' . $item->id . ']" value="' . $item->name . '" ' . $val . ' />' . $item->name . '</label></li>';
	}

	foreach ($res as $key => $item) {
	    $html .= '<div class="col"><span class="title">' . $key . '</span>';
	    $html .= '<ul>' . implode('', $item) . '</ul>';
	    $html .= '</div>';
	}

	echo $html;
    }

    public function actionGetOneStepFields($out = NULL, $item_id = NULL, $trans = NULL) {
	$id = isset($out) ? $out : Yii::app()->request->getParam('id');

	if (isset($item_id)) {
	    $fields_val = CValue::getValField($item_id);
	    $t_id = $trans;
	} else {
	    $fields_val = array();
	    $session = Yii::app()->session['addProd'];
	    $t_id = @$session['trans'][0];
	}

	$html = "";

	$condition = "func_id = :func_id AND (trans = :defid";
	$params[':defid'] = 0;
	$params[':func_id'] = $id;
	if (isset($t_id)) {
	    $condition .= " OR trans = :inid";
	    $params[':inid'] = $t_id;
	}
	$condition .= ")";

	$cr = new CDbCriteria();
	$cr->condition = $condition;
	$cr->params = $params;
	$cr->order = "orders ASC, id ASC";
	//$model = FuncFields::model()->findAllByAttributes(array('func_id' => $id), $condition, $params);
	$model = FuncFields::model()->findAll($cr);

	foreach ($model as $item) {
	    if ($item->type == "select") {
		$str = explode("\n", $item->default);
		$val = isset($fields_val[$item->id]) ? $fields_val[$item->id] : $str[0];
		$html .= '<li class="addFields">
                        <span class="label">' . $item->name . '<!-- span class="mark">*</span --></span>
                        <div class="right-part">
                            <div class="select-wrap">
                                <input type="hidden" name="addnew[field][' . $item->id . ']" value="' . $val . '" />
                                <div class="select">
                                    <span class="title">' . $val . '</span>
                                    <a href="#" class="arrow"><i class="icon-24"></i><i class="icon-9"></i></a>
                                </div>
                                <ul class="option-list">';
		for ($i = 0; $i < count($str); $i++) {
		    $html .= '<li data-value="' . $str[$i] . '">' . $str[$i] . '</li>';
		}
		$html .= '</ul>
                            </div>
                        </div>
                    </li>';
	    } else if ($item->type == 'input') {
		$req_class = "";
		$val = isset($fields_val[$item->id]) ? $fields_val[$item->id] : "";
		$html .= '<li class="addFields"><span class="label">' . $item->name;
		if ($item->required) {
		    $html .= '<span class="mark">*</span>';
		    $req_class = "class='rfield'";
		}
		$html .= '</span>
                        <div class="right-part">
                            <label class="small-input"><input id="level" ' . $req_class . ' name="addnew[field][' . $item->id . ']" type="text" value="' . $val . '" placeholder="1" /></label>
                        </div>
                    </li>';
	    }
	}
	echo $html;
    }

    public function actionPreRoom() {
	$id = Yii::app()->request->getParam('id');
	echo Func::model()->findByPk($id)->choose_rooms;
	Yii::app()->end();
    }

    public function actionSetParam($p, $id, $array = 0) {
	//$arr = array();
	$arr = Yii::app()->session['addProd'];
	if ($array == 1) {
	    $arr[$p][] = $id;
	} else {
	    $arr[$p][0] = $id;
	}
	var_dump($arr);
	Yii::app()->session['addProd'] = $arr;
	//Yii::app()->end();
    }

    public function actionGetFunc() {
	$id = Yii::app()->request->getParam('id');
	$model = Func::model()->findAllByAttributes(array('catid' => $id));
	foreach ($model as $item) {
	    echo "<li><a href='#' id='funcid-" . $item->id . "'>" . $item->name . "</a></li>";
	}
    }

    public function actionViewLoginUser() {
	$id = Yii::app()->user->id;
	$model = Users::model()->findByPk($id);
	$this->renderPartial('step4/_loginuser', array("model" => $model));
    }

    public function actionViewNoLoginUser() {
	$this->renderPartial('steps/_step4');
    }

    public function actionStateUser() {
	$status = 0;
	if (!Yii::app()->user->isGuest) {
	    $status = 1;
	}
	echo json_encode(array("status" => $status));
    }

    public function actionImageDelete() {
	var_dump($_POST);
	/* $path = __DIR__."/../../images/upload/";
	  $name = Yii::app()->request->getParam('files');
	  unlink($path.$name); */
    }

    public function actionUpload() {
	$type = Yii::app()->request->getParam('type', NULL);
	$path = __DIR__ . "/../../images/upload/";
	//$path_site = Yii::app()->getBaseUrl(true)."/images/upload/";
	$path_site = "/images/upload/";

	if (isset($type)) {
	    $path .= $type . "/";
	    $path_site .= $type . "/";
	}

	$file = $_FILES['upload'];
	if (is_uploaded_file($file["tmp_name"])) {
	    $typeFile = explode(".", $file['name']);

	    $name = md5(time()) . "_" . time() . "." . $typeFile[1];
	    move_uploaded_file($file["tmp_name"], $path . $name);
	    if ($type == "user") {
		$id = Yii::app()->user->id;
		$m_user = Users::model()->findByPk($id);
		$m_user->photo = $path_site . $name;
		$m_user->save();
	    }
	}
	echo json_encode(array('image' => 'TRUE', 'url' => $path_site . $name));
    }

    public function actionGetNumbWorlds() {
	$char = Yii::app()->request->getParam('char');
	$x = explode(".", $char);
	echo CValue::num_propis($x[0]);
    }

    public function actionSelectRayon() {
	$name_city = Yii::app()->request->getParam('name_city');
	$query = Yii::app()->request->getParam('query');

	$cr = new CDbCriteria;
	$cr->select = "id, name";
	//$cr->distinct = TRUE;
	$cr->condition = "name LIKE :name AND city = :city";
	$cr->params = array(':name' => $query . '%', ':city' => $name_city);
	$cr->group = "name";
	$model = Districts::model()->findAll($cr);

	foreach ($model as $item) {
	    $sugg[] = array(
		'value' => $item->name,
		'data' => $item->id
	    );
	    //$data[] = $item->id;
	}

	$arr = array(
	    'query' => $query,
	    'suggestions' => $sugg,
		//'data' => $data,
	);
	echo json_encode($arr);
    }

    public function actionSelectStreet() {
	$query = Yii::app()->request->getParam('query');

	$cr = new CDbCriteria;
	$cr->select = "id, name";
	$cr->condition = "name LIKE :name AND city = :city";
	$cr->params = array(':name' => $query . '%', ':city' => $this->city_name);
	$cr->group = "name";
	$model = Streets::model()->findAll($cr);

	foreach ($model as $item) {
	    $sugg[] = array(
		'value' => $item->name,
		'data' => $item->id
	    );
	}

	$arr = array(
	    'query' => $query,
	    'suggestions' => $sugg,
	);
	echo json_encode($arr);
    }

    public function actionAddNew() {
	$this->layout = "//layouts/newrequest_column";

	$post = Yii::app()->request->getPost('addnew');
	if (isset($post)) {
	    echo json_encode(array());
	} else {
	    //echo json_encode(array('code' => 0, 'data' => "Все идет по плану"));
	    //Yii::app()->end();
	}

	$ar = array(
	    'trans' => array(1),
	    'typeobj' => array(7),
	);
	Yii::app()->session['addProd'] = $ar;

	$this->render('addnew');
    }

    public function actionUpdateItem($id) {
	$this->layout = "//layouts/newrequest_column";
	$user_id = Yii::app()->user->id;
	$model = Items::model()->findByAttributes(array('id' => $id, 'owner_id' => $user_id));
	//var_dump($user_id);

	if (isset($model)) {
	    foreach (FuncFields::model()->findAllByAttributes(array(), "func_id = :func", array(':func' => $model->functionality)) as $item) {
		$arr[$item->id] = array('name' => $item->name, 'type' => 'input');
	    }

	    $fields_val = FuncFieldsValues::model()->findByAttributes(array(), "item_id = :id", array(':id' => $id));

	    $this->render('updateitem', array('model' => $model, 'field_name' => $arr, 'field_val' => $fields_val));
	} else {
	    throw new CHttpException(404, 'The requested page does not exist.');
	}
    }

    public function actionSaveAddNew() {
	$model = new Items();
	$addNew = Yii::app()->session['addProd'];
	$msg = json_encode(array('code' => 0, 'data' => 'You touch my tralala'));

	$post = Yii::app()->request->getPost('addnew');
	$user_post = Yii::app()->request->getPost('User');

	if (isset($post)) {
	    if (isset($user_post)) {
		$user_model = Users::model()->findByAttributes(array('e_mail' => $user_post['e_mail'], 'phone' => $user_post['phone']));
		if (!isset($user_model)) {
		    $attr = array(
			'phone' => $user_post['phone'],
			'name' => $user_post['name'],
			'city' => $post['city'],
		    );
		    $user_id = CSite::createUser($user_post['e_mail'], $attr);
		} else {
		    $user_id = $user_model->id;
		}
	    } elseif (!Yii::app()->user->isGuest) {
		$user_id = Yii::app()->user->id;
	    }
	    $model->attributes = $post;
	    /*
	    $pres_city = Cities::model()->findByAttributes(array('name' => $post['city']));
	    if(!isset($pres_city)) {
		$m_city = Cities::model()->findByPk($pres_city->)
		$m_city->name = $post['city'];
		$m_city->save();
	    } 
	     * 
	     */
	    $model->district = $post['rayon_id'];
	    $model->functionality = $addNew['typeobj'][0];
	    $model->trans = $addNew['trans'][0];
	    $model->street = $post['street_id'];
	    $model->rooms = Yii::app()->request->getParam('rooms-number');
	    $model->owner_id = $user_id;
	    $model->place = Yii::app()->request->getParam('place');
	    if ($model->save()) {
		$fields = @$post['field'];
		if (isset($fields)) {
		    foreach ($fields as $key => $item) {
			$m_ffv = new FuncFieldsValues();
			$m_ffv->field_id = $key;
			$m_ffv->item_id = $model->id;
			$m_ffv->value = $item;
			$m_ffv->save();
		    }
		}
		$model->type_price = Yii::app()->request->getParam('radio-price');

		$commis = Yii::app()->request->getParam('radio-commission');
		if ($commis) {
		    $model->komprice = $post['komprice'];
		} else {
		    $model->komprice = 0;
		}

		$checkbox = @$post['checkbox'];
		if (isset($checkbox)) {
		    foreach ($checkbox as $key => $item) {
			$m_ffv = new FuncFieldsValues();
			$m_ffv->field_id = $key;
			$m_ffv->item_id = $model->id;
			$m_ffv->value = $item;
			$m_ffv->save();
		    }
		}

		if (isset($addNew['image'])) {
		    foreach ($addNew['image'] as $item) {
			$m_image = new Images();
			$m_image->item_id = $model->id;
			$m_image->name = $item;
			if ($m_image->save()) {
			    //unset(Yii::app()->session['addProd']);
			    unset($addNew['image']);
			    Yii::app()->session['addProd'] = $addNew;
			}
		    }
		}

		$model->about = $post['addInf'];
		if ($model->save()) {
		    $msg = json_encode(array('code' => 1, 'data' => 'I feel Good'));
		} else {
		    $msg = json_encode(array('code' => 0, 'data' => 'All fields Item not save!!'));
		}
	    } else {
		$msg = json_encode(array('code' => 0, 'data' => 'Item dont save!!!'));
	    }
	} else {
	    $msg = json_encode(array('code' => 0, 'data' => 'Post not Found!!!'));
	}
	echo $msg;
    }

    public function actionDetails($id) {
	$html = "";
	$this->layout = '//layouts/prod_col';
	$model = Items::model()->findByPk($id);
	$model->saveCounters(array('hits' => 1));

	$m_ff = FuncFields::model()->findAllByAttributes(array('func_id' => $model->functionality, 'type' => 'checkbox'));

	if (count($m_ff) > 0) {
	    foreach ($m_ff as $item) {
		$res[$item->name_column][] = $item->id;
	    }

	    foreach ($res as $key => $item) {
		$cr = new CDbCriteria();
		$cr->select = "value";
		$cr->condition = "item_id = " . $id;
		$cr->addInCondition('field_id', $item);
		$ffv_items = FuncFieldsValues::model()->findAll($cr);
		if (count($ffv_items) > 0) {
		    $html .= '<li><span class="title">' . $key . '</span>';
		    $html .= '<ul class="features-list">';
		    foreach ($ffv_items as $ffv_item) {
			$html .= '<li><i class="icon-21"></i>' . $ffv_item->value . '</li>';
		    }
		    $html .= '</ul>';
		    $html .= '</li>';
		}
	    }
	}
	
	
	$similar = "";

	$this->render('details', array('model' => $model, 'fields' => $html));
    }

    public function actionList($id, $trans) {
	$this->layout = "//layouts/searchResult_column";
	$cr = new CDbCriteria();
	$cr->select = "*";
	$cr->condition = "functionality = :func AND city = :city AND trans = :trans AND status = :status";
	$cr->params = array(
	    ':func' => $id,
	    ':city' => $this->city_name,
	    ':trans' => $trans,
	    ':status' => 6
	);
	$cr->order = "created DESC";

	$count = $this->count_list = Items::model()->count($cr);

	$cr->limit = "7";
	$model = Items::model()->findAll($cr);

	if($id < 7) {
	    $cond = "functionality < 7";
	} elseif($id > 6) {
	    $cond = "functionality > 6";
	}
	$cr2 = new CDbCriteria();
	$cr2->condition = "city = :city AND trans = :trans AND status = :status AND ".$cond;
	$cr2->params = array(
	    ':city' => $this->city_name,
	    ':trans' => 1,
	    ':status' => 6,
	);
	$cr2->limit = 4;
	$hot = Items::model()->findAll($cr);

	$this->render('list', array('model' => $model, 'count' => $count, 'hot' => $hot));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
	$this->render('view', array(
	    'model' => $this->loadModel($id),
	));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
	$model = new Items;

	$post = Yii::app()->request->getPost('Items');

	if (isset($post)) {
	    $model->attributes = $post;
	    if ($model->save()) {
		$this->redirect(array('view', 'id' => $model->id));
	    }
	}

	$this->render('create', array(
	    'model' => $model,
	));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
	$model = $this->loadModel($id);

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if (isset($_POST['Items'])) {
	    $model->attributes = $_POST['Items'];
	    if ($model->save())
		$this->redirect(array('view', 'id' => $model->id));
	}

	$this->render('update', array(
	    'model' => $model,
	));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
	$this->loadModel($id)->delete();

	// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
	if (!isset($_GET['ajax']))
	    $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
	$dataProvider = new CActiveDataProvider('Items');
	$this->render('index', array(
	    'dataProvider' => $dataProvider,
	));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
	$model = new Items('search');
	$model->unsetAttributes();  // clear any default values
	if (isset($_GET['Items']))
	    $model->attributes = $_GET['Items'];

	$this->render('admin', array(
	    'model' => $model,
	));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Items the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
	$model = Items::model()->findByPk($id);
	if ($model === null)
	    throw new CHttpException(404, 'The requested page does not exist.');
	return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Items $model the model to be validated
     */
    protected function performAjaxValidation($model) {
	if (isset($_POST['ajax']) && $_POST['ajax'] === 'items-form') {
	    echo CActiveForm::validate($model);
	    Yii::app()->end();
	}
    }

}
