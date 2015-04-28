<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
	return array(
	    // captcha action renders the CAPTCHA image displayed on the contact page
	    'captcha' => array(
		'class' => 'CCaptchaAction',
		'backColor' => 0xFFFFFF,
	    ),
	    // page action renders "static" pages stored under 'protected/views/site/pages'
	    // They can be accessed via: index.php?r=site/page&view=FileName
	    'page' => array(
		'class' => 'CViewAction',
	    ),
	);
    }
    
    public function actionCleanSession () {
	Yii::app()->session = array();
    }
    
    public function actionTest () {
	var_dump(Yii::app()->session['addProd']);
    }

    public function actionSearchCity($q = "") {
	$html = "";
	$cr = new CDbCriteria();
	$cr->condition = "name LIKE :name";
	$cr->params = array(
	    ':name' => $q . '%',
	);
	$model = Cities::model()->findAll($cr);

	$leter = mb_substr($q, 0, 1);

	$html .= '<div class="slide" data-letter="' . $leter . '"><span class="letter">' . $leter . '</span><ul class="city-list">';

	foreach ($model as $item) {
	    $html .= '<li><a href="' . $this->createUrl("site/changecity", array("nameCity" => $item->name)) . '">' . $item->name . '</a><!-- span>Свердловская область</span --></li>';
	}
	$html .= '</ul><!-- end city-list --></div>';

	echo $html;
    }

    public function actionPeople() {
	$this->layout = "//layouts/newrequest_column";
	$cr = new CDbCriteria();
	$cr->condition = "city = :city AND type != 10";
	$cr->params = array(
	    ":city" => $this->city_name,
	);

	//$model = Users::model()->findAllByAttributes(array('city' => $this->city_name));
	$model = Users::model()->findAll($cr);

	$this->render('_people', array('model' => $model));
    }

    public function actionCleanSess() {
	Yii::app()->session['addProd'] = array();
	Yii::app()->end();
    }

    public function actionEnterUserView() {
	if (!Yii::app()->user->isGuest) {
	    $id = Yii::app()->user->id;
	    $model = Users::model()->findByPk($id);

	    if (($model->name == "") && ($model->e_mail == "") && ($model->phone == "")) {
		$this->renderPartial('_enteruserview', array('model' => $model));
	    } else {
		echo "<script type='text/javascript'>location.reload();</script>";
	    }
	}
    }

    public function actionSelectCity() {
	$name_city = Yii::app()->request->getParam('name_city');
	$query = Yii::app()->request->getParam('query');

	$cr = new CDbCriteria;
	$cr->select = "name";
	$cr->condition = "name LIKE :name";
	$cr->params = array(':name' => $query . '%');
	//$cr->group = "name";
	$model = Cities::model()->findAll($cr);

	foreach ($model as $item) {
	    $sugg[] = array(
		'value' => $item->name,
		'data' => $item->name
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

    public function actionAuthVk() {
	$code = Yii::app()->request->getParam('code');
    }

    public function actionChangeCity() {
	Yii::app()->session['cityName'] = Yii::app()->request->getParam('nameCity');
	$this->redirect(Yii::app()->request->urlReferrer);
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
	$land = Yii::app()->request->getParam('land', 0);

	if ($land) {
	    $this->user_views_id = md5(time()) . "_" . time();
	    $cookie = new CHttpCookie('user_views_id', $this->user_views_id); 
	    $cookie->expire = time() + 31104000;
	    Yii::app()->request->cookies['user_views_id'] = $cookie;

	    $this->redirect('/');
	}

	if (isset(Yii::app()->request->cookies['user_views_id'])) {
	    $this->layout = "/layouts/main_column";
	    $this->render('index');
	} else {
	    $this->render('_land');
	}
    }
    
    public function actionAbout () {
	$this->render("_land");
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
	$this->layout = "//layouts/main_column";
	if ($error = Yii::app()->errorHandler->error) {
	    if (Yii::app()->request->isAjaxRequest)
		echo $error['message'];
	    else
		$this->render('error', $error);
	}
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
	$model = new ContactForm;
	if (isset($_POST['ContactForm'])) {
	    $model->attributes = $_POST['ContactForm'];
	    if ($model->validate()) {
		$name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
		$subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
		$headers = "From: $name <{$model->email}>\r\n" .
			"Reply-To: {$model->email}\r\n" .
			"MIME-Version: 1.0\r\n" .
			"Content-Type: text/plain; charset=UTF-8";

		mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
		Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
		$this->refresh();
	    }
	}
	$this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
	$model = new LoginForm;

	$post = Yii::app()->request->getPost('User');
	// collect user input data
	if (isset($post)) {
	    $model->attributes = $post;
	    // validate user input and redirect to the previous page if valid
	    if ($model->validate() && $model->login()) {
		echo json_encode(array('code' => 1, 'data' => "Matrix has you"));
	    } else {
		echo json_encode(array('code' => 0, 'data' => "Пользователь или пароль введены не верно. Проверте правильность ввода"));
	    }
	    //$this->redirect(Yii::app()->user->returnUrl);
	} else {
	    // display the login form
	    $this->renderPartial('login', array('model' => $model));
	}
    }

    public function actionRegistration() {
	$model = new Users;

	$post = Yii::app()->request->getPost('User');

	if (isset($post)) {
	    $model->attributes = $post;
	    $model->url = md5(rand(0, 1000000));
	    $model->password = md5($post['password']);
	    if ($model->save()) {
		if ($_POST['activation'] == 'email') {
		    CSite::sendEmail($post['e_mail'], $model->url);
		    echo '<h2>Пройдите по ссылке, которая втечении пяти минут прийдет к вам на почту</h2>';
		}
	    }
	} else {
	    $this->renderPartial('registration');
	}
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
	Yii::app()->user->logout();
	$this->redirect(Yii::app()->homeUrl);
    }


}
