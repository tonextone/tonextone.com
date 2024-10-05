<?
// ini_set('include_path', ini_get('include_path').':/home/master/local/lib/php');

foreach ($_GET as $key => $value)
{
  ${$key} = $value;
  if ($key == 'qu') { $value = rawurlencode($value); } // PHP が勝手に urldecode してしまっているので。
  if ($key != '_DEST') { $_QUERY_STRINGS[] = "${key}=${value}"; }
}
$_QUERY_STRING = join('&',$_QUERY_STRINGS);

include_once('HTTP/Request.php');
$proxy =& new HTTP_Request("${_DEST}?${_QUERY_STRING}");
$proxy->setMethod(HTTP_REQUEST_METHOD_GET);
if (!PEAR::isError($proxy->sendRequest())) { $response = $proxy->getResponseBody(); }
else { $response = ''; }

echo($response);
?>