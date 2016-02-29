<?php

use Elab\Csmp\Blocks\Abs;
use Elab\Csmp\Blocks\Add;
use Elab\Csmp\Blocks\Amplify;
use Elab\Csmp\Blocks\ArcTan;
use Elab\Csmp\Blocks\CircuitDelay;
use Elab\Csmp\Blocks\Constant;
use Elab\Csmp\Blocks\Cos;
use Elab\Csmp\Blocks\DeadZone;
use Elab\Csmp\Blocks\Divide;
use Elab\Csmp\Blocks\Exp;
use Elab\Csmp\Blocks\FunctionGenerator;
use Elab\Csmp\Blocks\ImpulseGenerator;
use Elab\Csmp\Blocks\Integrator;
use Elab\Csmp\Blocks\Invert;
use Elab\Csmp\Blocks\IoT;
use Elab\Csmp\Blocks\Limiter;
use Elab\Csmp\Blocks\Multiply;
use Elab\Csmp\Blocks\NegativeLimiter;
use Elab\Csmp\Blocks\Offset;
use Elab\Csmp\Blocks\PositiveLimiter;
use Elab\Csmp\Blocks\Quit;
use Elab\Csmp\Blocks\Randomizer;
use Elab\Csmp\Blocks\Relay;
use Elab\Csmp\Blocks\Sign;
use Elab\Csmp\Blocks\Sin;
use Elab\Csmp\Blocks\Sqrt;
use Elab\Csmp\Blocks\Time;
use Elab\Csmp\Blocks\UnitDelay;
use Elab\Csmp\Blocks\Vacuous;
use Elab\Csmp\Blocks\Wye;

return [
    Abs::class,
    Add::class,
    Amplify::class,
    ArcTan::class,
    CircuitDelay::class,
    Constant::class,
    Cos::class,
    DeadZone::class,
    Divide::class,
    Exp::class,
    FunctionGenerator::class,
    ImpulseGenerator::class,
    Integrator::class,
    Invert::class,
    IoT::class,
    Limiter::class,
    Multiply::class,
    NegativeLimiter::class,
    Offset::class,
    PositiveLimiter::class,
    Quit::class,
    Randomizer::class,
    Relay::class,
    Sign::class,
    Sin::class,
    Sqrt::class,
    Time::class,
    UnitDelay::class,
    Vacuous::class,
    Wye::class,
];
