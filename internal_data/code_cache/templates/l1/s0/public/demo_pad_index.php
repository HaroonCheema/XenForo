<?php
// FROM HASH: 6ddb22234475b9931ea0da4a372a0bf7
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