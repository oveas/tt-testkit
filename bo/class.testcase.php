<?php
/**
 * \file
 * This file defines the testcase interface
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
 * \ingroup TTK_BO
 * Interface that defines the testcase classes. Classes that implement this interface must be
 * in a file called 'case.&lt;casename&gt;.php'. The classname must be 'TTK&lt;Setname&gt;_&lt;Casename&gt;
 * where &lt;casename&gt; is the name of the testcase and &lt;setname&gt; the name of the testset it
 * belongs to.
 *
 * Two special casenames are reserverd: <em>first</em> and <em>last</em>, which will be the first and
 * last testcases executed in a testset.
 * \brief Testcase
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version May 19, 2011 -- O van Eijk -- initial version
 */
interface TestCase {

	/**
	 * Class constuctor. All testcases must be implemented.
	 * \author Oscar van Eijk, Oveas Functionality Provider
	 */
	public function __construct();

	/**
	 * Prepare a testcase, e.g. create some database tables that are required for this testcase.
	 * \return TTK_RESULT_SUCCESS on success, TTK_RESULT_NONE when this testcase needs no preparation or
	 * an error message when failed
	 * \author Oscar van Eijk, Oveas Functionality Provider
	 */
	public function prepareTest ();

	/**
	 * Perform the test(s) for this testcase. Multiple tests can be performed, each writing a single
	 * message in an internal array explaining what the result was ('step X completed succefully', an
	 * error message in case of failures etc).
	 * Additional (private) methods can be created for each step.
	 * \return A 2 dimensional array with messages for all steps that were performed in this testcase.
	 * Each step in the testcase has exactly 1 element in the array, being an array with 2 elements: first
	 * is the code as defined in \ref Test_Results, the second is an human readable message.
	 * null when the step was skipped, e.g.
	 * \code
	 * 	array(
	 * 		 array(TTK_RESULT_SUCCESS, 'Step 1 completed successfully')
	 * 		,array(TTK_RESULT_SUCCESS, 'Step 2 completed successfully')
	 * 		,array(TTK_RESULT_FAIL, 'Step 3 failed with code XX')
	 * 		,array(TTK_RESULT_SKIPPED, 'Step 4 could not execute because step 3 failed')
	 * 	)
	 * \endcode
	 * \author Oscar van Eijk, Oveas Functionality Provider
	 */
	public function performTest ();

	/**
	 * Cleanup the testenvironment, e.g. drop temporary tables
	 * \return TTK_RESULT_SUCCESS on success, TTK_RESULT_NONE when this testcase needs no cleanup or
	 * an error message when failed
	 * \author Oscar van Eijk, Oveas Functionality Provider
	 */
	public function cleanupTest ();

	/**
	 * Gather all testdetails. During the tests, the testcase can collect all additional information
	 * in an internal datastructure, e.g. further details or explanations concerning failed tests.
	 * After finishing the testcase (and after cleanupTest()), the information will be retrieved.
	 * \return Tekstblock, can contain HTML. Null and an empty textstring are allowed if no details
	 * are available.
	 * \author Oscar van Eijk, Oveas Functionality Provider
	 */
	public function getDetails ();
}
