<?php
//
// This code and all components (c) Copyright 2006 - 2016, Wowza Media Systems, LLC. All rights reserved.
// This code is licensed pursuant to the Wowza Public License version 1.0, available at www.wowza.com/legal.
//
namespace Com\Wowza;

use Com\Wowza\Entities\Application\Helpers\Settings;

class DvrStreamRecord extends Wowza
{
    protected $name = "";
    protected $_applicationName = "live";
    protected $_applicationInstance = "_definst_";

    public function __construct(
        Settings $settings,
        $appName = null,
        $streamGroupName = null,
        $serverInstance = "_defaultServer_",
        $vhostInstance = "_defaultVHost_"
    ) {
        parent::__construct($settings);

        $this->restURI = $this->getHost() . "/dvrstreamrecord";

        if (!is_null($appName)) {
            $this->_applicationName = $appName;
        }

        if (!is_null($streamGroupName)) {
            $this->name = $streamGroupName;
        }
    }

    public function record($action = "start", $recordingName = null) {
        $queryParams = "app={$this->_applicationName}&streamgroupname={$this->name}&action={$action}";

        if (!is_null($recordingName)) {
            $queryParams .= "&recordingname={$recordingName}";
        }

        $response = $this->sendRequest($this->preparePropertiesForRequest(self::class), [], self::VERB_POST, $queryParams);

        return $response;
    }
}
