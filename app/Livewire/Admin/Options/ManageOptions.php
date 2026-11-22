<?php

namespace App\Livewire\Admin\Options;

Use App\Models\Option;
use Livewire\Component;

class ManageOptions extends Component
{

    public $options;

    public NewOptionForm $newOption;

    public function mount()
    {
        $this->options = Option::with('features')->get();
    }

    #[On('featureAdded')]
    public function updateOptionList()
    {
        $this->options = Option::with('features')->get();
    }

    public function addFeature()
    {
        $this->newOption->addFeature();
    }

    public function removeFeature($index)
    {
        $this->newOption->removeFeature($index);
    }

    public function deleteFeature(Feature $feature)
    {
        $feature->delete();
        $this->options = Option::with('features')->get();
    }

    public function deleteOption(Option $option)
    {
        $option->delete();
        $this->options = Option::with('features')->get();
    }

    public function addOption()
    {
        $rules = [
            'newOption.name' => 'required',
            'newOption.type' => 'required|in:1,2',
            'newOption.features' => 'required|array|min:1',
        ];

        foreach ($this->newOption['features'] as $index => $feature) {
            /* $rules['newOption.features.' . $index . '.value'] = 'required'; */

            if ($this->newOption['type'] == 1) {
                $rules['newOption.features.' . $index . '.value'] = 'required|numeric';
            } else {
                //Color
                $rules['newOption.features.' . $index . '.value'] = 'required|regex:/^[a-f0-9]{6}$/i';
            }

            $rules['newOption.features.' . $index . '.description'] = 'required|max:255';
        }

        $option = Option::create([
            'name' => $this->newOption['name'],
            'type' => $this->newOption['type'],
        ]);

        foreach ($this->newOption['features'] as $feature) {
            $option->features()->create([
                'value' => $feature['value'],
                'description' => $feature['description'],
            ]);
        }

        $this->newOption->save();

        $this->options = Option::with('features')->get();

        $this->reset('openModal', 'newOption');

        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'La opción se agregó correctamente',
        ]);
    }

    public function render()
    {
        return view('livewire.admin.options.manage-options');
    }
}