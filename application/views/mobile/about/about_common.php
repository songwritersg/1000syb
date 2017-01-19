<aside class="container" style="background: #fff;">
    <div class="row">
        <div class="tab-slide">
            <ul class="tab-slide-ul">
                <li <?=$this->uri->segment(2)=='agreement'?'class="active"':''?>><a href="<?=base_url("about/agreement")?>">이용약관</a></li>
                <li <?=$this->uri->segment(2)=='privacy'?'class="active"':''?>><a href="<?=base_url("about/privacy")?>">개인정보취급방침</a></li>
                <li <?=$this->uri->segment(2)=='travel'?'class="active"':''?>><a href="<?=base_url("about/travel")?>">여행약관</a></li>
            </ul>
        </div>
    </div>
</aside>