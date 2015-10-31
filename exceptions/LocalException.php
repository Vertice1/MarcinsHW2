<?php
namespace MarcinsHW2\exceptions;
/**
* Local exception class
*
* @author Malgorzata Wierzchowska <vertice2@outlook.com>
* @version 0.2
*/


class LocalException extends Exception
{
	public function __construct($sMessage = "", $lCode = 0, $previous = null) {
		if (version_compare(PHP_VERSION, "5.3.0") < 0) {
			parent::__construct($sMessage, $lCode);
		}
		else {
			parent::__construct($sMessage, $lCode, $previous);
		}
	}
}