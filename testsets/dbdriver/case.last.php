<?php
/**
 * \file
 * This file defines the last testcase for the Hierarchical Dataset
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \copyright{2011} Oscar van Eijk, Oveas Functionality Provider
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

/**
 * \ingroup TTK_TESTSETS
 * This testcase dropt a database table that was used in all DbDriver tests
 * \brief DbDriver Testcase
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version May 23, 2011 -- O van Eijk -- initial version
 */
class TTKDbdriver_Last implements TestCase
{
	// Name of the temporary database table that will be used in this testcase
	private $tablename;

	// Hold details of the testresults
	private $details;

	public function __construct()
	{
		$this->tablename = TTKDbdriver_tableName();
		$this->details = '';
	}

	public function prepareTest ()
	{
		return TTK_RESULT_NONE;
	}

	public function performTest ()
	{
		$returnCodes = array();
		$db = TT::factory('dbhandler');
		$dbId = $db->getResource();
		if ($db->getDriver()->dbDropTable($dbId, $db->tablename($this->tablename, true))) {
			$returnCodes[] = array(TTK_RESULT_SUCCESS, 'Successfully removed the table "' . $this->tablename . '"');
		} else {
			$returnCodes[] = array(TTK_RESULT_FAIL, 'Table "' . $this->tablename . '" could not be removed');
			$db->getDriver()->dbError($dbId,$nr, $msg);
			$this->details .= '<p>Dropping the table failed with error message<br/><em>' . $msg . '</em></p>';
		}
		return $returnCodes;
	}

	public function cleanupTest ()
	{
		return TTK_RESULT_NONE;
	}

	public function getDetails ()
	{
		return $this->details;
	}

}
