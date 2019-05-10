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

namespace View;

class View
{
    protected $_template = '';

    public function __construct(string $tpl)
    {
        $this->_template = $tpl;
    }

    public function renderTemplate(array $data)
    {
        extract($data);

        ob_start();

        $template = $this->_getTemplate();

        include  __DIR__ . '/../templates/main.phtml';

        $html = ob_get_contents();

        ob_end_clean();

        return $html;
    }

    private function _getTemplate()
    {
        $template = __DIR__ . '/../templates/' . $this->_template;

        if(!file_exists($template)) {
            throw new \Exception('Template:' . $this->_template . ' not found.');
        }

        return $template;
    }
}
