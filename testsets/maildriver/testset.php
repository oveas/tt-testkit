<?php
/**
 * \file
 * This file defines the testset for hierarchical data
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

if (!TTloader::getClass('schemehandler')) {
	trigger_error('Error loading the SchemeHandler class', E_USER_ERROR);
}

/**
 * \ingroup TTK_TESTSETS
 * This class defines the testsets for mail drivers
 * \brief Maildrivers testset
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version Jul 16, 2013 -- O van Eijk -- initial version
 */
class TTKMaildriver extends TestSet
{

	static public function getDescription ()
	{
		return 'This testset contains some tests to check mail drivers. During these tests, 3 different mail addresses will be used';
	}

	static public function getAdditionalData($table, $form)
	{
		self::getAddress($table, $form, 'Sender address', 'from');
		self::getAddress($table, $form, 'Recipient 1 (To)', 'to');
		self::getAddress($table, $form, 'Recipient 2 (Cc)', 'cc');
	}
	
	static private function getAddress ($table, $form, $label, $name)
	{
		$_row = $table->addContainer('row');
		$_cell = $_row->addContainer('cell');

		$_fld = $form->addField('text', $name, '', array('size' => 50));
		$_lbl = ContentArea::translate($label);
//		$_lbl = $label;
		$_cntnr = new Container('label', $_lbl, array('style' => 'display: block; float: left; width: 100px'), array('for' => &$_fld));
		$_cell = $_row->addContainer('cell');
		$_cell->setContent($_cntnr);
		$_cell->addToContent($form->showField($name));
		
//		$_row->addContainer('cell', $form->showField($name));
	}
}
