<?php
/**
 * \file
 * This file loads the OWL Test Kit application
 * \ingroup OTK_LIBRARY
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \copyright{2011-2013} Oscar van Eijk, Oveas Functionality Provider
 * \license
 * This file is part of OTK.
 *
 * OTK is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 *
 * OTK is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OTK. If not, see http://www.gnu.org/licenses/.
 */

/*
 * Register this class and all status codes
 */
Register::registerApp (OWLloader::getCurrentAppName(), 0xff000001);

// Set up the label translations
Register::registerLabels();


/**
 * \name Global constants
 * These constants are used OWL Test Kit wide
 * @{
 */
//! OWL Test Kit business objects
define ('OTK_BO', OWLloader::getCurrentAppUrl() . '/bo');

//! OWL Test Kit storage objects
define ('OTK_SO', OWLloader::getCurrentAppUrl() . '/so');

//! OWL Test Kitw layout objects
define ('OTK_UI', OWLloader::getCurrentAppUrl() . '/ui');

//! OWL Test Kit stylesheets
define ('OTK_CSS', OWLloader::getCurrentAppUrl() . '/css');

//! Location of all testsets
define ('OTK_TESTSETS', OWLloader::getCurrentAppUrl() . '/testsets');
//! @}

if (!OWLloader::getClass('otkuser', OTK_BO)) {
	trigger_error('Error loading classfile OTKUser from '. OTK_BO, E_USER_ERROR);
}

OTKUser::getReference();
OWLloader::getClass('otkhelpers', OTK_BO);
