<?php

namespace FS\ForumAutoReply;

use XF\AddOn\AbstractSetup;
use XF\AddOn\StepRunnerInstallTrait;
use XF\AddOn\StepRunnerUninstallTrait;
use XF\AddOn\StepRunnerUpgradeTrait;

use XF\Db\Schema\Alter;
use XF\Db\Schema\Create;

class Setup extends AbstractSetup
{
	use StepRunnerInstallTrait;
	use StepRunnerUpgradeTrait;
	use StepRunnerUninstallTrait;

	public function installstep1()
	{
		$this->schemaManager()->createTable('fs_forum_auto_reply', function (Create $table) {
			$table->addColumn('message_id', 'int', '255')->autoIncrement();
			$table->addColumn('node_id', 'int', '255');
			$table->addColumn('word', 'mediumtext');
			$table->addColumn('message', 'mediumtext');
			$table->addColumn('user_id', 'int', '255');
			$table->addColumn('user_group_id', 'int', '255');
			$table->addColumn('prefix_id', 'int', '255');
			$table->addPrimaryKey('message_id');
		});
	}

	public function uninstallStep1()
	{
		$sm = $this->schemaManager();
		$sm->dropTable('fs_forum_auto_reply');
	}
}
