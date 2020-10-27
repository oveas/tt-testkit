<?php
/**
 * \ingroup TTK_TESTSETS
 * \file
 * This file defines some helper functions for the Translations testset
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
 * Return the toplevel to check. This is in a seperate function so it easier to perform this
 * test for another application (but still the change must be made manually in the code!)
 * \return Toplevel of te application
 * \author Oscar van Eijk, Oveas Functionality Provider
 */
function TTKTranslations_topLocation ()
{
	return TT_ROOT;
}

/**
 * Return the location for lib files for the given application code
 * \param[in] $_appCode Application code
 * \return Library location
 * \author Oscar van Eijk, Oveas Functionality Provider
 */
function TTKTranslations_libLocation ($_appCode)
{
	if ($_appCode == TT_CODE) {
		return TT_LIBRARY;
	} else {
		return TT_APPS_ROOT . '/' . strtolower($_appCode) . '/lib';
	}
}
