<?php

/**
 * This file is part of the "dibi" project (http://dibi.texy.info/)
 *
 * @author     David Grudl
 * @copyright  Copyright (c) 2005-2007 David Grudl aka -dgx- (http://www.dgx.cz)
 * @license    New BSD License
 * @version    $Revision$ $Date$
 * @category   Database
 * @package    Dibi
 */


// security - include dibi.php, not this file
if (!class_exists('dibi', FALSE)) die();



/**
 * dibi exception class
 *
 */
class DibiException extends Exception
{
    private
        $sql,
        $dbError;


    public function __construct($message, $dbError = NULL, $sql = NULL)
    {
        $this->dbError = $dbError;
        $this->sql = $sql;

        parent::__construct($message);
    }


    final public function getSql()
    {
        return $this->sql;
    }


    final public function getDbError()
    {
        return $this->dbError;
    }



    public function __toString()
    {
        $s = parent::__toString();

        if ($this->dbError) {
            $s .= "\n\nDatabase error: ";
            if (isset($this->dbError['code']))
                $s .= "[" . $this->dbError['code'] . "] ";

            $s .= $this->dbError['message'];
        }

        if ($this->sql) $s .= "\nSQL: " . $this->sql;

        return $s;
    }

} // class DibiException
