<?php

namespace RedUNIT\Sqlite;

use RedUNIT\Sqlite as Sqlite;
use RedBeanPHP\Facade as R;

/**
 * Setget
 *
 * This class has been designed to test set/get operations
 * for a specific Query Writer / Adapter. Since RedBeanPHP
 * creates columns based on values it's essential that you
 * get back the 'same' value as you put in - or - if that's
 * not the case, that there are at least very clear rules
 * about what to expect. Examples of possible issues tested in
 * this class include:
 *
 * - Test whether booleans are returned correctly (they will become integers)
 * - Test whether large numbers are preserved
 * - Test whether floating point numbers are preserved
 * - Test whether date/time values are preserved
 * and so on...
 *
 * @file    RedUNIT/Sqlite/Setget.php
 * @desc    Tests whether values are stored correctly.
 * @author  Gabor de Mooij and the RedBeanPHP Community
 * @license New BSD/GPLv2
 *
 * (c) G.J.G.T. (Gabor) de Mooij and the RedBeanPHP Community.
 * This source file is subject to the New BSD/GPLv2 License that is bundled
 * with this source code in the file license.txt.
 */
class Setget extends Sqlite
{
	/**
	 * Test whether we can store DateTime objects and get them back
	 * as 'date-time' strings representing the same date and time.
	 *
	 * @return void
	 */
	public function testDateObject()
	{
		$dt = new \DateTime();
		$dt->setTimeZone( new \DateTimeZone( 'Europe/Amsterdam' ) );
		$dt->setDate( 1981, 5, 1 );
		$dt->setTime( 3, 13, 13 );
		asrt( setget( $dt ), '1981-05-01 03:13:13' );
		$bean = R::dispense( 'bean' );
		$bean->dt = $dt;
	}

	/**
	 * Test numbers.
	 *
	 * @return void
	 */
	public function testNumbers()
	{
		asrt( setget( "-1" ), "-1" );
		asrt( setget( -1 ), "-1" );
		asrt( setget( "-0.25" ), "-0.25" );
		asrt( setget( -0.25 ), "-0.25" );
		asrt( setget( "1.0" ), "1" );
		asrt( setget( 1.0 ), "1" );
		asrt( setget( "0.12345678" ), "0.12345678" );
		asrt( setget( 0.12345678 ), "0.12345678" );
		asrt( setget( "-0.12345678" ), "-0.12345678" );
		asrt( setget( -0.12345678 ), "-0.12345678" );
		asrt( setget( "2147483647" ), "2147483647" );
		asrt( setget( 2147483647 ), "2147483647" );
		asrt( setget( -2147483647 ), "-2147483647" );
		asrt( setget( "-2147483647" ), "-2147483647" );
		asrt( setget( "2147483648" ), "2147483648" );
		asrt( setget( "-2147483648" ), "-2147483648" );
		$x = setget( "199936710040730" );
		asrt( $x === "199936710040730"  || $x === "1.9993671004073E+14", TRUE );
		$x = setget( "-199936710040730" );
		asrt( $x === "-199936710040730"  || $x === "-1.9993671004073E+14", TRUE );
		//asrt( setget( "199936710040730" ), "199936710040730" );
		//asrt( setget( "-199936710040730" ), "-199936710040730" );
	}

	/**
	 * Test dates.
	 *
	 * @return void
	 */
	public function testDates()
	{
		asrt( setget( "2010-10-11" ), "2010-10-11" );
		asrt( setget( "2010-10-11 12:10" ), "2010-10-11 12:10" );
		asrt( setget( "2010-10-11 12:10:11" ), "2010-10-11 12:10:11" );
		asrt( setget( "x2010-10-11 12:10:11" ), "x2010-10-11 12:10:11" );
	}

	/**
	 * Test strings.
	 *
	 * @return void
	 */
	public function testStrings()
	{
		asrt( setget( "a" ), "a" );
		asrt( setget( "." ), "." );
		asrt( setget( "\"" ), "\"" );
		asrt( setget( "just some text" ), "just some text" );
	}

	/**
	 * Test booleans.
	 *
	 * @return void
	 */
	public function testBool()
	{
		asrt( setget( TRUE ), "1" );
		asrt( setget( FALSE ), "0" );
		asrt( setget( "TRUE" ), "TRUE" );
		asrt( setget( "FALSE" ), "FALSE" );
	}

	/**
	 * Test NULL.
	 *
	 * @return void
	 */
	public function testNull()
	{
		asrt( setget( "NULL" ), "NULL" );
		asrt( setget( "NULL" ), "NULL" );
		asrt( setget( NULL ), NULL );
		asrt( ( setget( 0 ) == 0 ), TRUE );
		asrt( ( setget( 1 ) == 1 ), TRUE );
		asrt( ( setget( TRUE ) == TRUE ), TRUE );
		asrt( ( setget( FALSE ) == FALSE ), TRUE );
	}
}
