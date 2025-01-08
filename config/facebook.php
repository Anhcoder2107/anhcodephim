<?php

$fb = new \Facebook\Facebook([
  'app_id' => '843414914383400',
  'app_secret' => '79869624cd103cb75756ffe66269f3cb',
  'default_graph_version' => 'v2.10',
]);

$helper = $fb->getRedirectLoginHelper();
