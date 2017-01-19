<h2 class="page-title">Real Review<small>허니문 후기</small></h2>

<article class="container">
    <div class="row">
        <h2 class="event-title">허니문 후기 이벤트 <i class="icon-instagram"></i></h2>
    </div>
    <div class="row event-body">
        <img class="img-responsive" src="<?=base_url("static/images/board/trstory_event_m.jpg")?>" alt="허니문 후기 이벤트 소개">
    </div>
</article>

<h2 class="event-title margin-top-15" style="border-top:1px solid #ddd;">허니문 후기 <i class="icon-edit"></i></h2>

<article class="container" id="form-search" style="padding:15px;background:transparent;border-bottom:1px solid #ddd;">
    <form method="get" >
        <input type="hidden" name="scol" value="title">
        <div class="input-group">
            <input type="search" class="form-control input-lg input-flat" name="stxt" placeholder="검색어를 입력해주세요" value="<?=$stxt?>">
            <span class="input-group-addon"><i class="icon-search"></i></span>
        </div>
    </form>
</article>


<article class="container" style="padding-top:15px; padding-bottom:15px; background:#fff; border-bottom:1px solid #ddd">
    <a href="<?=base_url("board/{$board['brd_key']}/write").$querystring?>" class="btn btn-primary btn-block btn-big"><i class="icon-edit"></i>&nbsp;리뷰작성하기</a>
</article>


<article class="container bg-color-white" style="border-bottom:1px solid #ddd;">
    <ul class="post-list media-list">
        <?php if(count($notice) > 0) :?>
            <?php $i=0;
            foreach($notice as $row) :?>
                <li class="media">
                    <div class="media-left">
                        <label class="label label-primary">공지</label>
                    </div>
                    <div class="media-body">
                        <a href="<?=$row['post_link']?>" title="<?=$row['post_title']?>"><?=$row['post_title']?></a>
                        <p><?=board_date_format($row['post_regtime'])?>&nbsp;|&nbsp;천생연분닷컴&nbsp;|&nbsp;<?=number_format($row['post_hit'])?></p>
                    </div>
                </li>
                <?php
                $i++;
                if($i>=3) break;
            endforeach;?>
        <?php endif;?>


        <?php foreach($list as $row) :
            $thumb = get_post_image($row['post_content'], 343,245); ?>
            <li class="media">
                <?php if($thumb):?>
                <div class="media-left">
                    <img src="<?=$thumb?>" alt="<?=$row['post_title']?>" style="width:135px;height:96px;">
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
