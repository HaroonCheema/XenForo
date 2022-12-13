<?php
// FROM HASH: 5ee9ff1db8d94fbb53315cb0106ce241
return array(
'code' => function($__templater, array $__vars, $__extensions = null)
{
	$__finalCompiled = '';
	$__finalCompiled .= $__templater->includeTemplate('crud_record_header', $__vars) . '

<div id="main-content">
  <h2>All Records</h2>
  <br />
  <table cellpadding="7px">
    <thead>
      <th>Id</th>
      <th>Name</th>
      <th>Class</th>
      <th>Roll No</th>
      <th>Edit</th>
      <th>Delete</th>
    </thead>
    <tbody>
      ';
	if ($__templater->isTraversable($__vars['data'])) {
		foreach ($__vars['data'] AS $__vars['val']) {
			$__finalCompiled .= '
        <tr>
          <td>' . $__templater->escape($__vars['val']['id']) . '</td>
          <td>' . $__templater->escape($__vars['val']['name']) . '</td>
          <td>' . $__templater->escape($__vars['val']['class']) . '</td>
          <td>' . $__templater->escape($__vars['val']['rollNo']) . '</td>
          <td>
            <a href="' . $__templater->func('link', array('crud/edit-view', $__vars['val'], ), true) . '">Edit</a>
          </td>
          <td>
            <a href="' . $__templater->func('link', array('crud/delete', $__vars['val'], ), true) . '">Delete</a>
          </td>
        </tr>
      ';
		}
	}
	$__finalCompiled .= '
    </tbody>
  </table>
</div>
</div>
</body>
</html>';
	return $__finalCompiled;
}
);