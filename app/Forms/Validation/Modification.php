<?php


namespace App\Forms\Validation;


class Modification extends BasicValidator
{
    private $rules = [
        'name' => 'required|max:255|string|regex:/^[ą-žĄ-ŽA-Za-z0-9 _-]+$/',
        'price' => 'nullable'
    ];

    private $messages = [
        'name.required' => 'Pavadinimas yra privalomas',
        'name.max' => 'Maksimalus pavadinimo ilgis 255 simboliai',
        'name.string' => 'Nekeist laukelio formato i kita !',
        'name.regex' => 'Panaudotas neleistinas simbolis(-iai). Galima naudoti raides a-z, A-Z, ą-ž, Ą-Ž, 0-9, " ", "-", "_"',
    ];

    public function __construct()
    {
        parent::__construct($this->rules, $this->messages);
    }
}
