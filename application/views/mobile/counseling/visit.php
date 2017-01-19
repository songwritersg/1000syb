<h2 class="page-title">Customer Service<small>평일방문신청</small></h2>

<?php $this->load->view('mobile/board/qna_common');?>


<article class="container margin-top-20" id="counseling">
    <?=form_open('https://www.1000syb.com/counseling/visit', array("id"=>"form-counseling-call", "class"=>"form-horizontal"))?>
    <input type="hidden" name="cns_const_name" value="방문상담신청">
    <input type="hidden" name="cns_status" value="방문">
    <input type="hidden" name="cns_call_t2" value="">

    <fieldset>
        <div class="form-group form-group-padding margin-bottom-0">
            <div class="col-xs-8">
                <div class="row margin-bottom-m0">
                    <input placeholder="작성자" type="text" class="form-control input-flat input-big input-no-border" name="cns_name" required style="border-right:0px;">
                </div>
            </div>
            <div class="col-xs-4">
                <div class="row margin-bottom-m0">
                    <select class="form-control input-flat input-big input-no-border" name="cns_gender">
                        <option value="bride">신부</option>
                        <option value="groom">신랑</option>
                    </select>
                    <i class="icon-caret-down" style="right:15px;"></i>
                </div>
            </div>
        </div>

        <div class="form-group form-group-padding margin-bottom-m0">
            <input type="tel" placeholder="연락처" class="form-control input-flat input-big input-no-border" data-toggle="phone-check" name="cns_phone" required>
            <i class="icon-iphone"></i>
        </div>

        <div class="form-group form-group-padding margin-bottom-m0">
            <input type="email" placeholder="이메일" class="form-control input-flat input-big input-no-border" data-toggle="email-check" name="cns_email" required>
            <i class="icon-envelope"></i>
        </div>

        <div class="form-group form-group-padding margin-bottom-m0">
            <input type="text" placeholder="상담신청일"  data-toggle="datepicker" class="form-control input-flat input-big input-no-border" id="visit_date" name="visit_date" min="<?=date('Y-m-d')?>">
            <i class="icon-calendar"></i>
        </div>

        <div class="form-group form-group-padding margin-bottom-m0">
            <textarea placeholder="상담신청 내용" name="cns_memo" rows="10" class="form-control input-flat input-big input-no-border" style="resize:none"></textarea>
        </div>

        <div class="panel panel-default margin-top-20">
            <div class="panel-heading">
                <h4><label for="agree_privacy" style="display:block;">개인정보 취급방침 동의<small class="text-primary">(필수)</small></label></h4>
                <div class="checks">
                    <input type="checkbox" value="Y" id="agree_privacy"><label for="agree_privacy"></label>
                </div>
            </div>
            <div class="panel-body no-padding">
                <textarea class="form-control input-flat" style="font-size:12px; letter-spacing:-0.05em; border:0px;" readonly rows="4"><?=$this->site->config('site_privacy')?></textarea>
            </div>
        </div>
        <div class="text-center margin-top-30">
            <div class="col-xs-6">
                <div class="row margin-bottom-m0">
                    <button type="button" class="btn btn-default btn-lg btn-block btn-flat" onclick="history.back(-1);">취소</button>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="row margin-bottom-m0">
                    <button type="submit" class="btn btn-primary btn-lg btn-block btn-flat">작성하기</button>
                </div>
            </div>
        </div>
    </fieldset>

    <?=form_close()?>
</article>
<script>
    $(function(){
        $("[data-toggle='datepicker']").datepicker();

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


            if(! $("#agree_privacy").prop('checked') )
            {
                alert('개인정보 취급방침에 동의하셔야 합니다.');
                e.preventDefault();
                $("#agree_privacy").focus();
                return false;
            }

            ga_send("전화상담 신청 완료", "/counseling/call_done");
            return true;
        });
    });
</script>

