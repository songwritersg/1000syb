<aside class="container">
    <div class="row">
        <div class="tab-slide">
            <ul class="tab-slide-ul">
                <li <?=$this->uri->segment(2)=='sybnotice'?'class="active"':''?>><a href="<?=base_url("board/sybnotice")?>">공지사항</a></li>
                <li <?=$this->uri->segment(2)=='alliance'?'class="active"':''?>><a href="<?=base_url("board/alliance/write")?>">제휴문의</a></li>
                <li <?=$this->uri->segment(2)=='article'?'class="active"':''?>><a href="<?=base_url("board/article")?>">보도자료</a></li>
                <li <?=$this->uri->segment(2)=='cscenter'?'class="active"':''?>><a href="<?=base_url("board/cscenter/write")?>">고객불편신고</a></li>
            </ul>
        </div>
    </div>
</aside>
