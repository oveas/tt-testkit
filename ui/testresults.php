<?php
/**
 * \file
 * \ingroup TTK_UI_LAYER
 * This file creates the area to show the testresults
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
 * \ingroup ICV_UI_LAYER
 * Setup the contentarea showing all testresults
 * \brief List knowledge
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version May 18, 2011 -- O van Eijk -- initial version
 */
class TestresultsArea extends ContentArea
{
	private $testKit;

	/**
	 * Show all results for a given testset
	 * \param[in] $arg Array with all results
	 */
	public function loadArea($arg = null)
	{
		$_html = '';
		if ($arg['containerTest'] === true) {
			// Containertests work slightly different since they can't be validated automatic.
			// Containertests will never be performed together other testsets.
			foreach ($arg['result'] as $_container => $_result) {
				$_html .= '<h2>Container ' . $_container  . '</h2>';
				$_html .= '<h3>' . $this->trn('Expected result') . '</h3>';
				$_html .= $_result[0];
				$_html .= '<h3>' . $this->trn('Actual result') . '</h3>';
				$_html .= $_result[1];
			}
		} else {
			$_html .= '<h2>' . $this->trn('Testset $p1$', array($arg['testset'])) . '</h2>';

			foreach ($arg['result'] as $_case => $_res) {
				$_html .= '<h3>' . $this->trn('Testcase $p1$', array($_case)) . '</h3>';
				$_counter = 0;
				foreach ($_res as $_step) {
					if (($_code = $_step[0]) === TTK_RESULT_NONE) {
						$_counter++;
						continue;
					}
					$_msg = $_counter++ . '. ' . $_step[1];
					switch ($_code) {
						case TTK_RESULT_FAIL :
							$_class = 'resultFail';
							break;
						case TTK_RESULT_SUCCESS :
							$_class = 'resultSuccess';
							break;
						case TTK_RESULT_WARNING :
							$_class = 'resultWarning';
							break;
						case TTK_RESULT_SKIPPED :
							$_class = 'resultSkipped';
							break;
					}
					$_div = new Container('div', array('class' => $_class));
					$_div->setContent($_msg);
					$_html .= $_div->showElement();
				}
			}
			if ($arg['details']) {
				$_div = new Container('div', array('class' => 'resultDetails'));
				$_c = '<h3>' . $this->trn('Details') . '</h3>' . $arg['details'];
				$_div->setContent($_c);
				$_html .= $_div->showElement();
			}
		}

		$this->contentObject = new Container('div', array('class' => 'testArea'));
		$this->contentObject->setContent($_html);
	}
}
