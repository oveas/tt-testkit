<?php
/**
 * \file
 * This file defines the testcase that does all table alterings
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
 * This testcase does some node handling, like inserts, move and remove
 * \brief DbDriver ALTER TABLE Testcase
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version Sep 26, 2011 -- O van Eijk -- initial version
 */
class TTKDbdriver_Alter implements TestCase
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
		$_scheme = TT::factory('schemehandler');

		$step = 1;
		$_scheme->createScheme($this->tablename);
		$_scheme->tableDescription($this->tablename, $data);
		$data['columns']['lastname']['length'] = 48;
		$_scheme->defineScheme($data['columns']);
		$_scheme->defineIndex($data['indexes']);
		// Step 1: alter a field
		if ($_scheme->scheme() <= TT_SUCCESS) {
			$_scheme->reset();
			$returnCodes[] = array(TTK_RESULT_SUCCESS, 'Successfully altered the table');
		} else {
			$_scheme->signal(TT_WARNING, $msg);
			$_scheme->reset();
			$returnCodes[] = array(TTK_RESULT_FAIL, 'Altering the table failed in step 1');
			$this->details .= "<p>Schemehandler returned an error while altyering the table:<blockquote>$msg</blockquote>";
		}

		// Step 2: Check the results
		$_expectedResult = $this->getExpected($step);
		if ($data == $_expectedResult) { // Just 2 '=' signs since not all datatypes (int vs string) might match
			$returnCodes[] = array(TTK_RESULT_SUCCESS, 'Table comparison succeeded');
		} else {
			$returnCodes[] = array(TTK_RESULT_WARNING, 'Table comparison failed');

			$this->details .= "<p>The table definition differed from the exected structure: "
				. TTKHelpers::compareTable($_expectedResult, $data);
		}

		// Step 3: Add a field
		$data['columns']['donation'] = array (
					 'type' => 'decimal'
					,'length' => 3
					,'precision' => 2
					,'default' => 999.99
		);
		$step++;
		// Step 4: Check the results
		$_expectedResult = $this->getExpected($step);
		if ($data == $_expectedResult) { // Just 2 '=' signs since not all datatypes (int vs string) might match
			$returnCodes[] = array(TTK_RESULT_SUCCESS, 'Table comparison succeeded');
		} else {
			$returnCodes[] = array(TTK_RESULT_FAIL, 'Table comparison failed');

			$this->details .= "<p>The table definition differed from the exected structure: "
				. TTKHelpers::compareTable($_expectedResult, $data);
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

	private function getExpected ($_step)
	{
		$_c =  array(
			 'columns' => array(
				 'id' => array(
					  'type' => 'int'
					, 'length' => '11'
					, 'unsigned' => ''
					, 'zerofill' => ''
					, 'null' => ''
					, 'auto_inc' => '1'
					, 'default' => ''
					, 'comment' => ''
				)
				,'firstname' => array(
					  'type' => 'varchar'
					, 'length' => '24'
					, 'unsigned' => ''
					, 'zerofill' => ''
					, 'null' => ''
					, 'auto_inc' => '0'
					, 'default' => ''
					, 'comment' => ''
				)
				,'lastname' => array(
					  'type' => 'varchar'
					, 'length' => '48'
					, 'unsigned' => ''
					, 'zerofill' => ''
					, 'null' => ''
					, 'auto_inc' => '0'
					, 'default' => ''
					, 'comment' => ''
				)
				,'address' => array(
					  'type' => 'text'
					, 'null' => ''
					, 'auto_inc' => '0'
					, 'default' => ''
					, 'comment' => ''
				)
				,'phone' => array(
					  'type' => 'varchar'
					, 'length' => '16'
					, 'unsigned' => ''
					, 'zerofill' => ''
					, 'null' => '1'
					, 'auto_inc' => '0'
					, 'default' => ''
					, 'comment' => ''
				)
				,'country' => array(
					 'type' => 'enum'
					, 'null' => ''
					, 'auto_inc' => '0'
					, 'options' => array(
						  '0' => '\'NL\''
						, '1' => '\'BE\''
						, '2' => '\'DE\''
						, '3' => '\'FR\''
						, '4' => '\'ES\''
					)
					, 'default' => 'ES'
					, 'comment' => ''
				)
			)
			,'indexes' => array(
				  'PRIMARY' => array(
					  'columns' => array(
						  '0' => 'id'
					)
					, 'unique' => '1'
					, 'type' => 'BTREE'
					, 'comment' => ''
				)
				, 'name' => array(
					  'columns' => array(
						  '0' => 'firstname'
						, '1' => 'lastname'
						)
					, 'unique' => ''
					, 'type' => 'BTREE'
					, 'comment' => ''
				)
				, 'address' => array(
					  'columns' => array(
						  '0' => 'address'
					)
					, 'unique' => ''
					, 'type' => 'FULLTEXT'
					, 'comment' => ''
				)
			)
		);
		if ($_step == 2) {
			$_c['columns']['donation'] = array(
				  'type' => 'decimal'
				, 'length' => '3'
				, 'precision' => '2'
				, 'default' => '999.99'
			);
		}
		return $_c;
	}
}
