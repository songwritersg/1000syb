<article id="skin-normal-view" class="container">
    <div class="post-header">
        <h1 class="post-title"><?=$post['post_title']?><small>조회수 : <?=number_format($post['post_hit'])?></small></h1>
    </div>
    <div class="post-content">
        <?=$post['contents']?>
    </div>
</article>
