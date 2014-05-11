<?php

require_once('hai.thar.php');

$key = 'UmrLWeWMX0z4mdWiluA4JqDF';

// Create an instance of our api object for client api calls.
$client = new HaiThar($key, 'client');


// Getting a list of your services
$services = $client->listServices();
/*
var_dump($services);

Output:
array(1) {
  [0]=>
  array(8) {
    ["id"]=>
    string(2) "79"
    ["type"]=>
    string(6) "mumble"
    ["description"]=>
    string(34) "15 user mumble server paid monthly"
    ["status"]=>
    string(6) "active"
    ["amount"]=>
    string(4) "2.40"
    ["userAmount"]=>
    string(4) "2.40"
    ["userCurrency"]=>
    string(3) "USD"
    ["created"]=>
    string(10) "1398907046"
  }
}
*/


// Create an instance of our api object for mumble api calls.
$mumble = new HaiThar($key, 'mumble');


// Set the mumble service id
$mumble->setServiceId($services[0]['id']);


// Test if the server is running
$isRunning = $mumble->isRunning();
/*
var_dump($isRunning);

Output:
bool(true)

If the server is running

bool(false)

If it is not
*/


// Start the server
$start = $mumble->start();
/*
var_dump($start);

Output:
bool(true)

On success
*/


// Stop the server
// $stop = $mumble->stop();
/*
var_dump($stop);

Output:
bool(true)

On success
*/


// Getting the current configuration of your server
$config = $mumble->getConfig();
/*
var_dump($config);

Output:
array(18) {
  ["allowHtml"]=>
  bool(false)
  ["bandwidth"]=>
  int(128000)
  ["certRequired"]=>
  bool(true)
  ["channelName"]=>
  string(27) "[ \-=\w\#\[\]\{\}\(\)\@\|]+"
  ["channelNestingLimit"]=>
  int(10)
  ["defaultChannel"]=>
  int(0)
  ["host"]=>
  string(11) "5.39.78.208"
  ["port"]=>
  int(1133)
  ["obfuscateIp"]=>
  bool(false)
  ["opusThreshold"]=>
  int(100)
  ["password"]=>
  string(12) "testPassword"
  ["rootChannel"]=>
  string(4) "root"
  ["rememberChannel"]=>
  bool(true)
  ["textMessageLength"]=>
  int(1024)
  ["timeout"]=>
  int(30)
  ["username"]=>
  string(25) "[-=\w\[\]\{\}\(\)\@\|\.]+"
  ["users"]=>
  int(15)
  ["welcomeText"]=>
  string(9) "Hai Thar!"
}
*/


// Setting some or all of the configuration options of your server.
$config = array(
	'allowHtml' => true,
	'obfuscateIp' => true,
	'defaultChannel' => 0,
	'password' => 'pieword',
	'rootChannel' => 'My server',
	'welcomeText' => 'Hello and welcome to my server!',
);

$config = $mumble->setConfig($config);
/*
var_dump($config);

Output:
bool(true)

On success
*/


// Send a message to every one on the server.
$message = $mumble->sendMessage(array('message' => 'What ho!'));
/*
var_dump($message);

Output:
bool(true)

On success
*/


// Send a message to every one on a channel.
$message = $mumble->sendMessage(array('message' => 'What ho, channel!', 'channelId' =>'0'));
/*
Notes: You can pull the channel id from the CVP

var_dump($message);

Output:
bool(true)

On success
*/


// Send a message to one user.
$message = $mumble->sendMessage(array('message' => 'What ho, user!', 'session' =>'0'));
/*
Notes: You can pull the user session from the CVP

var_dump($message);

Output:
bool(true)

On success
*/
