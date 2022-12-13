<?php
// FROM HASH: 8d5bd276a770d8d752fcbcd10dd775b6
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->includeTemplate('crud_record_header', $__vars) . '

<div id="main-content">
  <h2>Add New Record</h2>

  ' . $__templater->form('
    <div class="block-container">
      <div class="block-body">
        ' . $__templater->formTextBoxRow(array(
		'name' => 'name',
		'autosize' => 'true',
		'row' => '5',
	), array(
		'label' => 'Name',
	)) . '

        ' . $__templater->formTextBoxRow(array(
		'name' => 'class',
		'autosize' => 'true',
		'row' => '5',
	), array(
		'label' => 'Class',
	)) . '

        ' . $__templater->formNumberBoxRow(array(
		'name' => 'rollNo',
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
		'action' => $__templater->func('link', array('crud/insert', $__vars['crud'], ), false),
		'class' => 'block post-form',
		'ajax' => '1',
	)) . '
</div>

</div>
</body>

</html>
';
	return $__finalCompiled;
}
);