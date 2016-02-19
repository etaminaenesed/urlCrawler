
<?php
if($url[1] === 'api' && $url[2] === 'v2' && $url[3] && $url[4] && is_numeric($url[5]) && REQ === 'GET') { ApiController::getDisplayUrl($arr); }