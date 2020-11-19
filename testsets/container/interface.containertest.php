<?php
/**
 * \file
 * A test for all Terra-Terra containers plugins
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \copyright{2020} Oscar van Eijk, Oveas Functionality Provider
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
 * \ingroup TTK_SO
 * Interface for all container tests.
 * Container tests must be located in the same directory. The filename must be 'ct.classname.php', the classname itself
 * must start with a single capital preceded by "containertest", e.g. the filename 'ct.table.php' contains classname
 * 'containertestTable'.
 * \brief Containertest interface
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version Nov 17, 2020 -- O van Eijk -- initial version
 */
interface Containertest
{
	/**
	 * The result for containertests cannot be checked automatic, so a descriptive string
	 * is displayed to allow the tester to compare the result.
	 * \return HTML text describing the expected layout
	 */
	static function describeResult() : string;

	/**
	 * Create one or more containers and add them to the Testresultsarea
	 * \return HTML output of the test
	 */
	static function testContainer() : string;
}