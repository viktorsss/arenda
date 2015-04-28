<?php

class AdminController extends Controller {

    public $layout = '//layouts/admin_column';

    public function filters() {
	return array(
	    'accessControl', // perform access control for CRUD operations
	);
    }

    public function accessRules() {
	return array(
	    array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions' => array(
		    'index',
		    'fields',
		    'delfield',
		    'list',
		    'view',
		    'updateitem',
		    'publitem',
		    'pauseitem',
		    'cities', 'delcity', 'addcity'
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
    
    public function actionCities () {
	$model = Cities::model()->findAll();
	
	$this->render('cities', array('model' => $model));
    }
    
    public function actionAddCity () {
	$name = Yii::app()->request->getParam('nameCity');
	
	$model = new Cities();
	$model->name = $name;
	if($model->save()) {
	    echo 1;
	} else {
	    echo 0;
	}
    }
    
    public function actionDelCity () {
	$name = Yii::app()->request->getParam('name');
	if(isset($name)) Cities::model()->deleteAllByAttributes(array('name' => $name));
    }

    public function actionPauseItem($id) {
	$type = Yii::app()->user->type;
	if ($type == 777) {
	    $model = Items::model()->findByPk($id);
	    $model->status = 0;
	    if($model->save()) {
		echo "Обьявление заморожено";
	    } else {
		echo "Ошибка";
	    }
	}
    }

    public function actionPublItem($id) {
	$type = Yii::app()->user->type;
	if ($type == 777) {
	    $model = Items::model()->findByPk($id);
	    $model->status = 6;
	    if($model->save()) {
		echo "Опубликовано";
	    } else {
		echo "Ошибка";
	    }
	}
    }

    public function actionIndex() {
	$this->render('index');
    }

    /*
     * $model = new Users('search');
      $model->unsetAttributes();  // clear any default values
      if (isset($_GET['Users']))
      $model->attributes = $_GET['Users'];

      $this->render('admin', array(
      'model' => $model,
      ));
     */

    public function actionList($id, $trans) {
	//$this->layout = "//layouts/searchResult_column";
	$cr = new CDbCriteria();
	$cr->select = "*";
	$cr->condition = "functionality = :func AND city = :city AND trans = :trans";
	$cr->params = array(
	    ':func' => $id,
	    ':city' => $this->city_name,
	    ':trans' => $trans,
	);
	$cr->order = "status DESC, created DESC";

	$count = Items::model()->count($cr);

	//$cr->limit = "7";
	$model = Items::model()->findAll($cr);

	$this->render('list', array('model' => $model, 'count' => $count));
    }

    public function actionUpdateItem($id) {
	$this->layout = "//layouts/newrequest_column";

	//$user_id = Yii::app()->user->id;
	$model = Items::model()->findByPk($id);
	//var_dump($user_id);

	if (isset($model) && (Yii::app()->user->type == 777)) {
	    foreach (FuncFields::model()->findAllByAttributes(array(), "func_id = :func", array(':func' => $model->functionality)) as $item) {
		$arr[$item->id] = array('name' => $item->name, 'type' => 'input');
	    }

	    $fields_val = FuncFieldsValues::model()->findByAttributes(array(), "item_id = :id", array(':id' => $id));

	    $this->render('updateitem', array('model' => $model, 'field_name' => $arr, 'field_val' => $fields_val));
	} else {
	    throw new CHttpException(404, 'The requested page does not exist.');
	}
    }

    public function actionFields() {
	$catid = (int) Yii::app()->request->getParam('catid');
	$cr = new CDbCriteria();
	$cr->select = "*";
	$cr->condition = "func_id = :catid";
	$cr->params = array(":catid" => $catid);
	$cr->order = 'type DESC, orders ASC, id DESC';
	$model = FuncFields::model()->findAll($cr);

	//$model = new CatFields();
	//$this->layout = "/layouts/fields_column";

	$post = Yii::app()->request->getPost('field');

	if (isset($post)) {
	    for ($i = 0; $i < count($post['name']); $i++) {
		if (isset($post['id'][$i])) {
		    $cat_f = FuncFields::model()->findByPk($post['id'][$i]);
		} else {
		    $cat_f = new FuncFields();
		}
		$cat_f->required = isset($post['required'][$i]) ? $post['required'][$i] : 0;
		$cat_f->name = $post['name'][$i];
		$cat_f->type = $post['type'][$i];
		$cat_f->default = $post['default'][$i];
		$cat_f->func_id = $catid;

		$cat_f->orders = $post['order'][$i];
		$cat_f->name_column = ($post['type'][$i] == 'checkbox') ? $post['name_column'][$i] : "";
		$cat_f->block_id = ($post['type'][$i] == 'checkbox') ? 3 : 1;
		$cat_f->trans = $post['trans'][$i];

		if ($cat_f->save()) {
		    
		}
	    }
	    $this->redirect(array('admin/fields', 'catid' => $catid));
	} else {
	    $this->render('fields', array('model' => $model));
	}
    }

    public function actiondelField($id) {
	FuncFields::model()->deleteByPk($id);
    }

    public function actionView($id) {
	$this->render('view', array(
	    'model' => $this->loadModel($id),
	));
    }

    public function loadModel($id) {
	$model = Items::model()->findByPk($id);
	if ($model === null)
	    throw new CHttpException(404, 'The requested page does not exist.');
	return $model;
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

}
