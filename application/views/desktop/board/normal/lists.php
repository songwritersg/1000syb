<article id="skin-normal-list" class="container" data-toggle="pjax-container">
    <table class="post-list" summary="<?=$board['brd_title']?> 게시판 <?=$page?>페이지 목록">
        <caption><?=$board['brd_title']?> 게시판 <?=$page?>페이지</caption>
        <colgroup>
            <col width="150px" />
            <col width="*" />
            <col width="150px" />
            <col width="150px" />
            <col width="150px" />
        </colgroup>
        <thead>
            <tr>
                <th scope="번호">No.</th>
                <th scope="제목">제목</th>
                <th scope="작성자">작성자</th>
                <th scope="작성일">작성일</th>
                <th scope="조회수">HIT</th>
            </tr>
        </thead>
        <tbody>
        <?php if(count($list) == 0) :?>
            <tr>
                <td colspan="5">등록된 글이 없습니다.</td>
            </tr>
        <?php else :?>
            <?php foreach($list as $row) :?>
            <tr>
                <td><?=number_format($row['nums'])?></td>
                <td class="post-title">
                    <a href="<?=$row['post_link']?>"><?=$row['post_title']?></a>
                </td>
                <td><?=$row['usr_name']?></td>
                <td><?=board_date_format($row['post_regtime'])?></td>
                <td><?=number_format($row['post_hit'])?></td>
            </tr>
            <?php endforeach;?>
        <?php endif;?>
        </tbody>
    </table>
</article>