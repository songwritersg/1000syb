<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html lang="ko">
<head>
<title><?=$mail_subject?></title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
</head>
<body style="padding:0;margin:0;font-size:12px;">
<table border="0" cellspacing="0" cellpadding="0" width="620" style="margin:auto;">
    <tr>
        <td style="background:url(<?=base_url("static/images/common/logo.png")?>) right center no-repeat;">
            <h1 style="font-size:26px;font-weight:bold;margin:0;padding:0;margin-top:20px;margin-bottom:5px;"><?=preg_replace("/\\[|\\]/","",$product['prd_title'])?></h1>
            <h3 style="font-size:18px;font-weight:normal;margin:0;padding:0;margin-bottom:20px;color:#767676;"><?=$program_info['prg_title']?></h3>
        </td>
    </tr>
    <tr>
        <td valign="middle"><img align="center" alt="SALES COMMENT" src="<?=base_url("static/images/mailform/title_sales_comment.jpg")?>" style="display:block;border:0;" /></td>
    </tr>
    <tr>
        <td valign="middle" align="center" style="padding:10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="598" style="margin:auto">
                <tr>
                    <td style="padding:10px;border:1px solid #ddd;background:#f9f9f9;"><?=$sales_comment?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="middle">
            <img alt="포함사항" align="center" src="<?=base_url("static/images/mailform/title_benefit.jpg")?>" style="display:block;border:0;" />
        </td>
    </tr>
    <tr>
        <td valign="middle" align="center" style="padding:10px;" width="620">
            <?php if( isset($product['ben_content']) && is_array($product['ben_content']) ) :?>
            <?php foreach($product['ben_content'] as $ben_content) :?>
                <table border="0" cellpadding="0" cellspacing="0" style="margin-top:10px" width="600">
                    <tr>
                        <td bgcolor="#f9f9f9" style="font-size:20px;padding:20px;border:1px solid #ddd;border-bottom:0px;"><b><?=$ben_content['title']?></b></td>
                    </tr>
                    <?php for($i=0; $i<count($ben_content['content']); $i++) :?>
                    <tr>
                        <td style="padding:10px; border:1px solid #ddd;"><?=nl2br($ben_content['content'][$i])?></td>
                    </tr>
                    <?php endfor?>
                </table>
            <?php endforeach;?>
            <?php endif;?>

            <table border="0" cellpadding="0" cellspacing="0" style="margin-top:10px" width="601">
                <tr>
                    <td bgcolor="#f2f1f1" align="center" valign="middle" style="border:1px solid #ddd;" width="579">
                        <img alt="포함사항" align="center" src="<?=base_url("static/images/mailform/title_include.jpg")?>" style="display:block;border:0;" />
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="border:1px solid #ddd; padding:20px;" width="579"><?=$product['ben_include']?></td>
                </tr>
            </table>

            <table border="0" cellpadding="0" cellspacing="0" width="601" style="margin-top:10px;">
                <tr>
                    <td align="center" valign="middle" style="border:1px solid #ddd" bgcolor="#f2f1f1">
                        <img alt="불포함사항" width="579" height="58" align="center" src="<?=base_url("static/images/mailform/title_exclude.jpg")?>" style="display:block;border:0;" />
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="middle" style="border:1px solid #ddd; padding:20px;"><?=$product['ben_exclude']?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="middle">
            <img alt="포함사항" align="center" src="<?=base_url("static/images/mailform/title_resort.jpg")?>" style="display:block;border:0;" />
        </td>
    </tr>
    <tr>
        <td valign="middle" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="620" style="margin-top:10px;border:1px solid #ddd; padding:20px;">
                <tr>
                    <td colspan="3" >
                        <h2 align="left" style="font-size:40px;margin:0px;"><?=element('prd_info_title',$product,"상품 제목이 없습니다.")?></h2>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <p align="left" style="color:#7d7d7d;font-size:14px;"><?=nl2br(element('prd_info_desc',$product,"상품 설명이 없습니다."))?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="font-size:16px"><?=element('prd_info_img_a_title',$product,"이미지 그룹 이름이 없습니다.")?></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <img width="580" height="247" src="<?=file_check($product['prd_info_img_a_1'])?base_url($product['prd_info_img_a_1']):'/static/images/common/no_image_938x400.jpg'?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <img width="285" height="185" src="<?=file_check($product['prd_info_img_a_2'])?base_url($product['prd_info_img_a_2']):'/static/images/common/no_image_306x200.jpg'?>">
                    </td>
                    <td width="10">&nbsp;</td>
                    <td>
                        <img width="285" height="185" src="<?=file_check($product['prd_info_img_a_3'])?base_url($product['prd_info_img_a_3']):'/static/images/common/no_image_306x200.jpg'?>">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="10">&nbsp;</td>
    </tr>
    <tr>
        <td valign="middle" align="center" bgcolor="#f9f9f9" style="padding:20px;color:#7d7d7d;" ><?=nl2br(element('prd_info_img_a_desc',$product,"이미지 그룹 설명이 없습니다."))?></td>
    </tr>
    <tr>
        <td height="30">&nbsp;</td>
    </tr>
    <tr>
        <td valig="middle" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="620" style="margin-top:10px;border:1px solid #ddd; padding:20px;">
                <tr>
                    <td colspan="3" style="font-size:16px"><?=element('prd_info_img_b_title',$product,"이미지 그룹 이름이 없습니다.")?></td>
                </tr>
                <tr>
                    <td><img width="285" height="354" src="<?=file_check($product['prd_info_img_b_1'])?base_url($product['prd_info_img_b_1']):'/static/images/common/no_image_464x575.jpg'?>" /></td>
                    <td width="10">&nbsp;</td>
                    <td><img width="285" height="354" src="<?=file_check($product['prd_info_img_b_2'])?base_url($product['prd_info_img_b_2']):'/static/images/common/no_image_464x575.jpg'?>" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td height="10">&nbsp;</td>
    </tr>
    <tr>
        <td valign="middle" align="center" bgcolor="#f9f9f9" style="padding:20px;color:#7d7d7d;" ><?=nl2br(element('prd_info_img_b_desc',$product,"이미지 그룹 설명이 없습니다."))?></td>
    </tr>
    <tr>
        <td height="30">&nbsp;</td>
    </tr>
    <tr>
        <td> <p class="info-extra"><?=nl2br($product['prd_info_extra'])?></p></td>
    </tr>
</table>

</body>
</html>
