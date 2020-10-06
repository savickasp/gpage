<?php


namespace App\Forms\Validation;


class Manufacturer extends BasicValidator
{
    private $rules = [
        'name' => 'required|max:255|string|regex:/^[ą-žĄ-ŽA-Za-z0-9 _-]+$/',
        'slug' => 'required|max:100|string|regex:/^[A-Za-z0-9_-]+$/',
        'description' => 'nullable|string'
    ];

    private $messages = [
        'name.required' => 'Pavadinimas yra privalomas',
        'name.max' => 'Maksimalus pavadinimo ilgis 255 simboliai',
        'name.string' => 'Nekeist laukelio formato i kita !',
        'name.regex' => 'Panaudotas neleistinas simbolis(-iai). Galima naudoti raides a-z, A-Z, ą-ž, Ą-Ž, 0-9, " ", "-", "_"',
        'slug.required' => 'Url pavadinimas yra privalomas',
        'slug.max' => 'Maksimalus ilgis 100 simboliu',
        'slug.string' => 'Nekeist laukelio formato i kita !',
        'slug.regex' => 'Panaudotas neleistinas simbolis(-iai). Galima naudoti raides a-z, A-Z, ą-ž, Ą-Ž, 0-9, " ", "-", "_"',
        'description.string' => 'Nekeist laukelio formato i kita !',
    ];

    public function __construct()
    {
        parent::__construct($this->rules, $this->messages);
    }
}
