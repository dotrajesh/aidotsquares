<?php

/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */
namespace WPMailSMTP\Vendor\Google\Service\Gmail;

class PopSettings extends \WPMailSMTP\Vendor\Google\Model
{
    /**
     * @var string
     */
    public $accessWindow;
    /**
     * @var string
     */
    public $disposition;
    /**
     * @param string
     */
    public function setAccessWindow($accessWindow)
    {
        $this->accessWindow = $accessWindow;
    }
    /**
     * @return string
     */
    public function getAccessWindow()
    {
        return $this->accessWindow;
    }
    /**
     * @param string
     */
    public function setDisposition($disposition)
    {
        $this->disposition = $disposition;
    }
    /**
     * @return string
     */
    public function getDisposition()
    {
        return $this->disposition;
    }
}
// Adding a class alias for backwards compatibility with the previous class name.
\class_alias(\WPMailSMTP\Vendor\Google\Service\Gmail\PopSettings::class, 'WPMailSMTP\\Vendor\\Google_Service_Gmail_PopSettings');
