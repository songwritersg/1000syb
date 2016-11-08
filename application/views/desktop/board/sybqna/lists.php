<?php $this->load->view("desktop/board/qna_common");?>
<article id="skin-sybqna-list" class="container">
    <table class="post-list" summary="<?=$board['brd_title']?> 게시판 <?=$page?>페이지 목록">
        <caption><?=$board['brd_title']?> 게시판 <?=$page?>페이지</caption>
        <colgroup>
            <col width="150px" />
            <col width="150px" />
            <col width="*" />
            <col width="150px" />
            <col width="150px" />
            <col width="150px" />
            <col width="150px" />
        </colgroup>
        <thead>
            <tr>
                <th scope="번호">No.</th>
                <th scope="지사">지사</th>
                <th scope="제목">제목</th>
                <th scope="작성자">작성자</th>
                <th scope="작성일">작성일</th>
                <th scope="답변">답변</th>
                <th scope="조회수">HIT</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($list) == 0) :?>
            <tr>
                <td colspan="7">등록된 글이 없습니다.</td>
            </tr>
        <?php else :?>
            <?php foreach($notice as $row) :?>
            <tr>
                <td class="notice"><img class="icon-notice" src="/static/images/common/icon_notice.gif" alt="상시공지"></td>
                <td><?=$row['post_category']?></td>
                <td class="post-title">
                    <a href="<?=$row['post_link']?>">
                        <?=$row['is_new']?'<img src="/static/images/common/icon_new.gif" class="icon-new">':''?>
                        <?=$row['post_title']?>
                    </a>
                </td>
                <td><?=$row['usr_name']?></td>
                <td><?=board_date_format($row['post_regtime'])?></td>
                <td><?=$row['answer_count']?></td>
                <td><?=number_format($row['post_hit'])?></td>
            </tr>
            <?php endforeach;?>
            <?php foreach($list as $row) :?>
            <tr>
                <td><?=$row['is_reply']?"":number_format($row['nums'])?></td>
                <?php if($this->member->is_login()) : ?>
                    <td><a href="<?=base_url("board/{$board['brd_key']}")?>?category=<?=$row['post_category']?>"><?=$row['post_category']?></a></td>
                <?php else :?>
                    <td><?=$row['post_category']?></td>
                <?php endif;?>
                <td class="post-title">
                    <?=$row['is_reply']?'<img src="/static/images/common/icon_reply.gif" class="icon-reply">':''?>
                    <?=$row['is_new']?'<img src="/static/images/common/icon_new.gif" class="icon-new">':''?>
                    <a href="<?=$row['post_link'].$querystring?>">
                        <?=$row['post_title']?>
                    </a>
                    <?=$row['is_secret']?'<i class="fa fa-lock"></i>':''?>
                </td>
                <td><?=$row['usr_name']?></td>
                <td><?=board_date_format($row['post_regtime'])?></td>
                <td><img src="/static/images/board/answer_<?=$row['answer_count']>0?'y':'n'?>.jpg" alt="<?=$row['answer_count']>0?'답변완료':'미답변'?>"></td>
                <td><?=number_format($row['post_hit'])?></td>
            </tr>
            <?php endforeach;?>
        <?php endif;?>
        </tbody>
    </table>
    <div class="pagination-container margin-top-30">
        <?=$pagination?>
    </div>

    <div class="toolbar-group margin-top-30">
        <div class="search-form">
            <?=form_open(NULL, array("method"=>"get","class"=>"form-inline"))?>
            <select name="scol" data-toggle="syb-select">
                <option value="title" <?=$scol=="title"?"selected":""?>>제목</option>
                <option value="titlecontent" <?=$scol=="titlecontent"?"selected":""?>>제목+내용</option>
                <option value="nickname" <?=$scol=="nickname"?"selected":""?>>작성자</option>
            </select>
            <input type="search" class="form-control form-control-search" name="stxt" value="<?=$stxt?>" placeholder="검색어를 입력하세요">
            <?=form_close()?>
        </div>

        <div class="action-group">
            <?php if($auth['write']) : ?>
            <a class="btn btn-primary" href="<?=base_url("board/{$board['brd_key']}/write").$querystring?>"><i class="fa fa-pencil"></i>&nbsp;글쓰기</a>
            <?php endif; ?>
        </div>
    </div>
</article>