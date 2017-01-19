<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.min.js")?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css")?>

<h2 class="page-title"><?=$category['sca_info_title']?><small><?=$category['sca_info_subtitle']?></small></h2>

<article class="container">
    <div class="row">
        <div class="product-top-image">
            <img src="<?=$category['sca_info_bg_mobile']?>" class="img-responsive">
        </div>
    </div>
</article>

<?php if(count($category['children']) > 1) :?>
<aside class="container bg-color-white" style="margin-top:15px;">
    <div class="row">
        <div class="tab-slide margin-top-0">
            <ul class="tab-slide-ul margin-top-0">
                <?php foreach($category['children'] as $cate) : ?>
                <li <?=$selected==$cate['sca_key']?'class="active"':''?>><a href="<?=base_url("products/{$category['sca_key']}/{$cate['sca_key']}")?>"><?=$cate['sca_name']?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
</aside>
<?php endif;?>

<article class="container margin-top-20 bg-color-white" style="border-top:1px solid #ddd; border-bottom:1px solid #ddd;">
    <h2 class="text-primary text-bold">BEST RESORT</h2>
    <div class="flexslider" id="best-product-slide">
        <ul class="slides">
            <?php
            for($i=1; $i<=3; $i++) :
                if( $category["sca_top_{$i}"] && element('prd_idx',$category["sca_top_{$i}"]) ) : ?>
                    <li style="position:relative;">
                        <a class="item-container" href="<?=base_url("products/{$category['sca_top_'.$i]['sca_parent']}/{$category['sca_top_'.$i]['sca_key']}/{$category['sca_top_'.$i]['prd_idx']}")?>">
                            <div class="mark-best-product"></div>
                            <img class="product-thumbnail" src="<?=(validate_url($category["sca_top_".$i]['prd_thumb'])?'':base_url()).$category["sca_top_".$i]['prd_thumb']?>" alt="<?=$category["sca_top_".$i]['prd_title']?>">
                            <div class="bottom-overlay"></div>
                            <div class="product-detail" style="position:absolute; bottom:0px; left:0px;">
                                <h4 class="text-color-white text-center"><?=preg_replace("/\\[|\\]/","",$category["sca_top_".$i]['prd_title'])?></h4>
                            </div>
                        </a>
                    </li>
                    <?php
                endif;
            endfor;?>
        </ul>
    </div>
</article>

<?php
// 현재 선택된 2차카테고리의 정보를 가져온다.
$sub_category = $this->product_model->get_category($selected);
?>

<article class="container bg-color-grey">
    <h2><strong class="text-primary"><?=strtoupper($sub_category['sca_name'])?></strong>&nbsp;추천 여행지</h2>
    <div class="row">
        <ul class="product-list">
            <?php foreach($lists as $row) :?>
                <li class="col-xs-6">
                    <a href="<?=base_url("products/{$category['sca_key']}/{$selected}/{$row['prd_idx']}")?>">
                        <div class="thumbnails">
                            <img src="<?=$row['prd_thumb']?>" alt="<?=$row['prd_title']?>" class="img-responsive">
                        </div>
                        <div class="info">
                            <h3 class="product-title"><?=$row['prd_title']?></h3>
                            <p class="description">
                                <span class="text-primary text-bold"><?=($row['ppr_price'] >0 ? number_format($row['ppr_price']). '<small>원~</small>' : '<small>가격문의</small>')?></span>
                            </p>
                        </div>
                    </a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</article>

<script>
    $(function(){
        $("#best-product-slide").flexslider({
            controlNav : false,
            animation : 'slide'
        });
    });
</script>