<?php
/**
 * \file
 * \ingroup TTK_UI_LAYER
 * This file creates the area to list testsets
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
if (!TTloader::getClass('form')) {
	trigger_error('Error loading the Form class', E_USER_ERROR);
}
/**
 * \ingroup ICV_UI_LAYER
 * Setup the contentarea showing all testcases
 * \brief List knttedge
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version May 18, 2011 -- O van Eijk -- initial version
 */
class TestsetsArea extends ContentArea
{
	private $testKit;

	/**
	 * Show the list to select available testcases
	 * \param[in] $arg Not used here but required by ContentArea
	 */
	public function loadArea($arg = null)
	{
		// Create a new form
		$_form = new Form(
			  array(
				 'application' => 'TT TestKit'
				,'include_path' => 'TTK_BO'
				,'class_file' => 'ttk'
				,'class_name' => 'TTK'
				,'method_name' => 'doTests'
			)
			, array(
				 'name' => 'testsetForm'
			)
		);

		$_table = new Container('table', array('style'=>'border: 0px;'));

		$this->testKit = TT::factory('testkit', TTK_SO);
		$_sets = $this->testKit->getTestSets();

		foreach ($_sets as $_name => $_class) {
			$_row = $_table->addContainer('row');
			$_fld = $_form->addField('checkbox', "set[$_name]", 1);
			$_row->addContainer('cell', $_form->showField("set[$_name]"));
			$_lbl = $_class::getDescription() . '<br/>';
			$_cntnr = new Container('label', array(), array('for' => &$_fld));
			$_cntnr->setContent($_lbl);
			$_cell = $_row->addContainer('cell');
			$_cell->setContent($_cntnr);
			$_class::getAdditionalData($_table, $_form);
		}

		$_row = $_table->addContainer('row');
		$_form->addField('submit', 'act', $this->trn('Start tests'));
		$_row->addContainer(
			 'cell'
			,$_form->showField('act')
			,array('style'=>'text-align:center;')
			,array('colspan'=>2)
		);

		$_fldSet = new Container('fieldset');
		$_fldSet->setContent($_table);
		$_fldSet->addContainer('legend', $this->trn('Available testsets'));
		$_form->addToContent($_fldSet);

		$this->contentObject = new Container('div', array('class' => 'testArea'));
		$this->contentObject->addToContent($_form);
	}
}
