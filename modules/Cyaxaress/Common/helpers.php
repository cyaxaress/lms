<?php
function newFeedback($title, $body, $type){
    $session = session()->has('feedbacks') ? session()->get('feedbacks') : [];
    $session[] = ['title' => $title, "body"=>  $body, "type" => $type];
    session()->flash('feedbacks', $session);
}
