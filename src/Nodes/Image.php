<?php

namespace Scrumpy\HtmlToProseMirror\Nodes;

class Image extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'img';
    }

    public function data()
    {
        return [
            'type' => 'text',
            'text' => $this->DOMNode->getAttribute('src'),
            'marks' => [
                [
                    'type' => 'link',
                    'attrs' => [
                        'href' => $this->DOMNode->getAttribute('src'),
                        'class' => $this->getAlignmentClass(),
                        'alt' => $this->getAltText()
                    ],
                ],
            ],
        ];
    }

    private function getAlignmentClass()
    {
        if (method_exists($this->DOMNode, 'getAttribute')) {
            $domClass = $this->DOMNode->getAttribute('class');
            if (strpos($domClass, 'align-right') !== false) {
                return 'align-right';
            } else if (strpos($domClass, 'align-left') !== false) {
                return 'align-left';
            }
        }

        return null;
    }

    private function getAltText()
    {
        if (method_exists($this->DOMNode, 'getAttribute')) {
            return $this->DOMNode->getAttribute('alt');
        }

        return null;
    }
}
