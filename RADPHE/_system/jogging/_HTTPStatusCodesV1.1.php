<?php
    $_http_status_codes = array(
        100 => 'HTTP/1.1 100 Continue',
        101 => 'HTTP/1.1 101 Switching Protocols',
        200 => 'HTTP/1.1 200 OK',
        201 => 'HTTP/1.1 201 Created',
        202 => 'HTTP/1.1 202 Accepted',
        203 => 'HTTP/1.1 203 Non-Authoritative Information',
        204 => 'HTTP/1.1 204 No Content',
        205 => 'HTTP/1.1 205 Reset Content',
        206 => 'HTTP/1.1 206 Partial Content',
        300 => 'HTTP/1.1 300 Multiple Choices',
        301 => 'HTTP/1.1 301 Moved Permanently',
        302 => 'HTTP/1.1 302 Found',
        303 => 'HTTP/1.1 303 See Other',
        304 => 'HTTP/1.1 304 Not Modified',
        305 => 'HTTP/1.1 305 Use Proxy',
        307 => 'HTTP/1.1 307 Temporary Redirect',
        400 => 'HTTP/1.1 400 Bad Request',
        401 => 'HTTP/1.1 401 Unauthorized',
        402 => 'HTTP/1.1 402 Payment Required',
        403 => 'HTTP/1.1 403 Forbidden',
        404 => 'HTTP/1.1 404 Not Found',
        405 => 'HTTP/1.1 405 Method Not Allowed',
        406 => 'HTTP/1.1 406 Not Acceptable',
        407 => 'HTTP/1.1 407 Proxy Authentication Required',
        408 => 'HTTP/1.1 408 Request Time-out',
        409 => 'HTTP/1.1 409 Conflict',
        410 => 'HTTP/1.1 410 Gone',
        411 => 'HTTP/1.1 411 Length Required',
        412 => 'HTTP/1.1 412 Precondition Failed',
        413 => 'HTTP/1.1 413 Request Entity Too Large',
        414 => 'HTTP/1.1 414 Request-URI Too Large',
        415 => 'HTTP/1.1 415 Unsupported Media Type',
        416 => 'HTTP/1.1 416 Requested Range Not Satisfiable',
        417 => 'HTTP/1.1 417 Expectation Failed',
        500 => 'HTTP/1.1 500 Internal Server Error',
        501 => 'HTTP/1.1 501 Not Implemented',
        502 => 'HTTP/1.1 502 Bad Gateway',
        503 => 'HTTP/1.1 503 Service Unavailable',
        504 => 'HTTP/1.1 504 Gateway Time-out',
        505 => 'HTTP/1.1 505 HTTP Version Not Supported'
    );


/////////////////////////////////////////////////////////////////////////
// HTTP HEADER STATUS CODES
/*
header('HTTP/1.1 200 OK');
header('HTTP/1.1 404 Not Found');
header('HTTP/1.1 403 Forbidden');
header('HTTP/1.1 301 Moved Permanently');
header('HTTP/1.1 304 Not Modified');
header('HTTP/1.1 500 Internal Server Error');

header('Location: http://www.example.org/');
header('Refresh: 10; url=http://www.example.org/');
print 'You will be redirected in 10 seconds';

// you can also use the HTML syntax:
// <meta http-equiv="refresh" content="10;http://www.example.org/ />

// override X-Powered-By value
header('X-Powered-By: PHP/4.4.0');

// content language (en = English)
header('Content-language: en');

// last modified (Cache Friendly)
$time = time() - 60; // or filemtime($fn), etc
header('Last-Modified: '.gmdate('D, d M Y H:i:s', $time).' GMT');

// set content length (Friendly To Cache):		Also Firendly to downaloads, and mjpeg streams, and just about everything. The bbrowser rather know... gets hary with gzip though.
header('Content-Length: 1234');

// Headers for an download:
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="example.zip"');
header('Content-Transfer-Encoding: binary');
// load the file to send:
readfile('example.zip');

// Disable caching of the current document:
header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Pragma: no-cache');

// set content type:
header('Content-Type: text/html; charset=iso-8859-1');
header('Content-Type: text/html; charset=utf-8');
header('Content-Type: text/plain'); // plain text file
header('Content-Type: image/jpeg'); // JPG picture
header('Content-Type: application/zip'); // ZIP file
header('Content-Type: application/pdf'); // PDF file
header('Content-Type: audio/mpeg'); // Audio MPEG (MP3,...) file
header('Content-Type: application/x-shockwave-flash'); // Flash animation

// show sign in box
header('HTTP/1.1 401 Unauthorized');
header('WWW-Authenticate: Basic realm="Top Secret"');
print 'Text that will be displayed if the user hits cancel or enters wrong login data';
*/