<?php


namespace App\Traits\Sidebar;


trait Catalog
{
    private function getSidebar()
    {
        return ['currentUrl' => url()->current(), 'routes' => $this->generateRoutes()];
    }

    private function generateRoutes()
    {
        return [
            [
                'index' => 'Gamintojai',
                'route' => route('admin.manufacturer.index'),
            ],
            [
                'index' => 'Produktų linijos',
                'route' => route('admin.productline.index'),
            ],
            [
                'index' => 'Produktai',
                'route' => route('admin.product.index'),
            ],
            [
                'index' => 'Mato vienetai',
                'route' => route('admin.unitvalue.index'),
            ],
            [
                'index' => 'Kategorijos',
                'route' => route('admin.category.index')
            ],
        ];
    }
}
