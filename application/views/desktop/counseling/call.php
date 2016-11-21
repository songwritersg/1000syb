<?php $this->load->view("desktop/board/qna_common");?>
<article class="container" id="counseling">
    <?=form_open(NULL, array("id"=>"form-counseling-call", "class"=>"write-form-container"))?>
    <input type="hidden" name="cns_const_name" value="전화상담신청">
    <input type="hidden" name="cns_status" value="전화">
    <fieldset>
        <div class="form-group">
            <label class="form-group-label">고객명</label>
            <div class="input-box">
                <input type="text" class="form-control input-md" name="cns_name" required>
            </div>
            <div class="desc-box">
                <div class="radio">
                    <input type="radio" name="cns_gender" id="cns_gender_bride" value="bride" checked><label for="cns_gender_bride" >신부</label>
                </div>
                <div class="radio">
                    <input type="radio" name="cns_gender" id="cns_gender_groom" value="groom"><label for="cns_gender_groom">신랑</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">연락처</label>
            <div class="input-box">
                <input type="text" class="form-control input-md" data-toggle="phone-check" name="cns_phone" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">E-mal</label>
            <div class="input-box">
                <input type="email" class="form-control input-md" data-toggle="email-check" name="cns_email" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">상담신청일</label>
            <div class="input-box">
                <input type="text" class="form-control input-md" id="visit_date" name="visit_date" readonly>
            </div>
            <div class="desc-box">
                <input type="text" class="form-control input-md" name="cns_call_t2" placeholder="EX) 10시 20분" maxlength="20">
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">여행기간</label>
            <div class="input-box" style="padding-top:0px; padding-bottom:0px">
                <input type="text" class="form-control input-md datepicker" name="travel_start" readonly style="width:150px; display:inline-block">
                <input type="text" class="form-control input-md datepicker" name="travel_end" readonly style="width:150px; display:inline-block">
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label">희망지역</label>
            <div class="input-box">
                <input type="text" class="form-control input-md"  name="travel_expect">
            </div>
        </div>

        <div class="form-group">
            <textarea class="form-control" readonly rows="4"><?=$this->site->config('site_privacy')?></textarea>
            <div class="text-center margin-top-10">
                <div class="checkbox">
                    <input type="checkbox" value="Y" id="agree_privacy" checked><label for="agree_privacy">위 개인정보 취급방침에 동의합니다.</label>
                </div>
            </div>
        </div>


        <div class="text-center margin-top-30">
            <button type="submit" class="btn btn-primary btn-lg" style="padding:12px 40px;">작성하기</button>
        </div>
    </fieldset>

    <?=form_close()?>
</article>
<script>
    $(function(){
        $("#visit_date").datepicker({beforeShowDay: $.datepicker.noWeekends});
        
        $(".datepicker").datepicker();

        $("#form-counseling-call").submit(function(e){
            if( $("input[name='cns_name']").val().trim().length <= 0) {
                alert('신청자 성함을 입력하셔야 합니다.');
                e.preventDefault();
                $("input[name='cns_name']").focus();
                return false;
            }

            if( $("input[name='cns_phone']").val().trim().length <= 0) {
                alert('신청자 연락처를 입력하셔야 합니다.');
                e.preventDefault();
                $("input[name='cns_phone']").focus();
                return false;
            }

            if( $("input[name='cns_email']").val().trim().length <= 0) {
                alert('신청자 이메일을 입력하셔야 합니다.');
                e.preventDefault();
                $("input[name='cns_email']").focus();
                return false;
            }

            if( $("textarea[name='cns_memo']").val().trim().length <= 0) {
                alert('상담 내용을 입력하셔야 합니다.');
                e.preventDefault();
                $("input[name='cns_memo']").focus();
                return false;
            }

            if(! $("#agree_privacy").prop('checked') )
            {
                alert('개인정보 취급방침에 동의하셔야 합니다.');
                e.preventDefault();
                $("#agree_privacy").focus();
                return false;
            }
        });
    });
</script>