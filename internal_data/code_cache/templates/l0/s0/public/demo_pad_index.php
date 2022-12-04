<?php
// FROM HASH: 2f333bbd1598457f543126fef2c6fa2b
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__templater->pageParams['pageTitle'] = $__templater->preEscaped('Demo pad index page');
	$__finalCompiled .= '

<div class="block">
    <div class="block-container">
        <div class="block-body">
            <div class="block-row">
                <p>Hello There!</p>
                <p>
                    <a href="' . $__templater->func('link', array('notes/test', ), true) . '">Open the test page</a>
                </p>
            </div>

        </div>
    </div>
</div>';
	return $__finalCompiled;
}
);