<?php
use eftec\bladeone\BladeOne;

$view  = './app/Views'; // dinh nghia thu muc chia view!
$cache = './app/Cache'; // thu muc cache cho bladeone
// khoi tao
$blade = new BladeOne($view,$cache);
