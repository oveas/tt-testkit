<?php
/**
 * \file
 * \ingroup TTK_UI_LAYER
 * This file creates the TTK main page
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
 * \ingroup TTK_UI_LAYER
 * Setup the contentarea holding the main menu
 * \brief Test manu
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version Apr 11, 2014 -- O van Eijk -- initial version
 */
class TestoptsArea extends ContentArea
{
	/**
	 * Generate the link
	 * \param[in] $arg Not used here, but required by syntax
	 */
	public function loadArea($arg = null)
	{
		$this->contentObject = new Container('div');
		
		$_form = TT::factory('FormHandler');
		$_d = $_form->get(TT_DISPATCHER_NAME);
		if ($_form->getStatus() === FORM_NOVALUE || !$_d) {
			// Create the body container
			$dispatcher->dispatch('TT TestKit#TTK_BO#ttk#TTK#selectTestCases');
		} else {
			$dispatcher->dispatch(); // Run the tests. All output will be echoed immediatly
		}
		
	}
}
