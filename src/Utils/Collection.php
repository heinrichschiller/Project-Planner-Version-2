<?php

/**
 *
 * MIT License
 *
 * Copyright (c) 2019 Heinrich Schiller
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 *
 */

namespace ProjectPlanner\Util;

class Collection
{
    private $_list = [];
    private $_key  = null;

    public function add($data, $key = null)
    {
        if ( $key == null) {
            $this->_list[] = $data;
        } else {
            if ( isset($this->_list[$key])) {
                throw new KeyHasUseException("Key $key alredy in use.");
            } else {
                $this->_list[$key] = $data;
            }
        } 
    }

    /**
     * Completly clear the collection.
     */
    public function clear()
    {
        $this->_list = [];
    }

    /**
     * Return the length of the collection.
     * 
     * @return integer - length of the collection.
     */
    public function length(): int
    {
        return count($this->_list);
    }

    public function get()
    {
        return $this->_list;
    }

    public function has(string $needle)
    {
        return in_array($needle, $this->_list);
    }

    public function item($item)
    {
        if ( isset($this->_list[$item])) {
            return $this->_list[$item];
        } else {
            throw KeyInvalidException("Invalid key $item");
        }
    }

    public function remove($key)
    {
        if (isset($this->_list[$key])) {
            unset($this->_list[$key]);
        } else {
            throw KeyInvalidException("Invalid key $key");
        }
    }

    public function keys()
    {
        return array_keys($this->_list);
    }

    public function firstKey()
    {
        // if your php-version is older than 7.3
        if (!function_exists('array_key_first')) {
            function array_key_first(array $arr) {
                foreach($arr as $key => $unused) {
                    return $key;
                }

                return null;
            }
        }

        return array_key_first($this->_list);
    }

    public function lastKey()
    {
        // if your php-version is older than 7.3
        if (!function_exists('array_key_last')) {
            function array_key_last(array $arr) {
                if ( !is_array($arr) || empty($arr)) {
                    return null;
                }

                return array_keys($arr)[count($arr) - 1 ];
            }
        }

        return array_key_last($this->_list);
    }
}