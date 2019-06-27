<?php

namespace App\Admin\Controllers;

use App\Garbage;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Category;

class GarbageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Garbage';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Garbage);

        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', __('Id'))->sortable()->filter('like');
        $grid->column('category_id', __('Category id'))->using(Category::all()->pluck('name', 'id')->toArray())->sortable()->filter(Category::all()->pluck('name', 'id')->toArray());
        $grid->column('name', __('Name'))->sortable()->filter('like');
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
      
      	$grid->filter(function($filter){

    		$filter->like('name', 'name');

		});

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Garbage::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('category_id', __('Category id'))->using(Category::all()->pluck('name', 'id')->toArray());
        $show->field('name', __('Name'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Garbage);

        $form->select('category_id', __('Category id'))->options(Category::all()->pluck('name', 'id'));
        $form->text('name', __('Name'));

        return $form;
    }
}
