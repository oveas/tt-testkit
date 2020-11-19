<?php
/**
 * \file
 * Test the List- and Item continers
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
 * Test the List- and Item continers
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version Nov 19, 2020 -- O van Eijk -- initial version
 */
abstract class containertestList implements Containertest
{

	static public function describeResult() : string
	{
		return '<p>This test generates a list with 5 items.<br/>'
				. 'The 3th item contains a nested list with 3 items, '
				. 'the 4th item contains a numbered list, with 2 items.</p>';
	}

	static public function testContainer() : string
	{
		$_l1 = new Container('list');
		$_l1->addContainer('item', 'Item 1');
		$_l1->addContainer('item', 'Item 2');

		$_l2 = new Container('list');
		$_l2->addContainer('item', 'Subitem 1');
		$_l2->addContainer('item', 'Subitem 2');
		$_l2->addContainer('item', 'Subitem 3');
		$_s1 = $_l1->addContainer('item', 'Item 3: unordered list');
		$_s1->addToContent($_l2);

		$_l3 = new Container('list');
		$_l3->setOrdered();
		$_l3->addContainer('item', 'Numbered item 1');
		$_l3->addContainer('item', 'Numbered item 2');
		$_s2 = $_l1->addContainer('item', 'Item 4: ordered list');
		$_s2->addToContent($_l3);

		$_l1->addContainer('item', 'Item 5 (last)');

		return $_l1->showElement();
	}
}