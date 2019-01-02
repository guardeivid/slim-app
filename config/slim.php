<?php

$config['slim'] = ['settings' => [
    'responseChunkSize'         => 4096,

    // Debugging
    'displayErrorDetails'       => true,  //false in production

    // HTTP
    'httpVersion'               => '1.1',
    'addContentLengthHeader'    => true,
    'routerCacheFile'           => false, //ROOT_PATH . 'storage/cache/router.php', 
    //
    "determineRouteBeforeAppMiddleware" => true,

    //View
    'viewTemplatesDirectory'    => APP_PATH . 'Views',

    // Logging
    //'log.writer'    => null,
    //'log.level'     => \Slim\Log::DEBUG,
    //'log.enabled'   => true,

]];