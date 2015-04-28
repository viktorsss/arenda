<?php
class CSite {
    static function getSprosTrue ($post, $city) {
	$cond = "functionality = ".$post['catid']." AND trans = ".$post['trans']." AND city = '$city'";
		
	$cr = new CDbCriteria();
	$cr->select = "*";
		
	if(@$post['cost'] == 1) {
	    
	} elseif (@$post['cost'] == 2) {
		    
	}
		
	if(isset($post['areaFrom']) && ($post['areaFrom'] != 0))    $cond .= " AND area >= ".$post['areaFrom'];
	if(isset($post['areaTo']) && ($post['areaTo']) != 0)	    $cond .= " AND area <= ".$post['areaTo'];
	
	if(isset($post['costFrom']) && ($post['costFrom']) != 0)    $cond .= " AND price >= ".$post['costFrom'];
	if(isset($post['costTo']) && ($post['costTo']) != 0)	    $cond .= " AND price <= ".$post['costTo'];
		
	if(isset($post['kom'])) $cond .= " AND komprice = 0";
	$cr->condition = $cond;
	if(isset($post['distr'])) {
	    foreach ($post['distr'] as $item) {
		$arr[] = $item;
	    }
	    $cr->addInCondition('district', $arr);
	}
	$cr->order = "created DESC";
	
	$items = Items::model()->findAll($cr);
	
	return $items;
    }
    
    static function getRegionCity ($name) {
	$model = OutCity::model()->findByAttributes(array('name' => $name));
	//var_dump(array($model, $name));
	if(isset($model)) {
	    $m_region = OutRegion::model()->findByPk($model->region_id);
	    $name = $m_region->name;
	} else {
	    $name = "";
	}
	return $name;
    }


    public static function sendEmail ($email, $url) {
	$to = $email;
	$subject = "com-arenda.ru";
	$message = "Подтвердите свой Email, перейдя по ссылке <a href='".Yii::app()->request->getBaseUrl(TRUE)."/users/confirm?id=$url'>$url</a>";
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

	// Дополнительные заголовки
	$headers .= "To: Новый пользователь <$email>"."\r\n";
	$headers .= 'From: Info <info@com-arenda.ru>' . "\r\n";
	
	$res = mail($to, $subject, $message, $headers);
	
	return $res;
    }
    
    public static function createUser ($email, $attr = array()) {
	$model = new Users();
	
	if(strpos($email, "@") != FALSE) {
	    $pass = time();
	    
	    $user = explode("@", $email);
	    
	    $model->attributes = $attr;
	    $model->username = $user[0];
	    $model->e_mail = $email;
	    $model->password = $model->url = md5($pass);
	    $model->type = 9;
	    $model->confirm = 0;
	    $model->state = 2;
	    
	    if($model->save()) {
		if(CSite::sendEmail($email, $model->url, $pass)) {
		    
		}
		return $model->id;
	    }
	}
    }
    
    
    static function getNameDistr ($id) {
        //$model = Districts::model()
    }
    
    static function getCountFunc ($id, $city_name, $trans = 1, $status = 6) {
        return Items::model()->countByAttributes(array(
	    'functionality' => $id,
	    'city' => $city_name,
	    'trans' => $trans,
	    //'status' => $status,
	));
    }
    
    static function getCountObjUser ($id) {
        return Items::model()->count(array('condition' => 'owner_id = '.$id));
    }
    
    static function getImages ($id, $xyz = 0) {
        $model = Images::model()->findAllByAttributes(array('item_id' => $id));
        
	if(count($model) > 0) {
	    foreach ($model as $item) {
		$arr[] = $item->name;
	    }

	    if($xyz && isset($arr[0])) {
		return $arr[0];
	    } elseif(!$xyz && !isset($arr[0])) {
		return NULL;
	    }
	    return $arr;
	}
    }
    
    static function skrepka ($param) {
        foreach (Yii::app()->params['auth'][$param] as $key => $item) {
            $arr[] = $key."=".$item;
        }
        return implode("&", $arr);
    }
    
    static function mb_transliterate($string) { 
	$table = array( 
	    'А' => 'a', 'Б' => 'b', 'В' => 'v', 'Г' => 'g', 'Д' => 'd', 
	    'Е' => 'e', 'Ё' => 'yo', 'Ж' => 'zh', 'З' => 'z', 'И' => 'i', 
	    'Й' => 'j', 'К' => 'k', 'Л' => 'l', 'М' => 'm', 'Н' => 'n', 
	    'О' => 'o', 'П' => 'p', 'Р' => 'r', 'С' => 's', 'Т' => 't', 
	    'У' => 'u', 'Ф' => 'f', 'Х' => 'h', 'Ц' => 'c', 'Ч' => 'ch', 
	    'Ш' => 'sh', 'Щ' => 'sch', 'Ь' => '', 'Ы' => 'y', 'Ъ' => '', 
	    'Э' => 'e', 'Ю' => 'yu', 'Я' => 'ya', 
    
	    'І' => 'i', 'і' => 'i', 'Ї' => 'i', 'ї' => 'i','Є' => 'e', 'є' => 'e',

	    'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 
	    'е' => 'e', 'ё' => 'yo', 'ж' => 'zh', 'з' => 'z', 'и' => 'i', 
	    'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n',
	    'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 
	    'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 
	    'ш' => 'sh', 'щ' => 'sch', 'ь' => '', 'ы' => 'y', 'ъ' => '', 
	    'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 
	); 

	$output = str_replace( 
	    array_keys($table), 
	    array_values($table),$string 
	); 

	// таеже те символы что неизвестны
	$output = preg_replace('/[^-a-z0-9._\[\]\'"]/i', ' ', $output);
	$output = preg_replace('/ +/', '-', $output);

	return $output; 
    }
}

