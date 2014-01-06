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

if (!TTloader::getClass('datahandlerh')) {
	trigger_error('Error loading the DataHandelerH class', E_USER_ERROR);
}

/**
 * \ingroup TTK_TESTSETS
 * This class defines the testsets for the hierarchical data handler.
 * \brief HDataHandler testset
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version May 19, 2011 -- O van Eijk -- initial version
 */
class TTKHdata extends TestSet
{

	static public function getDescription ()
	{
		return 'This testset contains some test for the HDataHandler class, the class that works '
			. 'with hierarchical data.';
	}
}
