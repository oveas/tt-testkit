<?php
/**
 * \file
 * This is installer for the TT Testkit
 * \ingroup TTK_ADMIN
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \copyright{2011-2013} Oscar van Eijk, Oveas Functionality Provider
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

// Toplevel where TT can be found
define ('TT_ROOT', dirname(dirname(dirname(__FILE__))));

require (TT_ROOT . '/TTinstaller.php');

$_applicationID = TTinstaller::installXMLFile('install.xml');

TTinstaller::enableApplication($_applicationID);

TTloader::getClass('TTrundown.php', TT_ROOT);
