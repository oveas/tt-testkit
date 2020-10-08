<?php
/**
 * \file
 * This file defines the testcase that sends an email
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
 * \ingroup TTK_TESTSETS
 * This testcase sends an email using a From, To and Cc address.
 * \brief MailDriver Sendmail testcase
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version Oct 7, 2020 -- O van Eijk -- initial version
 */
class TTKMaildriver_Sendmail implements TestCase
{
	// From address
	private $from;

	// To address
	private $to;

	// Cc address
	private $cc;

	// Hold details of the testresults
	private $details;

	public function __construct()
	{
		$_form = TT::factory('FormHandler');

		$this->from = $_form->get('from');
		$this->to   = $_form->get('to');
		$this->cc   = $_form->get('cc');

		$this->details = '';
	}

	public function prepareTest ()
	{
		return TTK_RESULT_NONE;
	}

	public function performTest ()
	{
		$returnCodes = array();
		TTloader::getClass('mail');
		$_mailer = new Mail();

		$_from = $_mailer->makeDisplayableAddress($this->from, array('name' => 'Terra-Terra mailer'));
		$_mailer->setFrom($_from);
		$_mailer->addTo($this->to);
		$_mailer->addCc($this->cc);

		$step = 1;
		$_mailer->setSubject("Testmail 1 from TTK");
		$_mailer->setBody('This is the first testmail from the Terra-Terra testkit');

		if ($_mailer->send() <= TT_SUCCESS) {
			$returnCodes[] = array(TTK_RESULT_SUCCESS, 'Successfully sent the mail - please check the recipients mailboxes');
		} else {
			$_mailer->signal(TT_WARNING, $msg);
			$returnCodes[] = array(TTK_RESULT_FAIL, 'Sending an email failed in step 1');
			$this->details .= "<p>Mailer returned an error while sending:<blockquote>$msg</blockquote>";
		}
		return $returnCodes;
	}

	public function cleanupTest ()
	{
		return TTK_RESULT_NONE;
	}

	public function getDetails ()
	{
		return $this->details;
	}
}
