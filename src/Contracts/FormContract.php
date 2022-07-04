<?php


namespace Visanduma\LaravelFormy\Contracts;


use Illuminate\Http\Request;

interface FormContract
{
    public function inputs(): array;

    public function store(Request $request);

    public function update(Request $request);
}
