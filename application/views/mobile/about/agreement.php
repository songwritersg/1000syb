<h2 class="page-title">약관 및 정책<small>이용약관</small></h2>
<?php $this->load->view('mobile/about/about_common');?>
<article class="panel panel-default margin-top-20">
    <div class="panel-heading" style="background:#f5f5f5;">
        <h2 class="panel-title">이용약관<i class="icon-note"></i></h2>
    </div>
    <div class="panel-body" style="background:#fff;"><?=nl2br($this->site->config('site_agreement'))?></div>
</article>
