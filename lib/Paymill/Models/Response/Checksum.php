<?php

namespace Paymill\Models\Response;

/**
 * Checksum Model
 *
 * A checksum validation is a simple method to nearly ensure the integrity of transferred data.
 * Basically we generate a hash out of the over given parameters and your private key.
 * If you send us a request with transaction data and the generated checksum, we can easily validate the data
 * because we know your private key and the used hash algorithm.
 * To make the checksum computation as easy as possible we provide this endpoint for you.
 * @tutorial https://paymill.com/de-de/dokumentation/referenz/api-referenz/#document-checksum
 */
class Checksum
{
    /**
     * @var string
     */
    private $_checksum = null;
    private $_livemode = false;

    /**
     * Returns the checksum
     * @return string
     */
    public function getChecksum()
    {
        return $this->_checksum;
    }

    /**
     * Sets the checksum
     * @param string $val
     * @return \Paymill\Models\Response\Checksum
     */
    public function setChecksum($val)
    {
        $this->_checksum = $val;
        return $this;
    }

    /**
     * Returns the livemode flag of the checksum
     * @return boolean
     */
    public function getLivemode()
    {
        return $this->_livemode;
    }

    /**
     * Sets the livemode flag of the checksum
     * @param boolean $livemode
     * @return \Paymill\Models\Response\Checksum
     */
    public function setLivemode($livemode)
    {
        $this->_livemode = $livemode;
        return $this;
    }
}
