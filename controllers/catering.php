<?php
    $xtp = new XTemplate('views/catering.html');
    
    $xtp->parse('CATER');
    $acontent = $xtp->text('CATER');