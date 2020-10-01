<?php
/**
 * \file
 * This file defines the first testcase for the Hierarchical Dataset
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
 * This testcase creates a database table that will be used in all HData tests
 * \brief HData Testcase
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version May 23, 2011 -- O van Eijk -- initial version
 */
class TTKHdata_First implements TestCase
{
	// Name of the temporary database table that will be used in this testcase
	private $tablename;

	// Hold details of the testresults
	private $details;

	public function __construct()
	{
		$this->tablename = TTKHdata_tableName();
		$this->details = '';
	}

	public function prepareTest ()
	{
		$_scheme = TT::factory('schemehandler');
		$_table = array(
			 'id' => array (
				 'type' => 'INT'
				,'auto_inc' => true
				,'null' => false
				,'unsigned' => true
			)
			,'lval' => array (
				 'type' => 'INT'
				,'null' => false
			)
			,'rval' => array (
				 'type' => 'INT'
				,'null' => false
			)
			,'node' => array (
				 'type' => 'VARCHAR'
				,'length' => 45
				,'null' => false
			)
			,'xlink' => array (
				 'type' => 'INT'
				,'null' => true
				,'unsigned' => true
			)
		);
		$_index = array (
			 'lval' => array(
				 'columns' => array ('lval')
			)
			,'rval' => array(
				 'columns' => array ('rval')
			)
			,'node' => array(
				 'columns' => array ('node')
				,'unique' => true
			)
			,'xlink' => array(
				 'columns' => array ('xlink')
			)
		);

		$_scheme->createScheme($this->tablename);
		$_scheme->setEngine('MyISAM'); // TODO - This test won't work with InnoDB on MySQL otherwise
		$_scheme->defineScheme($_table);
		$_scheme->defineIndex($_index);
		$_severity = $_scheme->scheme();
		
		if ($_scheme->getStatus() === SCHEMEHANDLE_EXISTS) {
			$db = TT::factory('dbhandler');
			$dbId = $db->getResource();
			$db->resetTable($this->tablename);
		} else {
			if ($_severity <= TT_SUCCESS) {
				$_scheme->reset();
				return TTK_RESULT_SUCCESS;
			} else {
				$_scheme->signal(TT_WARNING, $msg);
				$_scheme->reset();
				return $msg;
			}
		}
	}

	public function performTest ()
	{
		$returnCodes = array();

		// Step 1; create a rootnode
		$hd = new HDataHandler();
		$hd->setTablename(TTKHdata_tableName());
		$hd->setLeft('lval');
		$hd->setRight('rval');
		if ($hd->insertNode(array('node' => 'Musical instruments'), array('field' => 'node')) === false) {
			$returnCodes[] = array(TTK_RESULT_FAIL, 'Inserting root node failed: ' . $hd->getLastWarning());
		} else {
			switch (TTKHdata_getData($data)) {
				case null:
					$returnCodes[] = array(TTK_RESULT_FAIL, 'No root node inserted - table empty');
					break;
				case false:
					$returnCodes[] = array(TTK_RESULT_FAIL, 'Failure while retrieving the results: ' . $data);
					break;
				case true:
					$_expectedResult = array(
											array(
												 'lval' => 1
												,'rval' => 2
												,'node' => 'Musical instruments'
												,'xlink' => null
											)
										);
					if ($data === $_expectedResult) {
						$returnCodes[] = array(TTK_RESULT_SUCCESS, 'Successfully inserted root node "Musical instruments"');
					} else {
						$returnCodes[] = array(TTK_RESULT_FAIL, 'Inserted root node was not as expected');
						$this->details .= '<p>The values of the root node differed from the exected result. '
							. 'The expected result was: <br/><pre>' . print_r($_expectedResult, 1) . '</pre><br/>'
							. 'The actual result was: <br/><pre>' . print_r($data, 1) . '</pre></p>';
					}
					break;
			}
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
