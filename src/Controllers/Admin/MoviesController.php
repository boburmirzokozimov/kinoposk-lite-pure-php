<?php

namespace Application\Controllers\Admin;

use Application\Kernel\Controller\Controller;

class MoviesController extends Controller
{
    public function create(): void
    {
        $this->view('admin/movies/create');
    }

    public function store(): void
    {
        $rules = [
            'name' => 'required|min:3',
        ];

        $this->request()->validate($rules);

        if (!$this->request()->passes()) {
            foreach ($this->request()->errors() as $field => $error) {
                $this->session()->set($field, $error);
            }
            $this->redirect('/admin/movies/create');
        }
        dd($this->request()->validated($rules));
        dd('ss');
    }
}