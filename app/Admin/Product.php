<?php

Admin::model('App\Product')->title('Товары')->display(function ()
{
	$display = AdminDisplay::datatables();
	$display->columns([
		Column::string('id')->label('ID'),
		Column::string('title')->label('Название'),
		Column::string('ym_url')->label('ЯМ ссылка')->append(
            Column::url('ym_url')
        ),
		Column::image('image_url')->label('Ссылка на картинку'),
	]);


    $display->columnFilters([
        null,
        ColumnFilter::text()->placeholder('Товар'),
        null,
        null,
    ]);
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('title', 'Название')->required(),
		FormItem::text('ym_url', 'ЯМ ссылка')->required(),
		FormItem::text('image_url', 'Ссылка на картинку')->required(),
	]);
	return $form;
});