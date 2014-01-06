<?php
/**
 * \file
 * This file defines the TT TestKit user class
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
 * User class.
 * \brief TTK User
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version May 23, 2011 -- O van Eijk -- initial version
 */
class TTKUser extends User
{
	/**
	 * Self reference
	 */
	private static $instance;

	/**
	 * Object constructor; private, since we want this to be a singleton here
	 */
	private function __construct()
	{
		parent::construct();
		TTKUser::$instance = $this;
	}

	/**
	 * Instantiate the singleton or return its reference
	 */
	static public function getReference()
	{
		if (!TTKUser::$instance instanceof TTKUser) {
			TTKUser::$instance = new self();
		}
		return TTKUser::$instance;
	}
}
