<?php

namespace Programs\Parkcms\Ticker;

use Parkcms\Programs\Admin\Editor as BaseEditor;

use Programs\Parkcms\Ticker\Models\Ticker;

class Editor extends BaseEditor
{
    public function register()
    {
        // $this->addEndpoint('index', 'index');
        // $this->addEndpoint('update', 'update');
        $this->addResourceEndpoint('', $this);
    }

    public function index($properties)
    {
        //$identifier = $properties['lang'] . $properties['page'] . '-' . $properties['identifier'];

        $page = (isset($properties['global']) && $properties['global'] === 'global') ? false : $properties['page'];

        if ($page) {
            $ticker = Ticker::where('identifier', $properties['lang'] . '-' . $properties['page'] . '-' . $properties['identifier'])->with('items')->first();
        } else {
            $ticker = Ticker::where('identifier', $properties['lang'] . '-' . $properties['identifier'])->with('items')->first();
        }

        $table = $this->makeField('Table');

        $table->setHeaders(array('title' => 'Title', 'description' => 'Description'));

        $table->setButtons(array(
            array(
                'action'    => 'edit',
                'title'     => 'Edit',
                'content'   => 'Edit'
            ),
            array(
                'action'    => 'delete',
                'title'     => 'Delete',
                'content'   => 'Delete'
            )
        ));

        $table->setRows($ticker->items);

        return $table;
    }

    public function create()
    {
        return 'Create';
    }

    public function update($properties)
    {
        $form = $properties['form'];

        //dd($properties);

        $page = (isset($properties['global']) && $properties['global'] === 'global') ? false : $properties['route'];

        $model = Model::byContext($properties['lang'], $page, $properties['identifier'])->first();

        //dd($model->text);

        $model->text = $form['text'];

        $model->save();

        return array('message' => 'Field updated successfully', 'type' => 'success', 'redirect' => 'index');
    }
}