<?php
if($additionFields){
    echo '<dl class="ap-descr">';
    HFormEditor::renderViewRows($additionFields, $data);
    echo '</dl>';
}

