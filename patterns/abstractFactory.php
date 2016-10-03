<?php

interface Footman {}
interface Transport {}
interface Weaponry {}

class AlienFootman implements Footman {}
class AlienTransport implements Transport {}
class AlienWeaponry implements Weaponry {}
class ZombieFootman implements Footman {}
class ZombieTransport implements Transport {}
class ZombieWeaponry implements Weaponry {}

abstract class AbstractFactoryRace
{
    abstract public function createFootman();
    abstract public function createTransport();
    abstract public function createWeaponry();
}

class ZombieFactory extends AbstractFactoryRace
{
    /**
     * @return Footman
     */

    public function createFootman()
    {
        return new ZombieFootman();
    }

    /**
     * @return Transport
     */

    public function createTransport()
    {
        return new ZombieTransport();
    }

    /**
     * @return Weaponry
     */

    public function createWeaponry()
    {
        return new ZombieWeaponry();
    }
}

class AlienFactory extends AbstractFactoryRace
{
    /**
     * @return Footman
     */
    
    public function createFootman()
    {
        return new AlienFootman();
    }

    /**
     * @return Transport
     */

    public function createTransport()
    {
        return new AlienTransport();
    }

    /**
     * @return Weaponry
     */

    public function createWeaponry()
    {
        return new AlienWeaponry();
    }
}