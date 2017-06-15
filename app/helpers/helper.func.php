<?php
/**
 * @project App\r7r1n17y\Framework (Trinity Framework)
 * @copyright Copyright (c) 2017-2017 nephp. (https://github.com/nephp)
 */

namespace App\r7r1n17y\Framework;

/**
 * @name escape Use to escape any text so XSS
 * attacks are prevented.
 *
 * @returns The same var escaped
 */
function escape($value)
{

	/** Escape the var and then return it */
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

}
