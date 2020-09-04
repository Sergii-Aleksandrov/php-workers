<?php
function render($templateName, $title, $body) {
    $template = file_get_contents($templateName);
    echo str_replace(['{{__BODY__}}', '{{__TITLE__}}'], [$body, $title], $template);
}