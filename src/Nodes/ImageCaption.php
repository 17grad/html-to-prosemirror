<?php

namespace Scrumpy\HtmlToProseMirror\Nodes;

class ImageCaption extends Node
{
    public function matching()
    {
        if (!in_array($this->DOMNode->nodeName, ['div', 'span'])) {
            return false;
        }

        if (method_exists($this->DOMNode, 'getAttribute')) {
            $domClass = $this->DOMNode->getAttribute('class');
            return (strpos($domClass, 'fr-inner') !== false);
        }

        return false;
    }

    public function data()
    {
        return [
            'type' => $this->DOMNode->nodeName,
            'class' => $this->DOMNode->getAttribute('class'),
        ];
    }
}
