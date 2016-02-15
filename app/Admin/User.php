<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

use App\Product;
use App\UserProduct;

Admin::model('App\User')->title('Пользователи')->display(function ()
{
	$display = AdminDisplay::datatables();
	$display->columns([
        Column::checkbox(),
		Column::string('id')->label('ID'),
		Column::string('name')->label('Имя'),
        Column::custom()->label('Актив.')->callback(function ($instance)
        {
            return $instance->is_active ? '&check;' : '-';
        }),
		Column::string('email')->label('Email'),
        Column::count('products')->label('Товаров')->orderable(true),
        Column::count('list_active_products')->label('Акт. товаров')->orderable(true),
        Column::string('balance')->label('Баланс'),
	]);
    $display->columnFilters([
        null,
        ColumnFilter::select()->model('App\User')->display('name'),
        null,
        null,
        null,
        null
    ]);

    $display->actions([
        Column::action('export')->value('Раздать товары')->icon('fa-share')->callback(function ($collection) {
            $max_products_per_user = config('main.max_products_per_user', 3);
            foreach($collection as $key => $user) {
                $active_products = $user->list_active_products;
                $count_active_products = count($active_products);
                if ($count_active_products >= 0 && $count_active_products < $max_products_per_user) {
                    $random_product = Product::orderByRaw("RAND()")->first();
                    try {
                        $user_product = UserProduct::create(['user_id' => $user->id, 'product_id' => $random_product->id]);
                    } catch (QueryException $e) {
                        //Nothing
                    }
                }
            }
        }),
    ]);

	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('name', 'Name')->required(),
		FormItem::text('email', 'Email')->required()->unique(),
		FormItem::password('password', 'Пароль'),
		FormItem::checkbox('is_active', 'Активность'),
	]);
	return $form;
});