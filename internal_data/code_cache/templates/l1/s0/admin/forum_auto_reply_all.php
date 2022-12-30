<?php
// FROM HASH: bcc79ef9b54c5f104f29b3704ce34677
return array(
'macros' => array('message_table_list' => array(
'arguments' => function($__templater, array $__vars) { return array(
		'data' => $__vars['data'],
		'nodeTree' => $__vars['nodeTree'],
		'userGroups' => $__vars['userGroups'],
		'prefixGroups' => $__vars['prefixGroups'],
		'prefixesGrouped' => $__vars['prefixesGrouped'],
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
    ';
			$__compilerTemp1 = array();
			$__compilerTemp2 = $__templater->method($__vars['nodeTree'], 'getFlattened', array(0, ));
			if ($__templater->isTraversable($__compilerTemp2)) {
				foreach ($__compilerTemp2 AS $__vars['treeEntry']) {
					if ($__vars['treeEntry']['record']['node_id'] == $__vars['val']['node_id']) {
						$__compilerTemp1[] = array(
							'href' => $__templater->func('link', array('forumAutoReply/edit', $__vars['val'], ), false),
							'_type' => 'cell',
							'html' => '
            ' . $__templater->filter($__templater->func('repeat', array('&nbsp;&nbsp;', $__vars['treeEntry']['depth'], ), false), array(array('raw', array()),), true) . '
            ' . $__templater->escape($__vars['treeEntry']['record']['title']) . '
          ',
						);
					}
				}
			}
			if ($__templater->isTraversable($__vars['userGroups'])) {
				foreach ($__vars['userGroups'] AS $__vars['userGroup']) {
					if ($__vars['userGroup']['user_group_id'] == $__vars['val']['user_group_id']) {
						$__compilerTemp1[] = array(
							'_type' => 'cell',
							'html' => ' ' . $__templater->escape($__vars['userGroup']['title']) . ' ',
						);
					}
				}
			}
			if ($__templater->isTraversable($__vars['prefixGroups'])) {
				foreach ($__vars['prefixGroups'] AS $__vars['prefixGroupId'] => $__vars['prefixGroup']) {
					if ($__templater->isTraversable($__vars['prefixesGrouped'][$__vars['prefixGroupId']])) {
						foreach ($__vars['prefixesGrouped'][$__vars['prefixGroupId']] AS $__vars['prefix_id'] => $__vars['prefix']) {
							if ($__vars['val']['prefix_id'] == $__vars['prefix_id']) {
								$__compilerTemp1[] = array(
									'_type' => 'cell',
									'html' => ' ' . $__templater->escape($__vars['prefix']['title']) . ' ',
								);
							}
						}
					}
				}
			}
			$__compilerTemp1[] = array(
				'href' => $__templater->func('link', array('forumAutoReply/delete-all', $__vars['val'], ), false),
				'overlay' => 'true',
				'_type' => 'delete',
				'html' => '',
			);
			$__finalCompiled .= $__templater->dataRow(array(
			), $__compilerTemp1) . '
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
			'nodeTree' => $__vars['nodeTree'],
			'userGroups' => $__vars['userGroups'],
			'prefixGroups' => $__vars['prefixGroups'],
			'prefixesGrouped' => $__vars['prefixesGrouped'],
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