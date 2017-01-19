<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/masonry/4.1.1/masonry.pkgd.min.js")?>
<?php $this->load->view("desktop/board/trstory/common_header")?>

<div class="container">
    <div class="board-title">
        <h2>여행후기 EVENT<small>허니문의 소중한 기억을 남겨주세요</small></h2>
    </div>
    <div id="trstory-event-body">

        <?php if($this->member->level() >= 8) :?>
            <aside id="board-editor">
                <button class="btn btn-white" type="button" onclick="$('#dialog-editor').dialog('open');"><i class="fa fa-cog"></i></button>
            </aside>
            <div id="dialog-editor">
                <form id="form-trstory-editor" enctype="multipart/form-data">
                    <h3>BEST REVIEW 1</h3>
                    <input type="file" class="form-control" name="userfile_1">
                    <input type="text" class="form-control" name="best_one_desc_1" value="<?=$board['extra']['best_one_desc_1']?>">
                    <input type="text" class="form-control" name="best_one_desc_2" value="<?=$board['extra']['best_one_desc_2']?>">
                    <input type="text" class="form-control" name="best_one_link" value="<?=$board['extra']['best_one_link']?>">
                    <hr>
                    <h3>BEST REVIEW 2</h3>
                    <input type="file" class="form-control" name="userfile_2">
                    <input type="text" class="form-control" name="best_two_desc_1" value="<?=$board['extra']['best_two_desc_1']?>">
                    <input type="text" class="form-control" name="best_two_desc_2" value="<?=$board['extra']['best_two_desc_2']?>">
                    <input type="text" class="form-control" name="best_two_link" value="<?=$board['extra']['best_two_link']?>">

                    <div class="text-center margin-top-10">
                        <button type="submit" class="btn btn-primary">저장</button>
                        <button type="button" onclick="$('#dialog-editor').dialog('close');" class="btn btn-white">닫기</button>
                    </div>
                </form>
            </div>
            <script>
                $(function(){
                    $("#form-trstory-editor").submit(function(e){
                        e.preventDefault();

                        var formData = new FormData();
                        formData.append('userfile_1', $("input[name='userfile_1']")[0].files[0]);
                        formData.append('userfile_2', $("input[name='userfile_2']")[0].files[0]);
                        formData.append('best_one_link', $("input[name='best_one_link'").val());
                        formData.append('best_two_link', $("input[name='best_two_link'").val());
                        formData.append('best_one_desc_1', $("input[name='best_one_desc_1']").val());
                        formData.append('best_one_desc_2', $("input[name='best_one_desc_2']").val());
                        formData.append('best_two_desc_1', $("input[name='best_two_desc_1']").val());
                        formData.append('best_two_desc_2', $("input[name='best_two_desc_2']").val());

                        $.ajax({
                            url : '/api/board/trstory_best',
                            type : 'post',
                            data : formData,
                            processData : false,
                            contentType: false,
                            success:function(data) {
                                location.reload();
                            }
                        })
                    });

                    $("#dialog-editor").dialog({
                        width : 300,
                        height :'auto',
                        autoOpen : false,
                        modal : true
                    });
                });
            </script>
        <?php endif;?>

        <img src="/static/images/board/event_trstory.jpg?20170109" class="wide-banner">
        <ul class="event-best">
            <li>
                <a href="<?=$board['extra']['best_one_link']?>">
                    <figure>
                        <img src="<?=base_url($board['extra']['best_one_thumb'])?>">
                        <figcaption>BEST REVIEW 1</figcaption>
                    </figure>
                    <h4><img src="/static/images/board/lbl_best_1.png"></h4>
                    <ul class="desc">
                        <li><?=$board['extra']['best_one_desc_1']?></li>
                        <li><?=$board['extra']['best_one_desc_2']?></li>
                    </ul>
                </a>
            </li>
            <li>
                <a href="<?=$board['extra']['best_two_link']?>">
                    <figure>
                        <img src="<?=base_url($board['extra']['best_two_thumb'])?>">
                        <figcaption>BEST REVIEW 1</figcaption>
                    </figure>
                    <h4><img src="/static/images/board/lbl_best_2.png"></h4>
                    <ul class="desc">
                        <li><?=$board['extra']['best_two_desc_1']?></li>
                        <li><?=$board['extra']['best_two_desc_2']?></li>
                    </ul>
                </a>
            </li>
        </ul>
    </div>
</div>
<article id="skin-trstory-list" class="container-fluid margin-top-30">
    <div class="container">
        <div class="toolbar-group margin-bottom-30">
            <div class="search-form">
                <?=form_open(NULL, array("method"=>"get","class"=>"form-inline"))?>
                <select name="scol" class="form-control">
                    <option value="title" <?=$scol=="title"?"selected":""?>>제목</option>
                    <option value="titlecontent" <?=$scol=="titlecontent"?"selected":""?>>제목+내용</option>
                    <option value="nickname" <?=$scol=="nickname"?"selected":""?>>작성자</option>
                </select>
                <input type="search" class="form-control form-control-search" name="stxt" value="<?=$stxt?>" placeholder="검색어를 입력하세요">
                <?=form_close()?>
            </div>

            <div class="action-group">
                <?php if($auth['write']) : ?>
                    <a class="btn btn-dark" style="padding:6px 14px;margin-right:15px;" href="<?=base_url("board/{$board['brd_key']}/write").$querystring?>"><i class="fa fa-pencil"></i>&nbsp;글쓰기</a>
                <?php endif; ?>
            </div>
        </div>

        <?php if(count($notice) > 0) :?>
        <ul class="notice-list margin-bottom-30">
            <?php $i=0;
                foreach($notice as $row) :?>
                <li>
                    <a href="<?=$row['post_link']?>" title="<?=$row['post_title']?>">
                        <h4><?=$row['post_title']?></h4>
                        <ul>
                            <li><?=board_date_format($row['post_regtime'])?></li>
                            <li><?=number_format($row['post_hit'])?></li>
                        </ul>
                    </a>
                </li>
            <?php
                $i++;
                if($i>=3) break;
                endforeach;?>
        </ul>
        <?php endif;?>

        <ol class="post-list">
            <?php foreach($list as $row) :
                $thumb = get_post_image($row['post_content'], 343,245);
                ?>
                <li class="card">
                    <a href="<?=$row['post_link'].$querystring?>">
                        <?php if($thumb):?>
                        <figure>
                            <img src="<?=$thumb?>">
                            <figcaption><?=$row['post_title']?></figcaption>
                        </figure>
                        <?php endif;?>
                        <h4 class="post-title"><?=$row['post_title']?></h4>
                        <ul class="post-info">
                            <li><?=board_date_format($row['post_regtime'])?></li>
                            <li><?=name_blind($row['usr_name'])?></li>
                            <li><?=number_format($row['post_hit'])?></li>
                        </ul>
                        <p class="post-desc"><?=strip_tags($row['post_content'],"<br>")?></p>
                    </a>
                </li>
            <?php endforeach;?>
        </ol>
    </div>

    <div class="pagination-container margin-top-30" style="padding-bottom:30px">
        <?=$pagination?>
    </div>

</article>


<script>
    $(function(){
        $(".post-list").masonry({
            itemSelector : '.card',
            columnWidth : 355,
            gutter : 10,
            isFitWidth:true,
            isAnimated:true,
        });
    });
</script>