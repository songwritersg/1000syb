<h2 class="page-title">Customer Service<small>언론 보도 자료</small></h2>
<?php $this->load->view('mobile/board/customer_common')?>

<article class="container" id="form-search" style="padding:15px;background:transparent;border-bottom:1px solid #ddd;">
    <form method="get" >
        <input type="hidden" name="scol" value="title">
        <div class="input-group">
            <input type="search" class="form-control input-lg input-flat" name="stxt" placeholder="검색어를 입력해주세요"  value="<?=$stxt?>">
            <span class="input-group-addon"><i class="icon-search"></i></span>
        </div>
    </form>
</article>

<article class="container bg-color-white" style="border-bottom:1px solid #ddd;">
    <ul class="post-list media-list">
        <?php foreach($list as $row) :
            $thumb = get_post_image($row['post_content'], 343,245); ?>
            <li class="media">
                <?php if($thumb):?>
                    <div class="media-left">
                        <a href="<?=$row['post_link']?>">
                            <img src="<?=$thumb?>" alt="<?=$row['post_title']?>" style="width:135px;height:96px;">
                        </a>
                    </div>
                <?php endif;?>
                <div class="media-body">
                    <a class="post-title-ellipsis" href="<?=$row['post_link']?>"><?=$row['post_title']?></a>
                    <p><?=board_date_format($row['post_regtime'])?>&nbsp;|&nbsp;<?=name_blind($row['usr_name'])?>&nbsp;|&nbsp;<?=$row['post_category']?>&nbsp;|&nbsp;<?=number_format($row['post_hit'])?></p>
                    <p class="post-content-ellipsis"><?=cut_str(trim(strip_tags($row['post_content'])),100)?></p>
                </div>
            </li>
        <?php endforeach;?>
    </ul>
    <div class="text-center">
        <?=$pagination?>
    </div>
</article>

