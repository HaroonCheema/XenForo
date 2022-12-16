<?php
// FROM HASH: ee12056ebba402deebcae413c914ca7e
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__compilerTemp1 = '';
	if ($__vars['crud']['id']) {
		$__compilerTemp1 .= ' Edit Record ' . $__templater->escape($__vars['crud']['name']) . ' ';
	} else {
		$__compilerTemp1 .= ' Add new Record
  ';
	}
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('
  ' . $__compilerTemp1 . '
');
	$__finalCompiled .= '

' . $__templater->form('
  <div class="block-container">
    <div class="block-body">
      ' . $__templater->formTextBoxRow(array(
		'name' => 'name',
		'value' => $__vars['crud']['name'],
		'autosize' => 'true',
		'row' => '5',
	), array(
		'label' => 'Name',
	)) . '

      ' . $__templater->formTextBoxRow(array(
		'name' => 'class',
		'value' => $__vars['crud']['class'],
		'autosize' => 'true',
		'row' => '5',
	), array(
		'label' => 'Class',
	)) . '

      ' . $__templater->formNumberBoxRow(array(
		'name' => 'rollNo',
		'value' => $__vars['crud']['rollNo'],
		'autosize' => 'true',
		'row' => '5',
	), array(
		'label' => 'Roll No',
	)) . '
    </div>

    ' . $__templater->formSubmitRow(array(
		'submit' => 'save',
		'fa' => 'fa-save',
	), array(
	)) . '
  </div>
', array(
		'action' => $__templater->func('link', array('crud/save', $__vars['crud'], ), false),
		'class' => 'block',
		'ajax' => '1',
	)) . '
';
	return $__finalCompiled;
}
);