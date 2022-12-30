<?php
// FROM HASH: ca850853bbaa32e27c58ca459cbc625f
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__compilerTemp1 = '';
	if ($__vars['message']['message_id']) {
		$__compilerTemp1 .= ' ' . 'Edit Message' . ' :
  ' . $__templater->escape($__vars['message']['message']) . ' ';
	}
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('
  ' . $__compilerTemp1 . '
');
	$__finalCompiled .= '

';
	$__compilerTemp2 = '';
	if ($__vars['message']['message_id']) {
		$__compilerTemp2 .= '
            <div class="inputGroup">
              ' . $__templater->formTextBox(array(
			'name' => 'words[]',
			'value' => $__vars['message']['word'],
			'placeholder' => 'Enter Word here...!',
			'size' => '24',
			'maxlength' => '25',
			'data-i' => '0',
			'dir' => 'ltr',
		)) . '

              <span class="inputGroup-splitter"></span>

              ' . $__templater->formTextBox(array(
			'name' => 'messages[]',
			'value' => $__vars['message']['message'],
			'placeholder' => 'Enter Message here...!',
			'size' => '24',
			'data-i' => '0',
		)) . '

              ' . $__templater->formTextBox(array(
			'name' => 'from_users[]',
			'value' => $__vars['message']['User']['username'],
			'ac' => 'single',
			'placeholder' => 'Enter Existing User...!',
			'size' => '24',
			'data-i' => '0',
		)) . '
            </div>  
          ';
	}
	$__finalCompiled .= $__templater->form('
  <div class="block-container">
    <div class="block-body">
      
      <!-- Words,Message,User inputs -->

      ' . $__templater->formRow('
        <div
          class="inputGroup-container"
          data-xf-init="list-sorter"
          data-drag-handle=".dragHandle"
        >
          ' . $__compilerTemp2 . '
        </div>
      ', array(
		'rowtype' => 'input',
		'label' => 'Word-Message',
		'hint' => 'Required',
	)) . '
    </div>
    ' . $__templater->formSubmitRow(array(
		'submit' => '',
		'icon' => 'edit',
	), array(
	)) . '
  </div>
', array(
		'action' => $__templater->func('link', array('forumAutoReply/edit-save', $__vars['message'], ), false),
		'class' => 'block',
		'data-force-flash-message' => 'true',
	));
	return $__finalCompiled;
}
);