<?php
/**
 * \file
 * \ingroup TTK_UI_LAYER
 * This file creates the TTK main menu
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
 * \version Apr 10, 2014 -- O van Eijk -- initial version
 */
class TestmenuArea extends ContentArea
{
	/**
	 * Generate the link
	 * \param[in] $arg Not used here, but required by syntax
	 */
	public function loadArea($arg = null)
	{
		if ($this->hasRight('executetest', TTloader::getTTId('TTK')) === false) {
			return false;
		}

		// Create the container for menu items
		$this->contentObject = new Container('menu', array('class' => 'mainMenu'));

		// Home link
		$_txt = $this->trn('Testkit');
		$_lnk = new Container('link');
		$_lnk->setContent($_txt);
		$_lnk->setContainer(array(
				'dispatcher' => array(
						'application' => 'TTK'
						,'include_path' => 'TTK_BO'
						,'class_file' => 'ttkuser'
						,'class_name' => 'TTKUser'
						,'method_name' => 'showTestOpts'
				)
			)
		);
		$this->contentObject->addContainer('item', $_lnk);

		$_txt = $this->trn('Container tests');
		$_lnk = new Container('link');
		$_lnk->setContent($_txt);
		$_lnk->setContainer(array(
				'dispatcher' => array(
					'application' => 'TTK'
					,'include_path' => 'TTK_BO'
					,'class_file' => 'ttkuser'
					,'class_name' => 'TTKUser'
					,'method_name' => 'performContainerTests'
				)
			)
		);
		$this->contentObject->addContainer('item', $_lnk);
	}
}
