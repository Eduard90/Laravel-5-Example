<?php

Admin::model('App\Feedback')->title('Техподдержка')->display(function ()
{
	$display = AdminDisplay::datatables();
	$display->columns([
		Column::string('id')->label('ID заявки'),
		Column::string('text')->label('Текст'),
		Column::string('user.id')->label('ID юзера'),
		Column::string('user.name')->label('Имя'),
		Column::string('created_at')->label('Дата'),
	]);
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('text', 'Текст')->required(),
		FormItem::select('user_id', 'Юзер')->model('App\User')->display('name')->required(),
	]);
	return $form;
});