<?php
if ($data->canShowInView('ci_square')) {
    echo '<dt>Площадь кухни:</dt><dd>' . $data->ci_square . ' ' . tc('site_square') . '</dd>';
}
?>