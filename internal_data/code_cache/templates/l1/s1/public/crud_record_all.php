<?php
// FROM HASH: dc2afb445f597552d985897164aba11f
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('CRUD');
	$__finalCompiled .= '

';
	$__compilerTemp1 = '';
	if ($__templater->method($__vars['xf']['visitor'], 'canSearch', array())) {
		$__compilerTemp1 .= '
    <a
      href="' . $__templater->func('link', array('search', ), true) . '"
      class="p-navgroup-link p-navgroup-link--iconic p-navgroup-link--search"
      data-xf-click="menu"
      data-xf-key="' . $__templater->filter('/', array(array('for_attr', array()),), true) . '"
      aria-label="' . $__templater->filter('Search', array(array('for_attr', array()),), true) . '"
      aria-expanded="false"
      aria-haspopup="true"
      title="' . $__templater->filter('Search', array(array('for_attr', array()),), true) . '"
      style="
        float: right;
        background-color: #2577b1;
        color: #fff;
        margin-left: 15px;
      "
    >
      <i aria-hidden="true"></i>
      <span class="p-navgroup-linkText">' . 'Search' . '</span>
    </a>
    <div
      class="menu menu--structural menu--wide"
      data-menu="menu"
      aria-hidden="true"
    >
      <form
        action="' . $__templater->func('link', array('search/search', ), true) . '"
        method="post"
        class="menu-content"
        data-xf-init="quick-search"
      >
        <h3 class="menu-header">' . 'Search' . '</h3>
        ' . '
        <div class="menu-row">
          ';
		if ($__vars['searchConstraints']) {
			$__compilerTemp1 .= '
            <div class="inputGroup inputGroup--joined">
              ' . $__templater->formTextBox(array(
				'name' => 'keywords',
				'placeholder' => 'Search' . $__vars['xf']['language']['ellipsis'],
				'aria-label' => 'Search',
				'data-menu-autofocus' => 'true',
			)) . '
              ';
			$__compilerTemp2 = array(array(
				'value' => '',
				'label' => 'Everywhere',
				'_type' => 'option',
			));
			if ($__templater->isTraversable($__vars['searchConstraints'])) {
				foreach ($__vars['searchConstraints'] AS $__vars['constraintName'] => $__vars['constraint']) {
					$__compilerTemp2[] = array(
						'value' => $__templater->filter($__vars['constraint'], array(array('json', array()),), false),
						'label' => $__templater->escape($__vars['constraintName']),
						'_type' => 'option',
					);
				}
			}
			$__compilerTemp1 .= $__templater->formSelect(array(
				'name' => 'constraints',
				'class' => 'js-quickSearch-constraint',
				'aria-label' => 'Search within',
			), $__compilerTemp2) . '
            </div>
            ';
		} else {
			$__compilerTemp1 .= '
            ' . $__templater->formTextBox(array(
				'name' => 'keywords',
				'placeholder' => 'Search' . $__vars['xf']['language']['ellipsis'],
				'aria-label' => 'Search',
				'data-menu-autofocus' => 'true',
			)) . '
          ';
		}
		$__compilerTemp1 .= '
        </div>

        <div class="menu-footer">
          <span class="menu-footer-controls">
            ' . $__templater->button('', array(
			'type' => 'submit',
			'class' => 'button--primary',
			'icon' => 'search',
		), '', array(
		)) . '
          </span>
        </div>

        ' . $__templater->func('csrf_input') . '
      </form>
    </div>
  ';
	}
	$__templater->pageParams['pageAction'] = $__templater->preEscaped('
  ' . $__templater->button('Add Record', array(
		'href' => $__templater->func('link', array('crud/add', ), false),
		'icon' => 'add',
	), '', array(
	)) . '

  <!--       < Search >  -->

  ' . $__compilerTemp1 . '

  <!--       </ Search > -->
');
	$__finalCompiled .= '

<!--       < Records >  -->

<div class="block">
  <div class="block-container">
    <div class="block-body">
      ';
	$__compilerTemp3 = '';
	if ($__templater->isTraversable($__vars['data'])) {
		foreach ($__vars['data'] AS $__vars['val']) {
			$__compilerTemp3 .= '
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
        ' . $__compilerTemp3 . '
      ', array(
		'data-xf-init' => 'responsive-data-list',
	)) . '
    </div>
  </div>
</div>

<!--       </ Records > -->
';
	return $__finalCompiled;
}
);