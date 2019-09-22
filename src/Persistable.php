<?php


namespace BeeJee\App;


trait Persistable
{
    private $attrs = [];

    public function __set(string $name, $value)
    {
        $this->attrs[$name] = $value;
    }

    public function __get(string $name)
    {
        return $this->attrs[$name] ?? null;
    }

    public function fromArray(array $data)
    {
        $this->attrs = array_merge($this->attrs, $data);

        return $this;
    }
}