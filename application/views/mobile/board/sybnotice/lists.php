<h2 class="page-title">Customer Service<small>공지사항</small></h2>
<?php $this->load->view('mobile/board/customer_common')?>

<article class="container" id="form-search" style="padding:15px;background:transparent;border-bottom:1px solid #ddd;">
    <form method="get" >
        <input type="hidden" name="scol" value="title">
        <div class="input-group">
            <input type="search" class="form-control input-lg input-flat" name="stxt" placeholder="검색어를 입력해주세요" value="<?=$stxt?>">
            <span class="input-group-addon"><i class="icon-search"></i></span>
        </div>
    </form>
</article>

<article class="container bg-color-white" style="border-bottom:1px solid #ddd;">
    <ul class="post-list media-list">
        <?php foreach($list as $row) :?>
            <li class="media">
                <?php if($row['is_new']):?>
                    <div class="media-left">
                        <label class="label label-danger">N</label>
                    </div>
                <?php endif;?>
                <div class="media-body">
                    <a class="post-title-ellipsis-1" href="<?=$row['post_link']?>"><?=$row['post_title']?></a>
                    <p><?=board_date_format($row['post_regtime'])?>&nbsp;|&nbsp;천생연분닷컴&nbsp;|&nbsp;<?=number_format($row['post_hit'])?></p>
                </div>
            </li>
        <?php endforeach;?>
    </ul>
    <div class="text-center">
        <?=$pagination?>
    </div>
</article>

