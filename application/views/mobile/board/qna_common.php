<ul class="tab" style="background:#fff;">
    <li <?=$this->uri->segment(2)=='sybqna'?' class="active"':''?> style="width:33.33333%"><a href="<?=base_url("board/sybqna")?>">Q&amp;A</a></li>
    <li <?=$this->uri->segment(2)=='call'?' class="active"':''?> style="width:33.33333%"><a href="<?=base_url("counseling/call")?>">전화상담</a></li>
    <li <?=$this->uri->segment(2)=='visit'?' class="active"':''?> style="width:33.33333%"><a href="<?=base_url("counseling/visit")?>">평일방문</a></li>
</ul>