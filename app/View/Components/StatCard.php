<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public string $name;
    public string $value;
    /**
     * @var null
     */
    public ?string $type = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $value, ?string $type = null)
    {
        //
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.stat-card');
    }
}
