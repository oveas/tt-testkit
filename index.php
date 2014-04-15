<?php
/**
 * \file
 * This is the entry point for the Terra-Terra Testkit
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \copyright{2011-2014} Oscar van Eijk, Oveas Functionality Provider
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

// When testing, we wanna see *all* messages
error_reporting(E_ALL | E_STRICT);

// Doxygen setup
/**
 * \defgroup TTK_UI_LAYER Presentation modules
 * \defgroup TTK_BO_LAYER Business Object modules
 * \defgroup TTK_SO_LAYER Storage Object modules
 * \defgroup TTK_LIBRARY Library (codes, messages files etc.)
 * \defgroup TTK_ADMIN Administrator section
 * \defgroup TTK_TESTSETS Test sets
 * \defgroup TTK_TESTCASES Test cases
 */

// Setup the constants required by TT
/**
 * \name Required constants
 * These constants dare required by TT
 * @{
 */
//! Toplevel where TT can be found
define ('TT_ROOT', '/var/www/terra-terra');

//! We wanna use timers in the test application.
define ('TT_TIMERS_ENABLED', true);
//! @}

// Load TT
require (TT_ROOT . '/TTloader.php');

// Load myself
TTloader::loadApplication('TTK');

// Load the testsets
require (TTK_SO . '/class.testkit.php');

// Load the Main page layout
require (TTK_UI . '/mainpage.php');

TTloader::getClass('TTrundown.php', TT_ROOT);
/**
 * \mainpage
 * The Terra-Terra TestKit (TTK) is a <a href="http://docs.terra-terra.org/terra-terra/index.html">Terra-Terra</a> application that has been written for automated testing of the Terra-Terra
 * functionalitaty.
 * TTK contains a simple framework and testsets, which can be easily added by creating a new testset directory
 * and the required files (testset.php and one ore more testcases in case.*.php)
 *
 * For a description of the testset class, refer to the documentation of the TestSet base class. Testcases should
 * implement the TestCase base class.
 *
 * TTK can be downloaded from <a href="https://github.com/oveas/tt-testkit">GitHub</a>
 *
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \copyright{2011-2014} Oscar van Eijk, Oveas Functionality Provider
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
