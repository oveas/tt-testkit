<?php
/**
 * \file
 * This file defines the testcase that checks untranslated messages codes
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
 * \ingroup TTK_TESTSETS
 * Check all messages codes that are registered with Register::registerCode() but not in the message file
 * \brief Check message codes
 * \author Oscar van Eijk, Oveas Functionality Provider
 * \version Jun 7, 2011 -- O van Eijk -- initial version
 */
class TTKTranslations_Messages implements TestCase
{
	// List of messages
	private $messages;

	// Hold details of the testresults
	private $details;

	// Array with return values
	private $returnCodes;

	// List of all status codes
	private $statusCodes;

	// Toplocation
	private $topLocation;

	// Location of the message file
	private $libLocation;

	// Application code
	private $applCode;

	public function __construct()
	{
		$this->details = '';
		$this->messages = array();
		$this->statusCodes = array(
			 'statusSet' => array() // All codes used in setStatus and TT::stat
			,'statusReg' => array() // All codes defined in registerCode
		);

		$this->topLocation = TTKTranslations_topLocation();
		$this->libLocation = TTKTranslations_libLocation();
		$this->applCode = TTKTranslations_applicCode();
	}

	public function prepareTest ()
	{
		// Load messages
		$_lang = ConfigHandler::get ('locale', 'lang');
		if (file_exists ($this->libLocation . '/' . $this->applCode . '.messages.' . $_lang . '.php')) {
			$file = $this->libLocation . '/' . $this->applCode . '.messages.' . $_lang . '.php';
		} elseif (file_exists ($this->libLocation . '/' . $this->applCode . '.messages.php')) {
			$file = $this->libLocation . '/' . $this->applCode . '.messages.php';
		} else {
			return 'No message file found for language code ' . $_lang . ' and the default file is missing';
		}
		$this->details .= 'Checking message file ' . $file . '<br/>';

		if (!($mFile = fopen($file, 'r'))) {
			return 'Error opening ' . $file;
		}

		while (($line = fgets($mFile, 1024)) !== false) {
			if (preg_match("/\s+,?\s*'([A-Z_]*)'\s+=>\s+'(.*?)'/i", $line, $match)) {
				$this->messages[$match[1]] = $match[2];
			}
		}
		fclose($mFile);
		return TTK_RESULT_SUCCESS;
	}

	public function performTest ()
	{
		$this->returnCodes = array();

		$this->checkDirectory ($this->topLocation);
		$this->checkCodes();
		if (count($this->returnCodes) == 0) {
			$this->returnCodes[] = array(TTK_RESULT_SUCCESS, "All messages codes have been registered");
		}
		return $this->returnCodes;
	}

	private function checkDirectory ($dir)
	{
		if (($dHandle = opendir($dir)) === false) {
			$this->returnCodes[] = array(TTK_RESULT_FAIL, "Error opening directory $dir for read");
			return;
		}
		while ($file = readdir($dHandle)) {
			if ($file == '.' || $file == '..') {
				continue;
			} elseif (is_dir ("$dir/$file")) {
				$this->checkDirectory("$dir/$file");
			} elseif (preg_match('/\.php$/', $file)) {
				$this->checkFile("$dir/$file");
			} else {
				; // No PHP file of subdirectory - nothing to do
			}
		}
		return;
	}

	private function checkFile ($file)
	{
		// TODO Existing TT codes are not checked when checking a different application
		if (($fHandle = fopen($file, 'r')) === false) {
			$this->returnCodes[] = array(TTK_RESULT_WARNING, "Error opening file $file for read");
			return;
		}
		$lineCounter = 0;
		while ($line = fgets($fHandle, 1024)) {
			$lineCounter++;
			$line = uncommentLine($line, TT_COMMENT_PHP);
			if (preg_match("/->setStatus\s*\((__FILE__)?\s*,?\s*(__LINE__)?\s*,?\s*([A-Z_]*?)[,\ \)]/i", $line, $matches)) {
				// TODO Might as well check for __FILE__ and __LINE__ here
				$this->statusCodes['statusSet'][$matches[3]] = array($file, $lineCounter);
			}
			if (preg_match("/TT::stat\s*\((__FILE__)?\s*,?\s*(__LINE__)?\s*,?\s*([A-Z_]*?)[,\ \)]/i", $line, $matches)) {
				// TODO Might as well check for __FILE__ and __LINE__ here
				$this->statusCodes['statusSet'][$matches[3]] = array($file, $lineCounter);
			}
			if (preg_match("/^\s*Register::registerCode\s*\('([A-Z_]*?)'\)/i", $line, $matches)) {
				$this->statusCodes['statusReg'][$matches[1]] = 1;
				if (!array_key_exists($matches[1], $this->messages)) {
					$this->returnCodes[] = array(TTK_RESULT_FAIL, "Message code $matches[1] does not appear in a message in file $file on line $lineCounter");
				} elseif ($this->messages[$matches[1]] == '') {
					$this->returnCodes[] = array(TTK_RESULT_WARNING, "Message code $matches[1] has no text in file $file on line $lineCounter");
				}
			}
		}
	}

	public function checkCodes()
	{
		foreach ($this->statusCodes['statusSet'] as $code => $where) {
			if (!array_key_exists($code, $this->statusCodes['statusReg'])) {
				$this->returnCodes[] = array(TTK_RESULT_FAIL, "Status code $code is used but never registered in file $where[0] on line $where[1]");
			}
		}
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
