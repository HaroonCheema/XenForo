<?php
// FROM HASH: dec44711e7d555a6521eff669108bf76
return array(
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
      <!--       < Records >  -->

      ';
	$__compilerTemp1 = '';
	if (!$__templater->test($__vars['data'], 'empty', array())) {
		$__compilerTemp1 .= ' -->
        <!-- list macro -->

        <!-- ' . $__templater->callMacro(null, 'record_table_list', array(
			'data' => $__vars['data'],
		), $__vars) . ' -->

        <!-- list macro -->
        <!-- ';
	} else {
		$__compilerTemp1 .= '
          <div class="blockMessage">
            ' . 'No items have been created yet.' . '
          </div>
        ';
	}
	$__finalCompiled .= $__templater->dataList('
        <h1>Haroon</h1>
        <!-- ' . $__compilerTemp1 . ' -->
      ', array(
		'data-xf-init' => 'responsive-data-list',
	)) . '
      <!-- ' . $__templater->func('page_nav', array(array(
		'page' => $__vars['page'],
		'total' => $__vars['total'],
		'link' => 'forumAutoReply',
		'wrapperclass' => 'block',
		'perPage' => $__vars['perPage'],
	))) . ' -->
      <!--       </ Records > -->
    </div>

    <!-- <div class="block-footer">
          <span class="block-footer-counter">footer</span>
        </div> -->
  </div>
</div>

<!-- All macros is here define in below -->
';
	return $__finalCompiled;
}
);