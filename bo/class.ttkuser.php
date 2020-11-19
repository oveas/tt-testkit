<?php
/**
 * \file
 * This file defines the TT TestKit user class
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
 * \ingroup TTK_BO_LAYER
 * User class.
 * \brief TTK User
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version May 23, 2011 -- O van Eijk -- initial version
 */
class TTKUser extends User
{
	/**
	 * Self reference
	 */
	private static $instance;

	/**
	 * Object constructor; private, since we want this to be a singleton here
	 */
	private function __construct()
	{
		parent::construct();
		TTKUser::$instance = $this;
	}

	/**
	 * Instantiate the singleton or return its reference
	 */
	static public function getReference()
	{
		if (!TTKUser::$instance instanceof TTKUser) {
			TTKUser::$instance = new self();
		}
		return TTKUser::$instance;
	}

	/**
	 * Show the main options
	 */
	public function showTestMenu()
	{
		if (($_mnu = TTloader::getArea('testmenu', TTK_UI)) !== null) {
			$_mnu->addToDocument(TTCache::get(TTCACHE_OBJECTS, 'mainMenuContainer'));
		}
	}

	/**
	 * Display the page with testoptions
	 */
	public function showTestOpts ()
	{
		require (TTK_SO . '/class.testkit.php');
		TT::factory('Dispatcher')->dispatch('TTK#TTK_BO#ttk#TTK#selectTestCases');
	}

	/**
	 * Perform all container tests.
	 * This test calls the Container tests directly. Containertests are located in the container directory
	 * in TTK_TESTSETS and have the name 'ct.&gt;containerName&lt;.php.
	 */
	public function performContainerTests ()
	{
		if (!TTloader::getInterface('Containertest', TTK_TESTSETS . '/container')) {
			trigger_error('Error loading the Containertest class', E_USER_ERROR);
		}
		$testResults = array('containerTest' => true, 'result' => array());

		if ($dH = opendir(TTK_TESTSETS . '/container')) {
			while (($fName = readdir($dH)) !== false) {
				if ($fName != '.' && $fName != '..' && !is_dir(TTK_TESTSETS . '/container/' . $fName)) {
					if (preg_match('/ct\.(\w*)\.php/', $fName, $_matches)) {
						$_className = ucfirst($_matches[1]);
						$_testCase = 'containertest' . $_className;
						require(TTK_TESTSETS . '/container/' . $fName);
						$testResults['result'][$_className] = array($_testCase::describeResult(), $_testCase::testContainer());
					}
				}
			}
			$_area = TTloader::getArea('testresults', TTK_UI, $testResults);
			$_area->addToDocument();
		}
		closedir($dH);

	}
}
