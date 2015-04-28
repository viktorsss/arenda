<?php
class ContentUrlRule extends CBaseUrlRule { 
    public $connectionID = 'db';
 
    public function createUrl($manager,$route,$params,$ampersand) {
	$trans = array(
	    1 => 'arenda',
	    2 => 'prodaja',
	);
	$func = array(
	    1 => 'ofisnoe-pomeschenie',
	    2 => 'skladskoe-pomeschenie',
	    3 => 'torgovaya-ploschad',
	    5 => 'proizvodstvennoe-pomeschenie',
	    6 => 'svobodnogo-naznacheniya',
	    7 => 'kvartiri',
	    8 => 'komnati',
	    9 => 'doma-i-dachi',
	    10 => 'kottedji',
	    11 => 'taunhausi'
	);
	$p = json_encode($params);
	$url = @SeoUrl::model()->findByAttributes(array('request' => $route, 'params' => $p))->url;
	if(!isset($url)) {
	    if($route === 'spros/index') {
		$url = "spros/".$func[$params['id']];
	    } elseif($route === 'items/list') {
		$url = $trans[$params['trans']]."/".$func[$params['id']];
	    } elseif($route === 'items/details') {
		$model = Items::model()->findByPk($params['id']);
		$url = $trans[$model->trans]."/".CSite::mb_transliterate($model->slogan);
	    } else {
		return false;
	    }
	    return $this->saveUrl($url, $route, $params).".html";
	} else {
	    return $url.".html";
	}// не применяем правило */
      return FALSE;
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo) {
	//var_dump($request);
	$m_seo = SeoUrl::model()->findByAttributes(array('url' => $pathInfo));
	if(isset($m_seo)) {
	    $_GET = json_decode($m_seo->params, TRUE);
	    return $m_seo->request;
	}
	
        return false;
    }
    
    protected function saveUrl ($url, $route, $params) {
	//$url = @SeoUrl::model()->findByAttributes(array('request' => $route, 'params' => $p))->url;
	$m_seo = new SeoUrl();
	$m_seo->url = $url;
	$m_seo->request = $route;
	$m_seo->params = json_encode($params);
	$m_seo->save();
	$m_seo->url = $url."-".$m_seo->id;
	$m_seo->save();
	
	return $url;
    }
}
?>
