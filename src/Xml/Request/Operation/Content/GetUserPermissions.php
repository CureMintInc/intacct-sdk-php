<?php

/*
 * Copyright 2016 Intacct Corporation.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy 
 * of the License at
 * 
 * http://www.apache.org/licenses/LICENSE-2.0
 * 
 * or in the "LICENSE" file accompanying this file. This file is distributed on 
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either 
 * express or implied. See the License for the specific language governing 
 * permissions and limitations under the License.
 */

namespace Intacct\Xml\Request\Operation\Content;

use Intacct\Xml\Request\Operation\Content\FunctionInterface;
use InvalidArgumentException;
use XMLWriter;

class GetUserPermissions implements FunctionInterface
{
    
    /**
     *
     * @var string
     */
    private $controlId;
    
    /**
     *
     * @var string
     */
    private $userId;

    /**
     * 
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        $defaults = [
            'control_id' => 'getUserPermissions',
            'user_id' => null,
        ];
        $config = array_merge($defaults, $params);
        
        if (!$config['user_id']) {
            throw new InvalidArgumentException(
                'Required "user_id" key not supplied in params'
            );
        }
        
        $this->controlId = $config['control_id'];
        $this->userId = $config['user_id'];
    }
    
    /**
     * 
     * @param XMLWriter $xml
     */
    public function getXml(XMLWriter &$xml)
    {
        $xml->startElement('function');
        $xml->writeAttribute('controlid', $this->controlId);
        
        $xml->startElement('getUserPermissions');
        
        $xml->writeElement('userId', $this->userId);
        
        $xml->endElement(); //getUserPermissions
        
        $xml->endElement(); //function
    }
    
}
