<?php
/**
 * \file
 * This file defines the TT TestKit helper class
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
 * Abstract class with some general functions.
 * \brief TTK Helper
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version May 26, 2011 -- O van Eijk -- initial version
 */
abstract class TTKHelpers
{
	/**
	 * Create a table with expected and actual testresults compared side by side
	 * \param[in] $expected The expected testresult
	 * \param[in] $actual The actual testresult
	 * \return HTML code
	 * \author Oscar van Eijk, Oveas Functionality Provider
	 */
	static public function compareTable($expected, $actual)
	{
		$table = new Container('table', array('style'=>'border: 1px; width: 100%;'));

		$hdrRow = $table->addContainer('row');
		$hdrRow->setHeader();
		$hdrRow->addContainer('cell', ContentArea::translate('Expected result'));
		$hdrRow->addContainer('cell', ContentArea::translate('Actual result'));
		$row = $table->addContainer('row');
		if (is_array($expected)) {
			$expected = print_r($expected, 1);
		}
		if (is_array($actual)) {
			$actual = print_r($actual, 1);
		}
		$row->addContainer('cell', '<pre>'.$expected.'</pre>', array(), array('valign' => 'top'));
		$row->addContainer('cell', '<pre>'.$actual.'</pre>', array(), array('valign' => 'top'));
		return $table->showElement();
	}
}
