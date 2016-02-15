<?php

Admin::model('App\UserProduct')->title('Юзер-Товар')->display(function ()
{
	$display = AdminDisplay::datatables();
	$display->columns([
		Column::string('id')->label('ID'),
		Column::string('user.name')->label('Юзер'),
		Column::string('product.title')->label('Товар'),
        Column::string('review')->label('Отзыв'),
        Column::string('status')->label('Статус'),
        Column::string('sum')->label('Сумма'),
        Column::string('created_at')->label('Дата'),
        Column::string('updated_at')->label('Обновлено'),
	]);
    $display->columnFilters([
        null,
        ColumnFilter::text()->placeholder('Юзер'),
        null,
        null,
        null,
        null,
        ColumnFilter::range()->from(
            ColumnFilter::date()->format('d.m.Y')->placeholder('С')
        )->to(
            ColumnFilter::date()->format('d.m.Y')->placeholder('По')
        ),
        null
    ]);
	return $display;
})->edit(function ()
{
	$form = AdminForm::form();
	$form->items([
        FormItem::select('user_id', 'Юзер')->model('App\User')->display('name')->required(),
        FormItem::select('product_id', 'Товар')->model('App\Product')->display('title')->required(),
        FormItem::text('review', 'Отзыв'),
        FormItem::select('status', 'Статус')->enum(['M', 'A', 'D', 'R'])->nullable(),
    ]);
	return $form;
})->create(function()
{
    $form = AdminForm::form();
    $form->items([
        FormItem::select('user_id', 'Юзер')->model('App\User')->display('name')->required(),
        FormItem::select('product_id', 'Товар')->model('App\Product')->display('title')->required(),
    ]);
    return $form;
});