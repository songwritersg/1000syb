<article class="container">
    <!--START: Breadcrumbs-->
    <aside class="container">
        <ol class="breadcrumbs">
            <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
            <li class="active"><span>여행약관</span></li>
        </ol>
    </aside>
    <!--END: Breadcrumbs-->
    <h2 class="page-title">약관 및 정책</h2>

    <ul class="about-tab">
        <li><a href="<?=base_url('about/agreement')?>">이용약관</a></li>
        <li class="privacy"><a href="<?=base_url('about/privacy');?>">개인정보취급방침</a></li>
        <li class="active"><span>여행약관</span></li>
    </ul>

    <div class="panel">
        <div class="panel-heading">
            <h2>여행약관 <small>천생연분닷컴의 여행약관입니다.</small><i class="fa fa-file-text-o"></i></h2>
        </div>
        <div class="panel-body"><pre><?=$this->site->config('site_travel')?></pre></div>
    </div>

</article>