<?php

class SprosController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/main_column';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'viewspros', 'indexviewspros', 'listfuncbuild'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function actionListFuncBuild ($catid) {
	    $title = "";
	    $html = "";
	    $model = Func::model()->findAllByAttributes(array('catid' => $catid));
	    
	    foreach ($model as $key => $item) {
		if(!$key) {
		    $id = $item->id;
		    $title = $item->name;
		}
		$html .= '<li id="func-'.$item->id.'" class="func" data-value="'.$item->id.'">'.$item->name.'</li>';
	    }
	    echo json_encode(array('data' => $html, 'id' => $id, 'title' => $title));
	}
	
	public function actionViewSpros ($pagin = 1, $limit = 7) {
	    $cond = "";
	    
	    $trans = Yii::app()->request->getParam('trans');
	    $funcCat = Yii::app()->request->getParam('funcCat');
	    $funcid = Yii::app()->request->getParam('funcid');
	    $funcid2 = Yii::app()->request->getParam('funcid2');
	    $show = Yii::app()->request->getParam('show');
	    
	    if(!isset($funcid)) $funcid = $funcid2;
	    
	    $userid = Yii::app()->user->id;

	    $cr = new CDbCriteria();
	    if(isset($trans))	$cond[] = 'trans = '.$trans;
	    $cond[] = 'city = "'.$this->city_name.'"';
	    if($funcid2 != "") {
		$cond[] = 'catid = '.$funcid;
	    }
	    
	    if(isset($userid))	$cond[] = 'user_id = '.$userid;
	    
        //var_dump($cond);
	    $cr->condition = implode(" AND ", $cond);
	    
	    if($funcid2 == "") {
		if($funcCat == 1) {
		    $cr->addInCondition('catid', array(1,2,3,4,5,6));
		} elseif ($funcCat == 2) {
		    $cr->addInCondition('catid', array(7,8,9,10,11));
		}
	    }
	    
	    $cr->offset = 0;
	    $cr->limit = $show;
    	//$this->render
	    $model = Spros::model()->findAll($cr);
	    $user  = Users::model()->findByPk($userid);
		//echo "<pre>";
		//var_dump($cr);
	    $this->renderPartial('usersproslist_part', array('model' => $model, 'user' => $user), FALSE);
	}
	
	public function actionIndexViewSpros ($pagin = 1, $limit = 7) {
	    $cond = "";
	    
	    $trans = Yii::app()->request->getParam('trans');
	    $funcCat = Yii::app()->request->getParam('funcCat');
	    $funcid = Yii::app()->request->getParam('funcid');
	    $funcid2 = Yii::app()->request->getParam('funcid2');
	    $show = Yii::app()->request->getParam('show');
	    
	    if(!isset($funcid)) $funcid = $funcid2;
	    
	    //$userid = Yii::app()->user->id;

	    $cr = new CDbCriteria();
	    if(isset($trans))	$cond[] = 'trans = '.$trans;
	    $cond[] = 'city = "'.$this->city_name.'"';
	    if($funcid2 != "") {
		$cond[] = 'catid = '.$funcid;
	    }
	    
	    //if(isset($userid))	$cond[] = 'user_id = '.$userid;
	    
        //var_dump($cond);
	    $cr->condition = implode(" AND ", $cond);
	    
	    if($funcid2 == "") {
		if($funcCat == 1) {
		    $cr->addInCondition('catid', array(1,2,3,4,5,6));
		} elseif ($funcCat == 2) {
		    $cr->addInCondition('catid', array(7,8,9,10,11));
		}
	    }
	    
	    $cr->offset = 0;
	    $cr->limit = $show;
    	//$this->render
	    $model = Spros::model()->findAll($cr);
	    //$user  = Users::model()->findByPk($userid);
		//echo "<pre>";
		//var_dump($cr);
	    $this->renderPartial('indexproslist_part', array('model' => $model), FALSE);
	}

	public function actionIndex ($id) {
	    $cr = new CDbCriteria();
	    $cr->condition = "city = :city AND trans = :trans AND catid = :catid";
	    $cr->params = array(
		':city' => $this->city_name,
		':trans' => 2,
		':catid' => $id,
	    );
	    //$cr->addInCondition('catid', array(7,8,9,10,11));
	    $cr->limit = 7;
	    
	    $model = Spros::model()->findAll($cr);
	    $this->render('index', array('model' => $model));
	}

}
