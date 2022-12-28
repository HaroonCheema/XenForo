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
		$this->schemaManager()->createTable('xf_forum_auto_reply', function (Create $table) {
			$table->addColumn('id', 'int', '255')->autoIncrement();
			$table->addColumn('forum_words', 'blob', '255')->nullable();
			$table->addPrimaryKey('id');
		});
	}

	public function uninstallStep1()
	{
		$sm = $this->schemaManager();
		$sm->dropTable('xf_forum_auto_reply');
	}
}
