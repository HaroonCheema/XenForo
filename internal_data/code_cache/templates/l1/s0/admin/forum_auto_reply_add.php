<?php
// FROM HASH: f9a073490437a0a742aa680330682461
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Add Message');
	$__finalCompiled .= '

';
	$__compilerTemp1 = array(array(
		'value' => '0',
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'None' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	if ($__templater->isTraversable($__vars['forums'])) {
		foreach ($__vars['forums'] AS $__vars['forum']) {
			$__compilerTemp1[] = array(
				'value' => $__vars['forum']['value'],
				'disabled' => $__vars['forum']['disabled'],
				'label' => $__templater->escape($__vars['forum']['label']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp2 = array(array(
		'value' => '0',
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'None' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	$__compilerTemp3 = $__templater->method($__vars['nodeTree'], 'getFlattened', array(0, ));
	if ($__templater->isTraversable($__compilerTemp3)) {
		foreach ($__compilerTemp3 AS $__vars['treeEntry']) {
			$__compilerTemp2[] = array(
				'value' => $__vars['treeEntry']['record']['node_id'],
				'disabled' => ($__vars['treeEntry']['record']['node_type_id'] != 'Forum'),
				'label' => $__templater->filter($__templater->func('repeat', array('&nbsp;&nbsp;', $__vars['treeEntry']['depth'], ), false), array(array('raw', array()),), true) . '
            ' . $__templater->escape($__vars['treeEntry']['record']['title']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp4 = '';
	if ($__templater->isTraversable($__vars['record']['tourn_prizes'])) {
		foreach ($__vars['record']['tourn_prizes'] AS $__vars['key'] => $__vars['value']) {
			$__compilerTemp4 .= '
            <div class="inputGroup">
              ' . $__templater->formTextBox(array(
				'name' => 'tourn_parto[]',
				'value' => $__vars['key'],
				'placeholder' => 'First One',
				'size' => '24',
				'maxlength' => '25',
				'dir' => 'ltr',
			)) . '

              <span class="inputGroup-splitter"></span>

              ' . $__templater->formTextBox(array(
				'name' => 'tourn_partt[]',
				'value' => $__vars['value'],
				'placeholder' => 'Last One',
				'size' => '24',
			)) . '
            </div>
          ';
		}
	}
	$__compilerTemp5 = array(array(
		'value' => '0',
		'label' => $__vars['xf']['language']['parenthesis_open'] . 'None' . $__vars['xf']['language']['parenthesis_close'],
		'_type' => 'option',
	));
	if ($__templater->isTraversable($__vars['userGroups'])) {
		foreach ($__vars['userGroups'] AS $__vars['userGroup']) {
			$__compilerTemp5[] = array(
				'value' => $__vars['userGroup']['user_group_id'],
				'label' => $__templater->escape($__vars['userGroup']['title']),
				'_type' => 'option',
			);
		}
	}
	$__compilerTemp6 = '';
	if (!$__templater->test($__vars['prefixesGrouped'], 'empty', array())) {
		$__compilerTemp6 .= '
        ';
		$__compilerTemp7 = array(array(
			'value' => '0',
			'label' => $__vars['xf']['language']['parenthesis_open'] . 'None' . $__vars['xf']['language']['parenthesis_close'],
			'_type' => 'option',
		));
		if ($__templater->isTraversable($__vars['prefixGroups'])) {
			foreach ($__vars['prefixGroups'] AS $__vars['prefixGroupId'] => $__vars['prefixGroup']) {
				if ($__templater->isTraversable($__vars['prefixesGrouped'][$__vars['prefixGroupId']])) {
					foreach ($__vars['prefixesGrouped'][$__vars['prefixGroupId']] AS $__vars['prefixId'] => $__vars['prefix']) {
						$__compilerTemp7[] = array(
							'value' => $__vars['prefixId'],
							'label' => $__templater->escape($__vars['prefix']['title']),
							'_type' => 'option',
						);
					}
				}
			}
		}
		$__compilerTemp6 .= $__templater->formSelectRow(array(
			'name' => 'prefix_id',
			'value' => $__vars['nodeIds'],
			'required' => 'required',
		), $__compilerTemp7, array(
			'label' => 'Prefixes',
			'hint' => 'Required',
		)) . '
      ';
	}
	$__compilerTemp8 = '';
	if (!$__templater->test($__vars['prefixesGrouped'], 'empty', array())) {
		$__compilerTemp8 .= '
        ';
		$__compilerTemp9 = array();
		if ($__templater->isTraversable($__vars['prefixGroups'])) {
			foreach ($__vars['prefixGroups'] AS $__vars['prefixGroupId'] => $__vars['prefixGroup']) {
				if ($__vars['prefixesGrouped'][$__vars['prefixGroupId']]) {
					$__compilerTemp9[] = array(
						'check-all' => 'true',
						'listclass' => 'listColumns',
						'label' => ($__vars['prefixGroupId'] ? $__vars['prefixGroup']['title'] : 'Ungrouped'),
						'_type' => 'optgroup',
						'options' => array(),
					);
					end($__compilerTemp9); $__compilerTemp10 = key($__compilerTemp9);
					if ($__templater->isTraversable($__vars['prefixesGrouped'][$__vars['prefixGroupId']])) {
						foreach ($__vars['prefixesGrouped'][$__vars['prefixGroupId']] AS $__vars['prefixId'] => $__vars['prefix']) {
							$__compilerTemp9[$__compilerTemp10]['options'][] = array(
								'value' => $__vars['prefixId'],
								'selected' => $__vars['forum']['prefix_cache'][$__vars['prefixId']],
								'label' => '<span class="label ' . $__templater->escape($__vars['prefix']['css_class']) . '"
                      >' . $__templater->escape($__vars['prefix']['title']) . '</span
                    >',
								'_type' => 'option',
							);
						}
					}
				}
			}
		}
		$__compilerTemp8 .= $__templater->formCheckBoxRow(array(
			'name' => 'available_prefixes',
			'listclass' => 'prefix',
			'data-xf-init' => 'checkbox-select-disabler',
			'data-select' => '.js-availablePrefixSelect',
		), $__compilerTemp9, array(
			'rowtype' => 'explainOffset',
			'label' => 'Available prefixes',
			'explain' => 'Select all prefixes that should be available for use within this forum',
			'hint' => '
            ' . $__templater->formCheckBox(array(
			'standalone' => 'true',
		), array(array(
			'check-all' => '.prefix',
			'label' => 'Select all',
			'_type' => 'option',
		))) . '
          ',
		)) . '
      ';
	}
	$__finalCompiled .= $__templater->form('
  <div class="block-container">
    <div class="block-body">
      <!-- Forums list -->

      <!-- ' . $__templater->formSelectRow(array(
		'name' => 'forum_id',
		'value' => $__vars['nodeIds'],
		'required' => 'required',
	), $__compilerTemp1, array(
		'label' => 'Forum',
		'hint' => 'Required',
	)) . ' -->

      ' . $__templater->formSelectRow(array(
		'name' => 'forum_id',
		'value' => $__vars['nodeIds'],
		'required' => 'required',
	), $__compilerTemp2, array(
		'label' => 'Forum',
		'hint' => 'Required',
	)) . '
      <!-- value="' . $__templater->escape($__vars['xf']['visitor']['username']) . '" -->

      ' . $__templater->formTextBoxRow(array(
		'name' => 'from_user',
		'ac' => 'single',
	), array(
		'label' => 'From user',
		'explain' => '
          <p>
            ' . 'Enter the name of an existing user the conversation should be started by.' . '
          </p>
          <p>
            <b>' . 'Note' . $__vars['xf']['language']['label_separator'] . '</b> ' . 'You cannot start a conversation with yourself.' . '
          </p>
        ',
	)) . '

      <!-- ' . $__templater->formTextBoxRow(array(
		'name' => 'forum_id',
		'autofocus' => 'autofocus',
		'maxlength' => $__templater->func('max_length', array($__vars['xf']['visitor'], 'title', ), false),
		'value' => $__vars['record']['forum_id'],
		'required' => 'required',
	), array(
		'label' => 'Forum',
		'hint' => 'Required',
	)) . ' -->

      ' . $__templater->formRow('
        <div
          class="inputGroup-container"
          data-xf-init="list-sorter"
          data-drag-handle=".dragHandle"
        >
          ' . $__compilerTemp4 . '

          <div
            class="inputGroup is-undraggable js-blockDragafter"
            data-xf-init="field-adder"
            data-remove-class="is-undraggable js-blockDragafter"
          >
            ' . $__templater->formTextBox(array(
		'name' => 'forum_words[]',
		'placeholder' => 'Enter Word here...!',
		'size' => '24',
		'maxlength' => '25',
		'data-i' => '0',
		'dir' => 'ltr',
	)) . '

            <span class="inputGroup-splitter"></span>

            ' . $__templater->formTextBox(array(
		'name' => 'forum_message[]',
		'placeholder' => 'Enter Message here...!',
		'size' => '24',
		'data-i' => '0',
	)) . '

            ' . $__templater->formTextBox(array(
		'name' => 'forum_user[]',
		'placeholder' => 'Enter Registered User...!',
		'size' => '24',
		'data-i' => '0',
	)) . '
          </div>
        </div>
      ', array(
		'rowtype' => 'input',
		'label' => 'Word-Message',
		'hint' => 'Required',
	)) . '

      <!-- User Group List -->

      ' . $__templater->formSelectRow(array(
		'name' => 'userGroup_id',
		'value' => $__vars['nodeIds'],
		'required' => 'required',
	), $__compilerTemp5, array(
		'label' => 'User group',
		'hint' => 'Required',
	)) . '

      <!-- ' . $__templater->formTextBoxRow(array(
		'name' => 'userGroup_id',
		'autofocus' => 'autofocus',
		'maxlength' => $__templater->func('max_length', array($__vars['xf']['visitor'], 'title', ), false),
		'value' => $__vars['record']['userGroup_id'],
		'required' => 'required',
	), array(
		'label' => 'User group',
		'hint' => 'Required',
	)) . ' -->

      <!-- Prefixes List -->

      ' . $__compilerTemp6 . '

      <!-- ' . $__compilerTemp8 . ' -->

      <!-- ' . $__templater->formTextBoxRow(array(
		'name' => 'prefix_id',
		'autofocus' => 'autofocus',
		'maxlength' => $__templater->func('max_length', array($__vars['xf']['visitor'], 'title', ), false),
		'value' => $__vars['record']['forum_id'],
		'required' => 'required',
	), array(
		'label' => 'Prefixes',
		'hint' => 'Required',
	)) . ' -->
    </div>
    ' . $__templater->formSubmitRow(array(
		'submit' => '',
		'icon' => 'save',
	), array(
	)) . '
  </div>
', array(
		'action' => $__templater->func('link', array('forumAutoReply/save', $__vars['record'], ), false),
		'class' => 'block',
		'data-force-flash-message' => 'true',
	)) . '
';
	return $__finalCompiled;
}
);