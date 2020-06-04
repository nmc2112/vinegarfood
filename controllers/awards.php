<?php
    $xtp = new XTemplate('views/awards.html');
    
    $xtp->parse('AWARD');
    $acontent = $xtp->text('AWARD');