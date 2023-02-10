<?php

return function($__templater, array $__vars, array $__options = [])
{
	$__widget = '';

	if ($__templater->func('in_array', array($__vars['xf']['reply']['containerKey'], array('node-2', 'node-3', 'node-4', 'node-5', 'node-6', 'node-7', 'node-8', ), ), false)) {
		$__widget = \XF::app()->widget()->widget('aggiungi_recensione', $__options)->render();
	}

	return $__widget;
};