<?php
// FROM HASH: ed615a7f38d1a1b22bd22b2e789d226a
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
                <p>Here is some content</p>
                <p>Here is some more content</p>
                <p>
                    <a href="' . $__templater->func('link', array('notes', ), true) . '">Back to the index page</a>
                </p>
            </div>
        </div>
    </div>
</div>';
	return $__finalCompiled;
}
);