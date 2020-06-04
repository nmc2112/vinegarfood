<?php
    $xtp = new XTemplate('views/feedback.html');
    
    $xtp->parse('FEEDBACK');
    $acontent = $xtp->text('FEEDBACK');