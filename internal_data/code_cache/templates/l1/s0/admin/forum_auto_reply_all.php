<?php
// FROM HASH: ec116905b428aba091e361c5715244c5
return array(
'macros' => array('message_table_list' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'data' => $__vars['data'],
	); },
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= '
  ' . $__templater->dataRow(array(
		'rowtype' => 'header',
	), array(array(
		'_type' => 'cell',
		'html' => ' ' . 'Forum' . ' ',
	),
	array(
		'_type' => 'cell',
		'html' => ' ' . 'Words' . ' ',
	),
	array(
		'_type' => 'cell',
		'html' => ' ' . 'Message' . ' ',
	),
	array(
		'_type' => 'cell',
		'html' => ' ' . 'User Name' . ' ',
	),
	array(
		'_type' => 'cell',
		'html' => ' ' . 'User Group' . ' ',
	),
	array(
		'_type' => 'cell',
		'html' => ' ' . 'Prefix' . ' ',
	),
	array(
		'class' => 'dataList-cell--min',
		'_type' => 'cell',
		'html' => ' Action ',
	))) . '
  ';
	if ($__templater->isTraversable($__vars['data'])) {
		foreach ($__vars['data'] AS $__vars['val']) {
			$__finalCompiled .= '
    ' . $__templater->dataRow(array(
			), array(array(
				'href' => $__templater->func('link', array('forumAutoReply/edit', $__vars['val'], ), false),
				'_type' => 'cell',
				'html' => '
        ' . $__templater->escape($__vars['val']['Node']['title']) . '
      ',
			),
			array(
				'_type' => 'cell',
				'html' => ' ' . $__templater->escape($__vars['val']['word']) . ' ',
			),
			array(
				'_type' => 'cell',
				'html' => ' ' . $__templater->escape($__vars['val']['message']) . ' ',
			),
			array(
				'_type' => 'cell',
				'html' => ' ' . $__templater->escape($__vars['val']['User']['username']) . ' ',
			),
			array(
				'_type' => 'cell',
				'html' => ' ' . $__templater->escape($__vars['val']['UserGroup']['title']) . ' ',
			),
			array(
				'_type' => 'cell',
				'html' => ' ' . $__templater->escape($__vars['val']['Prefix']['title']) . ' ',
			),
			array(
				'href' => $__templater->func('link', array('forumAutoReply/delete', $__vars['val'], ), false),
				'overlay' => 'true',
				'_type' => 'delete',
				'html' => '',
			))) . '
  ';
		}
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
}
)),
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Forum Auto Reply');
	$__finalCompiled .= '

';
	$__templater->breadcrumb($__templater->preEscaped('Forum Auto Reply'), '#', array(
	));
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
  ' . $__templater->button('Add Message', array(
		'href' => $__templater->func('link', array('forumAutoReply/add', ), false),
		'icon' => 'add',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

<div class="block">
  <div class="block-outer">
    ' . $__templater->callMacro('filter_macros', 'quick_filter', array(
		'key' => 'forumAutoReply',
		'class' => 'block-outer-opposite',
	), $__vars) . '
  </div>
  <div class="block-container">
    <div class="block-body">
      ';
	$__compilerTemp1 = '';
	if (!$__templater->test($__vars['data'], 'empty', array())) {
		$__compilerTemp1 .= '
          ' . $__templater->callMacro(null, 'message_table_list', array(
			'data' => $__vars['data'],
		), $__vars) . '

          ';
	} else {
		$__compilerTemp1 .= '
          <div class="blockMessage">
            ' . 'No items have been created yet.' . '
          </div>
        ';
	}
	$__finalCompiled .= $__templater->dataList('
        ' . $__compilerTemp1 . '
      ', array(
		'data-xf-init' => 'responsive-data-list',
	)) . '
      ' . $__templater->func('page_nav', array(array(
		'page' => $__vars['page'],
		'total' => $__vars['total'],
		'link' => 'forumAutoReply',
		'wrapperclass' => 'block',
		'perPage' => $__vars['perPage'],
	))) . '
    </div>
  </div>
</div>

' . '
';
	return $__finalCompiled;
}
);