<?php

class AuthController extends Controller {
	public function actionVK() {
            $code = Yii::app()->request->getParam('code');
            $client_id = Yii::app()->params['auth']['vk']['client_id'];
            $client_secret = Yii::app()->params['auth']['vk_sec']['client_secret'];
            $redirect_uri = Yii::app()->params['auth']['vk']['redirect_uri'];
            $url = "https://api.vk.com/oauth/access_token?client_id=".$client_id.
                    "&client_secret=".$client_secret.
                    "&code=".$code.
                    "&redirect_uri=".$redirect_uri;
            $data = @file_get_contents($url);
            if($data != FALSE) {
                $m_login = new LoginForm();
                $acces_data = json_decode($data, TRUE);
                //var_dump($acces_data);
                
                $url_udata = @file_get_contents("https://api.vk.com/method/users.get?user_id=".$acces_data['user_id']."&v=5.24&fields=photo_max_orig");
                if($url_udata != FALSE) {
                    $url_udata = json_decode($url_udata, true);
                    $details_user = $url_udata['response'][0];
                    $user = Users::model()->findByAttributes(array('username' => "vk_".$acces_data['user_id']));
                    if(isset($user->name)) {
                        $m_login->username = $acces_data['email'];
                        $m_login->password = "VK_ACCESS";
                        $x = $m_login->login();
                    } else {
                        $m_user = new Users();
                        $m_user->username = "vk_".$acces_data['user_id'];
                        $m_user->password = md5(time());
                        $m_user->name = $details_user['first_name'];
                        $m_user->so_name = $details_user['last_name'];
                        $m_user->e_mail = $acces_data['email'];
                        $m_user->photo = $details_user['photo_max_orig'];
                        $m_user->state = 5;
                        $m_user->role = "owner";
                        $m_user->save();
                        $m_login->username = $m_user->username;
                        $m_login->password = "VK_ACCESS";
                        $m_login->login();
                    }
                }
            }
            //var_dump($m_login);
            $this->renderPartial('index');
	}
        
        public function actionFB () {
            
        }

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}