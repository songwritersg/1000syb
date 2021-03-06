<?php $this->load->view("desktop/board/qna_common");?>
<article class="container" id="counseling">
    <?=form_open(base_url("counseling/visit","https"), array("id"=>"form-counseling-visit", "class"=>"write-form-container"))?>
    <input type="hidden" name="cns_const_name" value="방문상담신청">
    <input type="hidden" name="cns_status" value="방문">
    <fieldset>
        <table class="form-table">
            <colgroup>
                <col width="170" />
                <col width="*">
                <col width="443">
            </colgroup>
            <tr>
                <th><label>고객명</label></th>
                <td>
                    <input type="text" class="form-control input-md" name="cns_name" required>
                </td>
                <td>
                    <div class="radio">
                        <input type="radio" name="cns_gender" id="cns_gender_bride" value="bride" checked><label for="cns_gender_bride" >신부</label>
                    </div>
                    <div class="radio">
                        <input type="radio" name="cns_gender" id="cns_gender_groom" value="groom"><label for="cns_gender_groom">신랑</label>
                    </div>
                </td>
            </tr>
            <tr>
                <th><label>연락처</label></th>
                <td>
                    <input type="text" class="form-control input-md" data-toggle="phone-check" name="cns_phone" required>
                </td>
                <td><p class="help-block">※빠른 상담을 위해 핸드폰 번호를 입력해주세요</p></td>
            </tr>
            <tr>
                <th><label class="form-group-label">E-mail</label></th>
                <td>
                    <input type="email" class="form-control input-md" data-toggle="email-check" name="cns_email" required>
                </td>
                <td/>
            </tr>
            <tr>
                <th><label>상담신청일</label></th>
                <td>
                    <input type="text" class="form-control input-md" id="visit_date" name="visit_date" readonly required>
                </td>
                <td/>
            </tr>
            <tr>
                <th><label>상담내용</label></th>
                <td colspan="2">
                    <textarea name="cns_memo" rows="20" class="form-control" style="resize:none"></textarea>
                </td>
            </tr>
        </table>

        <div class="margin-top-30">
            <textarea class="form-control" readonly rows="4"><?=$this->site->config('site_privacy')?></textarea>
            <div class="text-center margin-top-10">
                <div class="checkbox">
                    <input type="checkbox" value="Y" id="agree_privacy"><label for="agree_privacy">위 개인정보 취급방침에 동의합니다.</label>
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
    $("#visit_date").datepicker({
        beforeShowDay: $.datepicker.noWeekends,
        minDate : 0
    });

    $("#form-counseling-visit").submit(function(e){
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

        if( $("input[name='visit_date']").val().trim().length <= 0) {
            alert('방문상담 신청일을 선택하셔야 합니다.');
            e.preventDefault();
            $("input[name='visit_date']").focus();
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


        ga_send("전화상담 신청 완료", "/counseling/visit_done");
        return true;
    });
});
</script>