<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use League\Tactician\CommandBus;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
