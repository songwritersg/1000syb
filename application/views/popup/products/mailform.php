<?=$this->site->add_js("/static/plugins/tinymce-4.3.13/tinymce.min.js");?>
<?=$this->site->add_js("http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js")?>
<?=$this->site->add_js("/static/js/mailform.min.js")?>
<article id="mailform">
    <div class="product-view-header">
        <h1><?=$product['prd_title']?></h1>
        <h3><?=$program_info['prg_title']?></h3>
    </div>

    <?=form_open()?>
    <input type="hidden" name="prd_idx" value="<?=$prd_idx?>">
    <input type="hidden" name="prg_idx" value="<?=$prg_idx?>">
    <input type="hidden" name="sca_key" value="<?=$sca_key?>">
    <input type="hidden" name="sca_parent" value="<?=$sca_parent?>">

    <div class="mail-form-container">

        <div class="form-group">
            <label class="form-group-label" for="mail_sender">보내는 사람 메일주소</label>
            <div class="input-box">
                <input type="text" class="form-control" name="mail_sender" id="mail_sender" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="mail_receiver">받는 사람 메일주소</label>
            <div class="input-box">
                <input type="text" class="form-control" name="mail_receiver" id="mail_receiver" required>
                <p class="help-block">여러사람일 경우 콤마(,)를 사용하세요</p>
            </div>
        </div>

        <div class="form-group">
            <label class="form-group-label" for="mail_subject">메일 제목</label>
            <div class="input-box">
                <input type="text" class="form-control" name="mail_subject" id="mail_subject" required>
            </div>
        </div>
        
        <div class="form-group">
            <label class="form-group-label" for="userfile">파일 첨부</label>
            <div class="input-box button-box">
                <input type="file" name="userfile" style="display:none;">
                <button type="button" class="btn btn-white" data-toggle="add-attach">파일 추가</button>
                <ul class="attach-list">

                </ul>
            </div>
        </div>

        <img class="wide-banner" src="<?=base_url("/static/images/mailform/title_sales_comment.jpg")?>">
        <div class="editor-form" style="border:1px solid #ddd;">
            <textarea id="sales_comment" name="sales_comment" class="tinymce"></textarea>
        </div>

        <img class="wide-banner margin-top-30" src="<?=base_url("/static/images/mailform/title_schedule.jpg")?>">
        <?php for($day=1; $day<count($program_info['schedule']); $day++) : ?>
        <div class="button-area">
            <button type="button" data-toggle="add-schedule-table">일차 추가</button>
        </div>
        <table class="table table-bordered table-schedules">
            <thead>
            <tr>
                <th style="width:80px;" class="days-info"><a class="editable"><?=$day?>일차</a></th>
                <th style="width:240px;border:0px;text-align:left">
                    <button type="button" data-toggle="remove-schedule-table">해당 일차 삭제</button>
                </th>
                <th style="border:0px" class="days-meal-b">
                    <img style="vertical-align:middle" src="/static/images/mailform/icon_meal_b.png">&nbsp;
                    <a class="editable"><?=$program_info['schedule'][$day-1]['meal']['b']?$program_info['schedule'][$day-1]['meal']['b']:'없음'?></a>
                </th>
                <th style="border:0px" class="days-meal-l">
                    <img style="vertical-align:middle" src="/static/images/mailform/icon_meal_l.png">&nbsp;
                    <a class="editable"><?=$program_info['schedule'][$day-1]['meal']['l']?$program_info['schedule'][$day-1]['meal']['l']:'없음'?></a>
                </th>
                <th style="border:0px" class="days-meal-d">
                    <img style="vertical-align:middle" src="/static/images/mailform/icon_meal_d.png">&nbsp;
                    <a class="editable"><?=$program_info['schedule'][$day-1]['meal']['d']?$program_info['schedule'][$day-1]['meal']['d']:'없음'?></a>
                </th>
            </tr>
            </thead>
            <tbody class="tbody-schedule-detail">
            <?php foreach($program_info['schedule'][$day-1]['items'] as $item) : ?>
                <tr>
                    <td colspan="5">
                        <div class="content"><?=$item['content']?></div>
                        <div class="button-area">
                            <a href="#" data-toggle="prepend-schedule-row">이전행 추가</a>
                            <a href="#" data-toggle="append-schedule-row">다음행 추가</a>
                            <a href="#" data-toggle="remove-schedule-row"><i class="fa fa-trash"></i>&nbsp;삭제</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endfor;?>
        <div class="button-area">
            <button type="button" data-toggle="add-schedule-table">일차 추가</button>
        </div>
    <textarea name="content" class="hide"></textarea>
    <div class="text-center margin-top-30 margin-bottom-50">
        <button type="submit" class="btn btn-primary btn-lg" onclick="get_data();">메일 보내기</button>
    </div>
    <?=form_close()?>

</article>
<script id="tmpl-new-row" type="text/x-jquery-tmpl">
    <tr>
        <td colspan="5">
            <div class="content"></div>
            <div class="button-area">
                <a href="#" data-toggle="prepend-schedule-row">이전행 추가</a>
                <a href="#" data-toggle="append-schedule-row">다음행 추가</a>
                <a href="#" data-toggle="remove-schedule-row"><i class="fa fa-trash"></i>&nbsp;삭제</a>
            </div>
        </td>
    </tr>
</script>
<script id="tmpl-new-table" type="text/x-jquery-tmpl">
     <div class="button-area">
        <button type="button" data-toggle="add-schedule-table">일차 추가</button>
    </div>
    <table class="table table-bordered table-schedules">
    <thead>
        <tr>
            <th style="width:80px;" class="days-info"><a class="editable">일차</a></th>
            <th style="width:240px;border:0px;text-align:left">
                <button type="button" data-toggle="remove-schedule-table">해당 일차 삭제</button>
            </th>
            <th style="border:0px" class="days-meal-b">
                <img style="vertical-align:middle" src="/static/images/mailform/icon_meal_b.png">&nbsp;
                <a class="editable">없음</a>
            </th>
            <th style="border:0px" class="days-meal-l">
                <img style="vertical-align:middle" src="/static/images/mailform/icon_meal_l.png">&nbsp;
                <a class="editable">없음</a>
            </th>
            <th style="border:0px" class="days-meal-d">
                <img style="vertical-align:middle" src="/static/images/mailform/icon_meal_d.png">&nbsp;
                <a class="editable">없음</a>
            </th>
        </tr>
        </thead>
        <tbody class="tbody-schedule-detail">
        <tr>
            <td colspan="5">
                <div class="content"></div>
                <div class="button-area">
                    <a href="#" data-toggle="prepend-schedule-row">이전행 추가</a>
                    <a href="#" data-toggle="append-schedule-row">다음행 추가</a>
                    <a href="#" data-toggle="remove-schedule-row"><i class="fa fa-trash"></i>&nbsp;삭제</a>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</script>