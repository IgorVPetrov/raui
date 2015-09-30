<?php
 return array (
  'components' => 
  array (
    'db' => 
    array (
      'class' => 'CDbConnection',
      'connectionString' => 'mysql:host=localhost;dbname=raui;port=3306',
      'username' => 'root',
      'password' => '',
      'emulatePrepare' => true,
      'charset' => 'utf8',
      'enableParamLogging' => false,
      'enableProfiling' => false,
      'schemaCachingDuration' => 7200,
      'tablePrefix' => 'bt_',
    ),
  ),
  'language' => 'ru',
) ;
?>