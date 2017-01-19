<style>
    @media print {
        .btn {display:none;}
    }
</style>
<div id="product-view" class="container" style="width:1000px;">
    <div class="product-view-header" style="padding:24px 35px;">
        <h1><?=$product['prd_title']?></h1>
        <h3><?=$program_info['prg_title']?></h3>

        <div class="navigation">
            <button type="button" class="btn btn-primary" onclick="window.print();"><i class="fa fa-print"></i>&nbsp;인쇄하기</button>
        </div>
    </div>
    <div id="product-program-detail" style="padding:0px;">

        <?php for($day=1; $day<=count($program_info['schedule']); $day++) : ?>
            <div class="schedule-title">
                <span class="schedule-title-msg"><?=$day?>일차</span>
                <ol class="day-meal-info">
                    <?=$program_info['schedule'][$day-1]['meal']['b'] ? "<li><label>B</label>{$program_info['schedule'][$day-1]['meal']['b']}</li>":""?>
                    <?=$program_info['schedule'][$day-1]['meal']['l'] ? "<li><label>L</label>{$program_info['schedule'][$day-1]['meal']['l']}</li>":""?>
                    <?=$program_info['schedule'][$day-1]['meal']['d'] ? "<li><label>D</label>{$program_info['schedule'][$day-1]['meal']['d']}</li>":""?>
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
                <?php foreach($program_info['schedule'][$day-1]['items'] as $item) :
                    ?>
                    <tr>
                        <td class="location"><?=$item['location']?></td>
                        <td class="transport"><?=$item['transport']?></td>
                        <td class="time"><?=$item['time']?></td>
                        <td class="detail"><?=$item['content']?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endfor;?>
    </div>
</div>
<script>
    $(function(){

        $("table.table.table-schedule-detail").each(function(){
            var $table = $(this);
            $table.find("tbody > tr").each(function(row) {
                $table.rowspan(row);
            });
        });
    });
</script>