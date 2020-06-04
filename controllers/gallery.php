<?php
    $xtp = new XTemplate('views/gallery.html');
    
    $xtp->parse('GALLERY');
    $acontent = $xtp->text('GALLERY');