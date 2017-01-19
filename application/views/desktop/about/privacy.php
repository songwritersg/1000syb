<article class="container">
    <!--START: Breadcrumbs-->
    <aside class="container">
        <ol class="breadcrumbs">
            <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
            <li class="active"><span>개인정보 취급방침</span></li>
        </ol>
    </aside>
    <!--END: Breadcrumbs-->

    <h2 class="page-title">약관 및 정책</h2>

    <ul class="about-tab">
        <li><a href="<?=base_url('about/agreement')?>">이용약관</a></li>
        <li class="active privacy"><span>개인정보취급방침</span></li>
        <li><a href="<?=base_url('about/travel');?>">여행약관</a></li>
    </ul>

    <div class="panel">
        <div class="panel-heading">
            <h2>개인정보취급방침 <small>고객의 개인정보를 소중히 보호합니다.</small><i class="fa fa-lock"></i></h2>
        </div>
        <div class="panel-body"><pre><?=$this->site->config('site_privacy')?></pre>
        </div>
    </div>

</article>