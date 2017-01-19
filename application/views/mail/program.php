<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>천생연분닷컴 상세일정 내용</title>
</head>
<body bgcolor="#f9f9f9" topmargin="0" leftmargin="0" marginheight="0" marginwidth="0" style="font-family:돋움,Dotum,sans-serif;font-size:14px;">
    <table cellspacing="0" cellpadding="0" width="620" bgcolor="#f5f5f5" style="border:1px solid #e9e6e3; border-bottom:0px;margin:auto;border-collapse:collapse">
        <tr>
            <td align="center" valign="middle">
                <img src="<?=base_url("static/images/mailform/title_mail.jpg")?>" alt="천생연분닷컴 상세일정내용" width="618" height="231">
            </td>
        </tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="620" bgcolor="#f5f5f5" style="border-left:1px solid #e9e6e3;border-right:1px solid #e9e6e3;margin:auto;border-collapse:collapse">
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="3" bgcolor="#404040" width="580" height="78" valign="middle" align="center" style="color:#ffffff;font-size:24px;font-weight:bold;border:1px solid #000"><?=preg_replace("/\\[|\\]/","",$prd_title)?></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="3" bgcolor="#33bfb2" width="580" height="58" valign="middle" align="center" style="color:#ffffff;font-size:20px;border:1px solid #217d74;"><?=$prg_title?></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>

        <tr><td colspan="5" bgcolor="#f5f5f5" width="620" height="30">&nbsp;</td></tr>

        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="3" width="580" bgcolor="#33bfb2" height="58" valign="middle" align="center" style="border:1px solid #217d74;">
                <img src="<?=base_url("static/images/mailform/title_sales_comment.jpg")?>" alt="SALES COMMENT">
            </td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20">&nbsp;</td>
            <td bgcolor="#ffffff" width="580" height="20" colspan="3" style="border-left:1px solid #ddd; border-right:1px solid #ddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20">&nbsp;</td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20">&nbsp;</td>
            <td bgcolor="#ffffff" width="20" style="border-left:1px solid #dddddd;">&nbsp;</td>
            <td bgcolor="#ffffff" valign="middle" width="540" align="left" style="color:#767676;font-size:12px;"><?=$sales_comment?></td>
            <td bgcolor="#ffffff" width="20" style="border-right:1px solid #dddddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20">&nbsp;</td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20">&nbsp;</td>
            <td bgcolor="#ffffff" width="580" height="20" colspan="3" style="border:1px solid #ddd; border-top:0px;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20">&nbsp;</td>
        </tr>

        <tr><td colspan="5" bgcolor="#f5f5f5" height="30">&nbsp;</td></tr>

        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="3" width="580" bgcolor="#33bfb2" height="58" valign="middle" align="center" style="border:1px solid #217d74">
                <img src="<?=base_url("static/images/mailform/title_benefit.jpg")?>" alt="상품특전">
            </td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>

        <?php
        if(isset($product['ben_content']) && count($product['ben_content'])) :
        foreach($product['ben_content'] as $ben_content) :?>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#f5f5f5" width="20" style="border:1px solid #ddd; border-right:0px;"></td>
            <td bgcolor="#f5f5f5" width="540" height="58" valign="middle" align="left" style="color:#282828;font-size:18px;font-weight:bold;border-bottom:1px solid #ddd;"><?=$ben_content['title']?></td>
            <td bgcolor="#f5f5f5" width="20" style="border:1px solid #ddd; border-left:0px; "></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
            <?php for($i=0; $i<count($ben_content['content']); $i++) :?>
            <tr>
                <td bgcolor="#f5f5f5" width="20"></td>
                <td colspan="3" bgcolor="#ffffff" width="580" height="20" style="border-left:1px solid #ddd; border-right:1px solid #ddd;"></td>
                <td bgcolor="#f5f5f5" width="20"></td>
            </tr>
            <tr>
                <td bgcolor="#f5f5f5" width="20"></td>
                <td bgcolor="#ffffff" width="20" style="border-left:1px solid #ddd;"></td>
                <td bgcolor="#ffffff" valign="middle" style="color:#767676;font-size:12px;line-height:2;"><?=nl2br($ben_content['content'][$i])?></td>
                <td bgcolor="#ffffff" width="20" style="border-right:1px solid #ddd; "></td>
                <td bgcolor="#f5f5f5" width="20"></td>
            </tr>
            <tr>
                <td bgcolor="#f5f5f5" width="20"></td>
                <td colspan="3" bgcolor="#ffffff" width="580" height="20" style="border:1px solid #ddd; border-top:0px;"></td>
                <td bgcolor="#f5f5f5" width="20"></td>
            </tr>
            <?php endfor;?>
        <?php endforeach;
        endif;
        ?>

        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#f5f5f5" colspan="3" width="580" height="58" valign="middle" align="center" style="border:1px solid #dddddd">
                <img width="580" height="58" src="<?=base_url("static/images/mailform/title_include.jpg")?>" alt="포함사항">
            </td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="580" colspan="3" style="border-left:1px solid #ddd; border-right:1px solid #ddd">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="20" style="border-left:1px solid #ddd;"></td>
            <td bgcolor="#ffffff" width="540" valign="middle" style="color:#767676;font-size:12px;line-height:2;"><?=$product['ben_include']?></td>
            <td bgcolor="#ffffff" width="20" style="border-right:1px solid #ddd;"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="580" colspan="3" height="20" style="border-left:1px solid #ddd; border-right:1px solid #ddd">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>

        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#f5f5f5" colspan="3" width="580" valign="middle" align="center" style="border:1px solid #dddddd">
                <img width="580" height="58" src="<?=base_url("static/images/mailform/title_exclude.jpg")?>" alt="불포함사항">
            </td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="580" colspan="3" height="20" style="border-left:1px solid #ddd; border-right:1px solid #ddd">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="20" style="border-left:1px solid #ddd;"></td>
            <td bgcolor="#ffffff" width="540" valign="middle" style="color:#767676;font-size:12px;line-height:2;"><?=$product['ben_exclude']?></td>
            <td bgcolor="#ffffff" width="20" style="border-right:1px solid #ddd;"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="580" colspan="3" height="20" style="border:1px solid #ddd; border-top:0px">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr><td colspan="5" bgcolor="#f5f5f5" height="30">&nbsp;</td></tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="620" bgcolor="#f5f5f5" style="border-left:1px solid #e9e6e3;border-right:1px solid #e9e6e3;margin:auto;border-collapse:collapse">
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#33bfb2" height="58" style="border:1px solid #217d74;"><img src="<?=base_url("static/images/mailform/title_resort_info.jpg")?>" alt="리조트 정보"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td rowspan="2" bgcolor="#f5f5f5" width="20"></td>
            <td rowspan="2" bgcolor="#ffffff" width="20" style="border-left:1px solid #ddd"></td>
            <td colspan="3" bgcolor="#ffffff" align="left" valign="top" height="87" width="390">
                <img src="<?=base_url("static/images/mailform/subtitle_about_resort.jpg")?>" alt="리조트 정보" style="display:block">
            </td>
            <td rowspan="2" bgcolor="#ffffff" align="center" valign="top" width="150">
                <img src="<?=base_url("static/images/mailform/bg_about_resort.jpg")?>" alt="리조트 이미지" style="display:block">
            </td>
            <td rowspan="2" bgcolor="#ffffff" width="20" style="border-right:1px solid #ddd;"></td>
            <td rowspan="2" bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td colspan="3" width="390" bgcolor="#ffffff" align="left" valign="top" style="color:#767676;"><?=nl2br(element('prd_info_desc',$product,"상품 설명이 없습니다."))?></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="20" style="border-left:1px solid #ddd"></td>
            <td colspan="4" height="30" bgcolor="#ffffff" width="540" style="border-top:1px solid #dddddd">&nbsp;</td>
            <td bgcolor="#ffffff" width="20" style="border-right:1px solid #ddd;"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="20" style="border-left:1px solid #ddd"></td>
            <td colspan="4" width="540" height="230" bgcolor="#ffffff" style="border-top:1px solid #dddddd">
                <img width="540" height="230" style="display:block" src="<?=file_check($product['prd_info_img_a_1'])?base_url($product['prd_info_img_a_1']):'/static/images/common/no_image_938x400.jpg'?>">
            </td>
            <td bgcolor="#ffffff" width="20" style="border-right:1px solid #ddd;"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#ffffff" height="20" width="580" style="border-left:1px solid #ddd;border-right:1px solid #ddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="20" style="border-left:1px solid #ddd"></td>
            <td width="260" height="170" bgcolor="#ffffff">
                <img width="260" height="170" style="display:block" src="<?=file_check($product['prd_info_img_a_2'])?base_url($product['prd_info_img_a_2']):'/static/images/common/no_image_306x200.jpg'?>">
            </td>
            <td width="20" height="170" bgcolor="#ffffff">&nbsp;</td>
            <td colspan="2" width="260" height="170" bgcolor="#ffffff">
                <img width="260" height="170"  src="<?=file_check($product['prd_info_img_a_3'])?base_url($product['prd_info_img_a_3']):'/static/images/common/no_image_306x200.jpg'?>">
            </td>
            <td bgcolor="#ffffff" width="20" style="border-right:1px solid #ddd;"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#ffffff" height="20" width="580" style="border-left:1px solid #ddd;border-right:1px solid #ddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#f5f5f5" style="border-left:1px solid #ddd;border-right:1px solid #ddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#f5f5f5" width="20" style="border-left:1px solid #ddd"></td>
            <td colspan="4" bgcolor="#f5f5f5" height="20" width="540" style="color:#767676;font-size:12px;"><?=nl2br(element('prd_info_img_a_desc',$product,"이미지 그룹 설명이 없습니다."))?></td>
            <td bgcolor="#f5f5f5" width="20" style="border-right:1px solid #ddd;"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>

        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#f5f5f5" style="border-left:1px solid #ddd;border-right:1px solid #ddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>

        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#ffffff" height="20" width="580" style="border-left:1px solid #ddd;border-right:1px solid #ddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="20" style="border-left:1px solid #ddd"></td>
            <td bgcolor="#ffffff" height="20" style="color:#767676;" width="260" height="324">
                <img width="260" height="324" style="display:block" src="<?=file_check($product['prd_info_img_b_1'])?base_url($product['prd_info_img_b_1']):'/static/images/common/no_image_464x575.jpg'?>" />
            </td>
            <td bgcolor="#ffffff" width="20">&nbsp;</td>
            <td colspan="2" bgcolor="#ffffff"  width="260" height="324">
                <img width="260" height="324" src="<?=file_check($product['prd_info_img_b_2'])?base_url($product['prd_info_img_b_2']):'/static/images/common/no_image_464x575.jpg'?>" />
            </td>
            <td bgcolor="#ffffff" width="20" style="border-right:1px solid #ddd;"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#ffffff" height="20" width="580" style="border-left:1px solid #ddd;border-right:1px solid #ddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#f5f5f5" style="border-left:1px solid #ddd;border-right:1px solid #ddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#f5f5f5" width="20" style="border-left:1px solid #ddd"></td>
            <td colspan="4" bgcolor="#f5f5f5" height="20" width="540" style="color:#767676;font-size:12px;"><?=nl2br(element('prd_info_img_b_desc',$product,"이미지 그룹 설명이 없습니다."))?></td>
            <td bgcolor="#f5f5f5" width="20" style="border-right:1px solid #ddd;"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#f5f5f5" style="border-left:1px solid #ddd;border-right:1px solid #ddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>

        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#ffffff" height="20" width="580" style="border-left:1px solid #ddd; border-right:1px solid #ddd;">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#ffffff" width="20" style="border-left:1px solid #ddd;"></td>
            <td colspan="4" bgcolor="#ffffff" height="20" width="540" style="color:#767676;font-size:12px;"><?=nl2br($product['prd_info_extra'])?></td>
            <td bgcolor="#ffffff" width="20" style="border-right:1px solid #ddd;"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="6" bgcolor="#ffffff" height="20" width="580" style="border:1px solid #ddd; border-top:0px">&nbsp;</td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <tr>
            <td colspan="8" bgcolor="#f5f5f5" width="20" height="30">&nbsp;</td>
        </tr>
    </table>

    <table cellspacing="0" cellpadding="0" width="620" bgcolor="#f5f5f5" style="border-left:1px solid #e9e6e3;border-right:1px solid #e9e6e3;margin:auto;border-collapse:collapse">
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td colspan="4" bgcolor="#33bfb2" height="58" style="border:1px solid #217d74;"><img src="<?=base_url("static/images/mailform/title_schedule.jpg")?>" alt="일정표 확인하기"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
        <?php foreach($schedule_info as $schedule) :?>
        <tr>
            <td bgcolor="#f5f5f5" width="20"></td>
            <td bgcolor="#f5f5f5" height="60" width="20" style="border-left:1px solid #ddd;border-bottom:1px solid #ddd; font-weight:bold;"></td>
            <td bgcolor="#f5f5f5" align="left" valign="middle" height="60" width="60" style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;font-weight:bold;"><?=$schedule['day']?></td>
            <td bgcolor="#f5f5f5" align="right" valign="middle" style="color:#767676;font-size:12px;border-bottom:1px solid #ddd;">
                <?php if(!empty($schedule['meal']['b'])) : ?>
                <img width="18" height="18" style="vertical-align:middle;display:inline-block;margin-left:10px;" src="<?=base_url("/static/images/mailform/icon_meal_b.png")?>">&nbsp;<?=$schedule['meal']['b']?>
                <?php endif;?>
                <?php if(!empty($schedule['meal']['l'])) : ?>
                <img width="18" height="18" style="vertical-align:middle;display:inline-block;margin-left:10px;" src="<?=base_url("/static/images/mailform/icon_meal_l.png")?>">&nbsp;<?=$schedule['meal']['l']?>
                <?php endif;?>
                <?php if(!empty($schedule['meal']['d'])) : ?>
                <img width="18" height="18" style="vertical-align:middle;display:inline-block;margin-left:10px;" src="<?=base_url("/static/images/mailform/icon_meal_d.png")?>">&nbsp;<?=$schedule['meal']['d']?>
                <?php endif;?>
            </td>
            <td bgcolor="#f5f5f5" height="60" width="20" style="border-right:1px solid #ddd;border-bottom:1px solid #ddd;"></td>
            <td bgcolor="#f5f5f5" width="20"></td>
        </tr>
            <?php foreach($schedule['content'] as $item) : ?>
            <tr>
                <td bgcolor="#f5f5f5" width="20"></td>
                <td bgcolor="#ffffff" width="20" style="border-left:1px solid #ddd;border-bottom:1px solid #ddd; font-weight:bold;"></td>
                <td bgcolor="#ffffff" colspan="2" style="border-bottom:1px solid #ddd;font-size:12px;"><?=$item?></td>
                <td bgcolor="#ffffff" width="20" style="border-right:1px solid #ddd;border-bottom:1px solid #ddd; font-weight:bold;"></td>
                <td bgcolor="#f5f5f5" width="20"></td>
            </tr>
            <?php endforeach;?>
        <?php endforeach;?>
        <tr>
            <td colspan="6" bgcolor="#f5f5f5" height="40" align="center" valign="middle" style="font-size:12px;color:#767676;">※ 상기 일정은 항공사정 및 현지사정으로 인하여 약간의 변경이 있을 수 있습니다.</td>
        </tr>
        <tr>
            <td colspan="6" bgcolor="#f5f5f5" height="100" align="center" valign="middle">
                <a href="http://www.1000syb.com" target="_blank" style="display:inline-block;cursor:pointer;padding:0;margin:0;width:235px;height:50px;"><img src="<?=base_url("static/images/mailform/btn_go_syb.png")?>" alt="천생연분닷컴 홈페이지 바로가기"></a>
            </td>
        </tr>
    </table>
</body>
</html>