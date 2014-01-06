<?php
/**
 * \file
 * This file defines TTK mainclass
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
 * Class that contains all methods that will be called by the TT dispatchers
 * \brief TTK mainclass
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version May 19, 2011 -- O van Eijk -- initial version
 */class TTK extends _TT
{
	/**
	 * Reference to the Testkit containerobject
	 */
	private $testKit;

	/**
	 * Class constructor
	 * \author Oscar van Eijk, Oveas Functionality Provider
	 */
	public function __construct()
	{
		parent::init(__FILE__, __LINE__);
		$this->testKit = TT::factory('testkit', TTK_SO);
	}

	/**
	 * Load the area from which the testsets can be selected for execution
	 * \author Oscar van Eijk, Oveas Functionality Provider
	 */
	public function selectTestCases ()
	{
		if (($_area = TTloader::getArea('testsets', TTK_UI)) !== null) {
			$_area->addToDocument($GLOBALS['TTK']['BodyContainer']);
		}
	}

	/**
	 * Read from the formdata which testsets must be executed and perform those tests.
	 * \author Oscar van Eijk, Oveas Functionality Provider
	 */
	public function doTests()
	{
		$_form = TT::factory('FormHandler');
		$_sets = $_form->get('set');
		if (count($_sets) > 0) {
			foreach ($_sets as $_set => $_val) {
				if ($_val) {
					$this->testKit->performTests($_set);
				}
			}
		}
	}

}
