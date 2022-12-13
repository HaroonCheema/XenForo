<?php
// FROM HASH: 1d65b63821074fe74017b2c96addfa82
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->includeTemplate('crud_record_header', $__vars) . '

<div id="main-content">
  <h2>Update Record</h2>

  ' . $__templater->form('
    <div class="block-container">
      <div class="block-body">
        ' . $__templater->formHiddenVal('id', $__vars['data']['id'], array(
	)) . '

        ' . $__templater->formTextBoxRow(array(
		'name' => 'name',
		'value' => $__vars['data']['name'],
		'autosize' => 'true',
		'row' => '5',
	), array(
		'label' => 'Name',
	)) . '

        ' . $__templater->formTextBoxRow(array(
		'name' => 'class',
		'value' => $__vars['data']['class'],
		'autosize' => 'true',
		'row' => '5',
	), array(
		'label' => 'Class',
	)) . '

        ' . $__templater->formNumberBoxRow(array(
		'name' => 'rollNo',
		'value' => $__vars['data']['rollNo'],
		'autosize' => 'true',
		'row' => '5',
	), array(
		'label' => 'Roll No',
	)) . '
      </div>

      ' . $__templater->formSubmitRow(array(
		'submit' => 'Update',
		'fa' => 'fa-save',
	), array(
	)) . '
    </div>
  ', array(
		'action' => $__templater->func('link', array('crud/update', ), false),
		'class' => 'block post-form',
		'ajax' => '1',
	)) . '
</div>

</div>
</body>
</html>';
	return $__finalCompiled;
}
);