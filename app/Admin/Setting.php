<?php

Admin::model('App\Setting')->title('Настройки')->display(function ()
{
	$display = AdminDisplay::table();
	$display->columns([
		Column::string('key')->label('Параметр'),
		Column::string('value')->label('Значение'),
	]);
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('key', 'Параметр')->required(),
		FormItem::text('value', 'Значение')->required(),
	]);
	return $form;
});