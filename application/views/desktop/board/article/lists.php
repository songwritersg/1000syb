<?php $this->load->view('desktop/board/customer_common');?>
<article id="skin-article-list" class="container">
    <ul class="post-list">
        <?php if(count($notice) > 0) :?>
            <?php foreach($notice as $row) :?>
                <li>
                    <figure>
                        <img src="<?=get_post_image($row['post_content'], 350,250)?>">
                        <figcaption><?=$row['post_title']?></figcaption>
                    </figure>
                    <div class="post-desc">
                        <h3><a href="<?=$row['post_link'].$querystring?>"><?=$row['is_new']?'<img src="/static/images/common/icon_new.gif" class="icon-new">&nbsp;':''?><?=$row['post_title']?></a></h3>
                        <p class="post-content"><?=strip_tags($row['post_content'],"<br>")?></p>
                        <ul class="post-info">
                            <li><?=board_date_format($row['post_regtime'])?></li>
                            <li>HIT <?=number_format($row['post_hit'])?></li>
                        </ul>
                    </div>
                    <a href="<?=$row['post_link'].$querystring?>">보도자료 자세히 보기 <i class="fa fa-plus"></i></a>
                </li>
            <?php endforeach;?>
        <?php endif;?>

        <?php foreach($list as $row) :?>
            <li>
                <figure>
                    <img src="<?=get_post_image($row['post_content'], 350,250)?>">
                    <figcaption><?=$row['post_title']?></figcaption>
                </figure>
                <div class="post-desc">

                    <h3><a href="<?=$row['post_link'].$querystring?>"><?=$row['is_new']?'<img src="/static/images/common/icon_new.gif" class="icon-new">&nbsp;':''?><?=$row['post_title']?></a></h3>
                    <p class="post-content"><?=strip_tags($row['post_content'],"<br>")?></p>

                    <ul class="post-info">
                        <li><?=board_date_format($row['post_regtime'])?></li>
                        <li>HIT <?=number_format($row['post_hit'])?></li>
                    </ul>
                </div>
                <a href="<?=$row['post_link'].$querystring?>">보도자료 자세히 보기 <i class="fa fa-plus"></i></a>
            </li>
        <?php endforeach;?>
    </ul>
    <div class="pagination-container margin-top-30">
        <?=$pagination?>
    </div>

    <div class="toolbar-group margin-top-30">
        <div class="action-group">
            <?php if($auth['write']) : ?>
            <a class="btn btn-primary" href="<?=base_url("board/{$board['brd_key']}/write").$querystring?>"><i class="fa fa-pencil"></i>&nbsp;글쓰기</a>
            <?php endif; ?>
        </div>
    </div>
</article>