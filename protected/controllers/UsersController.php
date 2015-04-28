<?php

class UsersController extends Controller {

    public $layout = "//layouts/user_column";

    public function filters() {
	return array(
	    'accessControl', // perform access control for CRUD operations
	);
    }

    public function accessRules() {
	return array(
	    array('allow', // allow all users to perform 'index' and 'view' actions
		'actions' => array('profileitemlist', 'confirm'),
		'users' => array('*'),
	    ),
	    array('allow', // allow authenticated user to perform 'create' and 'update' actions
		'actions' => array('profile', 'profileedit', 'deleteuserphoto',
		    'sproslist', 'index', 'myobjects', 'settings',
		    'pauseitem', 'publitem', 'savesettings'),
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

    public function actionPauseItem($id) {
	$mess = "Ошибка";
	$user = Yii::app()->user->id;
	$model = Items::model()->findByAttributes(array('id' => $id, 'owner_id' => $user));
	if (isset($model)) {
	    $model->status = 0;
	    if ($model->save()) {
		$mess = "Обьявление заморожено";
	    }
	}
	echo $mess;
    }

    public function actionPublItem($id) {
	$mess = "Ошибка";
	$user = Yii::app()->user->id;
	$model = Items::model()->findByAttributes(array('id' => $id, 'owner_id' => $user));
	if (isset($model)) {
	    $model->status = 6;
	    if ($model->save()) {
		$mess = "Опубликовано";
	    }
	}
	echo $mess;
    }

    public function actionConfirm($id) {
	$this->layout = "//layouts/main_column";
	$model = Users::model()->findByAttributes(array('url' => $id));

	if (isset($model)) {
	    $model->confirm = 1;
	    $model->url = "";
	    $model->save();
	    $this->render('welcome');
	} else {
	    throw new CHttpException(404, 'Проверочного кода не существует');
	}
    }

    public function actionSettings() {
	$uid = Yii::app()->user->id;
	$model = Users::model()->findByPk($uid);
	$params = json_decode($model->params, true);
	
	$this->render('settings', array('model' => $model, 'params' => $params));
    }
    
    public function actionSaveSettings () {
	$uid = Yii::app()->user->id;
	$model = Users::model()->findByPk($uid);
	
	$post = Yii::app()->request->getPost('Sett');
	//var_dump($post);
	if(isset($post)) {
	    $model->phone = $post['phone'];
	    $model->e_mail = $post['e_mail'];
	    if($post['pass'] != "") $model->password = md5($post['pass']);
	    unset($post['phone'], $post['e_mail'], $post['pass']);
	    foreach($post as $key => $items) {
		foreach($items as $key2 => $item) {
		    $arr[$key."_".$key2] = $item;
		}
	    }
	    $model->params = json_encode($arr);
	    if($model->save()) {
		echo json_encode(array('code' => 1, 'mess' => 'Сохранено'));
	    } else {
		echo json_encode(array('code' => 0, 'mess' => 'Ошибка! Данные не были сохранены.'));
	    }
	}
    }

    public function actionMyObjects() {
	$user_id = Yii::app()->user->id;

	$cr = new CDbCriteria();
	$cr->condition = "owner_id = :user_id";
	$cr->params = array(
	    ':user_id' => $user_id,
	);
	$model = Items::model()->findAll($cr);

	$this->render('myobj', array('model' => $model));
    }

    public function actionSprosList() {
	$userid = Yii::app()->user->id;

	$cr = new CDbCriteria();
	$cr->condition = "user_id = :user_id AND city = :city AND trans = :trans";
	$cr->params = array(
	    ':user_id' => $userid,
	    ':city' => $this->city_name,
	    ':trans' => 2,
	);
	$cr->addInCondition('catid', array(7, 8, 9, 10, 11));
	$cr->limit = 7;

	$model = Spros::model()->findAll($cr);
	$user = Users::model()->findByPk($userid);
	//echo "<pre>";
	//var_dump($model);
	$this->render('usersproslist', array('model' => $model, 'user' => $user));
    }

    public function actionProfileItemList($id) {
	$this->layout = "//layouts/newrequest_column";
	$m_user = Users::model()->findByPk($id);

	$cr = new CDbCriteria();
	$cr->condition = 'owner_id =' . $id;
	$cr->order = "created DESC";

	$m_item = Items::model()->findAll($cr);

	$list_phone = UsersInputFields::model()->findAllByAttributes(array('type' => 'phone', 'user_id' => $id));
	$list_cont = UsersInputFields::model()->findAllByAttributes(array('type' => 'cont', 'user_id' => $id));

	$this->render('useritemlist', array('m_user' => $m_user, 'm_item' => $m_item, 'phones' => $list_phone, 'contacts' => $list_cont));
    }

    public function actionDeleteUserPhoto() {
	$id = Yii::app()->user->id;
	$model = Users::model()->findByPk($id);
	$model->photo = "";
	$model->save();
    }

    public function actionProfileEdit() {
	/* if(count($_POST) > 0) {
	  $this->redirect($this->createUrl('users/profileedit'));
	  } */
	$id = Yii::app()->user->id;
	$model = Users::model()->findByPk($id);

	$post = Yii::app()->request->getPost('profile');

	if (isset($post)) {
	    $model->attributes = $post;
	    if ($post['slogan'] == "Опишите вашу деятельность")
		$model->slogan = "";
	    if ($post['so_name'] == "Фамилия")
		$model->so_name = "";

	    $model->subj = Yii::app()->request->getParam('client');
	    $model->phone = $post['phoneMain'];
	    if (isset($post['promotext']))
		$model->promotext = $post['promotext'];

	    $phone_arr = @$post['phone'];
	    if (isset($phone_arr)) {
		for ($i = 0; $i < count($phone_arr); $i++) {
		    $fieldPk = UsersInputFields::model()->findByAttributes(array('field_id' => $i, 'user_id' => $id, 'type' => 'phone'));
		    /* echo "<pre>";
		      var_dump(isset($fieldPk));
		      echo "</pre>"; */
		    if (isset($fieldPk)) {
			$m_field = UsersInputFields::model()->findByPk($fieldPk->id);
		    } else {
			$m_field = new UsersInputFields;
		    }
		    $m_field->field_id = $i;
		    $m_field->user_id = $id;
		    $m_field->type = "phone";
		    $m_field->value = $phone_arr[$i];
		    $m_field->save();
		}
	    }

	    $cont_type = @$post['contactType'];
	    $cont_val = @$post['contactVal'];

	    if (isset($cont_type, $cont_val)) {
		for ($i = 0; $i < count($cont_val); $i++) {
		    $fieldPk = UsersInputFields::model()->findByAttributes(array('field_id' => $i, 'user_id' => $id, 'type' => 'cont'));

		    if (!isset($fieldPk)) {
			$m_field = new UsersInputFields;
		    } else {
			$m_field = UsersInputFields::model()->findByPk($fieldPk->id);
		    }
		    $m_field->field_id = $i;
		    $m_field->user_id = $id;
		    $m_field->type = "cont";
		    $m_field->name = $cont_type[$i];
		    $m_field->value = $cont_val[$i];
		    $m_field->save();
		}
	    }

	    if ($model->save()) {
		echo json_encode(array('code' => 1, 'data' => 'Данные удачно сохранены.'));
		Yii::app()->end();
	    }
	}

	$list_phone = UsersInputFields::model()->findAllByAttributes(array('type' => 'phone', 'user_id' => $id));
	$list_cont = UsersInputFields::model()->findAllByAttributes(array('type' => 'cont', 'user_id' => $id));

	$this->render('cabinet/default_update', array('model' => $model, 'phones' => $list_phone, 'contacts' => $list_cont));
    }

    public function actionProfile($id = 0) {
	if ($id == 0) {
	    $id = Yii::app()->user->id;
	}
	$model = Users::model()->findByPk($id);

	$in_comp = UsersCompany::model()->findByAttributes(array('user_id' => $id));

	$list_phone = UsersInputFields::model()->findAllByAttributes(array('type' => 'phone', 'user_id' => $id));
	$list_cont = UsersInputFields::model()->findAllByAttributes(array('type' => 'cont', 'user_id' => $id));

	$this->render("cabinet/default", array('model' => $model, 'in_comp' => $in_comp, 'phones' => $list_phone, 'contacts' => $list_cont));
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
	$model = new Users;

	// Uncomment the following line if AJAX validation is needed
	// $this->performAjaxValidation($model);

	if (isset($_POST['Users'])) {
	    $model->attributes = $_POST['Users'];
	    if ($model->save())
		$this->redirect(array('view', 'id' => $model->id));
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

	if (isset($_POST['Users'])) {
	    $model->attributes = $_POST['Users'];
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
	$model = "";

	$this->render('index');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
	$model = new Users('search');
	$model->unsetAttributes();  // clear any default values
	if (isset($_GET['Users']))
	    $model->attributes = $_GET['Users'];

	$this->render('admin', array(
	    'model' => $model,
	));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Users the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
	$model = Users::model()->findByPk($id);
	if ($model === null)
	    throw new CHttpException(404, 'The requested page does not exist.');
	return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Users $model the model to be validated
     */
    protected function performAjaxValidation($model) {
	if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
	    echo CActiveForm::validate($model);
	    Yii::app()->end();
	}
    }

}
