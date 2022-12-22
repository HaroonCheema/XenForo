<?php
// FROM HASH: d4e33524ad28495b21f23c654dce5bfb
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('CRUD');
	$__finalCompiled .= '

';
	$__templater->breadcrumb($__templater->preEscaped('CRUD'), '#', array(
	));
	$__finalCompiled .= '

';
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
  ' . $__templater->button('Add Record', array(
		'href' => $__templater->func('link', array('crud/add', ), false),
		'icon' => 'add',
	), '', array(
	)) . '
');
	$__finalCompiled .= '

';
	if (!$__templater->test($__vars['data'], 'empty', array())) {
		$__finalCompiled .= '
  <div class="block">
    <div class="block-outer">
      ' . $__templater->callMacro('filter_macro', 'quick_filter', array(
			'key' => 'crud',
			'class' => 'block-outer-opposite',
		), $__vars) . '
    </div>
    <div class="block-container">
      <div class="block-body">
        <!--       < Records >  -->

        ';
		$__compilerTemp1 = '';
		if ($__templater->isTraversable($__vars['data'])) {
			foreach ($__vars['data'] AS $__vars['val']) {
				$__compilerTemp1 .= '
            ' . $__templater->dataRow(array(
				), array(array(
					'href' => $__templater->func('link', array('crud/edit', $__vars['val'], ), false),
					'_type' => 'cell',
					'html' => '
                ' . $__templater->escape($__vars['val']['name']) . '
              ',
				),
				array(
					'_type' => 'cell',
					'html' => ' ' . $__templater->escape($__vars['val']['class']) . ' ',
				),
				array(
					'_type' => 'cell',
					'html' => ' ' . $__templater->escape($__vars['val']['rollNo']) . ' ',
				),
				array(
					'href' => $__templater->func('link', array('crud/delete-record', $__vars['val'], ), false),
					'overlay' => 'true',
					'_type' => 'delete',
					'html' => '',
				))) . '
          ';
			}
		}
		$__finalCompiled .= $__templater->dataList('
          ' . $__templater->dataRow(array(
			'rowtype' => 'header',
		), array(array(
			'_type' => 'cell',
			'html' => ' Name ',
		),
		array(
			'_type' => 'cell',
			'html' => ' Class ',
		),
		array(
			'_type' => 'cell',
			'html' => ' Roll No ',
		),
		array(
			'class' => 'dataList-cell--min',
			'_type' => 'cell',
			'html' => ' Action ',
		))) . '
          ' . $__compilerTemp1 . '
        ', array(
			'data-xf-init' => 'responsive-data-list',
		)) . '
        ' . $__templater->func('page_nav', array(array(
			'page' => $__vars['page'],
			'total' => $__vars['total'],
			'link' => 'crud',
			'wrapperclass' => 'block',
			'perPage' => $__vars['perPage'],
		))) . '
        <!--       </ Records > -->
      </div>

      <!-- <div class="block-footer">
        <span class="block-footer-counter">footer</span>
      </div> -->
    </div>
  </div>
  ';
	} else {
		$__finalCompiled .= '
  <div class="blockMessage">' . 'No items have been created yet.' . '</div>
';
	}
	$__finalCompiled .= '
';
	return $__finalCompiled;
}
);