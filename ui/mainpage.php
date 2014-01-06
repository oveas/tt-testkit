<?php
/**
 * \file
 * Main layout page for the TT Test Kit. Here, all containers and content areas are filled
 * and the actual page is displayed.
 * \ingroup TTK_UI_LAYER
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

// First, get all required instances
$dispatcher = TT::factory('Dispatcher');
$document   = TT::factory('Document', 'ui');
// Load the stypesheet
$document->loadStyle(TTK_CSS . '/testkit.css');

// Create the header container
$GLOBALS['TTK']['HeaderContainer'] = new Container('div', '', array('class' => 'headerContainer'));

// Create the 'Home' link
$_home = TTloader::getArea('mainmenu', TTK_UI);
$_home->addToDocument($GLOBALS['TTK']['HeaderContainer']);

// Make a check first to see if we are gonna execute tests (don't wait for the dispatcher)
$_form = TT::factory('FormHandler');
$_d = $_form->get(TT_DISPATCHER_NAME);
if ($_form->getStatus() === FORM_NOVALUE || !$_d) {
	// Create the body container
	$GLOBALS['TTK']['BodyContainer'] = new Container('div', '', array('class' => 'bodyContainer'));
	$dispatcher->dispatch('TT TestKit#TTK_BO#ttk#TTK#selectTestCases');
	// Add the containers to the document
	$document->addToContent($GLOBALS['TTK']['HeaderContainer']);
	$document->addToContent($GLOBALS['TTK']['BodyContainer']);
	// Display the document
	OutputHandler::outputRaw($document->showElement());
} else {
	// Show the contents immedialty (without using a header container) to make sure we
	// don't have to wait 'til all tests are completed
	$document->addToContent($GLOBALS['TTK']['HeaderContainer']);
	OutputHandler::outputRaw($document->showElement());
	$dispatcher->dispatch(); // Run the tests. All output will be echoed immediatly
}

