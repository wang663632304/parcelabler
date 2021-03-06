<?php
/*
 * Copyright 2013 MeetMe, Inc.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *     http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Implements a transformation of the given List subclass
 */
class ListTransformer implements Transformer {
  private $mTypeSuffix;

  public function __construct( $typeSuffix ) {
    $this->mTypeSuffix = $typeSuffix;
  }

  public function getWriteCode( CodeField $field ) {
    return 'dest.writeList(' . $field->getName() . ');';
  }

  public function getReadCode( CodeField $field ) {
    $code  = $field->getName() . ' = new ' . $this->mTypeSuffix . '<' . $field->getTypeParam() . '>' . '();' . "\n";
    $code .= 'in.readList(' . $field->getName() . ', null);';
    return $code;
  }
}
