<?php
    $xtp = new XTemplate('views/recipe.html');
    
    $xtp->parse('RECIPE');
    $acontent = $xtp->text('RECIPE');