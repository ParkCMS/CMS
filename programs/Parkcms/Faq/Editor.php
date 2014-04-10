<?php

namespace Programs\Parkcms\Faq;

use Parkcms\Programs\Admin\Editor as BaseEditor;

use Programs\Parkcms\Faq\Models\Faq;
use Programs\Parkcms\Faq\Models\Question;

use Response;

class Editor extends BaseEditor
{
    public function register()
    {
        $this->addResourceEndpoint('', $this);
    }

    public function index($properties)
    {
        $faq = $this->getFaq($properties);

        $toolbar = $this->makeField('Toolbar');
        $toolbar->addButton('New Question', 'file', array('load-action' => 'create'));

        $table = $this->makeField('Table');

        $table->setHeaders(array('question' => 'Question'));

        $table->setButtons(array(
            array(
                'load-action'    => 'edit',
                'title'     => 'Edit',
                'content'   => 'Edit'
            ),
            array(
                'confirm-action'    => 'delete',
                'confirm-message'   => 'Do you really want to delete the selected entry?',
                'title'     => 'Delete',
                'content'   => 'Delete'
            )
        ));

        $table->setRows($faq->questions);

        return $toolbar->render() . $table->render();
    }

    public function create()
    {
        return $this->generateQuestionForm('store', 'post');
    }

    public function edit($properties)
    {
        $question = Question::find($properties['id']);

        if ($question === null) {
            return Response::json(array('error' => array('title' => 'FAQ Editor Error', 'message' => 'The given question with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        return $this->generateQuestionForm('update', 'put', $question);
    }

    public function update($properties)
    {
        $form = $properties['form'];

        $question = Question::find($form['id']);
        if ($question === null) {
            return Response::json(array('error' => array('title' => 'Ticker Editor Error', 'message' => 'The given question with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        $question->question = $form['question'];
        $question->answer = $form['answer'];

        if ($question->save()) {
            return array('success' => array('message' => 'Question updated successfully'), 'redirect' => 'index');
        } else {
            return array('error' => array('message' => 'The given question could not be saved!'), 'redirect' => 'index');
        }
    }

    public function store($properties)
    {
        $form = $properties['form'];

        $faq = $this->getFaq($properties);

        $item = new Question;

        $item->question = $form['question'];
        $item->answer = $form['answer'];
        $item->faq_id = $faq->id;

        if ($item->save()) {
            return array('success' => array('message' => 'Field created successfully'), 'redirect' => 'index');
        } else {
            return array('error' => array('message' => 'The given question could not be saved!'), 'redirect' => 'index');
        }
    }

    public function delete($properties)
    {
        $item = Question::find($properties['id']);

        if ($item === null) {
            return Response::json(array('error' => array('title' => 'FAQ Editor Error', 'message' => 'The given question with ID #' . $properties['id'] . ' was not found in the database!')), 404);
        }

        if ($item->delete()) {
            return array('success' => array('message' => 'Item deleted successfully'), 'redirect' => 'index');
        } else {
            return array('error' => array('message' => 'The given item could not be deleted!'), 'redirect' => 'index');
        }
    }

    private function getFaq($properties)
    {
        $page = (isset($properties['global']) && $properties['global'] === 'global') ? false : $properties['page'];

        if ($page) {
            $faq = Faq::where('identifier', $properties['lang'] . '-' . $properties['page'] . '-' . $properties['identifier'])->with('questions')->first();
        } else {
            $faq = Faq::where('identifier', $properties['lang'] . '-' . $properties['identifier'])->with('questions')->first();
        }

        return $faq;
    }

    private function generateQuestionForm($action, $method, $item = null)
    {
        $form = $this->makeField('Form');

        $form->setAction($action);
        $form->setMethod($method);

        $form->addFields(function($form) use ($item) {
            $question = $form->addField('Text', array(
                'name'  => 'question',
                'value' => '',
                'label' => 'Question:'
            ));

            $answer = $form->addField('Content', array(
                'name'  => 'answer',
                'value' => '',
                'label' => 'Answer:'
            ));

            if ($item !== null)
            {
                $question->setValue($item->question);
                $answer->setValue($item->answer);
                $id = $form->addField('Text', array(
                    'type'  => 'hidden',
                    'name'  => 'id',
                    'value' => $item->id
                ));
            }
        });

        $form->addSubmit('Save');
        $form->addButton('Cancel', 'abort', 'index');

        return $form;
    }
}