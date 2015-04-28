<?php
$arr = array();
$leter = array("А", "Б", "В", "Г", "Д", "Е", "Ж", "З", "И", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Х", "Ф", "Ц", "Ч", "Ш", "Щ", "Э", 
    //"Ю", 
    //"Я"
    );

foreach ($leter as $item) {
    $arr[$item] = array();
    $cr = new CDbCriteria;
    $cr->select = "*";
    //$cr->distinct = TRUE;
    $cr->condition="name LIKE :name";
    $cr->params=array(':name'=> $item.'%');
    $cities = Cities::model()->findAll($cr);
    
    foreach ($cities as $city) {
        $arr[$item][] = $city->name;
    }
}
?>
<div class="region-slider">
				<div class="slides-alphabet">
					<ul class="pagination">
                                            <?php foreach ($arr as $key => $item) { ?>
                                            <li><a href="#" <?php echo (count($item) > 0) ? "" : 'class="disabled"' ?> data-letter="<?php echo $key; ?>"><?php echo $key; ?></a></li>
                                            <?php } ?>
					</ul><!-- end pagination -->
				</div><!-- end slide-alphabet -->
				<div class="slides">
                                    <?php 
                                    
                                    foreach ($arr as $key => $items) {
                                        if(count($items) > 0) {
                                    ?>
                                    <div class="slide" data-letter="<?php echo $key; ?>">
						<span class="letter"><?php echo $key; ?></span>
						<ul class="city-list">
                                                    <?php 
                                                    foreach ($items as $city) { ?>
							<li>
                                                            <a href="<?php echo $this->createUrl('site/changecity', array('nameCity' => $city)) ?>"><?php echo $city; ?></a>
                                                            <span><?php echo CSite::getRegionCity($city); ?></span>
                                                        </li>
                                                    <?php } ?>
						</ul><!-- end city-list -->
					</div>
                                    <?php }} ?>
				</div>
			</div><!-- end region-slider -->