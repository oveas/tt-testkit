<?php
/**
 * \file
 * This file loads the TT Test Kit application
 * \ingroup TTK_LIBRARY
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

/*
 * Register this class and all status codes
 */
Register::registerApp (TTloader::getCurrentAppName(), 0x02000000);

// Set up the label translations
Register::registerLabels();


/**
 * \name Global constants
 * These constants are used TT Test Kit wide
 * @{
 */
//! TT Test Kit business objects
define ('TTK_BO', TTloader::getCurrentAppUrl() . '/bo');

//! TT Test Kit storage objects
define ('TTK_SO', TTloader::getCurrentAppUrl() . '/so');

//! TT Test Kitw layout objects
define ('TTK_UI', TTloader::getCurrentAppUrl() . '/ui');

//! TT Test Kit stylesheets
define ('TTK_CSS', TTloader::getCurrentAppUrl() . '/css');

//! Location of all testsets
define ('TTK_TESTSETS', TTloader::getCurrentAppUrl() . '/testsets');
//! @}

if (!TTloader::getClass('ttkuser', TTK_BO)) {
	trigger_error('Error loading classfile TTKUser from '. TTK_BO, E_USER_ERROR);
}

TTKUser::getReference();
TTloader::getClass('ttkhelpers', TTK_BO);
