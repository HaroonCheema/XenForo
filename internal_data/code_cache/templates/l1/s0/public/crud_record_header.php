<?php
// FROM HASH: 733045a852bfbc16d04093c822a154b1
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->includeCss('style.less');
	$__finalCompiled .= '

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    ';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('CRUD');
	$__finalCompiled .= '
  </head>

  <body>
    <div id="wrapper">
      <div id="header">
        <h1>Crud</h1>
      </div>
      <div id="menu">
        <center>
          <ul>
            <li>
              <a href="' . $__templater->func('link', array('crud', ), true) . '">Home</a>
            </li>
            <li>
              <a href="' . $__templater->func('link', array('crud/add/', ), true) . '">Add</a>
            </li>
          </ul>
        </center>
      </div>';
	return $__finalCompiled;
}
);