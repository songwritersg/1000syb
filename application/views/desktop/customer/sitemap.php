<style>

</style>
<article class="container" id="sitemap">
    <!--START: Breadcrumbs-->
    <aside class="container">
        <ol class="breadcrumbs">
            <li><a href="http://www.1000syb.com/"><i class="fa fa-home"></i></a></li>
            <li class="active"><span>SITEMAP</span></li>
        </ol>

    </aside>
    <h2 class="page-title">SITEMAP</h2>
    <ul class="sitemap-list">
        <li>
            <h3>천생연분닷컴</h3>
            <ul>
                <li>
                    <a href="<?=base_url("about")?>">회사 소개<i class="fa fa-angle-down"></i></a>
                    <ul>
                        <li><a href="<?=base_url("about#location")?>">찾아오시는 길</a></li>
                        <li><a href="<?=base_url("about#insurance")?>">해외 여행자 보험</a></li>
                        <li><a href="<?=base_url("about#account")?>">입금계좌안내</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?=base_url("about/branch")?>">지점 소개<i class="fa fa-angle-down"></i></a>
                    <ul>
                        <?php foreach($branch_list as $branch) :?>
                        <li><a href="<?=base_url("about/branch/".urlencode($branch['bnc_name']))?>"><?=$branch['bnc_name']?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <li><a href="<?=base_url("about/agreement")?>">이용약관<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("about/privacy")?>" style="font-weight:bold">개인정보취급방침<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("about/travel")?>">여행약관<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("about/events")?>">지역별 박람회 안내<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("recommend")?>">월별 베스트 허니문 지역<i class="fa fa-angle-right"></i></a></li>
            </ul>
        </li>
        <li>
            <h3>커뮤니티</h3>
            <ul>
                <li><a href="<?=base_url("board/trstory")?>">여행후기<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("board/sybqna")?>">Q&amp;A<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("counseling/call")?>">전화상담신청<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("counseling/visit")?>">평일방문신청<i class="fa fa-angle-right"></i></a></li>
            </ul>
        </li>
        <li>
            <h3>지역 소개</h3>
            <ul>
                <?php foreach($site_category as $cate) :?>
                <li>
                    <a href="<?=base_url("products/".$cate['sca_key'])?>"><?=$cate['sca_name']?><i class="fa fa-angle-down"></i></a>
                    <ul>
                        <?php foreach($cate['items'] as $item) :?>
                        <li><a href="<?=base_url("products/{$cate['sca_key']}/{$item['sca_key']}")?>"><?=$item['sca_name']?></a></li>
                        <?php endforeach;?>
                    </ul>
                </li>
                <?php endforeach;?>
            </ul>
        </li>
        <li>
            <h3>고객 센터</h3>
            <ul>
                <li><a href="<?=base_url("board/notice")?>">공지사항<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("board/alliance/write")?>">제휴문의<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("board/article")?>">보도자료<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("board/cscenter/write")?>">고객불편신고<i class="fa fa-angle-right"></i></a></li>
                <li><a href="<?=base_url("customer/sitemap")?>">사이트맵<i class="fa fa-angle-right"></i></a></li>
            </ul>
        </li>
    </ul>
</article>