<?php 


$StartDate = new \DateTime($data[0]['start_date_event']);
$EndDate = new \DateTime($data[0]['end_date_event']);

$displayStartDate = $StartDate->format('d/m/Y');
$displayEndDate = $EndDate->format('d/m/Y');


include_once $header ;
require_once 'event/event.phtml' ;
include_once $footer ;