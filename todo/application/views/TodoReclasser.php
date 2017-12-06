<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo form_open(base_url('Todo/reordonner/'));

foreach($mesTodos as $todo):
    echo form_label('ordre');
    echo form_input('ordre',set_value('ordre',$todo['ordre']));
    echo $todo['task'];
    echo "</br>";
endforeach;
    echo form_submit('Reordonner','Réordonner les tâches');
    echo form_close();
