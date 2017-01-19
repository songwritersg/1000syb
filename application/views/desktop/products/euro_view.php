<?=$this->site->add_js("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider.min.js")?>
<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js")?>
<?=$this->site->add_js("/static/js/jquery.carousel-1.1.min.js")?>
<?=$this->site->add_css("https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css")?>
<aside class="container">
    <ol class="breadcrumbs">
        <li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
        <li><a href="<?=base_url("products/{$sca_parent}")?>"><?=$category['sca_name']?></a></li>
        <li class="active"><span>상품보기</span></li>
    </ol>
</aside>

<article class="container" id="product-view">
    <div class="product-view-header">
        <h1><?=$product['prd_title']?></h1>
        <h3><?=$product['cty_name']?></h3>
    </div>
    <div class="product-view-gallery">
        <div class="carousel">
            <div class="slides">
                <?php foreach($product['gallery_list'] as $gallery) : ?>
                    <div>
                        <a class="gallery-item" href="<?=$gallery?>" data-toggle="image-preview">
                            <img src="<?=$gallery?>">
                        </a>
                    </div>
                <?php endforeach?>
            </div>
        </div>
    </div>

    <div class="product-program-list">

        <h3>항공별 가격안내</h3>
        <div class="action-box">
            <ul class="sns-share-list">
                <li class=""><a href="#" data-toggle="sns-share" data-service="facebook" data-title="<?=$product['prd_title']?>" data-url="<?=current_url()?>">페이스북 공유하기</a></li>
                <li class=""><a href="#" data-toggle="sns-share" data-service="google" data-title="<?=$product['prd_title']?>" data-url="<?=current_url()?>">구글+ 공유하기</a></li>
                <li class=""><a href="#" data-toggle="sns-share" data-service="kakaostory" data-title="<?=$product['prd_title']?>" data-url="<?=current_url()?>">카카오 스토리 공유하기</a></li>
                <li class=""><a href="#" data-toggle="sns-share" data-service="band" data-title="<?=$product['prd_title']?>" data-url="<?=current_url()?>">밴드 공유하기</a></li>
                <li class=""><a href="#" data-toggle="sns-share" data-service="naver" data-title="<?=$product['prd_title']?>" data-url="<?=current_url()?>">네이버 공유하기</a></li>
            </ul>
            <!--
            <button type="button" class="btn btn-primary" data-toggle="send-mail" data-idx="<?=$product['prd_idx']?>" data-prg="<?=$prg_idx?>" data-key="<?=$sca_key?>" data-parent="<?=$sca_parent?>">메일 보내기</button>
            -->
        </div>
        <div class="clearfix"></div>

        <ol class="program-list">
            <?php foreach($program_list as $prog) :?>
                <li <?=$prog['prg_idx']==$prg_idx?'class="active"':''?>>
                    <div class="program-list-header">
                        <h5><?=$prog['airline_name']?> <small>(<?=$prog['start_date']?>~<?=$prog['end_date']?>)</small></h5>
                        <a class="btn" href="<?=base_url("products/{$sca_parent}/{$sca_key}/{$product['prd_idx']}/{$prog['prg_idx']}")?>"><i class="fa <?=$prg_idx==$prog['prg_idx']?'fa-caret-down':'fa-caret-right'?>"></i></a>
                    </div>
                    <div class="program-list-body" <?=$prg_idx==$prog['prg_idx']?'style="display:block"':''?>>
                        <table class="table table-price">
                            <thead>
                            <tr>
                                <th>분류</th>
                                <th>출발 가능 일자</th>
                                <th>판매가</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?=$prog['flight_type']?></td>
                                    <td><?=$prog['start_date']?>~<?=$prog['end_date']?></td>
                                    <td><?=number_format($prog['price'])?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </li>
            <?php endforeach;?>
        </ol>
    </div>

    <div id="product-benefit">
        <ul class="product-menu">
            <li class="active"><a href="#product-benefit">상품특전 확인하기</a></li>
            <li><a href="#product-info">리조트 정보</a></li>
            <li><a href="#product-program-detail">일정표 확인하기</a></li>
            <li><a href="#" data-toggle="open-sybqna">상품 문의하기</a></li>
        </ul>
        <h4 class="detail-title"><img src="/static/images/products/title_product_benefit.jpg"></h4>
        <table class="table table-benefit">
            <thead>
                <th colspan="2">타사 비교 포인트</th>
            </thead>
            <tbody>
                <?php foreach($view['DIFFERENT_POINT_INFO'] as $diff) : ?>
                <tr>
                    <th><?=$diff['CityName']?></th>
                    <td><?=nl2br($diff['Content'])?></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>

        <?php foreach($view['RULE_INFO'] as $benefit) :?>
        <table class="table table-benefit">
            <tr>
                <th>상품 특전</th>
                <td><?=nl2br($benefit['BonusContent'])?></td>
            </tr>
        </table>
        <table class="table table-include">
            <thead>
            <tr>
                <th class="include"><i class="fa fa-check-circle"></i>&nbsp;포함사항</th>
                <th class="exclude">불포함 사항</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-left"><?=$benefit['InclusionContent']?></td>
                <td class="text-left"><?=$benefit['NotInclusionContent']?></td>
            </tr>
            </tbody>
        </table>
        <?php endforeach;?>
    </div>
    <div id="product-info">
        <ul class="product-menu">
            <li><a href="#product-benefit">상품특전 확인하기</a></li>
            <li class="active"><a href="#product-info">리조트 정보</a></li>
            <li><a href="#product-program-detail">일정표 확인하기</a></li>
            <li><a href="#" data-toggle="open-sybqna">상품 문의하기</a></li>
        </ul>

        <h4 class="detail-title"><img src="/static/images/products/title_product_info.jpg"></h4>
        <div class="info-detail">
            <div class="info-detail-header">
                <h2 style="font-size:32px;letter-spacing:-0.075em;"><strong style="font-weight:500;"><?=$product['prd_title']?></strong></h2>
                <p class="prd-info-description">
                    여행국가&nbsp;:&nbsp;<?=$product['cty_name']?><br>
                    여행도시&nbsp;:&nbsp;<?=$product['ct_name']?>
                </p>
            </div>
            <div class="info-detail-first">
                <h4 class="img-title">▶&nbsp;관광지 정보</h4>

                <div class="flexslider" style="margin-bottom:30px;">
                    <ul class="slides">
                        <?php foreach($view['TOUR_LOCATION_INFO'] as $tour) :?>
                        <li class="euro-resort-info">
                            <div class="img-thumb">
                                <img src="<?=$tour['ImgUrl']?>" title="<?=$tour['KoreanName']?>" />
                            </div>
                            <table summary="<?=$tour['NationName']?>/<?=$tour['CityName']?> 관광지 정보">
                                <colgroup>
                                    <col width="120" />
                                    <col width="*" />
                                </colgroup>
                                <tr>
                                    <th style="height:55px">국가/도시</th>
                                    <td style="height:55px;"><?=$tour['NationName']?>/<?=$tour['CityName']?></td>
                                </tr>
                                <tr>
                                    <th style="height:95px">찾아가는 방법</th>
                                    <td style="height:95px;">
                                        <p class="ellipsis" style="-webkit-line-clamp:3;"><?=$tour['Visit']?></p>
                                    </td>
                                </tr>
                                <tr>
                                    <th colspan="2" style="height:55px;">관광지안내</th>
                                </tr>
                                <tr>
                                    <td colspan="2" style="height:173px;">
                                        <p class="ellipsis"  style="-webkit-line-clamp:7;line-height:1.4"><?=nl2br(trim(strip_tags($tour['Description'])))?></p>
                                    </td>
                                </tr>
                            </table>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
            <div style="height:1px; background:#ddd; width:100%;"></div>
            <div class="info-detail-second">
                <h4 class="img-title">▶&nbsp;호텔</h4>
                <div class="flexslider">
                    <ul class="slides">
                        <?php foreach($view['HOTEL_INFO'] as $hotel) :?>
                            <li class="euro-resort-info">
                                <div class="img-thumb">
                                    <img src="<?=$hotel['ImageUrl']?>" title="<?=$hotel['HotelKName']?>" />
                                </div>
                                <table>
                                    <colgroup>
                                        <col width="120" />
                                        <col width="*" />
                                    </colgroup>
                                    <tr>
                                        <th style="height:55px;">호텔 이름</th>
                                        <td style="height:55px;"><?=$hotel['HotelEName']?></td>
                                    </tr>
                                    <tr>
                                        <th style="height:55px;">등급</th>
                                        <td style="height:55px;"><?=$hotel['StarRating']?></td>
                                    </tr>
                                    <tr>
                                        <th colspan="2" style="height:55px;">호텔 안내</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="height:213px;">
                                            <p class="ellipsis" style="-webkit-line-clamp:9;line-height:1.4">
                                            호텔 주소 : <?=$hotel['HotelAddress']?><br>
                                            호텔 전화번호 : <?=$hotel['HotelTel']?><br>
                                            호텔 객실수 : <?=$hotel['TotalRoomCount']?$hotel['TotalRoomCount']:'정보없음'?><br>
                                            호텔 층수 : <?=$hotel['TotalFloorCount']?$hotel['TotalFloorCount']:'정보없음'?><br>
                                                호텔 시설 : <?=str_replace("|",", ",$hotel['HotelFacilityNames'])?>
                                            </p>
                                        </td>
                                    </tr>
                                </table>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="product-program-detail">
        <ul class="product-menu">
            <li><a href="#product-benefit">상품특전 확인하기</a></li>
            <li><a href="#product-info">리조트 정보</a></li>
            <li class="active"><a href="#product-program-detail">일정표 확인하기</a></li>
            <li><a href="#" data-toggle="open-sybqna">상품 문의하기</a></li>
        </ul>
        <h4 class="detail-title"><img src="/static/images/products/title_product_program_detail.jpg"></h4>

        <?php for($day=1; $day<=count($view['schedule']); $day++) : ?>
            <div class="schedule-title">
                <span class="schedule-title-msg"><?=$day?>일차</span>
                <ol class="day-meal-info">
                </ol>
            </div>
            <table class="table table-schedule-detail">
                <thead>
                <tr>
                    <th class="location">지역</th>
                    <th class="transport">교통편</th>
                    <th class="time">시간</th>
                    <th class="detail">상세정보</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($view['schedule'][$day-1] as $item) :?>
                    <tr>
                        <td class="location"><?=$item['CityName']?></td>
                        <td class="transport"><?=$item['TrafficNo']?></td>
                        <td class="time"><?=$item['TrafficTime']?></td>
                        <td class="detail"><?=$item['TourType']?"<small>[{$item['TourType']}]</small>":''?>&nbsp;<?=$item['Content']?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        <?php endfor;?>
    </div>
</article>

<div id="dialog-sybqna">
    <div id="pop-sybqna">
        <img src="/static/images/products/title_sybqna.png">
        <a class="close" onclick="$('#dialog-sybqna').dialog('close');">&times;</a>
        <form id="form-sybqna" method="post" action="<?=base_url("api/products/sybqna","https")?>">
            <input type="text" class="fake-input">
            <input type="password" class="fake-input">
            <fieldset>
                <div class="form-group">
                    <label class="control-label" for="form-sybqna-usrname">이름</label>
                    <div class="input-box">
                        <input id="form-sybqna-usrname" type="text" name="usr_name" class="form-control input-md" placeholder="작성자 이름을 입력하세요" style="width:290px;" required>
                    </div>
                    <div class="input-box">
                        <div class="radio">
                            <input type="radio" class="form-control" name="usr_gender" id="usr_gender_m" value="M"><label for="usr_gender_m">신랑</label>
                        </div>
                        <div class="radio">
                            <input type="radio" class="form-control" name="usr_gender" id="usr_gender_f" value="F" checked><label for="usr_gender_f">신부</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="form-sybqna-phone">연락처</label>
                    <div class="input-box">
                        <input type="text" class="form-control input-md" data-toggle="phone-check" name="usr_phone" placeholder="" id="form-sybqna-phone" style="width:390px;" required>
                        <p class="help-block">※ 빠른 상담을 위해 핸드폰 번호를 입력해주세요.</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="form-sybqna-email">이메일</label>
                    <div class="input-box">
                        <input type="email" class="form-control input-md" data-toggle="email-check" name="usr_email" placeholder="" id="form-sybqna-email" style="width:390px;" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="form-sybqna-category">문의지사</label>
                    <div class="input-box">
                        <select class="form-control input-md" name="post_category" id="form-sybqna-category" style="width:200px;">
                            <?php foreach($qna_category as $cate) :?>
                                <option value="<?=$cate['bca_key']?>"><?=$cate['bca_key']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="form-sybqna-title">제목</label>
                    <div class="input-box">
                        <input type="text" class="form-control input-md" name="post_title" id="form-sybqna-title" required>
                    </div>
                    <div class="input-box">
                        <div class="checkbox">
                            <input type="checkbox" name="post_secret" id="syb_secret" value="Y" checked><label for="syb_secret">비밀글</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="form-sybqna-usrpass">비밀번호</label>
                    <div class="input-box">
                        <input type="password" class="form-control input-md" name="usr_pass" id="form-sybqna-usrpass" style="width:150px;" required minlength="4">
                    </div>
                </div>
                <div class="form-group">
                    <textarea class="tinymce" rows="20" id="post_content" name="post_content"></textarea>
                </div>

                <div class="policy">
                    <textarea class="form-control" readonly="readonly" rows="3" style="resize:none"><?=$this->site->config('site_privacy');?></textarea>
                    <div class="checkbox pull-right margin-top-10">
                        <input type="checkbox" value="Y" id="agree_privacy"><label for="agree_privacy">위 개인정보 취급방침에 동의합니다.</label>
                    </div>
                    <div class="clearfix"></div>
                </div>

                <div class="text-center margin-top-30">
                    <button type="submit" class="btn btn-primary btn-xlg">작성하기</button>
                    <button type="button" class="btn btn-default btn-xlg" onclick="$('#dialog-sybqna').dialog('close');">닫기</button>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<script>
    $(function() {

        $("table.table.table-schedule-detail").each(function(){
            var $table = $(this);
            $table.find("tbody > tr").each(function(row) {
                $table.rowspan(row);
            });
        });

        $("a[data-toggle='view-gallery']").on('click', function (e) {
            e.preventDefault();
            $.popup({url: $(this).attr('href'), width: 1080, height: 900});
        });
        if ($(".carousel .slides div").length > 0) {
            $('.carousel').carousel({
                hAlign: 'center',
                vAlign: 'center',
                hMargin: 0.8,
                reflection: true,
                shadow: false,
                mouse: false,
                speed: 200,
                autoplay: false,
                slidesPerScroll: 3,
                carouselWidth: 1000,
                carouselHeight: 450,
                frontWidth: 480,
                frontHeight: 360,
                backOpacity: 0.5,
                directionNav: true
            });
        }

        $("#dialog-sybqna").dialog({ autoOpen : false, draggable : false, dialogClass : 'close', resizeable : false, modal: true, width:800});

        $('.flexslider').flexslider({
            animation: "slide",
            slideshow:false,
            slideshowSpeed : 5000,
            prevText:"",
            nextText:"",
            controlNav:false
        });

        tinymce.init({
            selector:'textarea#post_content',
            height : 300,
            width : "99%",
            theme_advanced_resizing: true,
            theme_advanced_resizing_use_cookie : false,
            menubar : false,
            plugins : 'advlist autolink link image imagetools media lists print preview emoticons table textcolor colorpicker code pagebreak jsplus_easy_image',
            language: "ko",
            toolbar1: 'preview code | jsplus_easy_image image media table emoticons | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent blockquote | link pagebreak',
            toolbar2: 'formatselect fontselect fontsizeselect | forecolor backcolor | bold italic underline strikethrough removeformat',
            font_formats : "나눔고딕=Nanum Gothic;돋움=돋움,Dotum;굴림=굴림,Gulim;바탕=바탕,Batang;궁서=궁서;Arial=Arial;Comic Sans MS=Comic Sans MS;Courier New=Courier New;Tahoma=Tahoma;Times New Roman=Times New Roman;Verdana=Verdana",
            fontsize_formats : "10px 11px 12px 14px 16px 18px 20px 24px 28px",
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            }
        });

        $("#form-sybqna").on('submit', function(e){
            e.preventDefault();
            var form = $("#form-sybqna");
            if(! validation_check( $(this).find('input[name="usr_name"]'), '작성자 이름을 입력하세요' )) return false;
            if( ! form.find('#agree_privacy').prop('checked') )
            {
                alert('개인정보 취급방침에 동의하셔야 합니다.');
                form.find('#agree_privacy').focus();
                return false;
            }
            if( form.find('input[name="usr_gender"]:checked').length <= 0 )
            {
                alert("성별을 선택하셔야 합니다.");
                form.find('input[name="usr_gender"]').focus();
                return false;
            }
            if(! validation_check( $(this).find('input[name="usr_phone"]'), '연락처를 입력하세요' )) return false;
            if(! validation_check( $(this).find('input[name="usr_email"]'), '이메일 주소를 입력하세요' )) return false;
            if(! validation_check( $(this).find('input[name="post_title"]'), '제목을 입력하세요' )) return false;
            if(! validation_check( $(this).find('input[name="usr_pass"]'), '비밀번호를 입력하세요' )) return false;
            if(form.find('input[name="usr_pass"]').val().length < 4 )
            {
                alert('비밀번호는 최소 4자리 이상 입력하셔야 합니다.');
                form.find('input[name="usr_pass"]').focus();
                return false;
            }
            if(tinymce.activeEditor.getContent({format:'text'}).trim().length<=0){
                alert('글 내용을 입력하셔야합니다.');
                tinymce.activeEditor.focus();
                return false;
            }
            $.post('/api/products/sybqna', form.serialize(), function(res){
                if(res.status==true){
                    ga_send('문의작성 완료 :: 천생연분닷컴', '/board/sybqna/write_ok');
                    alert('문의 작성이 완료되었습니다.');
                    location.reload();
                }
                else
                {
                    alert('문의 작성도중 오류가 발생하였습니다.\n관리자에게 문의하세요');
                    $("#dialog-sybqna").dialog('close');
                    return false;
                }
            });
        });

        $("a[data-toggle='open-sybqna']").on('click',function(e){
            e.preventDefault();
            $("#form-sybqna")[0].reset();
            $("#dialog-sybqna").dialog('open');
        });

        $("#select-products").on('change.product_change',function(){
            location.href = "/products/<?=$sca_parent?>/" + $("#select-subcategory option:selected").val() + "/" + $("#select-products option:selected").val();
        });

        $('img').on('error', function(e){
            $(this).attr('src', '/static/images/common/no_image_570x380.jpg');
        });
    });
</script>
