<?php

namespace app\views\components;

interface IComponent
{
    function render():void;
    function getRenderString():string;
}
