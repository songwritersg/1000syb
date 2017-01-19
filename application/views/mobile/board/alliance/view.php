<h2 class="page-title">Customer Service<small>공지사항</small></h2>
<?php $this->load->view('mobile/board/customer_common')?>

<article class="container">
    <div class="row">
        <div class="panel panel-default margin-top-15">
            <div class="panel-heading">
                <h2 class="post-title"><?=$post['post_title']?></h2>
                <ul class="post-view-info">
                    <li><?=board_date_format($post['post_regtime'])?></li>
                    <li><?=name_blind($post['usr_name'])?></li>
                    <li><?=$post['post_category']?></li>
                    <li><?=number_format($post['post_hit'])?></li>
                </ul>
            </div>
            <div class="panel-body" style="background:#fff;">
                <?php
                if(isset($post['post_attach_image_count']) && $post['post_attach_image_count']  >0) :
                    foreach($post['post_attach_list'] as $attach) :
                        if( $attach['bfi_is_image'] == 'Y' ) :
                            ?>
                            <figure class="post-attach-image">
                                <img src="<?=base_url($attach['bfi_filename'])?>" class="img-responsive">
                                <figcaption><?=$attach['bfi_caption']?></figcaption>
                            </figure>
                            <?php
                        endif;
                    endforeach;
                endif;?>
                <?=$post['contents']?>
            </div>

            <div class="panel-body" style="background:#fff;">
                <div class="pull-right">
                    <a class="btn btn-default" href="<?=base_url("board/{$board['brd_key']}/{$post['post_idx']}/edit")?>">수정</a>
                    <a class="btn btn-default" href="<?=base_url("board/{$board['brd_key']}/delete/{$post['post_idx']}").$querystring?>" data-toggle='post-delete'>삭제</a>
                </div>
            </div>
        </div>
    </div>


</article>

