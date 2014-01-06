<?php
/**
 * \file
 * This is installer for the TT Testkit
 * \ingroup TTK_ADMIN
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \copyright{2011-2013} Oscar van Eijk, Oveas Functionality Provider
 * \license
 * This file is part of TTK.
 *
 * TTK is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * TTK is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with TTK. If not, see http://www.gnu.org/licenses/.
 */

// Toplevel where TT can be found
define ('TT_ROOT', '/var/www/terra-terra');

require (TT_ROOT . '/TTinstaller.php');

$_id = TTinstaller::installApplication('TTK', 'ttk', 'Terra-Terra TestKit', 'v0.2', 'Testapplication for Terra-Terra', 'https://github.com/oveas/tt-testkit', 'Oscar van Eijk', 'LGPL');

TTinstaller::addConfig($_id, 'general', 'debug', 16711935);
TTinstaller::addConfig($_id, 'database', 'prefix', 'ttk_', true);
TTinstaller::addConfig($_id, 'general', 'js_signal', true);

TTinstaller::addRights($_id
	,array(
		 'createtestset'=> 'Can create new testsets'
		,'createtestcase'=> 'Can create new testcases in an existing testset'
		,'executetest'=> 'Can execute tests'
	)
);

TTinstaller::addGroups($_id
	,array(
		 'TTK admin' => 'TT Testkit Administrators'
		,'TTK Developers' => 'TT developers'
		,'TTK Testers' => 'TT testers'
	)
);
TTinstaller::addGroupRights($_id
	,'TTK admin'
	,array(
		 'createtestset'
		,'createtestcase'
		,'executetest'
	)
);
TTinstaller::addGroupRights($_id
	,'TTK Developers'
	,array(
		 'createtestcase'
		,'executetest'
	)
);
TTinstaller::addGroupRights($_id
	,'TTK Testers'
	,array(
		 'executetest'
	)
);

TTinstaller::enableApplication($_id);

TTloader::getClass('TTrundown.php', TT_ROOT);
